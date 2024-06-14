<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\comprasCliente_controller;

class diasDeuda extends Command
{
    protected $signature = 'actualizar:diasDeuda';
    protected $description = 'Actualizar dias de deuda';

    public function handle()
    {
        $comprasController = new comprasCliente_controller();

       
        $comprasController->actualizarDiasDeuda();

        $this->info('Tareas de actualización de compras completadas.');
    }
}