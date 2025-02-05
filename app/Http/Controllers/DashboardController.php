<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener estadísticas
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
            ->get();

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

        return view('dashboard', [

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
        ]);
    }
}