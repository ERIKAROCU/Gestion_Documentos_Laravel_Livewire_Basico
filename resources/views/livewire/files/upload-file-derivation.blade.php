<div>
    @if($modalVisible)
        <!-- Fondo oscurecido que cubre toda la pantalla -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 z-50 overflow-y-auto">
            <!-- Contenedor del modal -->
            <div class="fixed inset-0 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg w-[40rem]">
                    <h2 class="text-lg font-bold mb-4">
                        {{ $isEditing ? 'Emitir Documento' : 'Editar Documento Emitido' }}
                    </h2>
                    <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-4">
                        <input type="hidden" wire:model="documento_id" value="{{ $documento_id }}">

                        <!-- Título del archivo -->
                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título del archivo</label>
                            <input
                                type="text"
                                wire:model="titulo"
                                id="titulo"
                                placeholder="Título del archivo"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('titulo') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Oficina de destino -->
                        <div wire:init="loadOficinas">
                            <label for="derivado_oficina" class="block text-sm font-medium text-gray-700">Oficina de destino</label>
                            <select
                                wire:model="derivado_oficina"
                                id="derivado_oficina"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                                <option value="">Seleccione una oficina</option>
                                @foreach($oficinas as $oficina)
                                    <option value="{{ $oficina->nombre_oficina }}">{{ $oficina->nombre_oficina }}</option>
                                @endforeach
                            </select>
                            @error('derivado_oficina') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Fecha de salida -->
                        <div>
                            <label for="fecha_salida" class="block text-sm font-medium text-gray-700">Fecha de salida</label>
                            <input
                                type="date"
                                wire:model="fecha_salida"
                                id="fecha_salida"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('fecha_salida') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Archivo -->
                        <div>
                            <label for="archivo" class="block text-sm font-medium text-gray-700">Archivo</label>
                            <input
                                type="file"
                                wire:model="archivo"
                                id="archivo"
                                accept="pdf,docs y mas"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('archivo') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <!-- Botones de acción -->
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