<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\comprasCliente_controller;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\ActualizarComprasOneYear::class,
        Commands\ActualizarComprasUnMes::class,
        Commands\ActualizarComprasDosMeses::class,
        Commands\ActualizarListaAbono::class,
        Commands\diasDeuda::class,
    ]; // Agrega un punto y coma aquí

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {     
        date_default_timezone_set('America/Mazatlan');
        // $schedule->command('inspire')->hourly();
        $schedule->command('actualizar:diasDeuda')->daily();
        $schedule->command('actualizar:comprasUnMes')->daily();
        $schedule->command('actualizar:comprasTwoMonths')->daily();
        $schedule->command('actualizar:comprasOneYear')->daily();
        $schedule->command('actualizar:abonos')->weekly()->saturdays()->at('02:00');
    }

    /**
     * Register the commands for the application.
     */
}


