<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;

class DocumentShow extends Component
{
    public $documentoId;
    public $document;

    public function mount($documentoId)
    {
        $this->document = Document::find($documentoId);
    }

    public function closeModal()
    {
        return redirect(route('documents.index')); // Notifica al componente padre para cerrar el modal
    }

    public function render()
    {
        return view('livewire.documents.document-show')->layout('layouts.app');
    }
}

