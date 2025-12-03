<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class University extends Model
{
     use HasFactory;
    protected $fillable = [
        'name',
        'country',
        'city',
        'currency',
        'type',
        'logo',
        'image',
        'content',
        'ranking',
        'intake',
        'deadline',
        'description',
        'isActive'
    ];

     protected $casts = [
        'deadline' => 'date',
        'isActive' => 'boolean'
    ];

    public function admissionForms()
    {
        return $this->hasMany(AdmissionForm::class);
    }
}
