<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\comprasCliente_controller;

class ActualizarListaAbono extends Command
{
    protected $signature = 'actualizar:abonos';
    protected $description = 'Actualizar compras según criterios específicos';

    public function handle()
    {
        $abonoController = new abono_controller();

        $abonoController->actualizarComprasDespuesDeUnaSemana();


        $this->info('Tareas de actualización de compras completadas.');
    }
}
