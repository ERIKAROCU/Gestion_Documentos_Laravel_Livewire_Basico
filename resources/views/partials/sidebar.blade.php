<div class="w-100 bg-gray-800 shadow-md">
    <div class="p-4">
        <h2 class="text-lg font-bold">Panel de Control</h2>
    </div>
    <nav>
        <ul>
            <li><a href="{{ route('dashboard') }}" class="block p-4 hover:bg-gray-200">Dashboard</a></li>
            <li><a href="{{ route('documents.index') }}" class="block p-4 hover:bg-gray-200">Documentos</a></li>
            
            <!-- Mostrar solo si el usuario es admin -->
            @if(Auth::check() && Auth::user()->role === 'admin')
                <li><a href="{{ route('users.index') }}" class="block p-4 hover:bg-gray-200">Usuarios</a></li>
            @endif

            <!-- Mostrar solo si el usuario es admin -->
            @if(Auth::check() && Auth::user()->role === 'admin')
                <li><a href="{{ route('ad.index') }}" class="block p-4 hover:bg-gray-200">Admin Documentos</a></li>
            @endif
        </ul>
    </nav>
</div>
