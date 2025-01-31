<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function download($id)
    {
        $file = File::findOrFail($id);

        // Depuración: Verificar si el archivo existe en el almacenamiento
        if (!Storage::disk('public')->exists($file->ruta_archivo)) {
            abort(404, 'Archivo no encontrado.');
        }

        return Storage::disk('public')->download($file->ruta_archivo, $file->nombre_original);
    }

}