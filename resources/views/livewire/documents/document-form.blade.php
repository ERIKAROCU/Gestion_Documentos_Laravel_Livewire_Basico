<div>
    @if($modalVisible)
        <!-- Fondo oscurecido que cubre toda la pantalla -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 overflow-y-auto">
            <!-- Contenedor del modal -->
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-[40rem]">
                    <h2 class="text-lg font-bold mb-4 text-center">
                        {{ $isEditing ? 'Editar Documento' : 'Nuevo Documento' }}
                    </h2>

                    <form wire:submit.prevent="save" class="grid grid-cols-2 gap-4">
                        <div class="mb-2">
                            <label class="block text-sm font-medium">Número de Documento</label>
                            <input type="text" wire:model="numero_documento" class="w-full border rounded p-2">
                            @error('numero_documento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-medium">Fecha de Ingreso</label>
                            <input type="date" wire:model="fecha_ingreso" class="w-full border rounded p-2">
                            @error('fecha_ingreso') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-medium">Origen Oficina</label>
                            <select wire:model="origen_oficina" class="w-full border rounded p-2">
                                <option value="">Seleccione una oficina</option>
                                @foreach($oficinas as $oficina)
                                    <option value="{{ $oficina->nombre_oficina }}">{{ $oficina->nombre_oficina }}</option>
                                @endforeach
                            </select>
                            @error('origen_oficina') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-medium">Título</label>
                            <input type="text" wire:model="titulo" class="w-full border rounded p-2">
                            @error('titulo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-medium">Número de Folios</label>
                            <input type="number" wire:model="numero_folios" class="w-full border rounded p-2">
                            @error('numero_folios') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-2">
                            <label class="block text-sm font-medium">Detalles</label>
                            <textarea wire:model="detalles" class="w-full border rounded p-2"></textarea>
                            @error('detalles') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-2 flex justify-end mt-4 space-x-2">
                            <button wire:click="$set('modalVisible', false)" type="button" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
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