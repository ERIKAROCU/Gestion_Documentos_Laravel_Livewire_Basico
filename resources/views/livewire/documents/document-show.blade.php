<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-center text-2xl font-semibold text-gray-700 mb-6">Detalles del Documento</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Columna de títulos -->
        <div>
            <div class="font-medium text-gray-800 mb-4"><strong>Responsable:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Número:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Fecha de Ingreso:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Origen:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Título:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Número de Folios:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Detalles:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Derivado a:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Fecha de Salida:</strong></div>
            <div class="font-medium text-gray-800 mb-4"><strong>Archivo:</strong></div>
        </div>

        <!-- Columna de resultados -->
        <div>
            @if($document)
                <div class="mb-4">
                    @if ($document->trabajador)
                        {{ $document->trabajador->name }}
                    @else
                        <span class="text-sm text-red-600">Sin asignar</span>
                    @endif
                </div>
                
                <div class="mb-4">
                    <p class="font-medium text-gray-800">{{ $document->numero_documento ?? 'No disponible' }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-medium text-gray-800">{{ $document->fecha_ingreso ?? 'No disponible' }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-medium text-gray-800">{{ $document->origen_oficina ?? 'No disponible' }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-medium text-gray-800">{{ $document->titulo ?? 'No disponible' }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-medium text-gray-800">{{ $document->numero_folios ?? 'No disponible' }}</p>
                </div>
                <div class="mb-4">
                    <p class="font-medium text-gray-800">{{ $document->detalles ?? 'No disponible' }}</p>
                </div>

                <div class="mb-4">
                    @if($document->derivado_oficina)
                        <p class="font-medium text-gray-800">{{ $document->derivado_oficina }}</p>
                    @else
                        <p class="font-medium text-red-500">No derivado</p>
                    @endif
                </div>

                <div class="mb-4">
                    @if($document->fecha_salida)
                        <p class="font-medium text-gray-800">{{ $document->fecha_salida }}</p>
                    @else
                        <p class="font-medium text-red-500">Sin fecha de salida</p>
                    @endif
                </div>

                <div class="mb-4">
                    @if ($document->files->isNotEmpty())
                        <p class="font-medium text-gray-800"><a href="{{ route('files.download', $document->files->first()->id) }}" class="text-blue-500 hover:text-blue-700">Descargar</a></p>
                    @else
                        <p class="font-medium text-red-500">Sin archivo</p>
                    @endif
                </div>
            @else
                <p class="text-red-500">No se ha encontrado el documento.</p>
            @endif
        </div>
    </div>

    <footer class="mt-6 flex justify-between space-x-4">
        <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-6 py-2 rounded-md transition-transform transform hover:scale-105 hover:bg-gray-600 duration-300">
            Cancelar
        </button>
    </footer>
</div>
