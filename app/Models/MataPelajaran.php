<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $fillable = ['nama_matapelajaran'];
    protected $table = 'mata_pelajarans';

    public function raport(): HasMany
    {
        return $this->hasMany(DataRaport::class, 'id_mapel');
    }
}
