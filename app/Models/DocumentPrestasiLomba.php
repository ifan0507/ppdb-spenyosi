<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentPrestasiLomba extends Model
{

    use HasFactory, HasUlids;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'document_prestasi_lombas';
    protected $fillable = ['id_register', 'nama_prestasi', 'jenis_prestasi', 'tingkat_prestasi', 'thn_perolehan', 'perolehan', 'image', 'status_berkas'];

    public function register(): BelongsTo
    {
        return $this->belongsTo(Register::class, 'id_register');
    }
}
