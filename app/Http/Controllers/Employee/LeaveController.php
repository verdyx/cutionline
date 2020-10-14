<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveYear;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function history()
    {
        $leaves = Leave::whereEmployeeId(auth()->user()->employee_id)->orderBy('updated_at', 'desc')->get();
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
        $leave = null;

        return view('leave.input', compact('opt_cuti', 'leave'));
    }

    public function createLeave(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required|after_or_equal:' . $request->tanggal_awal,
            'jenis_cuti' => 'required',
            'alasan' => 'required|max:191',
            'alamat' => 'required',
        ]);

        $diffDay = Carbon::parse($request->tanggal_awal)->diffInDays($request->tanggal_akhir) + 1;

        $leave = Leave::create([
            'number_of_days' => $diffDay,
            'kind_of_leave' => $request->jenis_cuti,
            'from_date' => $request->tanggal_awal,
            'to_date' => $request->tanggal_akhir,
            'reason' => $request->alasan,
            'employee_id' => auth()->user()->employee_id,
            'address' => $request->alamat,
        ]);

        $leave->letter_number = 'W29.U / ' . $leave->id . ' / KP.05.2 / X / ' . Carbon::now()->year;
        $leave->save();

        return redirect()->route('employee.history')->with('success', 'Berhasil mengajukan cuti');
    }

    public function inputLeaveYear()
    {
        $leave = LeaveYear::where('employee_id', auth()->user()->employee_id)->first();
        return view('leave.input-year', compact('leave'));
    }

    public function createLeaveYear(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required|after_or_equal:' . $request->tanggal_awal,
            'alasan' => 'required|max:191',
            'alamat' => 'required',
        ]);

        $diffDay = Carbon::parse($request->tanggal_awal)->diffInDays($request->tanggal_akhir) + 1;
        $leave_year = LeaveYear::where('employee_id', auth()->user()->employee_id)->first();

        if ($leave_year) {
            if ((int)$leave_year->N < $diffDay) {
                return back()->with('error', 'Tidak boleh melebihi sisa cuti')->withInput();
            }
        } else {
            return back()->with('error', 'Anda tidak memiliki jatah cuti')->withInput();
        }

        $leave = Leave::create([
            'number_of_days' => $diffDay,
            'kind_of_leave' => 'Cuti Tahunan',
            'from_date' => $request->tanggal_awal,
            'to_date' => $request->tanggal_akhir,
            'reason' => $request->alasan,
            'employee_id' => auth()->user()->employee_id,
            'address' => $request->alamat,
        ]);

        $leave->letter_number = 'W29.U / ' . $leave->id . ' / KP.05.2 / X / ' . Carbon::now()->year;
        $leave->save();

        return redirect()->route('employee.history')->with('success', 'Berhasil mengajukan cuti');
    }

    public function edit($id)
    {
        $opt_cuti = [
            'Cuti Besar',
            'Cuti Sakit',
            'Cuti Melahirkan',
            'Cuti Karena Alasan Penting',
            'Cuti di Luar Tanggungan Negara'
        ];

        $leave = Leave::find($id);
        $this->authorize('update', $leave);
        return view('leave.input', compact('opt_cuti', 'leave'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Leave::find($id));
        $request->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required|after_or_equal:' . $request->tanggal_awal,
            'jenis_cuti' => 'required',
            'alasan' => 'required|max:191',
            'alamat' => 'required',
        ]);

        $diffDay = Carbon::parse($request->tanggal_awal)->diffInDays($request->tanggal_akhir) + 1;

        Leave::whereId($id)->update([
            'number_of_days' => $diffDay,
            'kind_of_leave' => $request->jenis_cuti,
            'from_date' => $request->tanggal_awal,
            'to_date' => $request->tanggal_akhir,
            'reason' => $request->alasan,
            'employee_id' => auth()->user()->employee_id,
            'address' => $request->alamat
        ]);

        return redirect()->route('employee.history')->with('success', 'Berhasil memperbarui pengajuan cuti');
    }

    public function destroy($id)
    {
        $leave = Leave::find($id);
        $this->authorize('delete', $leave);

        if ($leave->status) {
            return back()->with('warning', 'Maaf status tidak dapat dihapus');
        }

        $leave->delete();
        return back()->with('success', 'Berhasil menghapus pengajuan');
    }
}
