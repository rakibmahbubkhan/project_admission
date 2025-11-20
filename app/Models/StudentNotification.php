<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentNotification extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'message',
        'is_read'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
