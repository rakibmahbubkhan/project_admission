<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo', 'location', 'website', 'description', 'created_by'
    ];

    public function forms()
    {
        return $this->hasMany(AdmissionForm::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

