<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Register extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasUlids, Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'registers';
    protected $with = ['siswa', 'jalur', "afirmasi", "lomba", "mutasi", "raport"];
    protected $fillable = ['no_register', 'nisn', 'email', 'verification_code', 'email_verified_at', 'password', 'id_jalur', "submit"];
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

    public function siswa(): HasOne
    {
        return $this->hasOne(SiswaBaru::class, 'id_register_siswa');
    }

    public function raport(): HasOne
    {
        return $this->hasOne(DataRaport::class, 'id_register');
    }

    public function afirmasi(): HasOne
    {
        return $this->hasOne(DocumentAfirmasi::class, 'id_register');
    }
    public function mutasi(): HasOne
    {
        return $this->hasOne(DocumentMutasi::class, 'id_register');
    }
    public function lomba(): HasOne
    {
        return $this->hasOne(DocumentPrestasiLomba::class, 'id_register');
    }

    public function jalur(): BelongsTo
    {
        return $this->belongsTo(Jalur::class, 'id_jalur');
    }

    public function pendaftaran(): HasOne
    {
        return $this->hasOne(Pendaftaran::class, 'id_register');
    }
}
