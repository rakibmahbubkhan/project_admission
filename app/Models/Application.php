<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'agent_id', 'admission_form_id', 'status', 'payment_status', 'remarks'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function form()
    {
        return $this->belongsTo(AdmissionForm::class, 'admission_form_id');
    }
}
