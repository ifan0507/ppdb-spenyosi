<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RataRataRaport extends Model
{
    use HasFactory, HasUlids;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'rata_rata_raports';
    protected $fillable = ['id_register', 'total_rata_rata', 'image'];

    public function register(): BelongsTo
    {
        return $this->belongsTo(Register::class, 'id_register');
    }
}
