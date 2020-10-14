<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Leave;
use Livewire\Component;

class Dashboard extends Component
{
    public $cuti, $approve, $waiting, $pegawai, $refuse;

    public function mount()
    {
        if (auth()->user()->role == "admin") {
            $this->cuti = Leave::all()->count();
            $this->approve = Leave::whereStatusBoss('Disetujui')->get()->count();
            $this->waiting = Leave::whereNull('status_boss')->orWhereNull('status_leader')->get()->count();
            $this->pegawai = Employee::all()->count();
        } else {
            $this->cuti = Leave::whereEmployeeId(auth()->user()->employee_id)->get()->count();
            $this->approve = Leave::whereEmployeeId(auth()->user()->employee_id)->whereStatusBoss('Disetujui')->whereStatusLeader('Disetujui')->get()->count();
            $this->waiting = Leave::whereEmployeeId(auth()->user()->employee_id)->whereNull('status_boss')->orWhereNull('status_leader')->get()->count();
            $this->refuse = Leave::whereEmployeeId(auth()->user()->employee_id)->whereStatusBoss('Tidak disetujui')->whereStatusLeader('Tidak disetujui')->get()->count();
        }

    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.dashboard');
    }
}
