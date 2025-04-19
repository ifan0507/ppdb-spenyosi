<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SiswaBaru extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'siswa_barus';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $with = ['ortu'];

    protected $fillable = [
        'id_register_siswa',
        'nisn',
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'asal_sekolah',
        'kabupaten',
        'kecamatan',
        'desa',
        'kab_id',
        'kec_id',
        'desa_id',
        'alamat',
        'no_hp',
        'email',
        'lokasi',
        'foto_kk',
        'foto_siswa',
        'foto_akte',
        'status_berkas'
    ];

    public function ortu(): HasOne
    {
        return $this->hasOne(OrtuSiswa::class, 'id_siswa');
    }
    public function register(): BelongsTo
    {
        return $this->belongsTo(Register::class, 'id_register_siswa');
    }
}
