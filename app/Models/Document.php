<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'numero_documento',
        'fecha_ingreso',
        'origen_oficina',
        'titulo',
        'numero_folios',
        'detalles',
        'derivado_oficina',
        'fecha_salida',
        'trabajador_id',
    ];

    public function files()
    {
        return $this->hasMany(File::class, 'documento_id');
    }

    public function trabajador()
    {
        return $this->belongsTo(User::class, 'trabajador_id');
    }
}
