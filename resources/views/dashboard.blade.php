<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Pestañas -->
            <div x-data="{ tab: 'documents' }" class="mb-8">
                <!-- Botones de Pestañas -->
                <div class="flex space-x-4 border-b">
                    <button @click="tab = 'documents'" :class="{ 'border-b-2 border-blue-500': tab === 'documents' }" class="px-4 py-2 text-gray-700 focus:outline-none">
                        Documentos
                    </button>
                    <button @click="tab = 'users'" :class="{ 'border-b-2 border-blue-500': tab === 'users' }" class="px-4 py-2 text-gray-700 focus:outline-none">
                        Usuarios
                    </button>
                </div>

                <!-- Contenido de las Pestañas -->
                <div x-show="tab === 'documents'" class="mt-6">
                    <!-- Tarjetas de Estadísticas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                        <!-- Total de Documentos -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800">Total de Documentos</h3>
                            <p class="text-2xl font-bold text-blue-600">{{ $totalDocumentos }}</p>
                        </div>

                        <!-- Documentos Recibidos -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800">Recibidos</h3>
                            <p class="text-2xl font-bold text-green-600">{{ $documentosRecibidos }}</p>
                        </div>

                        <!-- Documentos Emitidos -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800">Emitidos</h3>
                            <p class="text-2xl font-bold text-yellow-600">{{ $documentosEmitidos }}</p>
                        </div>

                        <!-- Documentos Vencidos -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800">Vencidos</h3>
                            <p class="text-2xl font-bold text-red-600">{{ $documentosVencidos }}</p>
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
                </div>

                <div x-show="tab === 'users'" class="mt-6">
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
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts para los gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráficos para Documentos
        const lineChartDocuments = new Chart(document.getElementById('lineChartDocuments'), {
            type: 'line',
            data: {
                labels: {!! json_encode($documentosPorDia['fechas']) !!},
                datasets: [{
                    label: 'Documentos Registrados',
                    data: {!! json_encode($documentosPorDia['cantidades']) !!},
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            }
        });

        const barChartDocuments = new Chart(document.getElementById('barChartDocuments'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($documentosPorEstado['estados']) !!},
                datasets: [{
                    label: 'Documentos por Estado',
                    data: {!! json_encode($documentosPorEstado['cantidades']) !!},
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)', // Azul
                        'rgba(252, 211, 77, 0.6)', // Amarillo
                        'rgba(239, 68, 68, 0.6)', // Rojo
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(252, 211, 77, 1)',
                        'rgba(239, 68, 68, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        const pieChartDocuments = new Chart(document.getElementById('pieChartDocuments'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($documentosPorOrigen['origenes']) !!},
                datasets: [{
                    label: 'Documentos por Origen',
                    data: {!! json_encode($documentosPorOrigen['cantidades']) !!},
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)', // Azul
                        'rgba(252, 211, 77, 0.6)', // Amarillo
                        'rgba(239, 68, 68, 0.6)', // Rojo
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(252, 211, 77, 1)',
                        'rgba(239, 68, 68, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        const lineChartExpiredDocuments = new Chart(document.getElementById('lineChartExpiredDocuments'), {
            type: 'line',
            data: {
                labels: {!! json_encode($documentosVencidosPorDia['fechas']) !!},
                datasets: [{
                    label: 'Documentos Vencidos',
                    data: {!! json_encode($documentosVencidosPorDia['cantidades']) !!},
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            }
        });

        // Gráficos para Usuarios
        const barChartUsersByRole = new Chart(document.getElementById('barChartUsersByRole'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($usuariosPorCargo['cargos']) !!},
                datasets: [{
                    label: 'Usuarios por Cargo',
                    data: {!! json_encode($usuariosPorCargo['cantidades']) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            }
        });

        const pieChartUsersByRole = new Chart(document.getElementById('pieChartUsersByRole'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($usuariosPorRol['roles']) !!},
                datasets: [{
                    label: 'Roles de Usuarios',
                    data: {!! json_encode($usuariosPorRol['cantidades']) !!},
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)', // Azul
                        'rgba(252, 211, 77, 0.6)', // Amarillo
                        'rgba(239, 68, 68, 0.6)', // Rojo
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(252, 211, 77, 1)',
                        'rgba(239, 68, 68, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        const barChartUsersActive = new Chart(document.getElementById('barChartUsersActive'), {
            type: 'bar',
            data: {
                labels: ['Activos', 'Inactivos'],
                datasets: [{
                    label: 'Usuarios',
                    data: [{{ $usuariosActivos }}, {{ $usuariosInactivos }}],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.6)', // Azul
                        'rgba(239, 68, 68, 0.6)', // Rojo
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(239, 68, 68, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        const lineChartUsersOverTime = new Chart(document.getElementById('lineChartUsersOverTime'), {
            type: 'line',
            data: {
                labels: {!! json_encode($usuariosRegistradosPorMes['meses']) !!},
                datasets: [{
                    label: 'Usuarios Registrados',
                    data: {!! json_encode($usuariosRegistradosPorMes['cantidades']) !!},
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            }
        });
    </script>
</x-app-layout>