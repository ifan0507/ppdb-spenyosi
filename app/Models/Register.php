<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Register extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasUlids, Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'registers';
    protected $fillable = ['nama_lengkap', 'nisn', 'email', 'password', 'jalur_ppdb'];
    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
