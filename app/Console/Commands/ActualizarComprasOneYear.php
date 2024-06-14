<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\comprasCliente_controller;

class ActualizarComprasOneYear extends Command
{
    protected $signature = 'actualizar:comprasOneYear';
    protected $description = 'Actualizar compras según criterios específicos';

    public function handle()
    {
        $comprasController = new comprasCliente_controller();

       
        $comprasController->actualizarComprasDespuesDeOneYear();

        $this->info('Tareas de actualización de compras completadas.');
    }
}
