<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'agent_id', 
        'given_name', 'surname', 'gender', 'nationality', 'religion', 'marital_status',
        'city_of_birth', 'dob', 'native_language', 'height', 'weight', 'blood_group',
        'in_china', 'in_china_from', 'in_china_institute',
        'studied_in_china', 'studied_in_china_from', 'studied_in_china_institute',
        'passport_number', 'passport_issue_date', 'passport_expiry_date',
        'street', 'city', 'country', 'zip_code', 'phone', 'email',
        'sponsor_info', 'parents_info', 'education_background', 'work_experience', 'other_info',
        'emergency_contact_number','emergency_contact_name','current_address'
    ];

    protected $casts = [
        'dob' => 'date',
        'in_china' => 'boolean',
        'in_china_from' => 'date',
        'studied_in_china' => 'boolean',
        'studied_in_china_from' => 'date',
        'passport_issue_date' => 'date',
        'passport_expiry_date' => 'date',
        'sponsor_info' => 'array',
        'parents_info' => 'array',
        'education_background' => 'array',
        'work_experience' => 'array',
        'other_info' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}