<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $colores = [
            'vencido' => 'red',
            'emitido' => 'green',
            'recibido' => 'blue',
        ];

        // Obtener estadísticas generales
        $totalDocumentos = Document::count();
        $documentosRecibidos = Document::where('estado', 'recibido')->count();
        $documentosEmitidos = Document::where('estado', 'emitido')->count();
        $documentosVencidos = Document::where('estado', 'vencido')->count();

        // Obtener usuarios
        $totalUsuarios = User::count();

        // Obtener los últimos documentos ingresados
        $ultimosDocumentos = Document::orderBy('created_at', 'desc')->take(5)->get();

        // Datos para gráficos de documentos
        $documentosPorDia = Document::selectRaw('DATE(fecha_ingreso) as fecha, COUNT(*) as cantidad')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        $documentosPorEstado = Document::select('estado', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('estado')
            ->get()
            ->map(function ($item) use ($colores) {
                return [
                    'estado' => $item->estado,
                    'cantidad' => $item->cantidad,
                    'color' => $colores[$item->estado] ?? 'gray', // Color gris por si hay otros estados no definidos
                ];
            });

        $documentosPorOrigen = Document::select('origen_oficina', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('origen_oficina')
            ->get();

        $documentosVencidosPorDia = Document::where('estado', 'vencido')
            ->selectRaw('DATE(fecha_ingreso) as fecha, COUNT(*) as cantidad')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        // Datos para gráficos de usuarios
        $usuariosPorCargo = User::select('cargo', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('cargo')
            ->get();

        $usuariosPorRol = User::select('role', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('role')
            ->get();

        $usuariosActivos = User::where('is_active', 1)->count();
        $usuariosInactivos = User::where('is_active', 0)->count();

        $usuariosRegistradosPorMes = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as cantidad')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Datos para gráficos del usuario autenticado
        $userId = Auth::id();

        $documentosUsuario = Document::where('trabajador_id', $userId)->count();

        $documentosUsuarioPorEstado = Document::where('trabajador_id', $userId)
        ->select('estado', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('estado')
        ->pluck('cantidad', 'estado');

        $documentosEstadoRecibido = $documentosUsuarioPorEstado['recibido'] ?? 0;
        $documentosEstadoEmitido = $documentosUsuarioPorEstado['emitido'] ?? 0;
        $documentosEstadoVencido = $documentosUsuarioPorEstado['vencido'] ?? 0;


        $documentosUsuarioPorDia = Document::where('trabajador_id', $userId)
            ->selectRaw('DATE(fecha_ingreso) as fecha, COUNT(*) as cantidad')
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        $documentosUsuarioPorMes = Document::where('trabajador_id', $userId)
            ->selectRaw('YEAR(fecha_ingreso) as year, MONTH(fecha_ingreso) as month, COUNT(*) as cantidad')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $documentosUsuarioPorAnio = Document::where('trabajador_id', $userId)
            ->selectRaw('YEAR(fecha_ingreso) as year, COUNT(*) as cantidad')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $documentosUsuarioPorEstadoGraficos = Document::where('trabajador_id', $userId)
            ->select('estado', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('estado')
            ->get()
            ->map(function ($item) use ($colores) {
                return [
                    'estado' => $item->estado,
                    'cantidad' => $item->cantidad,
                    'color' => $colores[$item->estado] ?? 'gray', // Color gris por si hay otros estados no definidos
                ];
            });

        return view('dashboard', [
            // Estadísticas generales
            'totalDocumentos' => $totalDocumentos,
            'documentosRecibidos' => $documentosRecibidos,
            'documentosEmitidos' => $documentosEmitidos,
            'documentosVencidos' => $documentosVencidos,
            'ultimosDocumentos' => $ultimosDocumentos,

            'totalUsuarios' => $totalUsuarios,

            // Datos para gráficos de documentos
            'documentosPorDia' => [
                'fechas' => $documentosPorDia->pluck('fecha'),
                'cantidades' => $documentosPorDia->pluck('cantidad'),
            ],
            'documentosPorEstado' => [
                'estados' => $documentosPorEstado->pluck('estado'),
                'cantidades' => $documentosPorEstado->pluck('cantidad'),
                'colores' => $documentosPorEstado->pluck('color'),
            ],
            'documentosPorOrigen' => [
                'origenes' => $documentosPorOrigen->pluck('origen_oficina'),
                'cantidades' => $documentosPorOrigen->pluck('cantidad'),
            ],
            'documentosVencidosPorDia' => [
                'fechas' => $documentosVencidosPorDia->pluck('fecha'),
                'cantidades' => $documentosVencidosPorDia->pluck('cantidad'),
            ],

            // Datos para gráficos de usuarios
            'usuariosPorCargo' => [
                'cargos' => $usuariosPorCargo->pluck('cargo'),
                'cantidades' => $usuariosPorCargo->pluck('cantidad'),
            ],
            'usuariosPorRol' => [
                'roles' => $usuariosPorRol->pluck('role'),
                'cantidades' => $usuariosPorRol->pluck('cantidad'),
            ],
            'usuariosActivos' => $usuariosActivos,
            'usuariosInactivos' => $usuariosInactivos,
            'usuariosRegistradosPorMes' => [
                'meses' => $usuariosRegistradosPorMes->map(function ($item) {
                    return Carbon::create()->month($item->month)->format('F Y');
                }),
                'cantidades' => $usuariosRegistradosPorMes->pluck('cantidad'),
            ],

            // Datos para gráficos del usuario autenticado

            'documentosUsuario' => $documentosUsuario,

            'documentosEstadoRecibido' => $documentosEstadoRecibido,
            'documentosEstadoEmitido' => $documentosEstadoEmitido,
            'documentosEstadoVencido' => $documentosEstadoVencido,

            'documentosUsuarioPorDia' => [
                'fechas' => $documentosUsuarioPorDia->pluck('fecha'),
                'cantidades' => $documentosUsuarioPorDia->pluck('cantidad'),
            ],
            'documentosUsuarioPorMes' => [
                'meses' => $documentosUsuarioPorMes->map(function ($item) {
                    return Carbon::create()->month($item->month)->format('F Y');
                }),
                'cantidades' => $documentosUsuarioPorMes->pluck('cantidad'),
            ],
            'documentosUsuarioPorAnio' => [
                'anios' => $documentosUsuarioPorAnio->pluck('year'),
                'cantidades' => $documentosUsuarioPorAnio->pluck('cantidad'),
            ],
            'documentosUsuarioPorEstadoGraficos' => [
                'estados' => $documentosUsuarioPorEstadoGraficos->pluck('estado'),
                'cantidades' => $documentosUsuarioPorEstadoGraficos->pluck('cantidad'),
                'colores' => $documentosUsuarioPorEstadoGraficos->pluck('color'),
            ],
        ]);
    }
}