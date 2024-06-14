<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Calle;

class Calle_controller extends Controller
{
    public function insertar(Request $req){

        $calle=new Calle();
        $calle->nombreCalle=$req->nombreCalle;
        $calle->fkColonia=$req->fkColonia;
        $calle->estatus=1;
        $calle->save();

        if ($calle->pkCalle) {
            return redirect(url('/calleVision'))->with('success', '¡Calle Agregada!');
        } else {
            return redirect(url('/calleVision'))->with('error', 'Error en insercion de calle');
        } 
    }

    public function mostrar(){
        $datosCalles=Calle::where('estatus', '=', 1)->get();
        return view('agregarYVistaCalle', compact('datosCalles'));
    }

    public function baja($pkCalle){
        $dato = Calle::findOrFail($pkCalle);
        
        if ($dato) {
            $dato->estatus = 0;
            $dato->save();

            return redirect(url('/calleVision'))->with('success', '¡Baja de Calle Completada!');
        } else {
            return redirect(url('/calleVision'))->with('error', 'Error en Baja de Calle');
        }
    }

    public function mostrarPorId($pkcalle){
        $datosCalles = Calle::findOrFail($pkcalle)
            ->join('colonia', 'colonia.pkColonia', '=', 'calle.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->first(); // Agrega esta línea para obtener el primer resultado
        
        return view('editarCalle', compact('datosCalles'));
    }
    

    public function editar(Request $req, $pkCalle){
        $datosCalle=Calle::findOrFail($pkCalle);

        $datosCalle->nombreCalle=$req->nombreCalle;
        $datosCalle->fkColonia=$req->fkColonia;
        $datosCalle->save();

        if ($datosCalle->pkCalle) {
            return redirect(url('/calleVision'))->with('success', '¡Actualizacion de Calle Completada!');
        } else {
            return redirect(url('/calleVision'))->with('error', 'Error en Actualización de Calle');
        }
    }
}
