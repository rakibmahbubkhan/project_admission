<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentNotification;

class StudentNotificationController extends Controller
{
    public function index()
    {
        $notifications = StudentNotification::where('student_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.notifications', compact('notifications'));
    }
}
