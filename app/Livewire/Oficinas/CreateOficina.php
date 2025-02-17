<?php

namespace App\Livewire\Oficinas;

use Livewire\Component;
use App\Models\Oficina;

class CreateOficina extends Component
{
    public $oficina_id, $nombre_oficina;
    public $modalVisible = false;

    protected $rules = [
        'nombre_oficina' => 'required|string|min:3|max:255',
    ];

    protected $messages = [
        'nombre_oficina.required' => 'El nombre de la oficina es obligatorio.',
        'nombre_oficina.string' => 'El nombre de la oficina debe ser una cadena de texto.',
        'nombre_oficina.min' => 'El nombre de la oficina debe tener al menos 3 caracteres.',
        'nombre_oficina.max' => 'El nombre de la oficina no puede tener más de 255 caracteres.',
    ];

    protected $listeners = ['edit' => 'loadOficina', 'showModal' => 'showModal', 'refreshTable' => '$refresh', 'swal' => 'swal'];

    public function loadOficina($id)
    {
        $oficina = Oficina::find($id);

        if (!$oficina) {
            session()->flash('error', 'La oficina no existe.');
            return;
        }

        $this->oficina_id = $oficina->id;
        $this->nombre_oficina = $oficina->nombre_oficina;
        $this->modalVisible = true;
    }

    public function showModal()
    {
        $this->reset(['oficina_id', 'nombre_oficina']);
        $this->resetValidation();
        $this->modalVisible = true;
    }

    public function save()
    {
        $this->validate();

        Oficina::updateOrCreate(
            ['id' => $this->oficina_id],
            ['nombre_oficina' => $this->nombre_oficina]
        );

        $message = $this->oficina_id ? 'Oficina actualizada.' : 'Oficina creada.';
        
        session()->flash('message', $message);

        $this->dispatch('swal', title: $message, icon: 'success');

        $this->modalVisible = false;
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        return view('livewire.oficinas.create-oficina');
    }
}
