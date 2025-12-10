<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
        'student_id',
        'agent_id',
        'university_id',
        'form_id',
        'answers',
        'status',
        'commission',
        'commission_paid',
    ];

    protected $casts = [
        'answers' => 'array',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function form()
    {
        return $this->belongsTo(AdmissionForm::class, 'form_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id');
    }

}
