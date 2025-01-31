<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">

    @livewire('documents.create-document')

    <br>

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
            @foreach ($documents as $document)
                <tr>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->numero_documento }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $document->titulo }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ \Carbon\Carbon::parse($document->fecha_ingreso)->format('d/m/Y H:i') }}</td>
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
                            {{ \Carbon\Carbon::parse($document->fecha_salida)->format('d/m/Y H:i') }}
                        @else
                            <span class="text-gray-500">Sin fecha de salida</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b text-sm">
                        <!-- Descargar archivo -->
                        @if ($document->files->isNotEmpty())
                            <a href="{{ route('files.download', $document->files->first()->id) }}" class="text-blue-500 hover:text-blue-700 text-sm">Descargar</a>                        
                        @else
                            <span class="text-gray-500">Sin archivo</span>
                        @endif
                        |
                        <!-- Editar documento -->
                        <a href="{{ route('documents.edit', $document->id) }}" class="text-blue-500 hover:text-blue-700 text-sm">Editar</a>
                        |
                        <!-- Emitir documento -->
                        <a href="{{ route('files.upload', $document->id) }}" class="text-blue-500 hover:text-blue-700 text-sm">Emitir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $documents->links() }}
    </div>
</div>
