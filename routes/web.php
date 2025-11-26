<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AgentRegisterController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AgentApprovalController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\StudentController as AgentStudentController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentNotificationController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\AdmissionFormController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\AdminApplicationController;
use App\Http\Controllers\Admin\FormSubmissionController as AdminFormSubmissionController;
use App\Http\Controllers\Admin\FormSubmissionController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/agent/register', [AgentRegisterController::class, 'showRegistrationForm'])->name('agent.register');
Route::post('/agent/register', [AgentRegisterController::class, 'register'])->name('agent.register.store');

Route::get('/student/register', [StudentRegisterController::class, 'showForm'])->name('student.register');
Route::post('/student/register', [StudentRegisterController::class, 'register'])->name('student.register.store');

// Authentication routes
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        return match($user->role) {
            'super_admin' => view('super_admin.dashboard'),
            'agent' => view('agent.dashboard'),
            'student' => view('student.dashboard'),
            default => abort(403, 'Unauthorized')
        };
    })->name('dashboard');
});

// Shared auth routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/redirect', function () {
        $user = Auth::user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isAgent()) {
            return redirect()->route('agent.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->name('admin.')->group(function () {
   
   
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Agents Management
    Route::get('/agents', [AgentApprovalController::class, 'index'])->name('agents.index');
    Route::get('/agents/{id}', [AgentApprovalController::class, 'show'])->name('agents.show');
    Route::post('/agents/{id}/update-status', [AgentApprovalController::class, 'updateStatus'])->name('agents.update-status');
    Route::post('/agents/{id}/approve', [AgentApprovalController::class, 'approve'])->name('agents.approve');
    Route::post('/agents/{id}/disable', [AgentApprovalController::class, 'disable'])->name('agents.disable');
    Route::post('/agents/{id}/enable', [AgentApprovalController::class, 'enable'])->name('agents.enable');
    Route::post('/agents/{id}/reject', [AgentApprovalController::class, 'reject'])->name('agents.reject');
    
    // Universities Management
    Route::resource('universities', UniversityController::class);
    
    // Forms Management
    Route::resource('forms', AdmissionFormController::class);
    Route::post('forms/{id}/toggle-status', [AdmissionFormController::class, 'toggleStatus'])->name('forms.toggleStatus');
    
    // Applications Management
    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{id}/approve', [AdminApplicationController::class, 'approve'])->name('applications.approve');
    Route::get('/applications/{id}/reject', [AdminApplicationController::class, 'reject'])->name('applications.reject');
    
    // Submissions
    Route::get('submissions', [AdminFormSubmissionController::class, 'index'])->name('submissions');
    Route::post('submissions/{submission}/mark-paid', [AdminFormSubmissionController::class, 'markPaid'])->name('submissions.markPaid');
});

// Agent Routes
Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('dashboard');
    

    // Student management
    Route::get('agent/students', [AgentDashboardController::class, 'students'])
        ->name('students');

    Route::get('agent/students/create', [AgentDashboardController::class, 'createStudent'])
        ->name('students.create');

    Route::post('agent/students', [AgentDashboardController::class, 'storeStudent'])
        ->name('students.store');

    // View submissions of students
    Route::get('agent/submissions', [AgentDashboardController::class, 'submissions'])
        ->name('submissions');

    Route::resource('students', AgentStudentController::class);
    Route::get('/students-list', [AgentDashboardController::class, 'students'])->name('students.list');
    
    // Submissions
//     Route::get('submissions', [FormSubmissionController::class, 'agentIndex'])->name('submissions.index');
//     Route::get('submissions/{id}', [FormSubmissionController::class, 'agentView'])->name('submissions.view');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [StudentProfileController::class, 'index'])->name('profile');
    Route::get('/profile/create', [StudentProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [StudentProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [StudentProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [StudentProfileController::class, 'update'])->name('profile.update');
    
    // Forms & Applications
    

    Route::get('/forms', [StudentApplicationController::class, 'index'])->name('forms');
    Route::get('/forms/{id}', [StudentApplicationController::class, 'show'])->name('forms.show');
    Route::get('/forms/{id}/apply', [StudentApplicationController::class, 'apply'])->name('forms.apply');
    Route::post('/forms/{id}/apply', [StudentApplicationController::class, 'submit'])->name('forms.submit');

    // Route::get('/forms/{form}/apply', [StudentApplicationController::class, 'apply'])->name('forms.apply');
    // Route::post('/forms/{form}/submit', [StudentApplicationController::class, 'submit'])->name('forms.submit');
    
    // Applications History
    Route::get('/applications', [StudentApplicationController::class, 'applications'])->name('applications');
    Route::get('/submissions', [StudentApplicationController::class, 'submissions'])->name('forms.submissions');
    Route::get('/history', [StudentController::class, 'history'])->name('history');
    
    // Notifications
    Route::get('/notifications', [StudentNotificationController::class, 'index'])->name('notifications');
});