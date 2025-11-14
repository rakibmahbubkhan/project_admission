<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AgentRegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AgentApprovalController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\StudentController as AgentStudentController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\StudentController;




use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', function () {
        return view('agent.dashboard');
    })->name('agent.dashboard');
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});

Route::get('/redirect', function () {
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isAgent()) {
        return redirect()->route('agent.dashboard');
    } else {
        return redirect()->route('student.dashboard');
    }
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


Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->group(function () {
    Route::get('/agents', [AgentApprovalController::class, 'index'])->name('admin.agents.index');
    Route::post('/agents/{id}/approve', [AgentApprovalController::class, 'approve'])->name('admin.agents.approve');
    Route::post('/agents/{id}/reject', [AgentApprovalController::class, 'reject'])->name('admin.agents.reject');
});



Route::middleware(['auth', 'role:agent'])->prefix('agent')->group(function () {
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');

    // Student CRUD
    Route::resource('students', AgentStudentController::class);
});


Route::get('/student/register', [StudentRegisterController::class, 'showForm'])->name('student.register');
Route::post('/student/register', [StudentRegisterController::class, 'register'])->name('student.register.store');


Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/students', [StudentController::class, 'index'])->name('agent.students.index');
    Route::get('/agent/students/create', [StudentController::class, 'create'])->name('agent.students.create');
    Route::post('/agent/students/store', [StudentController::class, 'store'])->name('agent.students.store');
});




require __DIR__.'/auth.php';
