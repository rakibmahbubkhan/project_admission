<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'student_id', 'amount', 'status'];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}

