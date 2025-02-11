<div class="bg-white p-2 rounded-lg">
    <h2 class="text-center text-2xl font-semibold text-gray-700 mb-4">Editar Documento</h2>
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Número de Documento -->
            <div>
                <label for="numero_documento" class="block text-sm font-medium text-gray-700">Número de Documento</label>
                <input
                    type="text"
                    wire:model="numero_documento"
                    id="numero_documento"
                    placeholder="Número de Documento"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                >
                @error('numero_documento')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Fecha de Ingreso -->
            <div>
                <label for="fecha_ingreso" class="block text-sm font-medium text-gray-700">Fecha de Ingreso</label>
                <input
                    type="date"
                    wire:model="fecha_ingreso"
                    id="fecha_ingreso"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                >
                @error('fecha_ingreso')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="origen_oficina" class="block text-sm font-medium text-gray-700">Oficina de Origen</label>
                <select
                    wire:model="origen_oficina"
                    id="origen_oficina"
                    placeholder="Oficina de Origen"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                >
                    <option value="">Seleccione una oficina</option>
                    @foreach($oficinas as $oficina)
                        <option value="{{ $oficina->nombre_oficina }}">{{ $oficina->nombre_oficina }}</option>
                    @endforeach
                </select>
                @error('origen_oficina') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
            </div>

            <!-- Título -->
            <div>
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <input
                    type="text"
                    wire:model="titulo"
                    id="titulo"
                    placeholder="Título"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                >
                @error('titulo')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Número de Folios -->
            <div>
                <label for="numero_folios" class="block text-sm font-medium text-gray-700">Número de Folios</label>
                <input
                    type="number"
                    wire:model="numero_folios"
                    id="numero_folios"
                    placeholder="Número de Folios"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                >
                @error('numero_folios')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Detalles -->
            <div>
                <label for="detalles" class="block text-sm font-medium text-gray-700">Detalles</label>
                <textarea
                    wire:model="detalles"
                    id="detalles"
                    placeholder="Detalles"
                    rows="3"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                ></textarea>
                @error('detalles')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>
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
