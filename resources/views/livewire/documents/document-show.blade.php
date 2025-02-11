<div>
    @if($modalVisible)
        <!-- Fondo oscurecido que cubre toda la pantalla -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 overflow-y-auto">
            <!-- Contenedor del modal -->
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-[40rem]">
                    <h2 class="text-lg font-bold mb-4">
                        Detalles del Documento
                    </h2>
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

                        <div class="col-span-2 flex justify-end mt-4 space-x-2">
                            <button wire:click="$set('modalVisible', false)" type="button" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deshabilitar el desplazamiento de la página cuando el modal está abierto -->
        <style>
            body {
                overflow: hidden;
            }
        </style>
    @endif
</div>
