<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\abonoArticulo;
use App\Models\ComprasClientes;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\ArticuloTipoVenta;
use Carbon\Carbon;

class abono_controller extends Controller
{
    public function agregar(Request $req)
    {
        date_default_timezone_set('America/Mazatlan');
        $compra = ComprasClientes::find($req->pkComprasCliente);
        if ($compra) {
        $abono= new abonoArticulo();
        $abono->fecha = now();
        $abono->estatus = 1;
        $abono->abono = $req->cantidad;
        $abono->fkConcepto = 1;
        $abono->saldo = $compra->cantidadASaldar;
        $abono->fkEmpleado=session('id');
        $abono->fkComprasCliente=$req->pkComprasCliente;
        $totalSaldar=$compra->cantidadASaldar-$req->cantidad;
        $compra->cantidadASaldar=$totalSaldar;
        if($totalSaldar==0)
        {
            $compra->estatus=0;
        }
        $compra->diasDeuda=$req->diasDeuda;
        $compra->estatusDeCobro=0;
        $abono->folioAbono=uniqid();

        $articulo = ArticuloTipoVenta::where('pkArticuloTipoVenta',$compra->fkArticuloTipoVenta )
        ->first();
      
        $tipoVenta2 = ArticuloTipoVenta::where('fkTipoVenta', 2)
        ->where('fkArticulo',$articulo->fkArticulo )
        ->first();
        $totalAbonado = AbonoArticulo::where('fkComprasCliente', $compra->pkcomprasCliente)
        ->where('fkConcepto', 1)
        ->sum('abono');


        $liquidacion2 = $tipoVenta2 ? $tipoVenta2->cantidadTipoVenta - ($totalAbonado + $req->cantidad) : null;

        // Fecha de un mes en el futuro
        $fechaUnMesAdelante = now()->addMonth();
        // Comprobar si la fecha de la compra está dentro de un mes o más en el futuro
        if ($compra->fecha <= $fechaUnMesAdelante && $liquidacion2 == 0) {
            $abono->fkConcepto = 6;
            $compra->estatus = 0;
            $compra->fkArticuloTipoVenta = $tipoVenta2->pkArticuloTipoVenta;
            $compra->cantidadASaldar = 0;
            $compra->diasDeuda = $req->diasDeuda;
            $compra->estatusDeCobro = 0;
            $abono->folioAbono = uniqid();
            $abono->save();
            $compra->save();
        
            return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
        }
        
        $tipoVenta3 = ArticuloTipoVenta::where('fkTipoVenta', 3)
            ->where('fkArticulo', $articulo->fkArticulo)
            ->first();
        
        $liquidacion3 = $tipoVenta3 ? $tipoVenta3->cantidadTipoVenta - ($totalAbonado + $req->cantidad) : null;
        
        // Fecha de dos meses en el futuro
        $fechaDosMesesAdelante = now()->addMonths(2);
        
        // Comprobar si la fecha de la compra está dentro de dos meses o más en el futuro
        if ($compra->fecha <= $fechaDosMesesAdelante && $compra->fecha > $fechaUnMesAdelante && $liquidacion3 == 0) {
            $abono->fkConcepto = 7;
            $compra->fkArticuloTipoVenta = $tipoVenta3->pkArticuloTipoVenta;
            $compra->estatus = 0;
            $compra->cantidadASaldar = 0;
            $compra->diasDeuda = $req->diasDeuda;
            $compra->estatusDeCobro = 0;
            $abono->folioAbono = uniqid();
            $abono->save();
            $compra->save();
        
            return redirect(url('/historialCompras'))->with('success', '¡Compra Actualizada!');
        }
        
    }
}
    function mostrarAbonosPorIdCliente($pkCompra, $vista = "detalleCompra"){
        $compra = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
        ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprascliente.fkArticuloTipoVenta')
        ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
        ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
        ->join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
        ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
       
        ->select(
            'cliente.*',
            'cliente.telefono',
            'comprascliente.*',
            'comprascliente.pkComprasCliente',
            'comprascliente.estatus as ESTATUSCOMPRA',
            'articulotipoventa.*',
            'articulo.*',
            'tipoventa.*',
            'colonia.*' ,'municipio.*'
        )    
        ->where('comprascliente.pkComprasCliente', '=', $pkCompra)
        ->first();
        
        $abonos=abonoArticulo::join('comprascliente', 'comprascliente.pkComprasCliente', '=', 'abonoarticulo.fkComprasCliente')
        ->join('empleado', 'abonoarticulo.fkEmpleado', '=', 'empleado.pkEmpleado')
        ->join('cliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
        ->join('concepto', 'concepto.pkConcepto', '=', 'abonoarticulo.fkConcepto')
                    ->select('empleado.*','concepto.*', 'cliente.*','abonoarticulo.*','abonoarticulo.fecha as FECHAABONO')->where('comprascliente.pkComprasCliente', '=', $pkCompra)->get();
        return view($vista,compact("abonos","compra"));
      }
      //FUNCION ABONOS GENERALES
      function mostrarAbonosPorGenerales(){
        $abonos=abonoArticulo::
        join('empleado', 'abonoarticulo.fkEmpleado', '=', 'empleado.pkEmpleado')
        ->join('comprascliente', 'comprascliente.pkComprasCliente', '=', 'abonoarticulo.fkComprasCliente')
        ->join('cliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
        ->join('articulotipoventa', 'comprascliente.fkArticuloTipoVenta', '=', 'articulotipoventa.pkArticuloTipoVenta')
        ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
        ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
                    ->select('empleado.*', 'cliente.*','abonoarticulo.*','abonoarticulo.fecha AS FECHAABONO'
                    ,'comprascliente.*','articulotipoventa.*','articulo.*','tipoventa.*',)
                    ->where('abonoarticulo.fkConcepto', '=', 1)
                    ->get();
                    return view("historialAbonos",compact("abonos"));
      }
      function infoParaAbono($pkEmpleado , $vista = "repartirTarjetas"){
        $datosUsuario=Empleado::join('tipousuario', 'empleado.fkTipoUsuario', '=', 'tipousuario.pkTipoUsuario')
        ->join('colonia', 'colonia.pkColonia', '=', 'empleado.fkColonia')
        ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                    ->select('empleado.*', 'tipousuario.*','municipio.*','colonia.*')->where('empleado.estatus', '=', '1')->where('empleado.pkEmpleado', '=', $pkEmpleado)->first();
        if($vista!='eliminarAsignacionTarjetas'){
       
         $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
                    ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprascliente.fkArticuloTipoVenta')
                    ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
                    ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
            ->join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                    ->select('cliente.*', 'comprascliente.*', 'articulotipoventa.*', 'articulo.*', 'tipoventa.*','colonia.*', 'municipio.*')
                    ->where('comprascliente.estatus', '=', 1)
                    ->where('comprascliente.fkEmpleado', '=', null)
                    ->get();
      }
      if($vista=="eliminarAsignacionTarjetas"){
         $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
                    ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprascliente.fkArticuloTipoVenta')
                    ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
                    ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
            ->join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                    ->select('cliente.*', 'comprascliente.*', 'articulotipoventa.*', 'articulo.*', 'tipoventa.*','colonia.*','municipio.*')
                    ->where('comprascliente.estatus', '=', 1)
                    ->where('comprascliente.fkEmpleado', '=', $pkEmpleado)
                    ->get();
      }      
        return view($vista,compact("datosUsuario","compras"));
      }
      function infoParaAbonoIndividual($pkEmpleado,$vista = "listaRepartidosCobrador"){
        $datosUsuario=Empleado::join('tipousuario', 'empleado.fkTipoUsuario', '=', 'tipousuario.pkTipoUsuario')
        ->join('colonia', 'colonia.pkColonia', '=', 'empleado.fkColonia')
        ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                    ->select('empleado.*', 'tipousuario.*','municipio.*','colonia.*')->where('empleado.estatus', '=', '1')->where('empleado.pkEmpleado', '=', $pkEmpleado)->first();
         $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
                    ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprascliente.fkArticuloTipoVenta')
                    ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
                    ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
            ->join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
                    ->select('cliente.*', 'comprascliente.*', 'articulotipoventa.*', 'articulo.*', 'tipoventa.*','colonia.*', 'municipio.*')
                    ->where('comprascliente.estatusDeCobro', '=', 1)
                    ->where('comprascliente.estatus', '=', 1)
                    ->where('comprascliente.fkEmpleado', '=', $pkEmpleado)
                    ->get();
                 
        return view($vista,compact("datosUsuario","compras"));
      }
      public function agregarReparto(Request $req)
      {
          // Acceder a las filas seleccionadas desde el campo oculto
          $filasSeleccionadas = $req->input('filasSeleccionadas');
      if($filasSeleccionadas){
          foreach ($filasSeleccionadas as $filaSeleccionada) {
              // Decodificar la cadena JSON a array
              $fila = json_decode($filaSeleccionada, true);  
             foreach($fila as $filitas){

                $compraId = $filitas['id'];
                $compra = ComprasClientes::find($compraId);
                $compra->estatusDeCobro = 1; 
                $compra->fkEmpleado = $req->fkEmpleado;
                $compra->save(); 
             }
             
        
          }
      
          // Realizar operaciones con las filas seleccionadas
      
      return redirect(url('/listaCobradores'))->with('success', '¡Reparto de Cobro Agregado Exitosamente!');
    } else {
        return redirect(url('/listaCobradores'))->with('error', 'Error en reparto de cobro');
    }
}
      
      
    public function actualizarComprasDespuesDeUnaSemana()
    {
        // Obtén las compras que cumplen con los criterios
        $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente');
            // ... (tu código actual)

        // Filtra solo las compras que tengan una semana de antigüedad
        $compras = $compras->where('comprascliente.estatus', '=', 1);

        // Actualiza las compras estableciendo fkEmpleado a null
        $compras->update(['estatusDeCobro' => 1]);
    }

    public function ordenarReparto(Request $req)
    {
        $contador=0;
        // Acceder a las filas seleccionadas desde el campo oculto
        $filasSeleccionadas = $req->input('filasSeleccionadas');
    if($filasSeleccionadas){
        foreach ($filasSeleccionadas as $filaSeleccionada) {
            // Decodificar la cadena JSON a array
            $fila = json_decode($filaSeleccionada, true);  
           foreach($fila as $filitas){
              $contador++;
              $compraId = $filitas['id'];
              $compra = ComprasClientes::find($compraId);
              $compra->ordenReparto=$contador;
              $compra->save(); 
           }
           
      
        }
    
            // Realizar operaciones con las filas seleccionadas
            return redirect(route('cobrador.Tarjetas', ['pkEmpleado' =>  session('id')]))->with('success', '¡Ordenado De Cobro Completado!');
        } else {
            return redirect(route('cobrador.Tarjetas', ['pkEmpleado' =>  session('id')]))->with('error', 'Error en ordenado de cobro');
        }
    }

    
    public function desasignarReparto(Request $req)
    {
        // Acceder a las filas seleccionadas desde el campo oculto
        $filasSeleccionadas = $req->input('filasSeleccionadas');
    if($filasSeleccionadas){
        foreach ($filasSeleccionadas as $filaSeleccionada) {
            // Decodificar la cadena JSON a array
            $fila = json_decode($filaSeleccionada, true);  
           foreach($fila as $filitas){
          
              $compraId = $filitas['id'];
              $compra = ComprasClientes::find($compraId);
              $compra->fkEmpleado=null;
              $compra->save(); 
           }
           
      
        }

        return redirect(url('/listaCobradores'))->with('success', '¡Desasignacion De Cobro Completada!');
    } else {
        return redirect(url('/listaCobradores'))->with('error', 'Error en desasignacion de cobro');
    }
        // Realizar operaciones con las filas seleccionadas
    
       
    }

     
    public function sumaAbonos(Request $request)
    {
        $fechainicio = $request->input('fechainicio');
        $fechaFin = $request->input('fechaFin');
        $pkempleado = $request->input('pkempleado');
    
        $sumaAbonos = abonoArticulo::join('empleado', 'abonoarticulo.fkEmpleado', '=', 'empleado.pkEmpleado')
            ->where('empleado.pkEmpleado', $pkempleado)
            ->whereBetween('fecha', [$fechainicio, $fechaFin])
            ->sum('abonoarticulo.abono');
    
        return response()->json(['sumaAbonos' => $sumaAbonos]);
    }

    
    
    
    public function envioCobro($pkEmpleado)
    {
        $empleado = Empleado::select('nombreEmpleado')
                            ->where('pkEmpleado', $pkEmpleado)
                            ->first();
    
        return view('calculocobro', [
            'pkEmpleado' => $pkEmpleado,
            'empleado' => $empleado
        ]);
    }
    
    

    
}
