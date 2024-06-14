<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Municipio;

class Municipio_controller extends Controller
{
    public function insertar(Request $req){
        $municipio=new Municipio();
        $municipio->nombreMunicipio=$req->nombreMunicipio;
        $municipio->estatus=1;
        $municipio->save();

        if ($municipio->pkMunicipio) {
            return redirect(url('/municipioVision'))->with('success', '¡Agregado de Municipio Completado!');
        } else {
            return redirect(url('/municipioVision'))->with('error', 'Error en Agregado de Municipio');
        }
    }

    public function mostrar(){
        $datosMunicipio=Municipio::where('estatus', '=', 1)->get();
        return view('agregarYvistaMunicipio', compact('datosMunicipio'));
    }

    public function baja($pkMunicipio){
        $dato = Municipio::findOrFail($pkMunicipio);
        
        if ($dato) {
            $dato->estatus = 0;
            $dato->save();

            return redirect(url('/municipioVision'))->with('success', 'Municipio dado de baja');
        } else {
            return redirect(url('/municipioVision'))->with('error', 'Error en Baja de Municipio');
        }
    }

    public function mostrarPorId($pkMunicipio){
        $datosMunicipio = Municipio::findOrFail($pkMunicipio);
        return view('editarMunicipio', compact('datosMunicipio'));
    }

    public function editar(Request $req, $pkMunicipio){
        $datosMunicipio=Municipio::findOrFail($pkMunicipio);

        $datosMunicipio->nombreMunicipio=$req->nombreMunicipio;
        $datosMunicipio->save();

        if ($datosMunicipio->pkMunicipio) {
            return redirect(url('/municipioVision'))->with('success', '¡Actualización de Municipio Completada!');
        } else {
            return redirect(url('/municipioVision'))->with('error', 'Error en Actualización de Municipio');
        }
    }
}
