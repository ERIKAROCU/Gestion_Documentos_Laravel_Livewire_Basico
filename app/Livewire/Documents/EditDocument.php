<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Oficina;

class EditDocument extends Component
{
    public $document;
    public $numero_documento, $fecha_ingreso, $origen_oficina, $titulo, $numero_folios, $detalles;

    public $oficinas = [];

    public $documentId;

    public function mount($documentId)
    {
        $this->document = Document::findOrFail($documentId);
        $this->numero_documento = $this->document->numero_documento;
        $this->fecha_ingreso = Carbon::parse($this->document->fecha_ingreso)->format('Y-m-d');
        $this->origen_oficina = $this->document->origen_oficina;
        $this->titulo = $this->document->titulo;
        $this->numero_folios = $this->document->numero_folios;
        $this->detalles = $this->document->detalles;

        $this->oficinas = Oficina::all();
    }

    protected function rules()
    {
        return [
            'numero_documento' => [
                'required',
                Rule::unique('documents')->ignore($this->document->id),
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


    public function save()
    {
        $this->validate();

        // Actualizar el documento
        $this->document->update([
            'numero_documento' => $this->numero_documento,
            'fecha_ingreso' => $this->fecha_ingreso,
            'origen_oficina' => $this->origen_oficina,
            'titulo' => $this->titulo,
            'numero_folios' => $this->numero_folios,
            'detalles' => $this->detalles,
        ]);

        session()->flash('message', 'Documento actualizado correctamente.');
        $this->redirect(route('documents.index'));
    }

    public function closeModal()
    {
        return redirect(route('documents.index')); // Esto redirige a la página anterior
    }

    public function render()
    {
        return view('livewire.documents.edit-document')->layout('layouts.app');
    }
}