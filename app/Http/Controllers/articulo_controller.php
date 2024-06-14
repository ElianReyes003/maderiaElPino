<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\TipoVenta;
use App\Models\ArticuloTipoVenta;
use App\Models\MovimientosArticulos;
use Carbon\Carbon;

class articulo_controller extends Controller
{
    public function todosLosArticulos(Request $request) {
 
        $datosArticulos = Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')    
            ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaarticulo.pkCategoriaArticulo')
            ->select('categoriaarticulo.*', 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
            ->where('articulotipoventa.fkTipoVenta', '=', 1) ->where('articulo.estatus', '!=', 3)
            ->get();
            
        return view('comprasClienteNuevo',compact('datosArticulos'));
    }
    public function todosLosArticulos2(Request $request) {
 
        $datosArticulos = Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')    
            ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaarticulo.pkCategoriaArticulo')
            ->select('categoriaarticulo.*', 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
            ->where('articulotipoventa.fkTipoVenta', '=', 1) ->where('articulo.estatus', '!=', 3)
            ->get();
            
        return view('comprasClienteExistente',compact('datosArticulos'));
    }
    public function todosLosArticulos3(Request $request) {
 
        $datosArticulos = Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')
        ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaarticulo.pkCategoriaArticulo')
        ->select('categoriaarticulo.*', 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulotipoventa.fkTipoVenta', 1) 
        ->where('articulo.estatus', '!=', 3)
        ->get();
    
        return view('listaArticulos',compact('datosArticulos'));
    }

    public function articuloDetalle($pkArticulo, $vista = "articuloDetalle") {
 
        $datosArticulos = Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')    
            ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaarticulo.pkCategoriaArticulo')
            ->select('categoriaarticulo.*', 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
            ->where('articulo.pkArticulo', '=', $pkArticulo)
            ->first();
        $datosEngancheYCosto1= Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')    
        ->select( 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.pkArticulo', '=', $pkArticulo)
        ->where('articulotipoventa.fkTipoVenta', '=', 1)
        ->first();
        $datosEngancheYCosto2= Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')    
        ->select( 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.pkArticulo', '=', $pkArticulo)
        ->where('articulotipoventa.fkTipoVenta', '=', 2)
        ->first();
        $datosEngancheYCosto3= Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')    
        ->select( 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.pkArticulo', '=', $pkArticulo)
        ->where('articulotipoventa.fkTipoVenta', '=', 3)
        ->first();
        $datosEngancheYCosto4= Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')    
        ->select( 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
        ->where('articulo.pkArticulo', '=', $pkArticulo)
        ->where('articulotipoventa.fkTipoVenta', '=', 4)
        ->first();
            
            
        return view($vista,compact('datosArticulos','datosEngancheYCosto1','datosEngancheYCosto2','datosEngancheYCosto3','datosEngancheYCosto4'));
    }


    public function mostrarArticuloTipoVenta(Request $req)
{
    // Obtén el tipo de venta predeterminado
    $tipoVentaPredeterminado = 1;

    // Si se seleccionó un tipo de venta diferente en el formulario
    if ($req->has('fkTipoVenta') && !empty($req->fkTipoVenta)) {
        $tipoVentaPredeterminado = $req->fkTipoVenta;
    }

    // Obtén los artículos para el tipo de venta predeterminado
    $datosArticulo = Articulo::join('articuloTipoVenta', 'articuloTipoVenta.fkArticulo', '=', 'articulo.pkArticulo')
        ->where('articuloTipoVenta.fkTipoVenta', '=', $tipoVentaPredeterminado)
        ->where('articulo.estatus', '=', 1)
        ->get();

    // Obtén todos los tipos de venta para el menú desplegable
    $datosTipoVenta = TipoVenta::all();

    return view("comprasClienteNuevo", compact('datosArticulo', 'datosTipoVenta', 'tipoVentaPredeterminado'));
}



public function obtenerDetalleArticulo(Request  $req,  $id, $tipoVentaSeleccionado)
{

    // Obtén el tipo de venta seleccionado del formulario
    $tipoVentaSeleccionado = $req->has('fkTipoVenta') ? $req->fkTipoVenta : 1;

    // Obtén el artículo con la cantidadTipoVenta correspondiente
    $articulo = Articulo::select(
            'articulo.*',
            'articulotipoventa.cantidadTipoVenta',
            'articulotipoventa.enganche',
            'categoriaarticulo.nombreCategoriaArticulo'
        )
        ->join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')
        ->join('categoriaarticulo', 'categoriaarticulo.pkCategoriaArticulo', '=', 'articulo.fkCategoriaArticulo')
        ->where('articulotipoventa.fkTipoVenta', '=', $tipoVentaSeleccionado)
        ->where('articulo.pkArticulo', '=', $id)
        ->where('articulo.estatus', '=', 1)
        ->first(); // Utilizamos first() para obtener solo un resultado
        
    // Verifica si se encontró el artículo
    if ($articulo) {
        return response()->json([
            'nombreArticulo' => $articulo->nombreArticulo,
            'categoriaArticulo' => $articulo->nombreCategoriaArticulo,
            'cantidadTipoVenta' => $articulo->cantidadTipoVenta,
            'enganche' => $articulo->enganche,
            // Agrega más detalles según sea necesario
        ]);
    } else {
        // Si no se encuentra el artículo, devuelve una respuesta de error
        return response()->json(['error' => 'Artículo no encontrado'], 404);
    }
}



public function obtenerCantidadTipoVenta(Request  $req,  $id, $tipoVentaSeleccionado)
{


    // Obtén el artículo con la cantidadTipoVenta correspondiente
    $articulo = Articulo::select(
        'articulo.*',
        'articulotipoventa.cantidadTipoVenta',
        'articulotipoventa.enganche'
    )
    ->join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')
    ->where('articulotipoventa.fkTipoVenta', '=', $tipoVentaSeleccionado)
    ->where('articulo.pkArticulo', '=', $id)
    ->where('articulo.estatus', '=', 1)
    ->first(); // Utilizamos first() para obtener solo un resultado

    // Verifica si se encontró el artículo
    if ($articulo) {
        return response()->json([
            'nombreArticulo' => $articulo->nombreArticulo,
            'categoriaArticulo' => $articulo->fkCategoriaArticulo,
            'cantidadTipoVenta' => $articulo->cantidadTipoVenta,
            'enganche' => $articulo->enganche,
        ]);
    } else {
        // Si no se encuentra el artículo, devuelve una respuesta de error
        return response()->json(['error' => 'Artículo no encontrado'], 404);
    }
}
  /*funcion agregar usuario en la base de datos*/
  public function agregarArticulo(Request $req)
  {
   
      $articulo= new Articulo();
      //nombre base de datos       //nombre formulario
      $articulo->nombreArticulo=$req->nombreArticulo;
      $articulo->fkCategoriaArticulo=$req->fkCategoriaArticulo;
      $articulo->cantidadMinima=$req->cantidadMinima;
      $articulo->cantidadActual=$req->cantidadActual;
      $articulo->abonoOchoDias=$req->abonoOchoDias;
      $articulo->abonoQuinceDias=$req->abonoQuinceDias;
      $articulo->abonoTreintaDias=$req->abonoTreintaDias;
     if ($req->hasFile('imagenArticulo')) {
      $imagen = $req->file('imagenArticulo');
      $rutaImagen = $imagen->store('public/images');
      $articulo->imagenArticulo = str_replace('public/', '', $rutaImagen);
     }
      $articulo->estatus=1;
    
      $articulo->save();
      if($articulo->pkArticulo){
      $arrayTipoVenta = [1, 2, 3,4];
      $arrayCantidadTipoVenta = [$req->precioAlContado, $req->precioAlMes, $req->precioADosMeses,$req->precioUnAño];
      $arrayEngancheTipoVenta = [0, $req->EngancheprecioAlMes, $req->EngancheADosMeses,$req->EngancheUnAño];
      for ($i = 0; $i < count($arrayTipoVenta); $i++) {
        $articuloTipoVenta= new ArticuloTipoVenta();
        $articuloTipoVenta->fkTipoVenta=$arrayTipoVenta[$i];
        $articuloTipoVenta->fkArticulo=$articulo->pkArticulo;
        $articuloTipoVenta->cantidadTipoVenta=$arrayCantidadTipoVenta[$i];
        $articuloTipoVenta->enganche=$arrayEngancheTipoVenta[$i];
        $articuloTipoVenta->save();
    }
    
        return redirect(url('/articulesList'))->with('success', '¡Producto Agregado Existosamente!');
    } else {
        return redirect(url('/articulesList'))->with('error', 'Error en agregado de producto');
    }
  }
  public function actualizarArticulo(Request $req)
  {
    date_default_timezone_set('America/Mazatlan');
      $articulo= Articulo::find($req->pkArticulo);
      if($articulo){
      $movimientosArticulos= new MovimientosArticulos();
      $movimientosArticulos->fkArticulo=$req->pkArticulo;
      $movimientosArticulos->fkTipoMovimiento=3;
      $movimientosArticulos->cantidad=0;
      $movimientosArticulos->fecha=Carbon::now();
      $movimientosArticulos->fkEmpleado=session('id');
      $movimientosArticulos->save();
       //nombre base de datos       //nombre formulario
       $articulo->nombreArticulo=$req->nombreArticulo;
       $articulo->fkCategoriaArticulo=$req->fkCategoriaArticulo;
       $articulo->cantidadMinima=$req->cantidadMinima;
       $articulo->cantidadActual=$req->cantidadActual;
       $articulo->abonoOchoDias=$req->abonoOchoDias;
       $articulo->abonoQuinceDias=$req->abonoQuinceDias;
       $articulo->abonoTreintaDias=$req->abonoTreintaDias;
       if ($req->hasFile('imagenArticulo')) {
        $imagen = $req->file('imagenArticulo');
        $rutaImagen = $imagen->store('public/images');
        $articulo->imagenArticulo = str_replace('public/', '', $rutaImagen);
        }
       $articulo->estatus=1;
       $articulo->save();
       $arrayTipoVenta = [1, 2, 3,4];
      $arrayCantidadTipoVenta = [$req->precioAlContado, $req->precioAlMes, $req->precioADosMeses,$req->precioUnAño];
      $arrayEngancheTipoVenta = [0, $req->EngancheprecioAlMes, $req->EngancheADosMeses,$req->EngancheUnAño];
      for ($i = 0; $i < count($arrayTipoVenta); $i++) {
        $articuloTipoVenta = ArticuloTipoVenta::where('fkArticulo', $req->pkArticulo)
                                                ->where('fkTipoVenta', $arrayTipoVenta[$i])
                                                ->first();
    
        if ($articuloTipoVenta) {
            $articuloTipoVenta->cantidadTipoVenta = $arrayCantidadTipoVenta[$i];
            $articuloTipoVenta->enganche = $arrayEngancheTipoVenta[$i];
            $articuloTipoVenta->save();
        }
    }

    return redirect(url('/articulesList'))->with('success', '¡Actualizacion de Producto Completada!');
    } else {
        return redirect(url('/articulesList'))->with('error', 'Error en desasignacion de cobro');
    } 
  }
  public function baja($pkArticulo)
  {
      $articulo= Articulo::find($pkArticulo);
      if($articulo){
      //nombre base de datos       //nombre formulario
      $articulo->estatus=3;
      $articulo->save();
     
        return redirect(url('/articulesList'))->with('success', '¡Baja de Producto Completada!');
    } else {
        return redirect(url('/articulesList'))->with('error', 'Error en Baja de Producto');
    } 
  }
  public function movimientosArticulo(Request $req)
  {
    date_default_timezone_set('America/Mazatlan');
      $articulo= Articulo::find($req->pkArticulo);
     
      $cantidadPresente=$articulo->cantidadActual;//nombre base de datos       //nombre formulario
      if($req->tipoMovimiento==1){
       
        $articulo->cantidadActual=$cantidadPresente+$req->cantidadSeleccionada;
      }
      if($req->tipoMovimiento==2){
       
        $articulo->cantidadActual=$cantidadPresente-$req->cantidadSeleccionada;
        if($articulo->cantidadActual<=$articulo->cantidadMinima){
            $articulo->estatus=2;
        }
        if($articulo->cantidadActual<=0){
            $articulo->estatus=0;
        }
      }
      $articulo->save();
      $movimientosArticulos= new MovimientosArticulos();
      $movimientosArticulos->fkArticulo=$req->pkArticulo;
      $movimientosArticulos->fkTipoMovimiento=$req->tipoMovimiento;
      $movimientosArticulos->cantidad=$req->cantidadSeleccionada;
      $movimientosArticulos->fecha= Carbon::now();
      $movimientosArticulos->fkEmpleado=session('id');
      $movimientosArticulos->save();
      if($articulo && $movimientosArticulos->pkMovimientosArticulos){
    
      return redirect(url()->previous())->with('success', '¡Movimiento de Producto Completado!');
    } else {
        return redirect(url()->previous())->with('error', 'Error en movimiento de producto');
    } 
     
  }
  public function todosmovimientosArticulos(Request $request) {
 
    $datosMovimientos = Articulo::join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaarticulo.pkCategoriaArticulo')
        ->join('movimientosarticulos', 'articulo.pkArticulo', '=', 'movimientosarticulos.fkArticulo')
        ->join('tipomovimiento', 'tipomovimiento.pktipoMovimiento', '=', 'movimientosarticulos.fkTipoMovimiento')
        ->join('empleado', 'empleado.pkEmpleado', '=', 'movimientosarticulos.fkEmpleado')
        ->select('categoriaarticulo.*', 'movimientosarticulos.*','tipomovimiento.*', 'empleado.*','articulo.*','articulo.estatus as ESTATUSARTICULO')
        ->get();
    
        
    return view('listaMovimientos',compact('datosMovimientos'));
}

}
