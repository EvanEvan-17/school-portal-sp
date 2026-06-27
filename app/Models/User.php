<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'username', 'email', 'password', 'is_super_admin', 'google_user_id', 'google_tokens'])]
#[Hidden(['password', 'remember_token', 'google_tokens'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'is_super_admin' => 'boolean',
            'password' => 'hashed',
            'google_tokens' => 'array',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin;
    }
    
    public function assignments()
    {
        // student_id instead of user_id
        return $this->belongsToMany(Assignment::class, 'student_assignments', 'student_id', 'assignment_id')
        ->withPivot(['status'])
        ->withTimestamps();
    }
}
