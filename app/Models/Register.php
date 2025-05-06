<?php

namespace App\Models;

use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Register extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasUlids, Notifiable;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'registers';
    protected $with = ['siswa', 'jalur', 'afirmasi', 'akademik', 'nonAkademik', 'mutasi', 'raport', 'rata_rata_raport'];
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

    public function raport(): HasMany
    {
        return $this->hasMany(DataRaport::class, 'id_register');
    }
    public function rata_rata_raport(): HasOne
    {
        return $this->hasOne(RataRataRaport::class, 'id_register');
    }

    public function afirmasi(): HasOne
    {
        return $this->hasOne(DocumentAfirmasi::class, 'id_register');
    }
    public function mutasi(): HasOne
    {
        return $this->hasOne(DocumentMutasi::class, 'id_register');
    }
    public function akademik(): HasMany
    {
        return $this->hasMany(Akademik::class, 'id_register');
    }

    public function nonAkademik(): HasMany
    {
        return $this->hasMany(NonAkademik::class, 'id_register');
    }

    public function jalur(): BelongsTo
    {
        return $this->belongsTo(Jalur::class, 'id_jalur');
    }

    public function pendaftaran(): HasOne
    {
        return $this->hasOne(Pendaftaran::class, 'id_register');
    }

    public function isBerkasLengkap(): bool
    {
        $siswaLengkap = $this->siswa->status_berkas === '1';
        $ortuLengkap = $this->siswa->ortu->status_berkas === '1';

        switch ($this->jalur->id) {
            case '2':
                return $siswaLengkap && $ortuLengkap && optional($this->afirmasi)->status_berkas === '1';

            case '3':
                return $siswaLengkap && $ortuLengkap && optional($this->mutasi)->status_berkas === '1';

            case '4':
                return $siswaLengkap && $ortuLengkap &&
                    $this->akademik->isNotEmpty() &&
                    $this->akademik->every(fn($a) => $a->status_berkas === '1');

            case '5':
                return $siswaLengkap && $ortuLengkap &&
                    $this->nonAkademik->isNotEmpty() &&
                    $this->nonAkademik->every(fn($na) => $na->status_berkas === '1');

            case '6':
                return $siswaLengkap && $ortuLengkap &&
                    $this->raport->isNotEmpty() &&
                    $this->raport->every(fn($r) => $r->status === '1') &&
                    optional($this->rata_rata_raport)->image !== null;

            default:
                return $siswaLengkap && $ortuLengkap;
        }
    }
}
