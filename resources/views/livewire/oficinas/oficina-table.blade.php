<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
    <div>
        <ul>
            <li>
                <button wire:click="dispatch('showModal')" class="bg-dark btn btn-sm">
                    Agregar
                </button>
            </li>
        </ul>
    </div>

    <div wire:key="oficinas-table">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Número</th>
                    <th class="border border-gray-300 p-2">Nombre</th>
                    <th class="border border-gray-300 p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($oficinas as $oficina)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $oficina->id }}</td>
                        <td class="border border-gray-300 p-2">{{ $oficina->nombre_oficina }}</td>
                        <td class="border border-gray-300 p-2 text-center">
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
