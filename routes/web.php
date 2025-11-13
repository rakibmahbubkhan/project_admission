<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AgentRegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AgentController;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Route::get('/admin', [AdminController::class, 'index'])->middleware('role:super_admin');

Route::get('/agent/register', [AgentRegisterController::class, 'showRegistrationForm'])->name('agent.register');
Route::post('/agent/register', [AgentRegisterController::class, 'register'])->name('agent.register.store');



Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
    Route::get('/agents/{id}', [AgentController::class, 'show'])->name('agents.show');
    Route::post('/agents/{id}/approve', [AgentController::class, 'approve'])->name('agents.approve');
    Route::delete('/agents/{id}', [AgentController::class, 'destroy'])->name('agents.destroy');
});


require __DIR__.'/auth.php';
