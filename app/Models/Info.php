<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory, HasUlids;
    protected $table = 'infos';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['judul', 'file', 'deskripsi', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
