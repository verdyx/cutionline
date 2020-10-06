<?php

namespace App\Http\Livewire\Employee\Leave;

use Livewire\Component;

class RequestYear extends Component
{
    public function render()
    {
        return view('livewire.employee.leave.request-year')->layout('layouts.dashboard');
    }
}
