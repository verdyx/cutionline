<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('livewire.user', compact('users'));
    }

    public function viewStatus($id)
    {
        $user = User::find($id);
        return view('livewire.user-status', compact('user'));
    }

    public function changeStatus($id, $status)
    {
        $user = User::find($id);
        $user->is_active = $status;
        $user->save();

        return redirect()->route('admin.user')->with('success', 'Berhasil merubah status user');
    }
}
