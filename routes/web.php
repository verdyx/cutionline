<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Form\EditEmployee;
use App\Http\Livewire\Form\Employee as FormEmployee;
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
    Route::get('/cetak-surat/{id}', [LeaveController::class, 'printLetter'])->name('leave.print.letter');
    Route::get('/cetak-permohonan/{id}', [LeaveController::class, 'printRequest'])->name('leave.print.req');

    Route::middleware('admin')->name('admin.')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/{id}', [UserController::class, 'viewStatus'])->name('user.status');
        Route::put('/user/{id}/{status}', [UserController::class, 'changeStatus'])->name('user.status.change');

        Route::get('/employee', [EmployeeController::class, 'index'])->name('employee');
        Route::delete('/h/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        Route::get('/f/employee', FormEmployee::class)->name('form.employee');
        Route::get('/employee/{id}', EditEmployee::class)->name('employee.detail');

        Route::get('/cuti-history', [LeaveController::class, 'history'])->name('history');
        Route::get('/cuti-approval', [LeaveController::class, 'index'])->name('approves');
        Route::get('/cuti-approval/{id}', [LeaveController::class, 'detail'])->name('approve');
        Route::put('/cuti-approval/{id}', [LeaveController::class, 'acc'])->name('approve.update');

        Route::get('/cuti-input', [LeaveController::class, 'employee'])->name('input.leave');
        Route::post('/cuti-input', [LeaveController::class, 'inputLeave'])->name('create.leave.employee');
        Route::put('/cuti-input/{id}', [LeaveController::class, 'resetLeave'])->name('reset.leave.employee');
        // Route::delete('/cuti-input/{id}', [LeaveController::class, 'deleteLeave'])->name('destroy.leave.employee');
    });

    Route::middleware('employee')->name('employee.')->group(function () {
        Route::get('/permohonan', [EmployeeLeaveController::class, 'inputLeave'])->name('leave');
        Route::post('/permohonan', [EmployeeLeaveController::class, 'createLeave'])->name('create.leave');
        Route::get('/permohonan/{id}', [EmployeeLeaveController::class, 'edit'])->name('edit.leave');
        Route::put('/permohonan/{id}', [EmployeeLeaveController::class, 'update'])->name('update.leave');
        Route::delete('/permohonan/{id}', [EmployeeLeaveController::class, 'destroy'])->name('destroy.leave');

        Route::get('/permohonan-tahunan', [EmployeeLeaveController::class, 'inputLeaveYear'])->name('leave.year');
        Route::post('/permohonan-tahunan', [EmployeeLeaveController::class, 'createLeaveYear'])->name('create.leave.year');

        Route::middleware('can:boss,leader')->group(function () {
            Route::get('/verifikasi', [LeaveController::class, 'index'])->name('leave.acc.view');
            Route::get('/verifikasi/{id}', [LeaveController::class, 'detail'])->name('leave.detail');
            Route::put('/verifikasi/{id}', [LeaveController::class, 'acc'])->name('leave.acc');
        });

        Route::get('/history', [EmployeeLeaveController::class, 'history'])->name('history');
    });
});
