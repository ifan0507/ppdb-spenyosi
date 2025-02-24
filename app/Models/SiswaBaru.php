<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SiswaBaru extends Model
{
    use HasFactory;
    use HasUlids;
    protected $table = 'siswa_barus';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $width = 'ortu';
    protected $fillable = ['nisn', 'nama', 'nik', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'asal_sekolah', 'kabupaten', 'kecamatan', 'desa', 'dusun', 'rt', 'rw', 'alamat', 'no_hp', 'email', 'jalur_ppdb', 'lokasi', 'foto_kk', 'foto_siswa', 'foto_akte', 'documents'];

    public function ortu(): HasOne
    {
        return $this->hasOne(OrtuSiswa::class, 'id_siswa');
    }

    public function pendaftaran(): HasOne
    {
        return $this->hasOne(Pendaftaran::class, 'id_siswa');
    }
}
