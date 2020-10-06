<?php

namespace App\Http\Livewire\Leave;

use Livewire\Component;

class History extends Component
{
    public function render()
    {
        return view('livewire.leave.history')->layout('layouts.dashboard');
    }
}
