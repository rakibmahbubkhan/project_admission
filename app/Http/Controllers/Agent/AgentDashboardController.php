<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $agent = Auth::user()->agent;
        $students = $agent->students()->latest()->take(5)->get();

        return view('agent.dashboard', compact('agent', 'students'));
    }
}
