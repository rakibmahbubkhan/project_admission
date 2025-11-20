<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    /**
     * Display all agents (Pending + Approved)
     */
    public function index()
    {
        $pendingAgents = User::where('role', 'agent')->where('status', 'pending')->with('agent')->latest()->get();
        $approvedAgents = User::where('role', 'agent')->where('status', 'approved')->with('agent')->latest()->get();

        return view('super_admin.agents.index', compact('pendingAgents', 'approvedAgents'));
    }

    /**
     * Show details of a specific agent
     */
    public function show($id)
    {
        $agentUser = User::with('agent')->findOrFail($id);
        return view('super_admin.agents.show', compact('agentUser'));
    }

    /**
     * Approve agent & generate referral code
     */
    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);

            if ($user->status === 'approved') {
                return;
            }

            // Generate referral code (e.g., AGT-2025-001)
            $latestId = User::where('role', 'agent')->whereNotNull('referral_code')->count() + 1;
            $referralCode = 'AGT-' . date('Y') . '-' . str_pad($latestId, 3, '0', STR_PAD_LEFT);

            $user->update([
                'status' => 'approved',
                'referral_code' => $referralCode,
            ]);
        });

        return redirect()->back()->with('success', 'Agent approved successfully and referral code generated.');
    }

    /**
     * Reject / Delete Agent
     */
    public function destroy($id)
    {
        $user = User::with('agent')->findOrFail($id);
        if ($user->agent) {
            $user->agent->delete();
        }
        $user->delete();

        return redirect()->back()->with('success', 'Agent record deleted successfully.');
    }
}
