<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'agent_id', 'nationality', 'phone', 'dob', 'gender', 'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}


