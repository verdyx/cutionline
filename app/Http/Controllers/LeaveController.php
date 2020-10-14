<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveYear;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LeaveController extends Controller
{


    /**
     * Verifikasi cuti
     */

    public function index()
    {
        if (auth()->user()->employee->is_leader == 0) {
            $employees = auth()->user()->employee->employees;
            $employees_id = [];
            foreach ($employees as $key => $value) {
                array_push($employees_id, $value->id);
            }
            $leaves = Leave::whereNull('status_boss')->whereIn('employee_id', $employees_id)->get();
        } else {
            $leaves = Leave::where('status_boss', 'Disetujui')->whereNull('status_leader')->get();
        }

        return view('leave.index', compact('leaves'));
    }

    public function history()
    {
        $leaves = Leave::whereNotNull('status_boss')->whereNotNull('status_leader')->get();
        return view('leave.history', compact('leaves'));
    }

    public function detail($id)
    {
        $leave = Leave::find($id);
        $opt_acc = ['Disetujui', 'Tidak disetujui', 'Perubahan', 'Ditangguhkan'];
        return view('leave.detail', compact('leave', 'opt_acc'));
    }

    public function acc($id, Request $request)
    {
        $request->validate([
            'approval' => 'required',
        ]);

        $leave = Leave::find($id);

        if (auth()->user()->employee->is_leader == 0) {
            $leave->status_boss = $request->approval;
        } else {
            $leave->status_leader = $request->approval;
        }

        $leave->save();
        return redirect()->route('employee.leave.acc.view')->with('success', 'Berhasil approve cuti');
    }


    /**
     * Input data tahunan
     */

    public function employee()
    {
        $leaves = LeaveYear::all();
        $employees = Employee::all();
        return view('leave.employee', compact('leaves', 'employees'));
    }

    public function inputLeave(Request $request)
    {

        $request->validate([
            'nip' => 'required',
            'N2' => 'required|gte:0',
            'N1' => 'required|gte:0',
            'N' => 'required|gte:0',
        ]);

        $leave = LeaveYear::where('employee_id', $request->nip)->first();
        if ($leave) {
            $leave->N2 = $request->t2;
            $leave->N1 = $request->t1;
            $leave->N = $request->t;
            $leave->save();
        } else {
            LeaveYear::create([
                'employee_id' => $request->nip,
                'N2' => $request->N2,
                'N1' => $request->N1,
                'N' => $request->N,
            ]);
        }

        return back()->with('success', 'Berhasil menambahkan cuti');
    }

    public function resetLeave($id)
    {
        $leave = LeaveYear::find($id);
        $leave->T = 0;
        $leave->save();

        return back()->with('success', 'Berhasil mereset cuti');
    }


    /**
     * Fungsi cetak
     */

    public function printLetter($id)
    {
        $leave = Leave::findOrFail($id);
        $templateProcessor = new TemplateProcessor('word-template/surat-cuti.docx');
        $templateProcessor->setValue('nomor_surat', $leave->letter_number);
        $templateProcessor->setValue('nama', $leave->employee->name);
        $templateProcessor->setValue('nip', $leave->employee->username);
        $templateProcessor->setValue('pangkat', $leave->employee->rank);
        $templateProcessor->setValue('jabatan', $leave->employee->position);
        $templateProcessor->setValue('hari', $leave->number_of_days);
        $templateProcessor->setValue('tanggal_awal', $leave->from_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('tanggal_akhir', $leave->to_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('tanggal', Carbon::now()->translatedFormat('d F Y'));

        $leader = Employee::where('is_leader', 1)->first();
        $templateProcessor->setValue('jabatan_ketua', ucwords($leader->position));
        $templateProcessor->setValue('nama_ketua', $leader->name);

        $fileName = 'Cuti ' . $leave->employee->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }

    public function printRequest($id)
    {
        $leave = Leave::findOrFail($id);
        $this->authorize('update', $leave);
        $opt_acc = ['Disetujui', 'Tidak disetujui', 'Perubahan', 'Ditangguhkan'];
        $opt_cuti = [
            'Cuti Tahunan',
            'Cuti Besar',
            'Cuti Sakit',
            'Cuti Melahirkan',
            'Cuti Karena Alasan Penting',
            'Cuti di Luar Tanggungan Negara'
        ];

        $templateProcessor = new TemplateProcessor('word-template/permohonan-cuti.docx');
        $templateProcessor->setValue('nomor_surat', $leave->letter_number);
        $templateProcessor->setValue('nama', $leave->employee->name);
        $templateProcessor->setValue('nip', $leave->employee->username);
        $templateProcessor->setValue('pangkat', $leave->employee->rank);
        $templateProcessor->setValue('jabatan', $leave->employee->position);
        $templateProcessor->setValue('telepon', $leave->employee->phone);
        $templateProcessor->setValue('hari', $leave->number_of_days);
        $templateProcessor->setValue('tanggal_awal', $leave->from_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('tanggal_akhir', $leave->to_date->translatedFormat('d F Y'));
        $templateProcessor->setValue('masa_kerja', Carbon::createFromDate($leave->employee->tmt_cpns->year, $leave->employee->tmt_cpns->month)->diff(Carbon::now())->format('%y tahun, %m bulan'));
        $templateProcessor->setValue('tanggal', Carbon::now()->translatedFormat('d F Y'));
        $templateProcessor->setValue('alasan', $leave->reason);
        $templateProcessor->setValue('alamat_cuti', $leave->address);
        $templateProcessor->setValue('jabatan_atasan', ucwords($leave->employee->boss->position));
        $templateProcessor->setValue('atasan', $leave->employee->boss->name);

        $leave_year = LeaveYear::where('employee_id', $leave->employee_id)->first();
        if ($leave_year) {
            $templateProcessor->setValue('n2', $leave_year->N2);
            $templateProcessor->setValue('n1', $leave_year->N1);
            $templateProcessor->setValue('n', $leave_year->N);
        } else {
            $templateProcessor->setValue('n2', '');
            $templateProcessor->setValue('n1', '');
            $templateProcessor->setValue('n', '');
        }

        $leader = Employee::where('is_leader', 1)->first();
        $templateProcessor->setValue('jabatan_ketua', ucwords($leader->position));
        $templateProcessor->setValue('nama_ketua', $leader->name);

        for ($i = 0; $i < 6; $i++) {
            if ($leave->kind_of_leave == $opt_cuti[$i]) {
                $templateProcessor->setValue('cuti' . ($i + 1), '√');
            } else {
                $templateProcessor->setValue('cuti' . ($i + 1), ' ');
            }
        }

        for ($i = 0; $i < 4; $i++) {
            if ($leave->status_boss == $opt_acc[$i]) {
                $templateProcessor->setValue('status' . ($i + 1), '√');
            } else {
                $templateProcessor->setValue('status' . ($i + 1), ' ');
            }
        }

        for ($i = 0; $i < 4; $i++) {
            if ($leave->status_leader == $opt_acc[$i]) {
                $templateProcessor->setValue('status-' . ($i + 1), '√');
            } else {
                $templateProcessor->setValue('status-' . ($i + 1), ' ');
            }
        }

        $fileName = 'Permohonan Cuti ' . $leave->employee->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
