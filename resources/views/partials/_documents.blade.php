<!-- Tarjetas de Estadísticas -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Total de Documentos -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Total de Documentos</h3>
        <p class="text-2xl font-bold text-blak">{{ $totalDocumentos }}</p>
    </div>

    <!-- Documentos Vencidos -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Vencidos</h3>
        <p class="text-2xl font-bold text-red-600">{{ $documentosVencidos }}</p>
    </div>

    <!-- Documentos Emitidos -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Emitidos</h3>
        <p class="text-2xl font-bold text-green-600">{{ $documentosEmitidos }}</p>
    </div>

    <!-- Documentos Recibidos -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Recibidos</h3>
        <p class="text-2xl font-bold text-blue-600">{{ $documentosRecibidos }}</p>
    </div>
</div>

<!-- Gráficos para Documentos -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Gráfico de Líneas - Documentos Registrados por Día -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Documentos Registrados por Día</h3>
        <canvas id="lineChartDocuments"></canvas>
    </div>

    <!-- Gráfico de Barras - Documentos por Estado -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Documentos por Estado</h3>
        <canvas id="barChartDocuments"></canvas>
    </div>

    <!-- Gráfico de Torta - Distribución de Documentos por Origen -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Documentos por Origen</h3>
        <canvas id="pieChartDocuments"></canvas>
    </div>

    <!-- Gráfico de Líneas - Documentos Vencidos en el Tiempo -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Documentos Vencidos en el Tiempo</h3>
        <canvas id="lineChartExpiredDocuments"></canvas>
    </div>
</div>