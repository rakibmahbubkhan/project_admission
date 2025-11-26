<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_form_id',
        'title',
        'description',
        'order',
    ];

    //    public function form()
    // {
    //     return $this->belongsTo(AdmissionForm::class, 'admission_form_id');
    // }

    // public function questions()
    // {
    //     return $this->hasMany(Question::class)->orderBy('order');
    // }

    public function admissionForm()
    {
        return $this->belongsTo(AdmissionForm::class);
    }
     public function questions()
    {
        return $this->hasMany(Question::class, 'section_id')->orderBy('order');
    }
}
