<div>
    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <input type="hidden" wire:model="documento_id" value="{{ $documento_id }}">

        <div>
            <label for="titulo">Título del archivo:</label>
            <input type="text" wire:model="titulo" id="titulo" placeholder="Título del archivo">
            @error('titulo') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="derivado_oficina">Oficina de destino:</label>
            <input type="text" wire:model="derivado_oficina" id="derivado_oficina" placeholder="Oficina de destino">
            @error('derivado_oficina') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="fecha_salida">Fecha de salida:</label>
            <input type="date" wire:model="fecha_salida" id="fecha_salida">
            @error('fecha_salida') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="archivo">Archivo:</label>
            <input type="file" wire:model="archivo" id="archivo">
            @error('archivo') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <footer>
            <button type="button" wire:click="cancel">Cancelar</button>
            <button type="submit" wire:loading.attr="disabled" wire:target="save">
                Subir y Derivar
            </button>
        </footer>
    </form>

    @if (session()->has('message'))
        <script>
            Swal.fire('Éxito', '{{ session('message') }}', 'success');
        </script>
    @endif
</div>
