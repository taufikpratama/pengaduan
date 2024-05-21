<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    
    protected $guarded = [
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // App/Models/Tindakan.php
    public function tindakans()
    {
        return $this->hasMany(Tindakan::class);
    }

}

