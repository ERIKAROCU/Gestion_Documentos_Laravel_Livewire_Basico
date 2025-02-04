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

    // Abrir modal de edición
    public function editDocument($id)
    {
        $this->documentId = $id;
        $this->showEditModal = true;
    }

    // Cerrar modal de edición
    public function closeEditModal()
    {
        $this->showEditModal = false;
    }

    // Abrir modal de emisión
    public function emitDocument($id)
    {
        $this->documentoId = $id;
        $this->showEmitModal = true;
    }

    // Cerrar modal de emisión
    public function closeEmitModal()
    {
        $this->showEmitModal = false;
    }

    // Abrir modal de ver
    public function verDocument($id)
    {
        $this->documentoId = $id;
        $this->document = Document::find($id);

        if (!$this->document) {
            session()->flash('error', 'Documento no encontrado.');
            return;
        }

        $this->showVerModal = true;
    }

    // Cerrar modal de ver
    public function closeVerModal()
    {
        $this->showVerModal = false;
    }

    public function actualizarEstados()
    {
        $documentos = Document::where('estado', '!=', 'emitido')
            ->where('estado', '!=', 'vencido')
            ->get();

        foreach ($documentos as $documento) {
            if ($documento->esVencido()) {
                $documento->estado = 'vencido';
                $documento->save();
            }
        }
    }

    public function render()
    {
        $this->actualizarEstados(); // Llamamos la función antes de renderizar la vista

        // Consulta base
        $documents = Document::query()
            ->when($this->search, function ($query) {
                // Búsqueda general en múltiples campos
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
            ->when($this->searchDate, function ($query) {
                // Filtro por fecha de ingreso
                $query->whereDate('fecha_ingreso', $this->searchDate);
            })
            ->when($this->searchOrigenOficina, function ($query) {
                // Filtro por oficina de origen
                $query->where('origen_oficina', $this->searchOrigenOficina);
            })
            ->when($this->searchDerivadoOficina, function ($query) {
                // Filtro por oficina derivada
                $query->where('derivado_oficina', $this->searchDerivadoOficina);
            })
            ->when($this->searchEstado, function ($query) {
                // Filtro por estado
                $query->where('estado', $this->searchEstado);
            })
            ->orderBy('estado', 'asc')
            ->paginate($this->perPage);

        return view('livewire.documents.document-table', [
            'documents' => $documents,
        ])->layout('layouts.app');
    }
}