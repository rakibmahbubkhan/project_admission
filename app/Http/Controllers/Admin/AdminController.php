<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\FormSubmission;
use App\Models\AdmissionForm;
use App\Models\University;

class AdminController extends Controller
{
    public function dashboard()
    {
        $total_agents = User::where('role', 'agent')->count();
        $total_students = Student::count();
        $total_forms = AdmissionForm::count();
        $total_submissions = FormSubmission::count();
        $total_commission = FormSubmission::sum('commission');
        $paid_commission = FormSubmission::where('commission_paid', true)->sum('commission');

        return view('super_admin.dashboard', compact(
            'total_agents',
            'total_students',
            'total_forms',
            'total_submissions',
            'total_commission',
            'paid_commission'
        ));
    }
}

