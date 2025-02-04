<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

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
        'estado',
    ];

    public function files()
    {
        return $this->hasMany(File::class, 'documento_id');
    }

    public function trabajador()
    {
        return $this->belongsTo(User::class, 'trabajador_id');
    }

    // Método para verificar si un documento está vencido
    public function esVencido()
    {
        if ($this->estado === 'emitido') {
            return false; // No se marca como vencido si está emitido
        }

        $fechaIngreso = Carbon::parse($this->fecha_ingreso);
        $fechaLimite = $fechaIngreso->addDays(5);
        return Carbon::now()->greaterThan($fechaLimite);
    }

    // Evento que actualiza el estado antes de consultar el documento
    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($document) {
            if ($document->esVencido() && $document->estado !== 'vencido') {
                $document->estado = 'vencido';
                $document->save();
            }
        });
    }
}