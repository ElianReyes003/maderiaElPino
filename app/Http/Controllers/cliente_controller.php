<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentos;
use App\Models\Colonia;
use App\Models\Calle;
use App\Models\Cliente;
class cliente_controller extends Controller
{
    public function buscarCliente(Request $request) {
        $searchTerm = $request->query('searchTermCliente');
        $fkMunicipio = $request->query('fkMunicipio');
        $fkColonia = $request->input('fkColonia'); 
        $datosClientes = Cliente::join('colonia', 'cliente.fkColonia', '=', 'colonia.pkColonia')
        ->join('municipio', 'colonia.fkMunicipio', '=', 'municipio.pkMunicipio')
        ->where('cliente.estatus', 1)
        ->select('cliente.*', 'municipio.*', 'colonia.*')
        ->where(function($query) use ($searchTerm, $fkMunicipio, $fkColonia) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('cliente.nombreCliente', 'LIKE', '%' . $searchTerm . '%')
                ->where('cliente.estatus', 1); 
            });
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
          
        })
        ->orWhere(function($query) use ($searchTerm, $fkMunicipio, $fkColonia) {
            $query->where('municipio.nombreMunicipio', 'LIKE', '%' . $searchTerm . '%')
            ->where('cliente.estatus', 1); 
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
         
        })
        ->orWhere(function($query) use ($searchTerm, $fkMunicipio,$fkColonia) {
            $query->where('colonia.nombreColonia', 'LIKE', '%' . $searchTerm . '%')
            ->where('cliente.estatus', 1); 
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
          
        })
        ->orWhere(function($query) use ($searchTerm, $fkMunicipio,$fkColonia) {
            $query->where('cliente.calle', 'LIKE', '%' . $searchTerm . '%')
            ->where('cliente.estatus', 1); 
    
            if ($fkMunicipio) {
                $query->where('colonia.fkMunicipio', '=', $fkMunicipio)
                ->where('cliente.estatus', 1); 
            }
            if ($fkColonia) {
                $query->where('cliente.fkColonia', '=', $fkColonia)
                ->where('cliente.estatus', 1); 
            }
          
        })
        // Resto de tus joins y condiciones...
        ->get();
    
        
    
        return response()->json($datosClientes);
    }
    public function mostrarClientePorId($pkCliente)
    {

        $cliente = Cliente::join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->select('cliente.*', 'colonia.*',  'municipio.*')
            ->where('cliente.pkCliente', '=', $pkCliente)
            ->first();
            $compras = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
    ->join('articulotipoventa', 'articulotipoventa.pkArticuloTipoVenta', '=', 'comprascliente.fkArticuloTipoVenta')
    ->join('articulo', 'articulo.pkArticulo', '=', 'articulotipoventa.fkArticulo')
    ->join('tipoventa', 'tipoventa.pkTipoVenta', '=', 'articulotipoventa.fkTipoVenta')
    ->select(
        'cliente.*',
        'comprascliente.*',
        'comprascliente.estatus as ESTATUSCOMPRA',
        'articulotipoventa.*',
        'articulo.*',
        'tipoventa.*'
    )    
    ->where('cliente.pkCliente', '=', $pkCliente)
    ->get();

    $documentos = Cliente::join('documentos', 'documentos.fkCliente', '=', 'cliente.pkCliente')
    ->select(
        'cliente.*',
        'documentos.*'
    )    
    ->where('cliente.pkCliente', '=', $pkCliente)
    ->get();

    
           return view('detalleCliente',compact('compras','cliente','documentos'));
    }
    public function mostrarClienteIndividual($pkCliente)
    {

        $cliente = Cliente::join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->select('cliente.*', 'colonia.*', 'municipio.*')
            ->where('cliente.pkCliente', '=', $pkCliente)
            ->first();
        $documentos = Cliente::join('documentos', 'cliente.pkCliente', '=', 'documentos.fkCliente')
            ->where('cliente.pkCliente', '=', $pkCliente)
            ->first();

    
           return view('editarCliente',compact('cliente','documentos'));
    }

    public function clienteActualizar($pkCliente)
    {

        $cliente = Cliente::join('colonia', 'colonia.pkColonia', '=', 'cliente.fkColonia')
            ->join('municipio', 'municipio.pkMunicipio', '=', 'colonia.fkMunicipio')
            ->select('cliente.*', 'colonia.*', 'municipio.*')
            ->where('cliente.pkCliente', '=', $pkCliente)
            ->first();


    
           return view('editarCliente',compact('cliente'));
    }
    public function actualizar(Request $req)
    {
        $cliente= Cliente::find($req->pkCliente);
      
        //nombre base de datos       //nombre formulario
        $cliente->nombreCliente = $req->nombreCliente;
        $cliente->telefono = $req->telefono;
        $cliente->fkColonia = $req->fkColonia;
        $cliente->calle = $req->calle;
        $cliente->numCasa = $req->numCasa;
        $cliente->descripcionDomicilio = $req->descripcionDomicilio;
        if ($req->hasFile('imagenDomicilio')) {
            $imagen = $req->file('imagenDomicilio');
            $rutaImagen = $imagen->store('public/images');
            $cliente->imagenDomicilio = str_replace('public/', '', $rutaImagen);
            }
        
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
            
            
        $cliente->save();
        if($cliente){
            return redirect(url('/clientesRegistrados'))->with('success', '¡Actualización de Cliente Completada!');
        } else {
            return redirect(url('/clientesRegistrados'))->with('error', 'Error en Actualizacion de Cliente');
    
        }
    
    }

    public function baja($pkCliente)
    {
        $cliente= Cliente::find($pkCliente);
        //nombre base de datos       //nombre formulario
        $cliente->estatus=0;
        $cliente->save();
        if($cliente){
            return redirect(url('/clientesRegistrados'))->with('success', '¡Baja de Cliente Completada!');
        } else {
            return redirect(url('/clientesRegistrados')->previous())->with('error', 'Error en Baja de Cliente');
    
        }

       
    }
 
     





}