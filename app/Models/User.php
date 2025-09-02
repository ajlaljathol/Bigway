<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // --- Role constants ---
    public const ROLE_ADMIN     = 'admin';
    public const ROLE_STAFF     = 'staff';
    public const ROLE_GUARDIAN  = 'guardian';
    public const ROLE_STUDENT   = 'student';
    public const ROLE_CARETAKER = 'caretaker';
    public const ROLE_DRIVER    = 'driver';

    /**
     * Mass assignable attributes
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Attributes hidden from serialization
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // --- Role check helpers ---
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isStaff(): bool
    {
        return $this->role === self::ROLE_STAFF;
    }

    public function isGuardian(): bool
    {
        return $this->role === self::ROLE_GUARDIAN;
    }

    public function isStudent(): bool
    {
        return $this->role === self::ROLE_STUDENT;
    }

    public function isCaretaker(): bool
    {
        return $this->role === self::ROLE_CARETAKER;
    }

    public function isDriver(): bool
    {
        return $this->role === self::ROLE_DRIVER;
    }

    /**
     * General role check
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Static helper: Get all available roles
     */
    public static function availableRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_STAFF,
            self::ROLE_GUARDIAN,
            self::ROLE_STUDENT,
            self::ROLE_CARETAKER,
            self::ROLE_DRIVER,
        ];
    }

    /**
     * Accessor for role (fallback default: guardian)
     */
    public function getRoleAttribute($value): string
    {
        return $value ?? self::ROLE_GUARDIAN;
    }
}
