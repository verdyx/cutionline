<?php

namespace App\Http\Livewire\Leave;

use Livewire\Component;

class Input extends Component
{
    public function render()
    {
        return view('livewire.leave.input')->layout('layouts.dashboard');
    }
}
