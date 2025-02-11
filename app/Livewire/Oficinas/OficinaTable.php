<?php

namespace App\Livewire\Oficinas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Oficina;

class OficinaTable extends Component
{
    use WithPagination;

    public $search = ''; // Búsqueda general
    public $perPage = 10; // Número de usuarios por página

    protected $listeners = ['refreshTable' => '$refresh', 'deleteRow' => 'deleteRow'];

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function deleteRow($id)
    {
        $oficina = Oficina::find($id);
        if ($oficina) {
            $oficina->delete();
            session()->flash('message', 'Oficina eliminada correctamente.');
            $this->dispatch('refreshTable'); // Refrescar la tabla después de eliminar
        }
    }

    public function render()
    {
        $oficinas = Oficina::query()
            ->when($this->search, function ($query) {
                $query->where('nombre_oficina', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        return view('livewire.oficinas.oficina-table', compact('oficinas'))->layout('layouts.app');
    }
}
