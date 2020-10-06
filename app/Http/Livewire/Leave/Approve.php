<?php

namespace App\Http\Livewire\Leave;

use Livewire\Component;

class Approve extends Component
{
    public function render()
    {
        return view('livewire.leave.approve')->layout('layouts.dashboard');
    }
}
