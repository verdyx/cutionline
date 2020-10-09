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
        if (auth()->user()->role == "Admin") {
            $this->cuti = Leave::all()->count();
            $this->approve = Leave::whereStatus('Disetujui')->get()->count();
            $this->waiting = Leave::whereNull('status')->get()->count();
            $this->pegawai = Employee::all()->count();
        } else {
            $this->cuti = Leave::whereUserId(auth()->id())->get()->count();
            $this->approve = Leave::whereUserId(auth()->id())->whereStatus('Disetujui')->get()->count();
            $this->waiting = Leave::whereUserId(auth()->id())->whereNull('status')->get()->count();
            $this->refuse = Leave::whereUserId(auth()->id())->whereStatus('Tidak disetujui')->get()->count();
        }

    }

    public function render()
    {
        return view('livewire.dashboard')->layout('layouts.dashboard');
    }
}
