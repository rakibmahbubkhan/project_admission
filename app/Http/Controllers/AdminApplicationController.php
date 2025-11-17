<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Commission;
use App\Mail\ApplicationApprovedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationRejectedMail;



class AdminApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['student', 'admissionForm', 'agent'])->get();
        return view('super_admin.applications.index', compact('applications'));
    }

    public function approve($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'approved';
        $application->save();

        // Generate commission for agent
        if ($application->agent_id) {
            $commissionAmount = $application->admissionForm->application_fee * 0.1; // 10% example
            Commission::create([
                'agent_id' => $application->agent_id,
                'application_id' => $application->id,
                'amount' => $commissionAmount,
                'status' => 'pending'
            ]);
        }

        
        Mail::to($application->student->user->email)
            ->send(new ApplicationApprovedMail($application));

        if ($application->agent) {
            Mail::to($application->agent->email)
                ->send(new ApplicationApprovedMail($application));
        }


        return back()->with('success', 'Application approved and commission generated.');
    }

    public function reject($id)
    {
        $application = Application::findOrFail($id);
        $application->status = 'rejected';
        $application->save();


        Mail::to($application->student->user->email)
            ->send(new ApplicationRejectedMail($application));

        if ($application->agent) {
            Mail::to($application->agent->email)
                ->send(new ApplicationRejectedMail($application));
        }

        return back()->with('success', 'Application rejected.');
    }
}

