<div>
    @if($modalVisible)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 overflow-y-auto">
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-[40rem]">
                    <h2 class="text-lg font-bold mb-4 text-center">
                        Historial de Usuario
                    </h2>

                    <div class="grid grid-cols-3 gap-4 items-start">
                        <!-- Etiquetas -->
                        <div class="flex flex-col space-y-3">
                            <p class="font-medium">Total de Documentos:</p>
                            <p class="font-medium text-green-600">Recibidos:</p>
                            <p class="font-medium text-blue-600">Emitidos:</p>
                            <p class="font-medium text-red-600">Vencidos:</p>
                        </div>
                    
                        <!-- Valores -->
                        <div class="flex flex-col space-y-4">
                            <p class="font-medium text-gray-700">{{ $totalDocumentos }}</p>
                            <p class="font-medium text-green-700">{{ $documentosRecibidos }}</p>
                            <p class="font-medium text-blue-700">{{ $documentosEmitidos }}</p>
                            <p class="font-medium text-red-700">{{ $documentosVencidos }}</p>
                        </div>
                    
                        <!-- Nombre de Usuario -->
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold">Nombre de Usuario</h3>
                            <p class="text-xl font-bold text-gray-800">{{ $nombreUsuario }}</p>
                        </div>
                    </div>
                    
                    <br>
                    <div class="max-h-[300px] overflow-y-auto border border-gray-300 rounded-md">
                        <!-- Tabla de documentos -->
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="sticky top-0 bg-gray-200 z-10">
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 p-2">Número</th>
                                    <th class="border border-gray-300 p-2">Fecha Ingreso</th>
                                    <th class="border border-gray-300 p-2">Título</th>
                                    <th class="border border-gray-300 p-2">Estado</th>
                                    <th class="border border-gray-300 p-2">Archivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documents as $document)
                                    <tr>
                                        <td class="border border-gray-300 p-2">{{ $document->numero_documento }}</td>
                                        <td class="border border-gray-300 p-2">{{ \Carbon\Carbon::parse($document->fecha_salida)->format('Y-m-d') }}</td>
                                        <td class="border border-gray-300 p-2">{{ $document->titulo }}</td>
                                        <td class="border border-gray-300 p-2">
                                            @if ($document->estado == 'recibido')
                                                <span class="text-blue-600">Recibido</span>
                                            @elseif ($document->estado == 'emitido')
                                                <span class="text-green-600">Emitido</span>
                                            @else
                                                <span class="text-red-600">Vencido</span>
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            @if ($document->files->isNotEmpty())
                                                <p class="font-medium text-gray-800"><a href="{{ route('files.download', $document->files->first()->id) }}" class="text-blue-500 hover:text-blue-700" title="Descargar"><i class="fas fa-download text-sm"></i></a></p>
                                            @else
                                                <p class="font-medium text-red-500" title="No hay archivo disponible"><i class="fas fa-ban text-sm text-gray-500"></i>
                                                </p>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-red-500 p-4">No hay documentos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Botón para cerrar -->
                    <div class="flex justify-end mt-4">
                        <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
