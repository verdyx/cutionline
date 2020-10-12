<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveYear;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::whereNull('status')->get();
        return view('leave.index', compact('leaves'));
    }

    public function history()
    {
        $leaves = Leave::whereNotNull('status')->get();
        return view('leave.history', compact('leaves'));
    }

    public function employee()
    {
        $leaves = LeaveYear::all();
        $employees = Employee::all();
        return view('leave.employee', compact('leaves', 'employees'));
    }

    public function detail($id)
    {
        $leave = Leave::find($id);
        $opt_acc = ['Disetujui', 'Tidak disetujui', 'Perubahan', 'Ditangguhkan'];
        $opt_sign = Employee::whereIsCore(1)->get();
        return view('leave.detail', compact('leave', 'opt_acc', 'opt_sign'));
    }

    public function acc($id, Request $request)
    {
        $request->validate([
            'approval' => 'required',
            'nomor_surat' => 'required',
            'penandatangan' => 'required',
            'sebagai' => 'required',
        ]);

        $leave = Leave::find($id);
        $leave->status = $request->approval;
        $leave->letter_number = 'W29.U / ' . $request->nomor_surat . ' / KP.05.2 / X / ' . Carbon::now()->year;
        $leave->signature_id = $request->penandatangan;
        $leave->as_signature = $request->sebagai;

        if ($request->approval == "Disetujui" && $leave->kind_of_leave == "Cuti Tahunan") {
            $ly = LeaveYear::where('employee_id', $leave->user->employee->id)->where('leave_year', $leave->leave_year)->first();
            // $ly->day = $ly->day + $leave->number_of_days;
            // $leave_year = LeaveYear::find($request->tahun);
            if ($leave->number_of_day > $ly->day) {
                return back()->with('error', 'Tidak boleh melebihi kuota cuti');
            }
            // elseif($ly->leave_year != Carbon::now()->year && $leave->number_of_day > 6){
            //     return back()->with('error', 'Sisa cuti selain tahun ini tidak boleh diambil melebihi 6 hari');
            // }
            $ly->day = $ly->day - $leave->number_of_day;
            $ly->save();
        }

        $leave->save();
        return redirect()->route('admin.approves')->with('success', 'Berhasil approve cuti');
    }

    public function inputLeave(Request $request)
    {

        $request->validate([
            'nip' => 'required',
            'hari' => 'required|gte:0',
            'tahun' => 'required'
        ]);

        $leave = LeaveYear::where('employee_id', $request->nip)->where('leave_year', $request->tahun)->first();
        if ($leave) {
            $leave->day = $leave->day + $request->hari;
            $leave->save();
        } else {
            LeaveYear::create([
                'employee_id' => $request->nip,
                'leave_year' => $request->tahun,
                'day' => $request->hari
            ]);
        }

        return back()->with('success', 'Berhasil menambahkan cuti');
    }

    public function deleteLeave($id)
    {
        LeaveYear::destroy($id);
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function printLetter($id)
    {
        $leave = Leave::findOrFail($id);
        $templateProcessor = new TemplateProcessor('word-template/surat-cuti.docx');
        $templateProcessor->setValue('nomor_surat', $leave->letter_number);
        $templateProcessor->setValue('nama', $leave->user->name);
        $templateProcessor->setValue('nip', $leave->user->username);
        $templateProcessor->setValue('pangkat', $leave->user->employee->rank);
        $templateProcessor->setValue('jabatan', $leave->user->employee->position);
        $templateProcessor->setValue('hari', $leave->number_of_days);
        $templateProcessor->setValue('tanggal_awal', $leave->from_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('tanggal_akhir', $leave->to_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('tanggal', Carbon::now()->translatedFormat('d F Y'));
        $templateProcessor->setValue('sebagai', ucwords($leave->as_signature));
        $templateProcessor->setValue('penandatangan', $leave->signature->name);

        $fileName = 'Cuti ' . $leave->user->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function printRequest($id)
    {
        $leave = Leave::findOrFail($id);
        $opt_acc = ['Disetujui', 'Tidak disetujui', 'Perubahan', 'Ditangguhkan'];
        $opt_cuti = [
            'Cuti Tahunan',
            'Cuti Besar',
            'Cuti Sakit',
            'Cuti Melahirkan',
            'Cuti Karena Alasan Penting',
            'Cuti di Luar Tanggungan Negara'
        ];

        $tahun = Carbon::now()->year;

        $templateProcessor = new TemplateProcessor('word-template/permohonan-cuti.docx');
        $templateProcessor->setValue('nomor_surat', $leave->letter_number);
        $templateProcessor->setValue('nama', $leave->user->name);
        $templateProcessor->setValue('nip', $leave->user->username);
        $templateProcessor->setValue('pangkat', $leave->user->employee->rank);
        $templateProcessor->setValue('jabatan', $leave->user->employee->position);
        $templateProcessor->setValue('hari', $leave->number_of_days);
        $templateProcessor->setValue('tanggal_awal', $leave->from_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('tanggal_akhir', $leave->to_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('tanggal', Carbon::now()->translatedFormat('d F Y'));
        $templateProcessor->setValue('alasan', $leave->reason);
        $templateProcessor->setValue('sebagai', ucwords($leave->as_signature));
        $templateProcessor->setValue('penandatangan', $leave->signature->name);

        for ($i = 0; $i < 6; $i++) {
            if ($leave->kind_of_leave == $opt_cuti[$i]) {
                $templateProcessor->setValue('cuti' . ($i + 1), '√');
            } else {
                $templateProcessor->setValue('cuti' . ($i + 1), ' ');
            }
        }

        for ($i = 0; $i <= 2; $i++) {
            $leave_year = LeaveYear::whereEmployeeId($leave->user->employee->id)
                ->where('leave_year', $tahun - $i)->first();
            if ($leave_year) {
                $templateProcessor->setValue('n' . $i, $leave_year->day);
            } else {
                $templateProcessor->setValue('n' . $i, ' ');
            }
        }

        for ($i = 0; $i < 4; $i++) {
            if ($leave->status == $opt_acc[$i]) {
                $templateProcessor->setValue('status' . ($i + 1), '√');
            } else {
                $templateProcessor->setValue('status' . ($i + 1), ' ');
            }
        }

        $fileName = 'Permohonan Cuti ' . $leave->user->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
