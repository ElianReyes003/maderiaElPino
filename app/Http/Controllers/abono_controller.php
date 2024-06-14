<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\abonoArticulo;
use App\Models\ComprasClientes;
use App\Models\Cliente;
use App\Models\Empleado;
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
        $abono->save();
        $compra->save();
        if(session('fkTipoUsuario') == 2){
            return redirect(route('cobrador.Tarjetas', ['pkEmpleado' =>  session('id')]))->with('success', '¡Abono agregado exitosamente!');
        }elseif(session('fkTipoUsuario') == 1||session('fkTipoUsuario') == 3){
            return redirect(url('/clientesRegistrados'))->with('success', '¡Abono agregado exitosamente!');
        }
    } else {
        return redirect(url()->previous())->with('error', 'Error en Abono');
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
                    ->select('empleado.*', 'cliente.*','abonoarticulo.*','abonoarticulo.fecha as FECHAABONO')->where('comprascliente.pkComprasCliente', '=', $pkCompra)->get();
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
                    ,'comprascliente.*','articulotipoventa.*','articulo.*','tipoventa.*',)->get();
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
