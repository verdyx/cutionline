<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\User;
use App\Http\Livewire\Employee;
use App\Http\Livewire\Leave\Approve;
use App\Http\Livewire\Leave\History;
use App\Http\Livewire\Leave\Input;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'web'])->group(function () {

    Route::middleware('admin')->name('admin')->prefix('admin')->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        // Route::get('/users', User::class)->name('user');
    });

    Route::middleware('employee')->name('employee')->prefix('employee')->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
    });

});
