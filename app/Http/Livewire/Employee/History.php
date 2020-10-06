<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;

class History extends Component
{
    public function render()
    {
        return view('livewire.employee.history')->layout('layouts.dashboard');
    }
}
