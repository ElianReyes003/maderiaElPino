<?php

namespace App\Http\Controllers;

use App\Models\abonoArticulo;
use App\Models\Cliente;
use App\Models\ComprasClientes;
use App\Models\MovimientosArticulos;
use App\Models\Articulo;
use Illuminate\Http\Request;
use App\Models\Documentos;
use Carbon\Carbon;
use App\Models\ArticuloTipoVenta;
use Illuminate\Support\Facades\Log;

class comprasCliente_controller extends Controller
{
    public function actualizarClientBuy(Request $req, $pkCompra)
    {
        $comprasCliente = ComprasClientes::find($pkCompra);
        // Buscar el registro de ArticuloTipoVenta
        $tipoVenta = ArticuloTipoVenta::where('fkTipoVenta', $req->fkTipoVenta)
                                      ->where('fkArticulo', $req->articulito)
                                      ->first();

        $tipoVentaDefinida = ArticuloTipoVenta::where('fkArticulo', $req->articulito)
                                        ->where('pkArticuloTipoVenta', $comprasCliente->fkArticuloTipoVenta)  
                                      ->first();


        $abono = new AbonoArticulo();
    
        // Verificar si se encontró el registro de ArticuloTipoVenta
        if ($tipoVenta) {
            $comprasCliente->estatus = $req->estatus;
            $comprasCliente->diasDeuda = $req->deuda;
    
            if ($req->saldar != $comprasCliente->cantidadASaldar) {
                $comprasCliente->cantidadASaldar = $req->saldar;
                $abono->fkConcepto = 2;

                $abono->fecha = now();
                $abono->estatus = 1;
                $abono->abono = $req->saldar;
                $abono->saldo = $comprasCliente->cantidadASaldar;
                $abono->fkEmpleado=session('id');
                $abono->fkComprasCliente=$pkCompra;
                $abono->folioAbono = uniqid();

                if ($req->saldar == 0) {
                    $comprasCliente->estatus = 0;
                }
                $abono->save();
                $comprasCliente->save();

                return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
            }
    
            date_default_timezone_set('America/Mazatlan');
       
            if ($comprasCliente) {
               
                $abono->fecha = now();
                $abono->estatus = 1;
                $abono->abono = 0;

                
    
                // Asignar concepto basado en condiciones
                
    
                $abono->saldo = $comprasCliente->cantidadASaldar;
                $abono->fkEmpleado = session('id');
                $abono->fkComprasCliente = $tipoVenta->pkArticuloTipoVenta;
    
                $totalAbonado = AbonoArticulo::where('fkComprasCliente', $pkCompra)
                ->where('fkConcepto', 1)->sum('abono');

                if ($tipoVentaDefinida->fkTipoVenta != $tipoVenta->fkTipoVenta) {
                    
                    $totalSaldar = $tipoVenta->cantidadTipoVenta - $totalAbonado;
                    $comprasCliente->cantidadASaldar = $totalSaldar;
                    $abono->folioAbono = uniqid();
                    $abono->abono = 0;
                    $abono->fkEmpleado=session('id');
                    $abono->saldo = $comprasCliente->cantidadASaldar;
                    $abono->fkComprasCliente=$pkCompra;

                    if ($tipoVentaDefinida->fkTipoVenta== 2 && $req->fkTipoVenta == 3) {
                        $abono->fkConcepto = 3;
                        $comprasCliente->fkArticuloTipoVenta = $tipoVenta-> pkArticuloTipoVenta;
                    } elseif ($tipoVentaDefinida->fkTipoVenta == 2 && $req->fkTipoVenta == 4) {
                        $abono->fkConcepto = 4;
                        $comprasCliente->fkArticuloTipoVenta = $tipoVenta->pkArticuloTipoVenta;
                    } elseif ($tipoVentaDefinida->fkTipoVenta == 3 && $req->fkTipoVenta == 4) {
                        $abono->fkConcepto = 5;
                        $comprasCliente->fkArticuloTipoVenta = $tipoVenta->pkArticuloTipoVenta;
                    }
                    $abono->save();
                    $comprasCliente->save();
    
                    return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
                } else {
                    $totalSaldar = $comprasCliente->cantidadASaldar;
                    $abono->save();
                    $comprasCliente->save();
    
                    return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
                }
    
             
                $tipoVenta2 = ArticuloTipoVenta::where('fkTipoVenta', 2)
                                               ->where('fkArticulo', $req->articulito)
                                               ->first();
                $liquidacion2 = $tipoVenta2 ? $tipoVenta2->cantidadTipoVenta - $comprasCliente->cantidadASaldar : null;
                $fechaUnMesAtras = now()->subMonth();
    
                if ($comprasCliente->fecha <= $fechaUnMesAtras && $liquidacion2 == 0) {
                    $abono->fkConcepto = 7;
                    $abono->save();
                    $comprasCliente->estatus = 0;
                    $comprasCliente->cantidadASaldar = 0;
                    $comprasCliente->diasDeuda = $req->diasDeuda;
                    $comprasCliente->estatusDeCobro = 0;
                    $abono->folioAbono = uniqid();
                    $abono->save();
                    $comprasCliente->save();
    
                    return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
                }
    
                $tipoVenta3 = ArticuloTipoVenta::where('fkTipoVenta', 3)
                                               ->where('fkArticulo', $req->articulito)
                                               ->first();
                $liquidacion3 = $tipoVenta3 ? $tipoVenta3->cantidadTipoVenta - $comprasCliente->cantidadASaldar : null;
                $fechaDosMesesAtras = now()->subMonths(2);
    
                if ($comprasCliente->fecha <= $fechaDosMesesAtras && $liquidacion3 == 0) {
                    $abono->fkConcepto = 6;
                    $abono->save();
                    $comprasCliente->estatus = 0;
                    $comprasCliente->cantidadASaldar = 0;
                    $comprasCliente->diasDeuda = $req->diasDeuda;
                    $comprasCliente->estatusDeCobro = 0;
                    $abono->folioAbono = uniqid();
                    $abono->save();
                    $comprasCliente->save();
    
                    return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
                }
    
                $comprasCliente->diasDeuda = $req->diasDeuda;
                $comprasCliente->estatusDeCobro = 0;
                $abono->folioAbono = uniqid();
                $abono->save();
                $comprasCliente->save();
    
                return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
            }
        } else {
            return redirect(url()->previous())->with('error', 'Error: No se actualizó la compra');
        }
    }
    
    
    


    public function agregarClientBuy(Request $req)
    {   
        date_default_timezone_set('America/Mazatlan');
        $cliente = $req->input('cliente')[0];
    
        $productoIds = $req->input('producto_id');
        $cantidades = $req->input('cantidadotas');
        $tiposVenta = $req->input('tipoVenta');
        if($req){
            
            // Imprime
            for ($i = 0; $i < count($productoIds); $i++) {
                $productoId = $productoIds[$i];
                $cantidad = $cantidades[$i];
                $tipoVenta = $tiposVenta[$i];
                $articuloTipoVenta = ArticuloTipoVenta::where('fkArticulo', $productoId)
                ->where('fkTipoVenta',  $tipoVenta )
                ->first();
                $movimientosArticulos= new MovimientosArticulos();
                $movimientosArticulos->fkArticulo=$productoId;
                $movimientosArticulos->fkTipoMovimiento=2;
                $movimientosArticulos->cantidad=$cantidad;
                $movimientosArticulos->fecha=now();
                $movimientosArticulos->fkEmpleado=session('id');
                $movimientosArticulos->save();

                $articulo= Articulo::find( $productoId);
              
                $cantidadPresente=$articulo->cantidadActual;//nombre base de datos       //nombre formulario
                $articulo->cantidadActual=$cantidadPresente-$cantidad;
                if($articulo->cantidadActual<=$articulo->cantidadMinima){
                    $articulo->estatus=2;
                }
                if($articulo->cantidadActual<=0){
                    $articulo->estatus=0;
                }
                $articulo->save();


                for ($j = 0; $j < $cantidad; $j++) {
                    $comprasCliente = new ComprasClientes();
                    $comprasCliente->fkCliente = $cliente;;
                
                    $comprasCliente->fecha = now();
                    if ($articuloTipoVenta->fkTipoVenta == 1) {
                        $comprasCliente->cantidadASaldar = 0;
                        $comprasCliente->estatus = 0;
                        $comprasCliente->estatusDeCobro = 0;
                    } else {
                        $comprasCliente->cantidadASaldar = $articuloTipoVenta->cantidadTipoVenta - $articuloTipoVenta->enganche;
                        $comprasCliente->estatus = 1;
                        $comprasCliente->estatusDeCobro = 1;
                    }
                    $comprasCliente->fkArticuloTipoVenta = $articuloTipoVenta->pkArticuloTipoVenta;
                    $comprasCliente->folioCompra=uniqid();
                    $comprasCliente->save();
                }
                // Aquí puedes realizar las operaciones que necesites con cada conjunto de datos
            }
  
                return redirect(url('/clienteEspecifico/' . $cliente))->with('success', '¡Compra Completada!');
            } else {
                return redirect(url('/tuInicio')->previous())->with('error', 'Error en Proceso de Compra');
        }
    }
    
            public function agregarNewClientBuy(Request $req)
        {   
            date_default_timezone_set('America/Mazatlan');
            if($req){
            $productoIds = $req->input('producto_id');
            $cantidades = $req->input('cantidadotas');
            $tiposVenta = $req->input('tipoVenta');
            
            $cliente = new Cliente();
            $cliente->nombreCliente = $req->nombreCliente;
            $cliente->telefono = $req->telefono;
            $cliente->fkColonia= $req->fkColonia;
            $cliente->calle = $req->calle;
            $cliente->numCasa = $req->numCasa;
            $cliente->descripcionDomicilio = $req->descripcionDomicilio;
            if ($req->hasFile('imagenDomicilio')) {
            $imagen = $req->file('imagenDomicilio');
            $rutaImagen = $imagen->store('public/images');
            $cliente->imagenDomicilio = str_replace('public/', '', $rutaImagen);
            }
            $cliente->estatus = 1;
            $cliente->save();
                
            if ($req->hasFile('documentos')) {
                foreach ($req->file('documentos') as $documento) {
                    $nombreDocumento = $documento->getClientOriginalName();
                    $ruta = $documento->store('public');
            
                    // Crear un nuevo documento asociado al cliente
                    $nuevoDocumento = new Documentos();
                    $nuevoDocumento->nombre = $nombreDocumento;
                    $nuevoDocumento->ruta = $ruta;
                    $nuevoDocumento->fkCliente = $cliente->pkCliente; // Asegúrate de tener el nombre correcto del campo
                    $nuevoDocumento->save();
                }
            }
            
            
                        
            
            // Imprime
            for ($i = 0; $i < count($productoIds); $i++) {
                $productoId = $productoIds[$i];
                $cantidad = $cantidades[$i];
                $tipoVenta = $tiposVenta[$i];
                $articuloTipoVenta = articulotipoventa::where('fkArticulo', $productoId)
                ->where('fkTipoVenta',  $tipoVenta )
                ->first();
                $movimientosArticulos= new MovimientosArticulos();
                $movimientosArticulos->fkArticulo=$productoId;
                $movimientosArticulos->fkTipoMovimiento=2;
                $movimientosArticulos->cantidad=$cantidad;
                $movimientosArticulos->fecha=now();
                $movimientosArticulos->fkEmpleado=session('id');
                $movimientosArticulos->save();

                $articulo= Articulo::find($productoId);
                
                $cantidadPresente=$articulo->cantidadActual;//nombre base de datos       //nombre formulario
                $articulo->cantidadActual=$cantidadPresente-$cantidad;
                if($articulo->cantidadActual<=$articulo->cantidadMinima){
                    $articulo->estatus=2;
                }
                if($articulo->cantidadActual<=0){
                    $articulo->estatus=0;
                }
                $articulo->save();
                for ($j = 0; $j < $cantidad; $j++) {
                    $comprasCliente = new ComprasClientes();
                    $comprasCliente->fkCliente = $cliente->pkCliente;
                
                    $comprasCliente->fecha = now();
                    if ($articuloTipoVenta->fkTipoVenta == 1) {
                        $comprasCliente->cantidadASaldar = 0;
                        $comprasCliente->estatus = 0;
                        $comprasCliente->estatusDeCobro = 0;
                    } else {
                        $comprasCliente->cantidadASaldar = $articuloTipoVenta->cantidadTipoVenta - $articuloTipoVenta->enganche;
                        $comprasCliente->estatus = 1;
                        $comprasCliente->estatusDeCobro = 1;
                    }
                    $comprasCliente->fkArticuloTipoVenta = $articuloTipoVenta->pkArticuloTipoVenta;
                    $comprasCliente->folioCompra=uniqid();
                    $comprasCliente->save();
                }
                // Aquí puedes realizar las operaciones que necesites con cada conjunto de datos
            }
                      
            return redirect(url('/clienteEspecifico/' . $cliente->pkCliente))->with('success', '¡Compra Completada!');
                } else {
                    return redirect(url('/tuInicio')->previous())->with('error', 'Error en Proceso de Compra');
            }
        }

        public function detalleCompra($pkCompra)
        {
        $abonos= ComprasClientes::join('abonoarticulo', 'abonoarticulo.fkComprasCliente', '=', 'comprascliente.pkComprasCliente')
        ->select('abonoarticulo.*')     
        ->where('compracliente.pkCompra', '=', $pkCompra)
                ->first();
                
        $compra = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
        ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprascliente.fkArticuloTipoVenta')
        ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
        ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
        ->join('concepto', 'concepto.pkConcepto', '=', 'comprascliente.fkConcepto')
        ->select('cliente.*','comprascliente.*','concepto.*', 'comprascliente.estatus as estatusCompra','articulotipoventa.*', 'articulo.*', 'tipoventa.*')
        ->where('compracliente.pkCompra', '=', $pkCompra)
        ->get();

            return view('detalleCompra',compact('abonos','compra'));
        }
        public function comprasGenerales()
        {
                
        $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
        ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprascliente.fkArticuloTipoVenta')
        ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
        ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
        ->select('cliente.*', 'comprascliente.*','comprascliente.estatus as ESTATUSCOMPRA', 'articulotipoventa.*', 'articulo.*', 'tipoventa.*')
        ->get();

            return view('historialCompras',compact('compras'));
        }
        public function actualizarComprasDespuesDeOneYear()
        {
            // Obtén las compras que cumplen con los criterios
            $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
                              ->where('comprascliente.fkTipoVenta', 4) 
                              ->where('comprascliente.estatus', 1)// Corregido: Agrega ->where después del join y usa ->where en lugar de =
                              ->get(); // Agrega ->get() para ejecutar la consulta y obtener los resultados
        
            // Filtra solo las compras que tengan un año de antigüedad
            $fechaUnAnioAtras = now()->subYear(); // Obtiene la fecha actual y resta un año
            $compras = $compras->where('comprascliente.fecha', '=', $fechaUnAnioAtras);
        
            // Actualiza las compras estableciendo el estatus a 2
            $compras->update(['estatus' => 2]);
        }
        
        public function actualizarComprasDespuesDeOneMonth()
        {
            // Obtén las compras que cumplen con los criterios
            $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
                              ->where('comprascliente.fkTipoVenta', 2) 
                              ->where('comprascliente.estatus', 1)// Corregido: Agrega ->where después del join y usa ->where en lugar de =
                              ->get(); // Agrega ->get() para ejecutar la consulta y obtener los resultados
        
            // Filtra solo las compras que tengan un mes de antigüedad
            $fechaUnMesAtras = now()->subMonth(); // Obtiene la fecha actual y resta un mes
            $compras = $compras->where('comprascliente.fecha', '=', $fechaUnMesAtras);
        
            // Actualiza las compras estableciendo el estatus a 2
            $compras->update(['estatus' => 2]);
        }
        
        public function actualizarComprasDespuesDeTwoMonth()
        {
            // Obtén las compras que cumplen con los criterios
            $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
                              ->where('comprascliente.fkTipoVenta', 3) 
                              ->where('comprascliente.estatus', 1)// Corregido: Agrega ->where después del join y usa ->where en lugar de =
                              ->get(); // Agrega ->get() para ejecutar la consulta y obtener los resultados
        
            // Filtra solo las compras que tengan dos meses de antigüedad
            $fechaDosMesesAtras = now()->subMonths(2); // Obtiene la fecha actual y resta dos meses
            $compras = $compras->where('comprascliente.fecha', '=', $fechaDosMesesAtras);
        
            // Actualiza las compras estableciendo el estatus a 2
            $compras->update(['estatus' => 2]);
        }
        

        public function actualizarDiasDeuda()
{
    // Obtener todas las compras cliente
    $comprasClientes = ComprasClientes::where('estatus', 1)->get();


    foreach ($comprasClientes as $compraCliente) {
        // Obtener el último abono realizado para esta compra
        $ultimoAbono = abonoArticulo::where('fkComprasCliente', $compraCliente->pkComprasCliente)
            ->orderByDesc('fecha')
            ->first();

        // Verificar si hay abonos para esta compra
        if ($ultimoAbono) {
            $fechaAbono = Carbon::parse($ultimoAbono->fecha);
            $fechaHoy = Carbon::now();

            // Calcular la diferencia de días entre el último abono y hoy
            $diferenciaDias = $fechaAbono->diffInDays($fechaHoy);

            // Si han pasado más de una semana desde el último abono, aumentar días de deuda en 1
            if ($diferenciaDias > 7) {
                $compraCliente->diasDeuda += 1;
                $compraCliente->save();
            }
        }
    }
}


  }
