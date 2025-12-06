<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationStatusNotification; 

class FormSubmissionController extends Controller
{
    // Show all submissions
    public function index()
    {
        $submissions = FormSubmission::with('student.user', 'agent', 'form', 'university')
                                     ->latest()
                                     ->paginate(20);

        // Status definitions for the modal on index page
        $statuses = $this->getStatuses();

        return view('super_admin.submissions.index', compact('submissions', 'statuses'));
    }

    // Show single submission details for review
    public function show($id)
    {
        $submission = FormSubmission::with('student.user', 'agent', 'form', 'university')->findOrFail($id);
        $statuses = $this->getStatuses();

        return view('super_admin.submissions.show', compact('submission', 'statuses'));
    }

    // Edit submission (Correction)
    public function edit($id)
    {
        $submission = FormSubmission::with('student.user', 'form', 'university')->findOrFail($id);
        return view('super_admin.submissions.edit', compact('submission'));
    }

    // Update submission (Save Correction)
    public function update(Request $request, $id)
    {
        $submission = FormSubmission::findOrFail($id);
        
        // Update answers
        // We assume answers is passed as an array 'answers' from the form
        if ($request->has('answers')) {
            $submission->answers = $request->input('answers');
            $submission->save();
        }

        return redirect()->route('admin.submissions.index')->with('success', 'Application information updated successfully.');
    }

    // Update status and send notification
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'custom_message' => 'nullable|string',
        ]);

        $submission = FormSubmission::findOrFail($id);
        $newStatus = $request->status;
        
        $submission->status = $newStatus;
        $submission->save();

        // Notification Logic
        $userToNotify = $submission->student->user;
        $notificationText = $this->getNotificationText($newStatus, $request->custom_message);

        // Send Email
        try {
            Mail::to($userToNotify->email)->send(new ApplicationStatusNotification($submission, $notificationText));
        } catch (\Exception $e) {
            \Log::error('Failed to send application status email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', "Status updated to " . ucfirst(str_replace('_', ' ', $newStatus)) . " and notification sent.");
    }

    // Mark commission as paid
    public function markPaid(FormSubmission $submission)
    {
        $submission->commission_paid = true;
        $submission->save();

        return redirect()->back()->with('success', 'Commission marked as paid.');
    }

    // Helper: Get Status List
    private function getStatuses()
    {
        return [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'correct_and_resubmit' => 'Correct and Resubmit',
            'pay_application_fees' => 'Pay Application Fees',
            'pay_required_deposit' => 'Pay Required Deposit',
            'passed_initial_review' => 'Passed Initial Review',
            'pre_admitted' => 'Pre-Admitted',
            'admitted' => 'Admitted',
            'successful' => 'Successful',
            'rejected' => 'Rejected',
            'refunded' => 'Refunded',
        ];
    }

    // Helper: Generate notification text
    private function getNotificationText($status, $customMessage = null)
    {
        // Statuses that require custom messages typically override defaults if provided
        if ($customMessage) {
            return $customMessage;
        }

        $messages = [
            'pending' => 'Your application is currently pending review.',
            'processing' => 'Your application is being processed by our team.',
            'pay_application_fees' => 'Please pay the required application fees to proceed.',
            'passed_initial_review' => 'Congratulations! Your application has passed the initial review.',
            'pre_admitted' => 'You have been pre-admitted. Please check your dashboard for next steps.',
            'successful' => 'Your application was successful!',
            'rejected' => 'We regret to inform you that your application was rejected.',
            'refunded' => 'Your payment has been refunded.',
        ];

        return $messages[$status] ?? 'Your application status has been updated to ' . ucfirst(str_replace('_', ' ', $status));
    }
}