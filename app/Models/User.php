<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tambahkan kolom role ke fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define roles
    public const ROLE_ADMIN = 'admin';
    public const ROLE_PETUGAS = 'petugas';
    public const ROLE_DEPARTEMEN = 'departemen';
    public const ROLE_MASYARAKAT = 'masyarakat';
    public const ROLE_ANGGOTA = 'anggota';

    // Method untuk mengecek role
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isPetugas()
    {
        return $this->role === self::ROLE_PETUGAS;
    }

    public function isDepartemen()
    {
        return $this->role === self::ROLE_DEPARTEMEN;
    }

    public function isMasyarakat()
    {
        return $this->role === self::ROLE_MASYARAKAT;
    }
    public function isAnggota()
    {
        return $this->role === self::ROLE_ANGGOTA;
    }
}

