<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id', 'title', 'description', 'fields', 'fees', 'deadline', 'created_by'
    ];

    protected $casts = ['fields' => 'array'];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
