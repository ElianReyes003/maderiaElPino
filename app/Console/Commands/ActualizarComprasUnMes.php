<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\comprasCliente_controller;

class ActualizarComprasUnMes extends Command
{
    protected $signature = 'actualizar:comprasUnMes';
    protected $description = 'Actualizar compras un mes';

    public function handle()
    {
        $comprasController = new comprasCliente_controller();

       
        $comprasController->actualizarComprasDespuesDeOneMonth();

        $this->info('Tareas de actualización de compras completadas.');
    }
}
