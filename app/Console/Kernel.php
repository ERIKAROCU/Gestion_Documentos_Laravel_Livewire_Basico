<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos de la aplicación.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }

    /**
     * Define el schedule de tareas.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            \App\Models\Document::where('fecha_ingreso', '<=', now()->subDays(5))
                ->where('estado', '!=', 'vencido')
                ->update(['estado' => 'vencido']);
        })->daily(); // Se ejecuta una vez al día
    }
}
