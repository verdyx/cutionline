<?php

namespace App\Http\Livewire\Employee\Leave;

use Livewire\Component;

class Request extends Component
{
    public function render()
    {
        return view('livewire.employee.leave.request')->layout('layouts.dashboard');
    }
}
