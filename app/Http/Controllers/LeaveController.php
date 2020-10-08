<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveYear;
use Illuminate\Http\Request;

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

    public function acc($id, $status)
    {
        $leave = Leave::find($id);
        $leave->status = $status;
        $leave->save();
        return redirect()->route('admin.user')->with('success', 'Berhasil merubah status user');
    }

    public function inputLeave(Request $request)
    {

        $request->validate([
            'nip' => 'required',
            'hari' => 'required|gte:0',
            'tahun' => 'required'
        ]);

        $leave = LeaveYear::whereEmployeeId($request->nip)->whereLeaveYear($request->tahun)->first();
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
}
