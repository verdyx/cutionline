<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveYear;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function history()
    {
        $leaves = Leave::whereUserId(auth()->id())->orderBy('updated_at', 'desc')->get();
        return view('leave.history', compact('leaves'));
    }

    public function inputLeave()
    {
        $opt_cuti = [
            'Cuti Besar',
            'Cuti Sakit',
            'Cuti Melahirkan',
            'Cuti Karena Alasan Penting',
            'Cuti di Luar Tanggungan Negara'
        ];

        return view('leave.input', compact('opt_cuti'));
    }

    public function createLeave(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required|after_or_equal:' . $request->tanggal_awal,
            'jenis_cuti' => 'required',
            'alasan' => 'required|max:191'
        ]);

        $diffDay = Carbon::parse($request->tanggal_awal)->diffInDays($request->tanggal_akhir) + 1;

        Leave::create([
            'number_of_days' => $diffDay,
            'kind_of_leave' => $request->jenis_cuti,
            'from_date' => $request->tanggal_awal,
            'to_date' => $request->tanggal_akhir,
            'reason' => $request->alasan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('employee.history')->with('success', 'Berhasil mengajukan cuti');
    }

    public function inputLeaveYear()
    {
        $tahun = Carbon::now()->year;
        $tahun_cuti = [];
        for ($i = 0; $i <= 2; $i++) {
            $leave_year = LeaveYear::where('employee_id', auth()->user()->employee->id)
                ->where('leave_year', $tahun - $i)->first();
            if ($leave_year) {
                array_push($tahun_cuti, $leave_year);
            }
        }

        return view('leave.input-year', compact('tahun_cuti'));
    }

    public function createLeaveYear(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required|after_or_equal:' . $request->tanggal_awal,
            'tahun' => 'required',
            'alasan' => 'required|max:191'
        ]);

        $diffDay = Carbon::parse($request->tanggal_awal)->diffInDays($request->tanggal_akhir) + 1;

        $leave_year = LeaveYear::find($request->tahun);
        if ($diffDay > $leave_year->day) {
            return back()->with('error', 'Tidak boleh melebihi kuota cuti');
        }
        // elseif($leave_year->leave_year != Carbon::now()->year && $diffDay > 6){
        //     return back()->with('error', 'Sisa cuti selain tahun ini tidak boleh diambil melebihi 6 hari');
        // }

        // $leave_year->day = $leave_year->day - $diffDay;
        // $leave_year->save();

        Leave::create([
            'number_of_days' => $diffDay,
            'kind_of_leave' => 'Cuti Tahunan',
            'from_date' => $request->tanggal_awal,
            'to_date' => $request->tanggal_akhir,
            'reason' => $request->alasan,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('employee.history')->with('success', 'Berhasil mengajukan cuti');
    }
}
