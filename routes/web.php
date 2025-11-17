<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AgentRegisterController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AgentApprovalController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\StudentController as AgentStudentController;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\AdmissionFormController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\AdminApplicationController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('super_admin.dashboard');
    })->name('super_admin.dashboard');
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

Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/forms', [StudentController::class, 'forms'])
        ->name('student.forms');

});


Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('/student/applications', [StudentController::class, 'applications'])
        ->name('student.applications');

});

Route::get('/redirect', function () {
    $user = Auth::user();
    if ($user->isAdmin()) {
        return redirect()->route('super_admin.dashboard');
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


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});


Route::middleware(['auth', 'role:super_admin'])->group(function () {

    Route::get('/admin/universities',      [UniversityController::class, 'index'])->name('admin.universities.index');
    Route::get('/admin/universities/create',[UniversityController::class, 'create'])->name('admin.universities.create');
    Route::post('/admin/universities/store',[UniversityController::class, 'store'])->name('admin.universities.store');
    Route::get('/admin/universities/edit/{id}',[UniversityController::class, 'edit'])->name('admin.universities.edit');
    Route::post('/admin/universities/update/{id}',[UniversityController::class, 'update'])->name('admin.universities.update');
    Route::delete('/admin/universities/delete/{id}',[UniversityController::class, 'destroy'])->name('admin.universities.delete');

});

Route::middleware(['auth', 'role:super_admin'])->group(function () {

    Route::get('/admin/forms', [AdmissionFormController::class, 'index'])->name('admin.forms.index');
    Route::get('/admin/forms/create', [AdmissionFormController::class, 'create'])->name('admin.forms.create');
    Route::post('/admin/forms/store', [AdmissionFormController::class, 'store'])->name('admin.forms.store');

});


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/forms', [StudentApplicationController::class, 'index'])->name('student.forms');
    Route::get('/student/forms/{id}', [StudentApplicationController::class, 'show'])->name('student.forms.show');
    Route::post('/student/forms/{id}/submit', [StudentApplicationController::class, 'submit'])->name('student.forms.submit');
    Route::get('/student/applications', [StudentApplicationController::class, 'applications'])->name('student.applications');
});

Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
Route::get('/student/applications', [StudentController::class, 'applications'])->name('student.applications');
Route::get('/student/history', [StudentController::class, 'history'])->name('student.history');
Route::get('/student/notifications', [StudentController::class, 'notifications'])->name('student.notifications');


Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/admin/applications', [AdminApplicationController::class, 'index'])->name('admin.applications.index');
    Route::get('/admin/applications/{id}/approve', [AdminApplicationController::class, 'approve'])->name('admin.applications.approve');
    Route::get('/admin/applications/{id}/reject', [AdminApplicationController::class, 'reject'])->name('admin.applications.reject');
});


Route::middleware(['auth', 'role:super-admin'])->group(function () {

    // Universities
    Route::resource('universities', UniversityController::class);

    // Admission Forms
    // Route::resource('forms', AdmissionFormController::class);
Route::resource('forms', AdmissionFormController::class)
     ->names('admin.forms')
     ->middleware(['auth','role:super_admin']);

    // Publish/Unpublish Form
    Route::post('forms/{id}/toggle-status', 
        [AdmissionFormController::class, 'toggleStatus'])
        ->name('forms.toggleStatus');
});


// Student applies to a form
Route::middleware(['auth', 'role:student'])->group(function () {

    Route::get('student/apply/{form_id}', 
        [FormSubmissionController::class, 'showForm'])
        ->name('student.form.show');

    Route::post('student/apply/{form_id}', 
        [FormSubmissionController::class, 'submitForm'])
        ->name('student.form.submit');
});

// Agent – View Submitted Forms
Route::middleware(['auth', 'role:agent'])->group(function () {

    Route::get('agent/submissions', 
        [FormSubmissionController::class, 'agentIndex'])
        ->name('agent.submissions.index');

    Route::get('agent/submissions/{id}', 
        [FormSubmissionController::class, 'agentView'])
        ->name('agent.submissions.view');
});


Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('student/dashboard', [StudentDashboardController::class, 'index'])
        ->name('student.dashboard');
});




Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('agent/dashboard', [AgentDashboardController::class, 'index'])
        ->name('agent.dashboard');

    // Student management
    Route::get('agent/students', [AgentDashboardController::class, 'students'])
        ->name('agent.students');

    Route::get('agent/students/create', [AgentDashboardController::class, 'createStudent'])
        ->name('agent.students.create');

    Route::post('agent/students', [AgentDashboardController::class, 'storeStudent'])
        ->name('agent.students.store');

    // View submissions of students
    Route::get('agent/submissions', [AgentDashboardController::class, 'submissions'])
        ->name('agent.submissions');
});

Route::middleware(['auth', 'role:super_admin'])->prefix('admin')->group(function () {
    
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('super_admin.dashboard');

    // Universities
    Route::resource('universities', UniversityController::class);

    // Admission Forms
    Route::resource('forms', AdmissionFormController::class);
    
    // Agents
    Route::resource('agents', AgentController::class);
    Route::post('agents/{agent}/approve', [AgentController::class, 'approve'])->name('agents.approve');

    // View all submissions
    Route::get('submissions', [FormSubmissionController::class, 'index'])->name('admin.submissions');

    // Manage Commissions
    Route::post('submissions/{submission}/mark-paid', [FormSubmissionController::class, 'markPaid'])->name('admin.submissions.markPaid');
});
