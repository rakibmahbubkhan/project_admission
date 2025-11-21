<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('super_admin.dashboard');
    }

    public function agent()
    {
        return view('agent.dashboard');
    }

    public function student()
    {
        return view('student.dashboard');
    }
}

