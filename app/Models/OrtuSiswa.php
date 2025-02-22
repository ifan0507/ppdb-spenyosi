<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrtuSiswa extends Model
{
    use HasFactory;
    protected $table = 'ortu_siswas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['nama_ortu', 'tempat_lahir', 'tanggal_lahir', 'kabupaten', 'kecamatan', 'desa', 'dusun', 'rt', 'rw', 'alamat', 'pekerjaan', 'pendidikan', 'no_hp'];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(SiswaBaru::class, 'id_siswa');
    }
}
