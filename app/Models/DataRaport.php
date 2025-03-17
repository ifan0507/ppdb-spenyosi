<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataRaport extends Model
{
    use HasFactory, HasUlids;
    protected $table = 'data_raports';
    protected $with = 'mapel';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'kelas4_1',
        'kelas4_2',
        'kelas5_1',
        'kelas5_2',
        'kelas6_1',
        'rata_kelas4_sem1',
        'rata_kelas4_sem2',
        'rata_kelas5_sem1',
        'rata_kelas5_sem2',
        'rata_kelas6_sem1',
        'status'
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(SiswaBaru::class, 'id_siswa');
    }

    public function mapel(): BelongsTo
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }

    public function jalur(): BelongsTo
    {
        return $this->belongsTo(Jalur::class, "id_jalur");
    }
}
