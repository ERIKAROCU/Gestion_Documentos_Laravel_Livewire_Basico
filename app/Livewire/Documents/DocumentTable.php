<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;

class DocumentTable extends Component
{
    use WithPagination;

    public $search = ''; // Búsqueda general
    public $filtro_oficina = ''; // Filtro por oficina de origen
    public $filtro_derivado = ''; // Filtro por oficina derivada
    public $filtro_fecha_ingreso = ''; // Filtro por fecha de ingreso
    public $filtro_fecha_salida = ''; // Filtro por fecha de salida

    protected $queryString = [
        'search' => ['except' => ''],
        'filtro_oficina' => ['except' => ''],
        'filtro_derivado' => ['except' => ''],
        'filtro_fecha_ingreso' => ['except' => ''],
        'filtro_fecha_salida' => ['except' => ''],
    ];

    public function render()
    {
        $query = Document::query();

        // Búsqueda general (número de documento, título, etc.)
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('numero_documento', 'like', '%' . $this->search . '%')
                  ->orWhere('titulo', 'like', '%' . $this->search . '%')
                  ->orWhere('origen_oficina', 'like', '%' . $this->search . '%')
                  ->orWhere('derivado_oficina', 'like', '%' . $this->search . '%');
            });
        }

        // Ordenar por número de documento (descendente)
        $documents = $query->orderBy('numero_documento', 'desc')->paginate(10);

        return view('livewire.documents.document-table', [
            'documents' => $documents,
        ])->layout('layouts.app');
    }

}