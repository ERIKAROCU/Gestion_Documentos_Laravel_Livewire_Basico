<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
    @livewire('documents.create-document')
    <br>
    <!-- Barra de búsqueda y filtros -->
    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Filtro por fecha -->
        <div>
            <input
                type="date"
                wire:model.live="searchDate"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Filtrar por fecha"
            >
        </div>

        <!-- Filtro por oficina de origen -->
        <div>
            <select
                wire:model.live="searchOrigenOficina"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Oficina de origen (Todo)</option>
                @foreach($oficinas as $oficina)
                    <option value="{{ $oficina->nombre_oficina }}">{{ $oficina->nombre_oficina }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por oficina derivada -->
        <div>
            <select
                wire:model.live="searchDerivadoOficina"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Oficina derivada (Todo)</option>
                @foreach($oficinas as $oficina)
                    <option value="{{ $oficina->nombre_oficina }}">{{ $oficina->nombre_oficina }}</option>
                @endforeach
            </select>
        </div>

        <!-- Número de documentos por página -->
        <div class="sm:col-span-2 lg:col-span-1">
            <select
                wire:model.live="perPage"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="10">10 por página</option>
                <option value="25">25 por página</option>
                <option value="50">50 por página</option>
            </select>
        </div>

        <!-- Búsqueda general -->
        <div class="lg:col-span-2">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Buscar por número documento, título..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <!-- Busqueda por estado -->
        <div class="sm:col-span-2 lg:col-span-1">
            <select
                wire:model.live="searchEstado"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Todo</option>
                <option value="recibido">Recibidos</option>
                <option value="emitido">Emitidos</option>
                <option value="vencido">Vencidos</option>
            </select>
        </div>

        <div>
            <button
                wire:click="resetFilters"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
            >
                Resetear Filtros
            </button>
        </div>
    </div>
    
    

    <!-- Tabla de documentos -->
    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-2 border-b text-left text-sm font-medium text-gray-600 w-10">Número de Documento</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Título</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Fecha de Ingreso</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Oficina de Origen</th>
                <th class="py-2 px-2 border-b text-left text-sm font-medium text-gray-600 w-10">Folios</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Derivado Oficina</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Fecha de Salida</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Estado</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Tiempo Restante</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($documents as $document)
                <tr>
                    <td class="py-2 px-2 border-b text-sm text-gray-700 w-10 truncate">{{ $document->numero_documento }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->titulo }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ \Carbon\Carbon::parse($document->fecha_ingreso)->format('d-m-Y') }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->origen_oficina }}</td>
                    <td class="py-2 px-2 border-b text-sm text-gray-700 w-10 text-center">{{ $document->numero_folios }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">
                        @if ($document->derivado_oficina)
                            {{ $document->derivado_oficina }}
                        @else
                            <span class="text-gray-500">Sin derivar</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">
                        @if ($document->fecha_salida)
                            {{ \Carbon\Carbon::parse($document->fecha_salida)->format('Y-m-d') }}
                        @else
                            <span class="text-gray-500">Sin fecha de salida</span>
                        @endif
                    </td>

                    <td class="py-2 px-4 border-b text-sm text-gray-700">
                        @if ($document->estado == 'vencido')
                            <span class="text-red-600 font-bold">Vencido</span>
                        @elseif ($document->estado == 'emitido')
                            <span class="text-green-600 font-bold">Emitido</span>
                        @else
                            <span class="text-blue-600 font-bold">{{ $document->estado }}</span>
                        @endif
                    </td>
                    
                    <td class="py-2 px-4 border-b text-sm text-gray-700">
                        @if ($document->derivado_oficina)
                            <span class="font-bold text-green-600">Emitido</span>
                        @else
                            @php
                                // Calcular fechas
                                $fechaIngreso = \Carbon\Carbon::parse($document->fecha_ingreso);
                                $fechaLimite = $fechaIngreso->copy()->addDays(5);
                                $fechaActual = \Carbon\Carbon::now();
                        
                                // Calcular días restantes con decimales
                                $diasRestantes = round($fechaActual->floatDiffInDays($fechaLimite, false), 2);
                                $totalDias = 5;
                        
                                // Calcular porcentaje restante, asegurando que no pase del 100%
                                $porcentajeRestante = min(max(($diasRestantes / $totalDias) * 100, 0), 100);
                        
                                // Determinar color según los días restantes
                                if ($diasRestantes >= 3.5) {
                                    $colorClass = 'bg-green-500'; // Verde (más de 3 días restantes)
                                } elseif ($diasRestantes >= 2.5) {
                                    $colorClass = 'bg-yellow-500'; // Amarillo (3 días restantes)
                                } elseif ($diasRestantes >= 2) {
                                    $colorClass = 'bg-orange-500'; // Naranja (2 días restantes)
                                } elseif ($diasRestantes >= 1) {
                                    $colorClass = 'bg-orange-600'; // Naranja (2 días restantes)
                                } else {
                                    $colorClass = 'bg-red-500'; // Rojo (1 día o menos)
                                    $porcentajeRestante = 100; // Si está vencido, la barra es 100% roja
                                }
                            @endphp
                    
                            <!-- Barra de progreso con ancho restringido -->
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                <div class="h-2.5 rounded-full {{ $colorClass }}" style="width: {{ $porcentajeRestante }}%; max-width: 100%; transition: width 0.5s;"></div>
                            </div>
                            
                            <!-- Texto con los días restantes -->
                            <div class="mt-1 text-sm font-semibold">
                                @if ($diasRestantes > 0)
                                    {{ number_format($diasRestantes, 2) }} días restantes
                                @else
                                    <span class="text-red-600 font-bold">Vencido</span>
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b text-sm">
                        <!-- Descargar archivo -->
                        @if ($document->files->isNotEmpty())
                            <a href="{{ route('files.download', $document->files->first()->id) }}" class="text-blue-500 hover:text-blue-700 text-sm">
                                <i class="fas fa-arrow-down w-5 h-5 inline-block"></i>
                            </a>                        
                        @else
                            <span class="text-red-500">Sin archivo</span>
                        @endif
                        |
                        <!-- Editar documento -->
                        <button wire:click="editDocument({{ $document->id }})" class="text-blue-500 hover:text-blue-700 text-sm">
                            <i class="fas fa-pencil-alt w-5 h-5 inline-block"></i>
                        </button>
                        |
                        <!-- Emitir documento -->
                        <button wire:click="emitDocument({{ $document->id }})" class="text-blue-500 hover:text-blue-700 text-sm">
                            <i class="fas fa-share-square w-5 h-5 inline-block"></i>
                        </button>
                        |
                        <!-- Ver documento -->
                        <button wire:click="verDocument({{ $document->id }})" class="text-blue-500 hover:text-blue-700 text-sm">
                            <i class="fas fa-eye w-5 h-5 inline-block"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <!-- Si no hay documentos -->
                <tr>
                    <td colspan="9" class="text-center">No se encontraron resultados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $documents->links() }}
    </div>

    <!-- Modal para editar documento -->
    @if ($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-2 rounded-lg shadow-lg w-1/2">
                @livewire('documents.edit-document', ['documentId' => $documentId], key($documentId))
            </div>
        </div>
    @endif

    <!-- Modal para emitir documento -->
    @if ($showEmitModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                @livewire('files.upload-file-derivation', ['documentoId' => $documentoId], key($documentoId))
            </div>
        </div>
    @endif

    <!-- Modal para ver documento -->
    @if ($showVerModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                @livewire('documents.document-show', ['documentoId' => $documentoId], key($documentoId))
            </div>
        </div>
    @endif
</div>