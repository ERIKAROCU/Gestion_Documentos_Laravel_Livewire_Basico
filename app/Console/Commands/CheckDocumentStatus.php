<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Document;
use Carbon\Carbon;

class CheckDocumentStatus extends Command
{
    protected $signature = 'documents:check-status';
    protected $description = 'Verifica y actualiza el estado de los documentos vencidos';

    public function handle()
    {
        $documents = Document::where('estado', '!=', 'emitido')
            ->where('estado', '!=', 'vencido')
            ->get();

        foreach ($documents as $document) {
            if ($document->esVencido()) {
                $document->estado = 'vencido';
                $document->save();
            }
        }

        $this->info('Estado de los documentos verificado y actualizado correctamente.');
    }
}