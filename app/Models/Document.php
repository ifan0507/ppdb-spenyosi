<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;
    protected $table = "documents";
    protected $fillable = ["document"];

    public function jalur(): BelongsTo
    {
        return $this->belongsTo(Jalur::class, "id_jalur");
    }
}
