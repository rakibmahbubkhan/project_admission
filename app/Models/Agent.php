<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'profile_image', 'company', 'nationality', 'introduction',
        'whatsapp_number', 'website', 'terms_accepted', 'establishment_date',
        'num_offices', 'num_employees', 'num_schools_in_cooperation',
        'num_students_last_year', 'trade_license', 'full_name', 'age',
        'highest_diploma', 'graduate_institution', 'occupation', 'passport_identity',
        'main_student_nationality'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }   
}

