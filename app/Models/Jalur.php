<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Jalur extends Model
{
    use HasFactory;

    protected $table = 'jalurs';
    protected $fillable = ['nama_jalur', 'keterangan'];

    public function register(): HasMany
    {
        return $this->hasMany(Register::class, "id_jalur");
    }
}
