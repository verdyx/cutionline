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
        $employees = Employee::all();
        return view('leave.employee', compact('employees'));
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
            'jumlah' => 'required|gte:0'
        ]);

        $employee = Leave::whereUserId($request->nip)->first();

        LeaveYear::updateOrCreate([
            'employee_id' => $employee->id,
            'year' => $request->year,
        ], [
            'jumlah' => $request->jumlah
        ]);

        return with('success', 'Berhasil menambahkan cuti');
    }
}
