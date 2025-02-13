<div>
    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Total de Documentos -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800">Total de Documentos</h3>
            <p class="text-2xl font-bold text-blak">{{ $documentosUsuario }}</p>
        </div>

        <!-- Documentos Vencidos -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800">Vencidos</h3>
            <p class="text-2xl font-bold text-red-600">{{ $documentosEstadoVencido }}</p>
        </div>

        <!-- Documentos Emitidos -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800">Emitidos</h3>
            <p class="text-2xl font-bold text-green-600">{{ $documentosEstadoEmitido }}</p>
        </div>

        <!-- Documentos Recibidos -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800">Recibidos</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $documentosEstadoRecibido }}</p>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Gráfico de Líneas - Documentos Registrados por Día -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Documentos Registrados por Día</h3>
            <canvas id="lineChartUserDocuments"></canvas>
        </div>

        <!-- Gráfico de Barras - Documentos por Estado -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Documentos por Estado</h3>
            <canvas id="barChartUserDocuments"></canvas>
        </div>
    </div>
</div>