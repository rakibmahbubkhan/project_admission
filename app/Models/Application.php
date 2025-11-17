<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'student_id', 'admission_form_id', 'agent_id', 'form_data', 'status'
    ];

    protected $casts = [
        'form_data' => 'array',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function admissionForm()
    {
        return $this->belongsTo(AdmissionForm::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
