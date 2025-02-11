<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;

class DocumentShow extends Component
{
    public $numero_documento, $fecha_ingreso, $origen_oficina, $titulo, $numero_folios, $detalles;
    public $documentId, $document_id;
    public $document;

    public $modalVisible = false;

    protected $listeners = ['viewDocument' => 'loadDocument', 'showDocumentShowModal' => 'showModal', 'refreshTable' => '$refresh'];

    public function loadDocument($id)
    {
        $this->document = Document::find($id); // Asignar el documento completo
        if (!$this->document) {
            session()->flash('error', 'El documento no existe.');
            return;
        }

        $this->modalVisible = true; // Mostrar el modal
    }

    public function showModal()
    {
        $this->reset(['documentId', 'numero_documento', 'fecha_ingreso', 'origen_oficina', 'titulo', 'numero_folios', 'detalles']);
        $this->resetValidation();
        $this->modalVisible = true;
    }

    public function render()
    {
        return view('livewire.documents.document-show')->layout('layouts.app');
    }
}

