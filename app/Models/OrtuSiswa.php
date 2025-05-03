<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrtuSiswa extends Model
{
    use HasFactory, HasUlids;
    protected $table = 'ortu_siswas';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['ayah', 'status_ayah', 'status_hubungan', 'hubungan_wali', 'pekerjaan_ayah', 'pendidikan_ayah', 'ibu', 'status_ibu', 'pekerjaan_ibu', 'pendidikan_ibu', 'no_hp', 'id_siswa', 'status_berkas'];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(SiswaBaru::class, 'id_siswa');
    }
}
