<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgentApprovalController extends Controller
{
    
    public function index()
    {
        $agents = User::where('role', 'agent')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('super_admin.agents.index', compact('agents'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'agent') {
            $user->status = 'approved';
            
            // Generate referral code only if it doesn't exist
            if (empty($user->referral_code)) {
                $user->referral_code = strtoupper(Str::random(8));
            }
            
            $user->save();

            return back()->with('success', 'Agent approved successfully!');
        }

        return back()->with('error', 'Invalid agent or action');
    }

    public function disable($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'agent' && $user->status === 'approved') {
            $user->status = 'disabled';
            $user->save();

            return back()->with('success', 'Agent disabled successfully!');
        }

        return back()->with('error', 'Invalid agent or action');
    }

    public function enable($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'agent' && $user->status === 'disabled') {
            $user->status = 'approved';
            $user->save();

            return back()->with('success', 'Agent enabled successfully!');
        }

        return back()->with('error', 'Invalid agent or action');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'agent') {
            $user->status = 'rejected';
            $user->save();

            return back()->with('success', 'Agent rejected successfully!');
        }

        return back()->with('error', 'Invalid agent or action');
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role !== 'agent') {
            return back()->with('error', 'Invalid agent');
        }

        $newStatus = $request->input('status');
        $validStatuses = ['pending', 'approved', 'disabled', 'rejected'];

        if (!in_array($newStatus, $validStatuses)) {
            return back()->with('error', 'Invalid status');
        }

        // Generate referral code when approving
        if ($newStatus === 'approved' && empty($user->referral_code)) {
            $user->referral_code = strtoupper(Str::random(8));
        }

        $user->status = $newStatus;
        $user->save();

        $statusMessages = [
            'pending' => 'Agent status changed to pending',
            'approved' => 'Agent approved successfully!',
            'disabled' => 'Agent disabled successfully!',
            'rejected' => 'Agent rejected successfully!'
        ];

        return back()->with('success', $statusMessages[$newStatus]);
    }

}
