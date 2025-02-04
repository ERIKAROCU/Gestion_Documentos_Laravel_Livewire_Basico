<div class="space-y-4">
    <h2 class="text-center text-2xl font-semibold text-gray-700 mb-4">Emitir Documento</h2>
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
        <div>
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
                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
            >
            @error('archivo') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Botones de acción -->
        <footer class="mt-6 flex justify-between space-x-4">
            <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-md transition-transform transform hover:scale-105 hover:bg-gray-600 duration-300">
                Cancelar
            </button>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md transition-transform transform hover:scale-105 hover:bg-blue-600 duration-300">
                Guardar
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