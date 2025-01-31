<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;

class DocumentTable extends Component
{
    use WithPagination;

    public $search = ''; // Búsqueda general

    public $showEditModal = false; // Modal de edición
    public $showEmitModal = false; // Modal de emisión
    public $showVerModal = false; // Modal de ver
    public $documentId; // ID del documento a editar
    public $documentoId; // ID del documento a emitir
    public $document;

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

    public function render()
    {
        // Búsqueda general (número de documento, título, etc.)
        $documents = Document::query()
            ->when($this->search, function($query) {
                $query->where('numero_documento', 'like', '%' . $this->search . '%')
                    ->orWhere('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('fecha_ingreso', 'like', '%' . $this->search . '%')
                    ->orWhere('fecha_salida', 'like', '%' . $this->search . '%')
                    ->orWhere('origen_oficina', 'like', '%' . $this->search . '%')
                    ->orWhere('derivado_oficina', 'like', '%' . $this->search . '%');
            })
            ->orderby('numero_documento', 'desc')
            ->paginate(10);

        return view('livewire.documents.document-table', [
            'documents' => $documents,
            'search' => $this->search, // Pasar la búsqueda a la vista
        ])->layout('layouts.app');
    }


        public function clearFilters()
        {
            $this->search = '';
        }
    }
