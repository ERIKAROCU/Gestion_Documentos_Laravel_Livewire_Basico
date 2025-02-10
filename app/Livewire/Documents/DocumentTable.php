<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\Oficina;

class DocumentTable extends Component
{
    use WithPagination;


    public $search = ''; // Búsqueda general
    public $perPage = 10; // Número de documentos por página
    public $searchDate = ''; // Filtro por fecha
    public $searchOrigenOficina = ''; // Filtro por oficina de origen
    public $searchDerivadoOficina = ''; // Filtro por oficina derivada
    public $searchEstado = ''; // Filtro por estado

    public $showEditModal = false; // Modal de edición
    public $showEmitModal = false; // Modal de emisión
    public $showVerModal = false; // Modal de ver
    public $documentId; // ID del documento a editar
    public $documentoId; // ID del documento a emitir
    public $document;
    public $oficinas = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'searchDate' => ['except' => ''],
        'searchOrigenOficina' => ['except' => ''],
        'searchDerivadoOficina' => ['except' => ''],
        'searchEstado' => ['except' => ''],
    ];

    public function  mount(){
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->oficinas = Oficina::all();
        $this->actualizarEstados();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'searchDate', 'searchOrigenOficina', 'searchDerivadoOficina', 'searchEstado']);
    }

    public function actualizarEstados()
    {
        // Solo actualiza los estados si no se ha hecho recientemente
        if (cache('estados_actualizados') !== true) {
            Document::where('estado', '!=', 'emitido')
                ->where('estado', '!=', 'vencido')
                ->each(function ($documento) {
                    if ($documento->esVencido()) {
                        $documento->estado = 'vencido';
                        $documento->save();
                    }
                });

            cache(['estados_actualizados' => true], now()->addMinutes(10)); // Cachear por 10 minutos
        }
    }

    public function render()
{
    $this->actualizarEstados(); // Actualizar estados antes de renderizar

    $documents = Document::query()
        ->when($this->search, function ($query) {
            $query->where(function ($subquery) {
                $subquery->where('numero_documento', 'like', '%' . $this->search . '%')
                         ->orWhere('titulo', 'like', '%' . $this->search . '%')
                         ->orWhere('fecha_ingreso', 'like', '%' . $this->search . '%')
                         ->orWhere('fecha_salida', 'like', '%' . $this->search . '%')
                         ->orWhere('origen_oficina', 'like', '%' . $this->search . '%')
                         ->orWhere('derivado_oficina', 'like', '%' . $this->search . '%')
                         ->orWhere('estado', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->searchDate, fn($query) => $query->whereDate('fecha_ingreso', $this->searchDate))
        ->when($this->searchOrigenOficina, fn($query) => $query->where('origen_oficina', $this->searchOrigenOficina))
        ->when($this->searchDerivadoOficina, fn($query) => $query->where('derivado_oficina', $this->searchDerivadoOficina))
        ->when($this->searchEstado, fn($query) => $query->where('estado', $this->searchEstado))
        ->orderBy('numero_documento', 'desc')
        ->paginate($this->perPage);

    return view('livewire.documents.document-table', [
        'documents' => $documents,
    ])->layout('layouts.app');
}
}