<div>
    @if($modalVisible)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-lg font-bold mb-4">
                    {{ $oficina_id ? 'Editar Oficina' : 'Nueva Oficina' }}
                </h2>

                <input type="text" wire:model="nombre_oficina" class="w-full p-2 border rounded" placeholder="Nombre de la oficina">
                @error('nombre_oficina') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div class="flex justify-end mt-4 space-x-2">
                    <button wire:click="$set('modalVisible', false)" class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
                    <button wire:click="save" class="px-4 py-2 bg-blue-500 text-white rounded">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
