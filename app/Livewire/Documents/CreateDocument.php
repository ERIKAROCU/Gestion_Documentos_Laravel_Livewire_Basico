<?php

namespace App\Livewire\Documents;

use Livewire\Component;
use App\Models\Document;
use App\Models\Oficina;
use Illuminate\Validation\Rule;

class CreateDocument extends Component
{
    public $isOpen = false;
    public $numero_documento, $fecha_ingreso, $origen_oficina, $titulo, $numero_folios, $detalles;
    public $oficinas = [];

    protected $rules = [
        'numero_documento' => 'required|unique:documents',
        'fecha_ingreso' => 'required|date',
        'origen_oficina' => 'required',
        'titulo' => 'required',
        'numero_folios' => 'required|numeric',
        'detalles' => 'required',
    ];

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

    public function mount()
    {
        $this->oficinas = Oficina::all();
    }

    public function openModal()
    {
        $this->reset();
        $this->oficinas = Oficina::all();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function save()
    {
        $this->validate();

        Document::create([
            'numero_documento' => $this->numero_documento,
            'fecha_ingreso' => $this->fecha_ingreso,
            'origen_oficina' => $this->origen_oficina,
            'titulo' => $this->titulo,
            'numero_folios' => $this->numero_folios,
            'detalles' => $this->detalles,
            'trabajador_id' => auth()->id(),
            'estado' => 'recibido',
        ]);

        session()->flash('message', 'Documento registrado correctamente.');
        $this->reset();
        $this->closeModal();
        return redirect()->route('documents.index');
    }

    public function render()
    {
        return view('livewire.documents.create-document')->layout('layouts.app');
    }
}