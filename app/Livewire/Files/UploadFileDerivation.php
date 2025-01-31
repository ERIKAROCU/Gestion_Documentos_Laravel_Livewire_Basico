<?php

namespace App\Livewire\Files;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UploadFileDerivation extends Component
{
    use WithFileUploads;

    public $documento_id;
    public $archivo;
    public $derivado_oficina;
    public $fecha_salida;
    public $titulo;

    protected $rules = [
        'archivo' => 'required|file|mimes:pdf,doc,docx,xlsx|max:10240', // 10 MB máximo
        'derivado_oficina' => 'required',
        'fecha_salida' => 'required|date',
        'titulo' => 'required',
    ];

    protected $messages = [
        'archivo.required' => 'El archivo es obligatorio.',
        'archivo.file' => 'El archivo debe ser un archivo válido.',
        'archivo.mimes' => 'El archivo debe ser de tipo: pdf, doc, docx, xlsx.',
        'archivo.max' => 'El archivo no debe ser mayor a 10 MB.',
        'derivado_oficina.required' => 'La oficina derivada es obligatoria.',
        'fecha_salida.required' => 'La fecha de salida es obligatoria.',
        'fecha_salida.date' => 'La fecha de salida debe ser una fecha válida.',
        'titulo.required' => 'El título es obligatorio.',
    ];

    public function mount($documentoId = null)
    {
        logger('Documento ID recibido:', [$documentoId]);  // Agrega esta línea para depurar
        $this->documento_id = $documentoId;

        // Si el documento existe, cargar los datos del documento
        if ($this->documento_id) {
            $documento = Document::find($this->documento_id);

            if ($documento) {
                $this->titulo = $documento->titulo;
                $this->derivado_oficina = $documento->derivado_oficina;

                // Verifica si fecha_salida tiene un valor válido antes de formatear
                $this->fecha_salida = $documento->fecha_salida 
                    ? \Carbon\Carbon::parse($documento->fecha_salida)->format('Y-m-d')
                    : null;
            }
        }

        // Resetea el archivo si es necesario
        $this->reset(['archivo']);
    }

    public function save()
    {
        $this->validate();
    
        // Verificar si el documento_id está presente
        if (!$this->documento_id) {
            session()->flash('error', 'Documento ID no encontrado.');
            return;
        }
    
        // Depuración: Verificar si el archivo se está recibiendo
        logger('Archivo recibido:', ['archivo' => $this->archivo]);
    
        // Buscar el documento
        $documento = Document::find($this->documento_id);
    
        // Verificar si el documento existe
        if (!$documento) {
            session()->flash('error', 'El documento no existe.');
            return;
        }
    
        // Guardar el archivo
        $rutaArchivo = $this->archivo->store('uploads', 'public');
    
        // Actualizar el documento
        $documento->update([
            'derivado_oficina' => $this->derivado_oficina,
            'fecha_salida' => $this->fecha_salida,
            'trabajador_id' => Auth::id(), // Asignar el trabajador autenticado
        ]);
    
        // Buscar si ya hay un archivo asociado a este documento
        $file = File::where('documento_id', $this->documento_id)->first();
    
        if ($file) {
            // Si ya existe, actualizar los datos del archivo
            $file->update([
                'ruta_archivo' => $rutaArchivo,
                'tipo' => $this->archivo->getClientOriginalExtension(),
                'nombre_original' => $this->archivo->getClientOriginalName(),
            ]);
        } else {
            // Si no existe, crear un nuevo registro
            File::create([
                'documento_id' => $this->documento_id,
                'ruta_archivo' => $rutaArchivo,
                'tipo' => $this->archivo->getClientOriginalExtension(),
                'nombre_original' => $this->archivo->getClientOriginalName(),
            ]);
        }
    
        session()->flash('message', 'Archivo subido y documento derivado correctamente.');
        $this->reset();
        return redirect()->route('documents.index');
    }

    public function closeModal()
    {
        return redirect(route('documents.index')); // Esto redirige a la página anterior
    }

    public function render()
    {
        return view('livewire.files.upload-file-derivation')->layout('layouts.app');
    }
}