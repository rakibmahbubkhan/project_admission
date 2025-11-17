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
        'isPublished'
    ];

    protected $casts = [
        'form_fields' => 'array'
    ];

    /**
     * Relation: The form belongs to a university
     */
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    /**
     * Relation: The form has many submissions
     *
     * (Previously named applications, but that points to the wrong model)
     */
    public function submissions()
    {
        return $this->hasMany(FormSubmission::class, 'form_id');
    }

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('order');
    }

public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }
}
