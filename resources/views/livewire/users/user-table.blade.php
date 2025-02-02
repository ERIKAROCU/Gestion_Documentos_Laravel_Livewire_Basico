<div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
    
    <!-- Botón para crear usuario -->
    <button
        wire:click="openCreateModal"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mb-4"
    >
        Crear Usuario
    </button>

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

    <!-- Tabla de usuarios -->
    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
        <thead>
            <tr class="bg-gray-100">
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Nombre</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Correo Electrónico</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">DNI</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Cargo</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Rol</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Estado</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-600">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $user->dni }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $user->cargo }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $user->role }}</td>
                    <td class="py-2 px-4 border-b text-sm text-gray-700">
                        @if ($user->is_active)
                            <span class="text-green-600">Activo</span>
                        @else
                            <span class="text-red-600">Inactivo</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b text-sm">
                        <!-- Editar usuario -->
                        <button
                            wire:click="openEditModal({{ $user->id }})"
                            class="text-blue-500 hover:text-blue-700 text-sm"
                        >
                            <i class="fas fa-pencil-alt w-5 h-5 inline-block"></i>
                        </button>
                        |
                        <!-- Ver usuario -->
                        <button
                            wire:click="openViewModal({{ $user->id }})"
                            class="text-blue-500 hover:text-blue-700 text-sm"
                        >
                            <i class="fas fa-eye w-5 h-5 inline-block"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <!-- Modal para crear usuario -->
    @if ($showCreateModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                @livewire('users.user-form', key('create-user'))
            </div>
        </div>
    @endif

    <!-- Modal para editar usuario -->
    @if ($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                @livewire('users.user-form', ['userId' => $userId], key($userId))
            </div>
        </div>
    @endif

    <!-- Modal para ver usuario -->
    @if ($showViewModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
                @livewire('users.user-show', ['userId' => $userId], key($userId))
            </div>
        </div>
    @endif
</div>