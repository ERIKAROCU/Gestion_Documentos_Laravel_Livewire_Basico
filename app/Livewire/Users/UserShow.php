<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class UserShow extends Component
{
    public $id;
    public $documents = [];
    public $modalVisible = false;

    // Variables para almacenar conteos
    public $totalDocumentos = 0;
    public $documentosRecibidos = 0;
    public $documentosEmitidos = 0;
    public $documentosVencidos = 0;
    public $nombreUsuario;

    protected $listeners = ['verusuario' => 'loadDocuments'];

    public function loadDocuments($id)
    {
        $this->id = $id;

        // Obtener documentos del trabajador
        $this->documents = Document::where('trabajador_id', $id)->get();

        // Calcular la cantidad total y por estado
        $documentosPorEstado = Document::where('trabajador_id', $id)
            ->select('estado', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('estado')
            ->pluck('cantidad', 'estado');

        $this->totalDocumentos = $this->documents->count();
        $this->documentosRecibidos = $documentosPorEstado['recibido'] ?? 0;
        $this->documentosEmitidos = $documentosPorEstado['emitido'] ?? 0;
        $this->documentosVencidos = $documentosPorEstado['vencido'] ?? 0;

        $this->nombreUsuario = User::where('id', $id)->pluck('name')->first();

        // Mostrar el modal
        $this->modalVisible = true;
    }

    public function closeModal()
    {
        $this->modalVisible = false;
    }

    public function render()
    {
        return view('livewire.users.user-show', [
            'documents' => $this->documents
        ]);
    }
}
