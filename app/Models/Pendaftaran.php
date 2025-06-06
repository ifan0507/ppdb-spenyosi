<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasFactory, HasUlids;
    protected $table = 'pendaftarans';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $with = ['register', 'user'];
    protected $fillable = ['tanggal_daftar', 'confirmations', 'decline', 'id_register', 'id_user', 'status'];

    public function register(): BelongsTo
    {
        return $this->belongsTo(Register::class, 'id_register');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
