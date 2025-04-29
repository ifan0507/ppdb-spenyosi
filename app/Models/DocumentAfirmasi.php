<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentAfirmasi extends Model
{
    use HasFactory, HasUlids;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'document_afirmasis';
    protected $fillable = ['id_register', 'jenis_afirmasi', 'image', 'status_berkas'];

    public function register(): BelongsTo
    {
        return $this->belongsTo(Register::class, 'id_register');
    }
}
