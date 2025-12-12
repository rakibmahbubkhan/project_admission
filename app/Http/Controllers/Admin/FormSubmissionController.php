<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use App\Mail\ApplicationStatusNotification; 

class FormSubmissionController extends Controller
{
    public function index()
    {
        $submissions = FormSubmission::with('student.user', 'agent', 'form', 'university')
                                     ->latest()
                                     ->paginate(20);
        $statuses = $this->getStatuses();
        return view('super_admin.submissions.index', compact('submissions', 'statuses'));
    }

    public function show($id)
    {
        $submission = FormSubmission::with('student.user', 'agent', 'form', 'university')->findOrFail($id);
        $statuses = $this->getStatuses();
        return view('super_admin.submissions.show', compact('submission', 'statuses'));
    }

    public function edit($id)
    {
        $submission = FormSubmission::with('student.user', 'form', 'university')->findOrFail($id);
        return view('super_admin.submissions.edit', compact('submission'));
    }

    
    public function update(Request $request, $id)
    {
        $submission = FormSubmission::findOrFail($id);
        
        // 1. Get Existing Data
        $currentAnswers = $submission->answers ?? [];
        $existingDocs = $currentAnswers['documents'] ?? [];

        if ($request->has('answers')) {
            $currentAnswers = array_replace_recursive($currentAnswers, $request->input('answers'));
        }

        $newDocuments = $this->processDocuments($request, $submission->id);

        $mergedDocuments = $existingDocs;
        
        foreach ($newDocuments as $key => $paths) {
            if (!empty($paths)) {
                if (!isset($mergedDocuments[$key]) || !is_array($mergedDocuments[$key])) {
                    $mergedDocuments[$key] = [];
                }
                $mergedDocuments[$key] = array_merge($mergedDocuments[$key], $paths);
            }
        }

        $currentAnswers['documents'] = $mergedDocuments;

        $submission->answers = $currentAnswers;
        $submission->save();

        return redirect()->route('admin.submissions.show', $id)
                         ->with('success', 'Application information and documents updated successfully.');
    }

    private function processDocuments(Request $request, $submissionId)
    {
        $paths = [];
        
        $allFiles = $request->allFiles();
        $documentInput = $allFiles['documents'] ?? [];

        foreach ($documentInput as $key => $content) {
            $filesToProcess = is_array($content) ? $content : [$content];

            foreach ($filesToProcess as $file) {
                if ($file instanceof UploadedFile && $file->isValid()) {
                    $path = $file->store("documents/{$submissionId}/{$key}", 'public');
                    
                    $paths[$key][] = 'storage/' . $path;
                }
            }
        }
        
        return $paths;
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'custom_message' => 'nullable|string',
        ]);

        $submission = FormSubmission::with(['student.user', 'university'])->findOrFail($id);
        $newStatus = $request->status;
        
        $submission->status = $newStatus;
        $submission->save();

        // Notification Logic
        if ($submission->student && $submission->student->user) {
            $userToNotify = $submission->student->user;
            $notificationText = $this->getNotificationText($newStatus, $request->custom_message);

            try {
                Mail::to($userToNotify->email)->send(new ApplicationStatusNotification($submission, $notificationText));
            } catch (\Exception $e) {
                Log::error('Failed to send application status email: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', "Status updated to " . ucfirst(str_replace('_', ' ', $newStatus)) . ".");
    }

    public function markPaid(FormSubmission $submission)
    {
        $submission->commission_paid = true;
        $submission->save();
        return redirect()->back()->with('success', 'Commission marked as paid.');
    }

    private function getStatuses()
    {
        return [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'draft' => 'Correct and Resubmit',
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

    private function getNotificationText($status, $customMessage = null)
    {
        if (!empty($customMessage)) {
            return $customMessage;
        }

        $messages = [
            'pending' => 'Your application is currently pending review.',
            'processing' => 'Your application is being processed by our team.',
            'draft' => 'Your application requires corrections. Please log in to edit and resubmit.',
            'pay_application_fees' => 'Please pay the required application fees to proceed.',
            'pay_required_deposit' => 'Please pay the required deposit to secure your admission.',
            'passed_initial_review' => 'Congratulations! Your application has passed the initial review.',
            'pre_admitted' => 'You have been pre-admitted. Please check your dashboard for next steps.',
            'admitted' => 'Congratulations! You have been officially admitted.',
            'successful' => 'Your application was successful!',
            'rejected' => 'We regret to inform you that your application was rejected.',
            'refunded' => 'Your payment has been refunded.',
        ];

        return $messages[$status] ?? 'Your application status has been updated to ' . ucfirst(str_replace('_', ' ', $status));
    }
}