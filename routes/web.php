<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\User;
use App\Http\Livewire\Employee;
use App\Http\Livewire\Leave\Approve;
use App\Http\Livewire\Leave\History;
use App\Http\Livewire\Leave\Input;
use App\Http\Livewire\Employee\Leave\Request;
use App\Http\Livewire\Employee\Leave\RequestYear;
use App\Http\Livewire\Employee\History as EmployeeHistory;
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

    Route::get('/', Dashboard::class)->name('dashboard');

    Route::middleware('admin')->name('admin.')->prefix('admin')->group(function () {
        Route::get('/user', User::class)->name('user');
        Route::get('/employee', Employee::class)->name('employee');
        Route::get('/cuti-history', History::class)->name('history');
        Route::get('/cuti-approval', Approve::class)->name('approve');
        Route::get('/cuti-input', Input::class)->name('input.leave');
    });

    Route::middleware('employee')->name('employee.')->prefix('employee')->group(function () {
        Route::get('/permohonan', Request::class)->name('leave');
        Route::get('/permohonan/tahunan', RequestYear::class)->name('leave.year');
        Route::get('/history', EmployeeHistory::class)->name('history');
    });

});
