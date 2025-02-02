<div class="container mx-auto p-4 bg-white rounded-lg shadow-md">
    
    <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" wire:model="name" id="name" placeholder="Nombre completo"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Correo Electrónico -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
            <input type="email" wire:model="email" id="email" placeholder="Correo electrónico"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
            @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- DNI -->
        <div>
            <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
            <input type="text" wire:model="dni" id="dni" placeholder="DNI"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
            @error('dni') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Cargo -->
        <div>
            <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo</label>
            <input type="text" wire:model="cargo" id="cargo" placeholder="Cargo"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
            @error('cargo') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Rol -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
            <select wire:model="role" id="role"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                <option value="admin">Administrador</option>
                <option value="user">Usuario</option>
            </select>
            @error('role') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="is_active" class="block text-sm font-medium text-gray-700">Estado</label>
            <select wire:model="is_active" id="is_active"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            @error('is_active') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Contraseña -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" wire:model="password" id="password" placeholder="Contraseña"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
            @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Confirmar Contraseña -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
            <input type="password" wire:model="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña"
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2">
        </div>
    
        <footer class="col-span-2 flex justify-end space-x-4">
            <button type="button" wire:click="closeModal"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancelar
            </button>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ $isEditing ? 'Actualizar' : 'Crear' }}
            </button>
        </footer>
    </form>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <script>
            Swal.fire('Éxito', '{{ session('message') }}', 'success');
        </script>
    @endif
</div>
