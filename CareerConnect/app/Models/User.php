<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Your migration uses singular table name `user`
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'nim',
        'study_program',
        'class',
        'image',
        'interest',
        'field',
        'current_field',
        'graduation_year',
        'contact',
        'experience',
        'role',
        'login_method',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Ensure the model uses the singular `user` table.
     * This explicitly returns the table name to avoid pluralization issues.
     */
    public function getTable(): string
    {
        return 'user';
    }

    /**
     * Check if this is a Google OAuth user
     */
    public function isGoogleUser(): bool
    {
        return $this->login_method === 'google';
    }
}