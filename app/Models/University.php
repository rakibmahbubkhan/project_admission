<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class University extends Model
{
     use HasFactory;
    protected $fillable = [
        'name', 'country', 'city', 'logo', 'details', 'isActive'
    ];

    public function admissionForms()
    {
        return $this->hasMany(AdmissionForm::class);
    }
}
