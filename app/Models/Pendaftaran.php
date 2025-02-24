<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasFactory;
    use HasUlids;
    protected $table = 'pendaftarans';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $width = ['siswa', 'user'];
    protected $fillable = ['tanggal_daftar', 'confirmations', 'decline'];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(SiswaBaru::class, 'id_siswa');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
