<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\comprasCliente_controller;

class ActualizarComprasDosMeses extends Command
{
    protected $signature = 'actualizar:comprasTwoMonths';
    protected $description = 'Actualizar compras dos meses';

    public function handle()
    {
        $comprasController = new comprasCliente_controller();

       
        $comprasController->actualizarComprasDespuesDeTwoMonth();

        $this->info('Tareas de actualización de compras completadas.');
    }
}
