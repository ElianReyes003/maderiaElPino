<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categoriaArticulo;

class categoriaArticulo_controller extends Controller
{
    public function insertar(Request $req){
        $categoria=new categoriaArticulo();
        $categoria->nombreCategoriaArticulo=$req->nombreCategoriaArticulo;
        $categoria->estatus=1;
        $categoria->save();

        if ($categoria->pkCategoriaArticulo) {
            return redirect(url('/categoriaArticuloVision'))->with('success', '¡Categoria Articulo Agregada!');
        } else {
            return redirect(url('/categoriaArticuloVision'))->with('error', 'Error en Agregado de Articulo');
        }
    }

    public function mostrar(){
        $datosArticulo=categoriaArticulo::where('estatus', '=', 1)->get();
        return view('agregarYvistaCategoriaArticulo', compact('datosArticulo'));
    }

    public function baja($pkArticulo){
        $dato = categoriaArticulo::findOrFail($pkArticulo);
        
        if ($dato) {
            $dato->estatus = 0;
            $dato->save();

            return redirect(url('/categoriaArticuloVision'))->with('success', '¡Baja  Categoria de Articulo Completada!');
        } else {
            return redirect(url('/categoriaArticuloVision'))->with('error', 'Error en  Baja de Categoria Articulo');
        }
    }

    public function mostrarPorId($pkCategoriaArticulo){
        $datoCategoriaArticulo = categoriaArticulo::findOrFail($pkCategoriaArticulo);
        return view('editarCategoriaArticulo', compact('datoCategoriaArticulo'));
    }

    public function editar(Request $req, $pkCategoriaArticulo){
        $datosArticulo=categoriaArticulo::findOrFail($pkCategoriaArticulo);

        $datosArticulo->nombreCategoriaArticulo=$req->nombreCategoriaArticulo;
        $datosArticulo->save();

        if ($datosArticulo->pkCategoriaArticulo) {
            return redirect(url('/categoriaArticuloVision'))->with('success', '¡Actualización de Categoria de Articulo Agregada!');
        } else {
            return redirect(url('/categoriaArticuloVision'))->with('error', 'Error en Actualización de Categoria de Articulo');
        }
    }
}
