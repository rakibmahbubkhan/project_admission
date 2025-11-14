<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'referral_code', 'created_by'
    ];

    protected $hidden = ['password', 'remember_token'];

    // Relationships
    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

    public function students()
    {
        return $this->hasMany(User::class, 'created_by')->where('role', 'student');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted()
{
    static::creating(function ($user) {
        if ($user->role === 'agent' && empty($user->referral_code)) {
            $user->referral_code = strtoupper(substr($user->name, 0, 3)) . rand(1000, 9999);
        }
    });
}
}
