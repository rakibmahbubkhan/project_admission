<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    // Show all submissions
    public function index()
    {
        $submissions = FormSubmission::with('student.user', 'agent', 'form', 'university')
                                     ->latest()
                                     ->get();

        return view('super_admin.submissions.index', compact('submissions'));
    }

    // Mark commission as paid
    public function markPaid(FormSubmission $submission)
    {
        $submission->commission_paid = true;
        $submission->save();

        return redirect()->back()->with('success', 'Commission marked as paid.');
    }
}
