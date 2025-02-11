<!-- Tarjetas de Estadísticas -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Total de Usuarios -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Total de Usuarios</h3>
        <p class="text-2xl font-bold text-blue-600">{{ $totalUsuarios }}</p>
    </div>

    <!-- Activos -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Activos</h3>
        <p class="text-2xl font-bold text-green-600">{{ $usuariosActivos }}</p>
    </div>

    <!-- Inactivos -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800">Inactivos</h3>
        <p class="text-2xl font-bold text-red-600">{{ $usuariosInactivos }}</p>
    </div>
</div>

<!-- Gráficos para Usuarios -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Gráfico de Barras - Usuarios por Cargo -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Usuarios por Cargo</h3>
        <canvas id="barChartUsersByRole"></canvas>
    </div>

    <!-- Gráfico de Torta - Roles de Usuarios -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribución de Roles</h3>
        <canvas id="pieChartUsersByRole"></canvas>
    </div>

    <!-- Gráfico de Barras - Usuarios Activos e Inactivos -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Usuarios Activos e Inactivos</h3>
        <canvas id="barChartUsersActive"></canvas>
    </div>

    <!-- Gráfico de Líneas - Usuarios Registrados en el Tiempo -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Usuarios Registrados en el Tiempo</h3>
        <canvas id="lineChartUsersOverTime"></canvas>
    </div>
</div>