<div>
    <!-- Botón para abrir el modal -->
    <button wire:click="openModal" class="bg-green-500 text-white px-4 py-2 rounded-md">Nuevo Documento</button>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed inset-0 flex justify-center items-center z-50 bg-gray-500 bg-opacity-50">
            <div class="bg-white p-8 rounded-lg shadow-lg w-96">
                <form wire:submit.prevent="save">
                    <div>
                        <input type="text" wire:model="numero_documento" placeholder="Número de Documento" class="w-full p-2 border rounded-md">
                        @error('numero_documento') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <input type="date" wire:model="fecha_ingreso" class="w-full p-2 border rounded-md">
                        @error('fecha_ingreso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <input type="text" wire:model="origen_oficina" placeholder="Oficina de Origen" class="w-full p-2 border rounded-md">
                        @error('origen_oficina') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <input type="text" wire:model="titulo" placeholder="Título" class="w-full p-2 border rounded-md">
                        @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <input type="number" wire:model="numero_folios" placeholder="Número de Folios" class="w-full p-2 border rounded-md">
                        @error('numero_folios') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <textarea wire:model="detalles" placeholder="Detalles" class="w-full p-2 border rounded-md"></textarea>
                        @error('detalles') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <footer class="mt-6 flex justify-between">
                        <button type="button" wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-md">Cancelar</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</button>
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
