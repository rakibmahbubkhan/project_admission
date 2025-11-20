<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionForm extends Model
{
    use HasFactory;

    protected $table = 'admission_forms'; // VERY IMPORTANT

    protected $fillable = [
        'university_id',
        'title',
        'description',
        'form_fields',
        'application_fee',
        'isPublished',
        'isActive'
    ];

    protected $casts = [
        'form_fields' => 'array',
        'isPublished' => 'boolean',
        'isActive' => 'boolean',
    ];

    
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    // All submissions from students
    public function submissions()
    {
        return $this->hasMany(FormSubmission::class, 'form_id');
    }

    // If you later allow structured sections (builder 2.0)
    public function sections()
    {
        return $this->hasMany(Section::class, 'form_id')->orderBy('order');
    }

    // Questions under each form (if not using form_fields JSON)
    public function questions()
    {
        return $this->hasMany(Question::class, 'form_id')->orderBy('order');
    }

    // Applications created by students (if using Application model)
    public function applications()
    {
        return $this->hasMany(Application::class, 'form_id');
    }

}
