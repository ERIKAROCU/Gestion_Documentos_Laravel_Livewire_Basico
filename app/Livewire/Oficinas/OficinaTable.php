<?php

namespace App\Livewire\Oficinas;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Oficina;

class OficinaTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshTable' => '$refresh', 'deleteRow' => 'deleteRow'];

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
        return view('livewire.oficinas.oficina-table', [
            'oficinas' => Oficina::orderBy('id', 'desc')
            ->paginate(10)
        ])->layout('layouts.app');
    }
}
