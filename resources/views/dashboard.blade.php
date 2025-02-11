<x-app-layout>
    <div class="container mx-auto p-4 bg-gray-50 rounded-lg shadow-md">
        <div>
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Dashboard</h1>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Pestañas -->
                <div x-data="{ tab: 'myactivity' }" class="mb-8">
                    <!-- Botones de Pestañas -->
                    <div class="flex space-x-4 border-b">
                        <button @click="tab = 'myactivity'" :class="{ 'border-b-2 border-blue-500': tab === 'myactivity' }" class="px-4 py-2 text-gray-700 focus:outline-none">
                            Mis actividades
                        </button>

                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <button @click="tab = 'documents'" :class="{ 'border-b-2 border-blue-500': tab === 'documents' }" class="px-4 py-2 text-gray-700 focus:outline-none">
                            Documentos
                        </button>
                        @endif

                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <button @click="tab = 'users'" :class="{ 'border-b-2 border-blue-500': tab === 'users' }" class="px-4 py-2 text-gray-700 focus:outline-none">
                            Usuarios
                        </button>
                        @endif
                    </div>

                    <!-- Contenido de las Pestañas -->
                    <div x-show="tab === 'documents'" class="mt-6">
                        @include('partials._documents')
                    </div>

                    <div x-show="tab === 'users'" class="mt-6">
                        @include('partials._users')
                    </div>

                    <div x-show="tab === 'myactivity'" class="mt-6">
                        @include('partials._myactivity')
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
                        'rgba(239, 68, 68, 0.6)', // Rojo
                        'rgba(34, 197, 94, 0.6)', // Verde
                        'rgba(59, 130, 246, 0.6)', // Azul
                    ],
                    borderColor: [
                        'rgba(239, 68, 68, 0.6)', // Rojo
                        'rgba(34, 197, 94, 0.6)', // Verde
                        'rgba(59, 130, 246, 0.6)', // Azul
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
    </div>
</x-app-layout>