<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Persona_controller;
use App\Http\Controllers\Articulo_controller;
use App\Http\Controllers\categoriaArticulo_controller;
use App\Http\Controllers\comprasCliente_controller;
use App\Http\Controllers\ubicaciones_controller;
use App\Http\Controllers\cliente_controller;
use App\Http\Controllers\empleado_controller;
use App\Http\Controllers\abono_controller;
use App\Http\Controllers\Municipio_controller;
use App\Http\Controllers\Colonia_controller;
use App\Http\Controllers\Calle_controller;
use App\Models\Articulo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/logout', [empleado_controller::class, 'logout'])->name('logout');

Route::get('/compraNewClient', function () {
    return view('comprasClienteNuevo');
});
Route::get('/seleccionCompra', function () {
    return view('compras');
});

Route::get('/tuInicio', function () {
    return view('paginaInicio');
});
Route::get('/tuInicioCobrador', function () {
    return view('paginaInicioCobrador');
});

Route::get('/compraClient', function () {
    return view('comprasClienteExistente');
});
Route::get('/clientesRegistrados', function () {
    return view('listaClientes');
});
Route::get('/clienteEspecifico/{pkCliente}', function () {
    return view('detalleCliente');
})->name('cliente.mostrar');

Route::get('/AggUsers', function () {
    return view('agregarEmpleado');
})->name('formEmpleado');

Route::get('/compraEspecifica', function () {
    return view('detalleCompra');
});
Route::get('/compraEspecifica', function () {
    return view('detalleCompra');
});
Route::get('/articuloAgregar', function () {
    return view('formularioArticulos');
})->name('articleAgg');

//MOVIMIENTOS ///
Route::get('/movimientosVision', [articulo_controller::class, 'todosmovimientosArticulos'])->name('movimientos.mostrar');
Route::get('/articulosOpcionesSeleccionables', [articulo_controller::class, 'todosmovimientosArticulos4'])->name('opciones.detalle');

//MUNICIPIO CRUD
Route::get('/municipioVision', [Municipio_controller::class, 'mostrar'])->name('municipio.vista');
Route::post('/aggMunicipio', [Municipio_controller::class,"insertar"])->name('municipio.insertar');
Route::post('/bajaMunicipio/{pkMunicipio}', [Municipio_controller::class,"baja"])->name('municipio.baja');
Route::post('/UpdateMunicipio/{pkMunicipio}', [Municipio_controller::class,"editar"])->name('municipio.actualizar');
Route::get('/mostrarMunicipio/{pkMunicipio}', [Municipio_controller::class, 'mostrarPorId'])->name('municipio.mostrarPorId');

//COLONIA CRUD
Route::get('/coloniaVision', [Colonia_controller::class, 'mostrar'])->name('colonia.vista');
Route::post('/aggColonia', [Colonia_controller::class,"insertar"])->name('colonia.insertar');
Route::post('/bajaColonia/{pkColonia}', [Colonia_controller::class,"baja"])->name('colonia.baja');
Route::post('/UpdateColonia/{pkColonia}', [Colonia_controller::class,"editar"])->name('colonia.actualizar');
Route::get('/mostrarColonia/{pkColonia}', [Colonia_controller::class, 'mostrarPorId'])->name('colonia.mostrarPorId');

//COLONIA CRUD
Route::get('/calleVision', [Calle_controller::class, 'mostrar'])->name('calle.vista');
Route::post('/aggCalle', [Calle_controller::class,"insertar"])->name('calle.insertar');
Route::post('/bajaCalle/{pkCalle}', [Calle_controller::class,"baja"])->name('calle.baja');
Route::post('/UpdateCalle/{pkCalle}', [Calle_controller::class,"editar"])->name('calle.actualizar');
Route::get('/mostrarCalle/{pkCalle}', [Calle_controller::class, 'mostrarPorId'])->name('calle.mostrarPorId');



//CATEGORIA ARTICULO CRUD
Route::get('/categoriaArticuloVision', [categoriaArticulo_controller::class, 'mostrar'])->name('categoriaArticulo.vista');
Route::post('/aggCategoriaArticulo', [categoriaArticulo_controller::class,"insertar"])->name('categoriaArticulo.insertar');
Route::post('/bajaCategoriaArticulo/{pkArticulo}', [categoriaArticulo_controller::class,"baja"])->name('categoriaArticulo.baja');
Route::post('/UpdateCategoriaArticulo/{pkCategoriaArticulo}', [categoriaArticulo_controller::class,"editar"])->name('categoriaArticulo.actualizar');
Route::get('/mostrarCategoriaArticuloPorId/{pkCategoriaArticulo}', [categoriaArticulo_controller::class, 'mostrarPorId'])->name('categoriaArticulo.mostrarPorId');
///////////////////////////          /////////////////////////////////////



Route::post('/aggArticulo', [Articulo_controller::class,"agregarArticulo"])->name('articulo.insertar');
Route::post('/updateArticulo', [Articulo_controller::class,"actualizarArticulo"])->name('articulo.actualizar');
Route::post('/bajaArticulo/{pkArticulo}', [Articulo_controller::class,"baja"])->name('articulo.baja');

Route::get('/articuloDetails/{pkArticulo}/{vista?}', [Articulo_controller::class, 'articuloDetalle'])->name('articulo.detalle');
Route::post('/articuloMovement/{pkArticulo}', [Articulo_controller::class, 'movimientosArticulo'])->name('articulo.Movimiento');


Route::post('/aggCompraNewClient', [comprasCliente_controller::class,"agregarNewClientBuy"])->name('compra.insertar');

Route::post('/updateCompraClient/{pkCompra}', [comprasCliente_controller::class,"actualizarClientBuy"])->name('compra.actualizar');


Route::post('/aggCompraClient', [comprasCliente_controller::class,"agregarClientBuy"])->name('compraCExistente.insertar');

Route::get('/opcionesColoniasId', [ubicaciones_controller::class, 'obtenerColoniasId'])->name('Ubicaciones.coloniasId');

Route::get('/opcionesColoniasString', [ubicaciones_controller::class, 'obtenerColoniasString'])->name('Ubicaciones.coloniasString');
Route::get('/opcionesCallesId', [ubicaciones_controller::class, 'obtenerCallesId'])->name('Ubicaciones.callesId');
Route::get('/opcionesCallesString', [ubicaciones_controller::class, 'obtenerCallesString'])->name('Ubicaciones.callesString');

Route::get('/compraNewClient', [Articulo_controller::class, 'todosLosArticulos'])->name('buscarArticulo');
Route::get('/compraClient', [Articulo_controller::class, 'todosLosArticulos2'])->name('buscarArticulo2');
Route::get('/articulesList', [Articulo_controller::class, 'todosLosArticulos3'])->name('buscarArticulo3');


////CLIENTE CRUD///////////////////////////7
Route::get('/ClienteBusqueda', [cliente_controller::class, 'buscarCliente'])->name('buscarCliente');

Route::get('/ComprasBusqueda/{pkCliente}', [cliente_controller::class, 'mostrarClientePorId'])->name('cliente.compras');

Route::get('/edicionCliente/{pkCliente}', [cliente_controller::class, 'mostrarClienteIndividual'])->name('cliente.mostrarEdicion');
Route::post('/actualizarCliente/{pkCliente}', [cliente_controller::class, 'actualizar'])->name('cliente.actualizar');
Route::post('/bajaCliente/{pkCliente}', [cliente_controller::class, 'baja'])->name('cliente.baja');


Route::get('/obtener-detalle-articulo/{id}/{tipoVenta}', [Articulo_controller::class,"obtenerDetalleArticulo"])->name('articulo.Articulo');
Route::get('/obtener-cantidad-tipo-venta/{id}/{tipoVenta}', [Articulo_controller::class,"obtenerCantidadTipoVenta"])->name('articulo.cantidadVenta');


Route::post('/abonoInsertion', [abono_controller::class,"agregar"])->name('abono.insertar');

///////EMPLEADOS CRUD   /////////////
Route::post('/aggNewEmployee', [empleado_controller::class,"agregar"])->name('empleado.insertar');
Route::get('/allEmployees', [empleado_controller::class,"mostrarUsuariosGeneral"])->name('empleado.mostrar');
Route::get('/idEmployee/{pkEmpleado}/{vista?}', [empleado_controller::class,"mostrarUsuarioPorId"])->name('empleado.mostrarPorId');
Route::post('/updateEmployee', [empleado_controller::class,"actualizar"])->name('empleado.actualizar');
Route::post('/deleteEmployee', [empleado_controller::class,"baja"])->name('empleado.baja');

Route::post('/inicioSesion', [empleado_controller::class, 'login'])->name('inicioSesion');

Route::get('compraEspecifica/{pkCompra}/{vista?}', [abono_controller::class, 'mostrarAbonosPorIdCliente'])->name('cliente.abonos');
Route::get('clienteEspecifico/{pkCliente}', [cliente_controller::class, 'mostrarClientePorId'])->name('cliente.detalle');


///AREA ABONOS  ////////////////////////////////////////////////////////////


Route::get('/calcular-suma-abonos', [abono_controller::class, 'sumaAbonos']);

Route::get('/calculoCobroyeahh/{pkEmpleado}', [abono_controller::class,"envioCobro"])->name('empleado.cobrado');


Route::get('seleccionabono/{pkCompra}/{vista?}', [abono_controller::class, 'mostrarAbonosPorIdCliente'])->name('cliente.abonos');

Route::get('reparto/{pkEmpleado}/{vista?}', [abono_controller::class, 'infoParaAbono'])->name('cobrador.FormAbono');

Route::get('repartido/{pkEmpleado}/{vista?}', [abono_controller::class, 'infoParaAbonoIndividual'])->name('cobrador.Tarjetas');


Route::post('/insercionReparto', [abono_controller::class, 'agregarReparto'])->name('reparto.Insertar');

Route::post('/insercionOrden', [abono_controller::class, 'ordenarReparto'])->name('reparto.Ordenar');

Route::post('/deinsercionOrden', [abono_controller::class, 'desasignarReparto'])->name('reparto.desasignarReparto');


Route::get('/listaCobradores', [empleado_controller::class, 'mostrarSoloCobradores'])->name('cobradores.lista');


//Lista de compras
Route::get('/historialCompras', [comprasCliente_controller::class,"comprasGenerales"])->name('compras.ver');

Route::get('/historialAbonos', [abono_controller::class, 'mostrarAbonosPorGenerales'])->name('abonos.historial');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
