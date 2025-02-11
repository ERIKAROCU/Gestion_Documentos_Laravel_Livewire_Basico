<div>
    <!-- Botón para abrir el modal -->
    <button wire:click="openModal" class="bg-green-500 text-white px-4 py-2 rounded-md transition-transform transform hover:scale-105 hover:bg-green-600 duration-300">
        Nuevo Documento
    </button>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed inset-0 flex justify-center items-center z-50 bg-gray-500 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/2 sm:w-86 transform transition-all duration-500">
                <h2 class="text-center text-2xl font-semibold text-gray-700 mb-4">Nuevo Documento</h2>
                <form wire:submit.prevent="save" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="numero_documento" class="block text-sm font-medium text-gray-700">Número de Documento</label>
                            <input
                                type="text"
                                wire:model="numero_documento"
                                id="numero_documento"
                                placeholder="Número de Documento"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('numero_documento') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="fecha_ingreso" class="block text-sm font-medium text-gray-700">Fecha de Ingreso</label>
                            <input
                                type="date"
                                wire:model="fecha_ingreso"
                                id="fecha_ingreso"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('fecha_ingreso') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- <div>
                            <label for="origen_oficina" class="block text-sm font-medium text-gray-700">Oficina de Origen</label>
                            <input
                                type="text"
                                wire:model="origen_oficina"
                                id="origen_oficina"
                                placeholder="Oficina de Origen"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('origen_oficina') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div> --}}

                        <div>
                            <label for="origen_oficina" class="block text-sm font-medium text-gray-700">Oficina de Origen</label>
                            <select
                                wire:model="origen_oficina"
                                id="origen_oficina"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                                <option value="">Seleccione una oficina</option>
                                @foreach($oficinas as $oficina)
                                    <option value="{{ $oficina->nombre_oficina }}">{{ $oficina->nombre_oficina }}</option>
                                @endforeach
                            </select>
                            @error('origen_oficina') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        

                        <div>
                            <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                            <input
                                type="text"
                                wire:model="titulo"
                                id="titulo"
                                placeholder="Título"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('titulo') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="numero_folios" class="block text-sm font-medium text-gray-700">Número de Folios</label>
                            <input
                                type="number"
                                wire:model="numero_folios"
                                id="numero_folios"
                                placeholder="Número de Folios"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            >
                            @error('numero_folios') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="detalles" class="block text-sm font-medium text-gray-700">Detalles</label>
                            <textarea
                                wire:model="detalles"
                                id="detalles"
                                placeholder="Detalles"
                                rows="3"
                                class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                            ></textarea>
                            @error('detalles') <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <footer class="mt-6 flex justify-between space-x-4">
                        <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-md transition-transform transform hover:scale-105 hover:bg-gray-600 duration-300">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md transition-transform transform hover:scale-105 hover:bg-blue-600 duration-300">
                            Guardar
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    @endif

    @if (session()->has('message'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
</div>
