<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Employee extends Component
{
    public function render()
    {
        return view('livewire.employee')->layout('layouts.dashboard');
    }
}
