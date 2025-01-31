<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'documento_id',
        'ruta_archivo',
        'tipo',
        'nombre_original',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'documento_id');
    }
}