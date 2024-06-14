<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Colonia;

class Colonia_controller extends Controller
{
    public function insertar(Request $req){
        $colonia=new Colonia();
        $colonia->nombreColonia=$req->nombreColonia;
        $colonia->fkMunicipio=$req->fkMunicipio;
        $colonia->estatus=1;
        $colonia->save();

        if ($colonia->pkColonia) {
            return redirect(url('/coloniaVision'))->with('success', '¡Agregado de Colonia Completado!');
        } else {
            return redirect(url('/coloniaVision'))->with('error', 'Error en Agregado de Colonia');
        }
    }

    public function mostrar()
    {
        $datosColonia = Colonia::join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->where('colonia.estatus', '=', 1)
            ->select('municipio.*', 'colonia.*')
            ->get();
        return view('agregarYvistaColonia', compact('datosColonia'));
    }
    

    public function baja($pkColonia){
        $dato = Colonia::findOrFail($pkColonia);
        
        if ($dato) {
            $dato->estatus = 0;
            $dato->save();

            return redirect(url('/coloniaVision'))->with('success', 'Colonia dada de baja');
        } else {
            return redirect(url('/coloniaVision'))->with('error', 'Hay algún problema con la baja de Colonia');
        }
    }

    public function mostrarPorId($pkcolonia){
        $datosColonia = Colonia::findOrFail($pkcolonia);
        return view('editarColonia', compact('datosColonia'));
    }

    public function editar(Request $req, $pkColonia){
        $datosColonia=Colonia::findOrFail($pkColonia);

        $datosColonia->nombreColonia=$req->nombreColonia;
        $datosColonia->fkMunicipio=$req->fkMunicipio;
        $datosColonia->save();

        if ($datosColonia->pkColonia) {
            return redirect(url('/coloniaVision'))->with('success', '¡Actualización de Colonia Completado!');
        } else {
            return redirect(url('/coloniaVision'))->with('error', 'Error en Actualizacion de Colonia');
        }
    }
}
