<?php

namespace App\Http\Controllers;

use App\Models\Employee as ModelsEmployee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = ModelsEmployee::all();
        return view('livewire.employee', compact('employees'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.employee')->with('success', 'Data berhasil dihapus');
    }
}
