<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
    <div>
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Gestión de Oficinas</h1>
    </div>
    <div>
        <ul>
            <li>
                <button wire:click="dispatch('showModal')" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-building"></i>  Agregar
                </button>
            </li>
        </ul>
    </div>
    <br>
    <div class="mb-4 flex justify-between items-center">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar por nombre"
            class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <select
            wire:model.live="perPage"
            class="px-6 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="10">10 por página</option>
            <option value="25">25 por página</option>
            <option value="50">50 por página</option>
        </select>
    </div>

    <div wire:key="oficina-table">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-900">Número</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-900">Nombre</th>
                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-900">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($oficinas as $oficina)
                    <tr wire:key="oficina-{{ $oficina->id }}">
                        <td class="py-2 px-4 border-b text-sm text-gray-800">{{ $oficina->id }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-800">{{ $oficina->nombre_oficina }}</td>
                        <td class="py-2 px-4 border-b text-sm text-gray-800 text-center">
                            {{-- Botón Editar --}}
                            <button wire:click="dispatch('edit', { id: {{ $oficina->id }} })"
                                class="bg-blue-500 text-white px-3 py-1 rounded">
                                <i class="fas fa-edit"></i>
                             </button>

                            {{-- Botón Eliminar --}}
                            <button onclick="confirmDelete({{ $oficina->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $oficinas->links() }}
    </div>

    {{-- Incluir el modal --}}
    @livewire('oficinas.create-oficina')

    {{-- Script para confirmar eliminación --}}
    <script>
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar esta oficina?')) {
                Livewire.dispatch('deleteRow', { id: id });

            }
        }
    </script>
</div>
