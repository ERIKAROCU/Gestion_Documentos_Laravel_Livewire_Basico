<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;
use App\Models\Oficina;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DocumentForm extends Component
{
    public $modalVisible = false;
    public $documentId, $document_id;
    public $numero_documento, $fecha_ingreso, $origen_oficina, $titulo, $numero_folios, $detalles;
    public $oficinas = [];

    public $isEditing;

    protected function rules()
    {
        return [
            'numero_documento' => [
                'required',
                Rule::unique('documents')->ignore($this->documentId),
            ],
            'fecha_ingreso' => 'required|date',
            'origen_oficina' => 'required',
            'titulo' => 'required',
            'numero_folios' => 'required|numeric',
            'detalles' => 'required',
        ];
    }

    protected $messages = [
        'numero_documento.required' => 'El número de documento es obligatorio.',
        'numero_documento.unique' => 'El número de documento ya existe.',
        'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
        'fecha_ingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
        'origen_oficina.required' => 'El origen de la oficina es obligatorio.',
        'titulo.required' => 'El título es obligatorio.',
        'numero_folios.required' => 'El número de folios es obligatorio.',
        'numero_folios.numeric' => 'El número de folios debe ser un número.',
        'detalles.required' => 'Los detalles son obligatorios.',
    ];

    public function updatedModalVisible()
    {
        if ($this->modalVisible) {
            $this->oficinas = Oficina::all();
        }
    }

    protected $listeners = ['edit' => 'loadDocument', 'showDocumentFormModal' => 'showModal', 'refreshTable' => '$refresh'];

    public function loadDocument($id)
    {
        $document = Document::find($id);
        if (!$document) {
            session()->flash('error', 'El documento no existe.');
            return;
        }

        $this->documentId = $document->id; // Cambia document_id por documentId
        $this->numero_documento = $document->numero_documento;
        $this->fecha_ingreso = $document->fecha_ingreso;
        $this->origen_oficina = $document->origen_oficina;
        $this->titulo = $document->titulo;
        $this->numero_folios = $document->numero_folios;
        $this->detalles = $document->detalles;
        
        $this->isEditing = true;
        $this->oficinas = Oficina::all();
        $this->modalVisible = true;
    }


    public function showModal()
    {
        $this->reset(['documentId', 'numero_documento', 'fecha_ingreso', 'origen_oficina', 'titulo', 'numero_folios', 'detalles']);
        $this->resetValidation();
        $this->oficinas = Oficina::all(); // Recargar oficinas cada vez que se abre el modal
        $this->isEditing = false;
        $this->modalVisible = true;
    }
    

    public function closeModal()
    {
        $this->modalVisible = false;
        $this->reset(['documentId', 'numero_documento', 'fecha_ingreso', 'origen_oficina', 'titulo', 'numero_folios', 'detalles']);
        $this->resetValidation();
    }


    public function save()
    {
        $this->validate();

        Document::updateOrCreate(
            ['id' => $this->documentId], // Buscar por ID
            array_merge(
                [
                    'numero_documento' => $this->numero_documento,
                    'fecha_ingreso' => $this->fecha_ingreso,
                    'origen_oficina' => $this->origen_oficina,
                    'titulo' => $this->titulo,
                    'numero_folios' => $this->numero_folios,
                    'detalles' => $this->detalles,
                    'trabajador_id' => Auth::id(),
                ],
                $this->documentId ? [] : ['estado' => 'recibido'] // Solo asignar "estado" si es nuevo
            )
        );

        session()->flash('message', $this->documentId ? 'Documento actualizado correctamente.' : 'Documento registrado correctamente.');
        $this->reset();
        $this->closeModal();
        return redirect()->route('documents.index');
    }

    public function render()
    {
        return view('livewire.documents.document-form', [
            'oficinas' => $this->oficinas,
        ]);
    }
}