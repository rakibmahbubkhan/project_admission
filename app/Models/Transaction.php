<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'amount', 'type', 'status'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
