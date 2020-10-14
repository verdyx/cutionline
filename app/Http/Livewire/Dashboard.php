<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Leave;
use Livewire\Component;

class Dashboard extends Component
{
    public $cuti, $approve, $waiting, $pegawai, $refuse, $waiting_list;

    public function mount()
    {
        if (auth()->user()->role == "admin") {
            $this->cuti = Leave::all()->count();
            $this->approve = Leave::whereStatusBoss('Disetujui')->count();
            $this->waiting = Leave::whereNull('status_boss')->orWhereNull('status_leader')->count();
            $this->pegawai = Employee::all()->count();
        } else {
            $this->cuti = Leave::whereEmployeeId(auth()->user()->employee_id)->count();
            $this->approve = Leave::whereEmployeeId(auth()->user()->employee_id)->whereStatusBoss('Disetujui')->whereStatusLeader('Disetujui')->count();
            $this->waiting = Leave::whereEmployeeId(auth()->user()->employee_id)->whereNull('status_boss')->whereNull('status_leader')->count();
            $this->refuse = Leave::whereEmployeeId(auth()->user()->employee_id)->whereStatusBoss('Tidak disetujui')->whereStatusLeader('Tidak disetujui')->count();

            if (auth()->user()->employee->is_leader == 1) {
                $this->waiting_list = Leave::whereNotNull('status_boss')->whereNull('status_leader')->count();
            } else {
                $employees = auth()->user()->employee->employees;
                $employees_id = [];
                foreach ($employees as $value) {
                    array_push($employees_id, $value->id);
                }
                $this->waiting_list = Leave::whereNull('status_boss')->whereIn('employee_id', $employees_id)->count();
            }

        }
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.dashboard');
    }
}
