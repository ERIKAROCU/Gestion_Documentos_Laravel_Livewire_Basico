<div>
    @if($modalVisible)
        <!-- Fondo oscurecido que cubre toda la pantalla -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 overflow-y-auto">
            <!-- Contenedor del modal -->
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-[40rem]">
                    <h2 class="text-lg font-bold mb-4 text-center">
                        {{ $isEditing ? 'Editar Usuario' : 'Nuevo Usuario' }}
                    </h2>

                    <form wire:submit.prevent="save" class="grid grid-cols-2 gap-4">
                        <!-- Nombre -->
                        <div class="col-span-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" wire:model="name" id="name" placeholder="Nombre completo"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="col-span-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                            <input type="email" wire:model="email" id="email" placeholder="Correo electrónico"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                            @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- DNI -->
                        <div class="col-span-1">
                            <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                            <input type="text" wire:model="dni" id="dni" placeholder="DNI"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                            @error('dni') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Cargo -->
                        <div class="col-span-1">
                            <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo</label>
                            <input type="text" wire:model="cargo" id="cargo" placeholder="Cargo"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                            @error('cargo') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Rol -->
                        <div class="col-span-1">
                            <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                            <select wire:model="role" id="role"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                                <option value="admin">Administrador</option>
                                <option value="user">Usuario</option>
                            </select>
                            @error('role') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Estado -->
                        <div class="col-span-1">
                            <label for="is_active" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select wire:model="is_active" id="is_active"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            @error('is_active') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Contraseña -->
                        <div class="col-span-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" wire:model="password" id="password" placeholder="Contraseña"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                            @error('password') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="col-span-1">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                            <input type="password" wire:model="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña"
                                class="mt-1 block w-full rounded-md border-gray-300 p-2">
                        </div>

                        <!-- Botones (col-span-2 para ocupar ambas columnas) -->
                        <div class="col-span-2 flex justify-end mt-4 space-x-2">
                            <button wire:click="$set('modalVisible', false)" type="button"
                                class="px-4 py-2 bg-gray-300 rounded">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded">
                                {{ $isEditing ? 'Actualizar' : 'Guardar' }}
                            </button>
                        </div>
                    </form>
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
<script>
    window.addEventListener('swal', event => {
        Swal.fire({
            title: event.detail.title,
            icon: event.detail.icon,
            showConfirmButton: true,
            timer: 1000
        });
    });
</script>
