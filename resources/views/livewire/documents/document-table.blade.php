<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">

    @livewire('documents.create-document')

    <br>

    <!-- Formulario de búsqueda -->
    <div class="mb-4">
        <input type="text" wire:model="search" class="form-control" placeholder="Buscar por número documento, fecha, título, oficina...">
        <button wire:click="$refresh" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Buscar</button>
    </div>

    <!-- Tabla de documentos -->
    <!-- Tabla de documentos -->
<table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
    <thead>
        <tr class="bg-gray-100">
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Número de Documento</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Título</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Fecha de Ingreso</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Oficina de Origen</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Folios</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Derivado Oficina</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Fecha de Salida</th>
            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($documents as $document)
            <tr>
                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->numero_documento }}</td>
                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->titulo }}</td>
                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ \Carbon\Carbon::parse($document->fecha_ingreso)->format('Y-m-d') }}</td>
                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->origen_oficina }}</td>
                <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->numero_folios }}</td>
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
                <td colspan="8" class="text-center">No se encontraron resultados para "<strong>{{ $search }}</strong>"</td>
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
            <div class="bg-white p-2 rounded-lg shadow-lg w-1/2 ">
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
