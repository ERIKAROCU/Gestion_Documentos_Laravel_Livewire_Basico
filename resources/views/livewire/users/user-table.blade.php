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

    <!-- Barra de búsqueda y filtros -->
    <div class="mb-4 flex justify-between items-center">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar por nombre, correo, DNI o cargo..."
            class="w-1/2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <select
            wire:model.live="isActive"
            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="">Todos</option>
            <option value="1">Activos</option>
            <option value="0">Inactivos</option>
        </select>

        <select
            wire:model.live="perPage"
            class="px-6 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="10">10 por página</option>
            <option value="25">25 por página</option>
            <option value="50">50 por página</option>
        </select>
    </div>

    <div wire:key="users-table">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Nombre</th>
                    <th class="border border-gray-300 p-2">Correo</th>
                    <th class="border border-gray-300 p-2">DNI</th>
                    <th class="border border-gray-300 p-2">Cargo</th>
                    <th class="border border-gray-300 p-2">Rol</th>
                    <th class="border border-gray-300 p-2">Estado</th>
                    <th class="border border-gray-300 p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 p-2">{{ $user->dni }}</td>
                        <td class="border border-gray-300 p-2">{{ $user->cargo }}</td>
                        <td class="border border-gray-300 p-2">{{ $user->role }}</td>
                        <td class="border border-gray-300 p-2 text-center">
                            @if ($user->is_active)
                                <span class="text-green-600">Activo</span>
                            @else
                                <span class="text-red-600">Inactivo</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 p-2 text-center">
                            <!-- Botón Editar -->
                            <button wire:click="dispatch('edit', { id: {{ $user->id }} })"
                                class="bg-blue-500 text-white px-3 py-1 rounded">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Botón Eliminar -->
                            {{-- <button onclick="confirmDelete({{ $user->id }})"
                                class="bg-red-500 text-white px-3 py-1 rounded">
                                <i class="fas fa-trash"></i> Eliminar
                            </button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    {{-- Incluir el modal --}}
    @livewire('users.user-form')

    {{-- Script para confirmar eliminación --}}
    <script>
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                Livewire.dispatch('deleteRow', { id: id });
            }
        }
    </script>
</div>
