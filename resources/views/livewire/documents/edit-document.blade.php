<div>
    <form wire:submit.prevent="save">

        <div>
            <div>
                <input type="text" wire:model="numero_documento" placeholder="Número de Documento">
                @error('numero_documento') <span style="color: red">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="date" wire:model="fecha_ingreso">
                @error('fecha_ingreso') <span style="color: red">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="text" wire:model="origen_oficina" placeholder="Oficina de Origen">
                @error('origen_oficina') <span style="color: red">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="text" wire:model="titulo" placeholder="Título">
                @error('titulo') <span style="color: red">{{ $message }}</span> @enderror
            </div>

            <div>
                <input type="number" wire:model="numero_folios" placeholder="Número de Folios">
                @error('numero_folios') <span style="color: red">{{ $message }}</span> @enderror
            </div>

            <div>
                <textarea wire:model="detalles" placeholder="Detalles"></textarea>
                @error('detalles') <span style="color: red">{{ $message }}</span> @enderror
            </div>
        </div>

        <footer>
            <button type="button" wire:click="cancel">Cancelar</button>
            <button type="submit">Guardar</button>
        </footer>
    </form>

    @if (session()->has('message'))
        <script>
            Swal.fire('Éxito', '{{ session('message') }}', 'success');
        </script>
    @endif
</div>