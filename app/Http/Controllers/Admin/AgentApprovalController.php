<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AgentApprovalController extends Controller
{
    /**
     * Show all pending agents
     */
    public function index()
    {
        $agents = User::where('role', 'agent')->with('agent')->orderByDesc('created_at')->get();
        return view('admin.agents.index', compact('agents'));
    }

    /**
     * Approve agent
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'agent' && $user->status === 'pending') {
            $user->status = 'approved';
            $user->referral_code = strtoupper(Str::random(8)); // unique code
            $user->save();
        }

        return back()->with('success', 'Agent approved successfully!');
    }

    /**
     * Reject agent
     */
    public function reject($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'agent' && $user->status === 'pending') {
            $user->status = 'rejected';
            $user->save();
        }

        return back()->with('warning', 'Agent rejected.');
    }
}
