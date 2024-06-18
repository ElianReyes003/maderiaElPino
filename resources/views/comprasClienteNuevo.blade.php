<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
</head>
<body>
@if(session('id'))
    @if(session('fkTipoUsuario')==1||session('fkTipoUsuario')==3)
        @include("sidebar")
        <!-- El resto de tu contenido aquí... -->
    @else
        <script>
            window.location.href="{{url('/')}}";
        </script>
    @endif
@else
    <script>
        window.location.href="{{url('/')}}";
    </script>
@endif

@php
        use App\Models\tipoVenta;
        $datosTipoVenta = tipoventa::all();
        
@endphp


<form  id="formulario"  action="{{ route('compra.insertar') }}" enctype="multipart/form-data"  method="post" >

@csrf

<div class="p-4 sm:ml-64 mt-16 md:mt-10">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div class="flex justify-end">
				<h1 class="flex text-end md:mr-10 font-semibold text-xl">Fecha: <p class="flex ml-1">18/02/2024</p></h1>
			</div>
			<div class="mt-5 md:mt-10">
				<h1 class="text-center font-bold text-2xl">Compra</h1>
			</div>
			<div class="flex justify-center mt-5 md:mt-10">
                    <h1 class="text-center font-bold text-2xl">Ingrese los datos del cliente</h1>
			</div>
			<div class="mt-10">
			
				<div class="grid gap-6 mb-6 md:grid-cols-2 mt-10">
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre Cliente</label>
						<input type="text" name="nombreCliente"  id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">telefono</label>
						<input type="number" name="telefono"  class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <select name="fkMunicipio" id="fkMunicipio" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                        @php
                            use App\Models\Municipio;
                            $datosMunicipio=Municipio::all();
                        @endphp
                        <option value="">Selecciona Ciudad</option>
                        @foreach ($datosMunicipio as $dato)
                            <option value="{{$dato->pkMunicipio}}">{{$dato->nombreMunicipio}}</option>
                        @endforeach
                    </select>
                    <div>
                        <label for="underline_select" class="sr-only">Selecciona Colonia</label>
                        <select name="fkColonia" id="fkColonia" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">                   
                        <option value=""></option>
                        </select>
                    </div>
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Calle</label>
                        <input type="text" name="calle" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
                    </div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Numero de casa</label>
						<input type="number" name="numCasa" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Sube un archivo</label>
					    <input name="imagenDomicilio" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none" aria-describedby="file_input_help" id="" type="file">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Sube un archivo</label>	
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none" aria-describedby="file_input_help" type="file" id="documentos" name="documentos[]" multiple>              
                    </div>
                </div>
			
		</div>
		<div>			
			<label for="message" class="block mb-2 text-sm font-medium text-gray-900">Descripccion del domicilio</label>
			<textarea id="message"  name="descripcionDomicilio" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-400 focus:border-green-400"  placeholder="Descripcion.."></textarea>
		</div>
		   </div>
		</div>
	</div>

    <div class="p-4 sm:ml-64">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div>
				<div class="flex justify-center md:justify-normal items-center mt-10">
                    <form class="w-[13rem] md:w-[30rem]">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search"  id="busqueda"  class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
                        </div>
                    </form>
                 </div>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10">
                 <label for="underline_select" class="sr-only">Selecciona Categoria Articulo</label>
                    <select name="fkCategoria" id="fkCategoria" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                            @php
                                use App\Models\categoriaArticulo;
                                $datosCategoria=categoriaArticulo::where('estatus', 1)->get();
                            @endphp	
                            <option selected value="">Categoria Articulo</option>
                            @foreach ($datosCategoria as $dato)
                            <option value="{{$dato->nombreCategoriaArticulo}}">{{$dato->nombreCategoriaArticulo}}</option>
                            @endforeach
                                </select>
                                <label for="underline_select" class="sr-only">Selecciona Estatus</label>
                                <select name="fkEstatus" id="fkEstatus" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                                    <option selected value="" >Estatus</option>
                        <option value="1">Disponible</option>
                        <option value="0">No Disponible</option>
                        <option value="2">Por Agotarse</option>
                    </select>
                    <div class="flex mt-3   ">
                        <button type="button"id="limpiarFiltros" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                            Limpiar filtros
                        </button>    
                    </div>
                 </div>
			</div>
		   </div>
		   <div class="bg-white rounded-lg shadow-lg mt-10">
			<div class="flex justify-center mb-[1rem]">
				<div class="">
					<h1 class="text-center font-bold text-2xl mt-5">Selecciona articulos</h1>
				</div>
			</div>
			<table class="w-full table-auto mt-[1rem]"  id="tablaArticulos" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
                        <td class="oculto">ID</td>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Estatus</th>
                        <th>Enganche</th>
                        <th>Seleccionar</th>
					</tr>
					<tbody>
                    @foreach ($datosArticulos as $dato ) 
						<tr class="h-20">
                        <td class="oculto">{{$dato->pkArticulo}}</td>
                        <th>{{$dato->nombreArticulo}}</th>
                        <th>{{$dato->nombreCategoriaArticulo}}</th>
                        <th>{{$dato->cantidadTipoVenta}}</th>
                        <th>
                            @if($dato->ESTATUSARTICULO == 1)
                                Disponible
                            @elseif($dato->ESTATUSARTICULO == 2)
                                Por Agotarse
                            @elseif($dato->ESTATUSARTICULO == 0)
                                No Disponible
                            @else
                                Estado Desconocido
                            @endif
                        </th>
                        <th>{{$dato->enganche}}</th>
							<td class="items-center flex justify-center">									
								<div class="mt-2 md:mt-5">
									<input type="checkbox" name="articulo-seleccionado" class="seleccionar-articulo" data-articulo-id="{{$dato->pkArticulo}}" class="w-6 h-6 rounded text-green-400 bg-gray-100 border-gray-300 focus:ring-green-400 focus:ring-2">
                                </div>
							</td>
						</tr>
                    @endforeach

					</tbody>
					</thead>
				</table>
				<div class="flex justify-center	mt-16">
					<div class="md:p-10 p-5">
						  <div class="flex">
							<!-- Previous Button -->
                            <button id="previousBtn"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button id="nextBtn"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Siguiente
							</button>
						  </div>
					</div>
				</div>
			</div>
        </div>
     </div>
	 <div class="p-4 sm:ml-64">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
	 <div class="bg-white rounded-lg shadow-lg">
		<div class="flex justify-center mb-[1rem]">
		
		</div>
		<table class="w-full table-auto mt-[1rem]" id="articulos-lista" class="display nowrap" width="90%">
			<thead class="text-center">
				<tr class="h-24 text-center">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Ingresa cantidad</th>
                    <th>Tipo de compra</th>
                    <th>Enganche</th>
                    <th>Cancelar</th>
				</tr>
				<tbody id="detalle-articulos-body">
					
				</tbody>
				</thead>
			</table>
			<div class="flex justify-center	mt-16">
				<div class="md:p-10 p-5">
					  <div class="flex">
						<!-- Previous Button -->
                            <button id="previousBtn2" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button   id="nextBtn2"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Siguiente
							</button>
					  </div>
				</div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 ml-10 md:ml-0 p-5">
				<div class="flex p-5 md:justify-end">
					<h1 class="font-semibold">Total a pagar:</h1><label class="totalPago" for="">$$$</label>
				</div>
				<div class="flex p-5">
					<h2 class="font-semibold">Total enganche:</h2> <label class="totalEnganche" for="">$$$</label>
				</div>
			</div>
			
		</div>
	</div>
 </div>       
        <input type="hidden" name="producto_id[]" value="">
        <input type="hidden" name="cantidadotas[]" value="">
        <input type="hidden" name="tipoVenta[]" value="">

 <div class="flex p-4 sm:ml-64 justify-center">
	<div class="bg-white rounded-lg shadow-lg">
		<div class="flex justify-center">
			<div class="md:p-10 p-10 mt-5">
				  <div class="flex">
					<!-- Previous Button -->
					<a href="{{ url()->previous() }}"  class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
					  Cancelar
					</a>
					<!-- Next Button -->
					<button type="submit"   id="completar" value="Completar"class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
					  Completar
					</button>
				  </div>
			</div>
		</div>	
	</div>
 </div>

</form>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>



<script>
   


   var fila=0;
    var numeroDeFila=0;
    var precioOriginal=0;
    var tipoVentaSelected = 0;
    var paraEnganche = 0;
    var contador=0;
    var precioAño=0;
    // Función para calcular el precio total
    function calcularPrecioTotal(cantidad) {
        return cantidad * precioOriginal;
    }
  
   

    //SELECCION DE ARTICULO Y LISTA 
$(document).ready(function () {

    function calcularTotalAPagar() {
  var total = 0;
  var enganche = 0;
    
  $('#articulos-lista tbody tr').each(function () {
    var cantidad = parseFloat($(this).find('[id^="cantidad"]').val()) || 0;

    
    var precioOriginal = tableArticulosSeleccionados.row(this).data().precioOriginal;
    var enganche1 = tableArticulosSeleccionados.row(this).data().enganche;
    var tipoVenta = $(this).find("[id^=fkTipoVenta]").val();


    total += isNaN(cantidad) ? 0 : cantidad * precioOriginal;
    console.log(precioAño);
    // Establecer paraEnganche al 10% del precioOriginal si el tipoVenta es 4 (primera vez)

    // Calcular el enganche basado en el valor de paraEnganche
    if (tipoVenta === "1") {
      // Si el tipo de venta es 1, el enganche es 0
      enganche += 0;
    } else {
      // De lo contrario, calcular el enganche usando el valor de paraEnganche
      enganche += isNaN(cantidad) ? 0 : cantidad * enganche1;
    }
  });

  $('.totalPago').text('$' + total.toFixed(2));
  $('.totalEnganche').text('$' + enganche.toFixed(2));
}


    calcularTotalAPagar();
    var tableArticulos = $('#tablaArticulos').DataTable({
        responsive: true,
        "language": {
            "search": "Buscar compra:",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "zeroRecords": "Sin resultados",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },
    });
    $('#previousBtn').on('click', function(e) {
      e.preventDefault();
      tableArticulos.page('previous').draw(false);
    });

    // Agrega evento de clic al botón Next
    $('#nextBtn').on('click', function(e) {
      e.preventDefault();
      tableArticulos.page('next').draw(false);
    });
    $('#limpiarFiltros').on('click', function () {
        $('#fkEstatus, #fkCategoria').val('');
        tableArticulos.search('').columns().search('').draw();
    });

    var tableArticulosSeleccionados = $('#articulos-lista').DataTable({
        responsive: true,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
        },
    });
    $('#previousBtn2').on('click', function(e) {
      e.preventDefault();
      tableArticulosSeleccionados.page('previous').draw(false);
    });

    // Agrega evento de clic al botón Next
    $('#nextBtn2').on('click', function(e) {
      e.preventDefault();
      tableArticulosSeleccionados.page('next').draw(false);
    });

    $('#fkEstatus, #fkCategoria').change(function () {
        var estatus = $('#fkEstatus').val();
        var categoria = $('#fkCategoria').val();
            if (estatus === '1') {
            estatus = 'Disponible';
        } else if (estatus === '2') {
            estatus = 'Por Agotarse';
        }
        else if (estatus === '0') {
            estatus = 'No Disponible';
        }

        tableArticulos.column(4).search(estatus).draw();
        tableArticulos.column(2).search(categoria).draw();
    });

    $('#busqueda').on('keyup', function (e) {
        var filtroBusqueda = $('#busqueda').val();
        tableArticulos.search(filtroBusqueda).draw();
    });

    $('#limpiarFiltros').on('click', function () {
        $('#fkEstatus, #fkCategoria').val('');
        tableArticulos.search('').columns().search('').draw();
    });

     $('#tablaArticulos tbody').on('click', 'tr', function () {
        var checkbox = $(this).find('.seleccionar-articulo');
        checkbox.prop('checked', !checkbox.prop('checked'));
        var tipoVentaSeleccionado = $(this).find("[id^='fkTipoVenta']").val();
        var data = tableArticulos.row(this).data();
        var articuloId = data[0];
        var fila = $(this); 
 
   // Move this line above to define precioCell before using it
   var row = tableArticulosSeleccionados.row.add([
    data[0],
    data[1],
    data[2],
    data[3],
 
    `<td><input type="number" class="cantidad${articuloId} bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" id="cantidad${articuloId}" name="cantidades[]" value="1" min="1"></td>`,
   
    `<td>
        <select data-articulo-id="${articuloId}" id="fkTipoVenta${articuloId}" name="fkTipoVenta" class="p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" required>
            <?php foreach ($datosTipoVenta as $opcion): ?>
                <option value="<?= $opcion->pkTipoVenta ?>" <?= $opcion->pkTipoVenta == 4 ? 'selected' : '' ?>><?= $opcion->nombreTipoVenta ?></option>
            <?php endforeach; ?>
        </select>
    </td>`,
    data[5],
    `<button class="cancelar-articulo flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400" data-articulo-id="${articuloId}">Cancelar</button>`
]).draw();
    
        actualizarCamposOcultos();
            // Guardar precio original en la estructura de DataTable
        var rowData = row.data();
        rowData.precioOriginal = data[3];
        rowData.enganche = data[5];
        tipoVentaSeleccionado = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 5 }).node().getElementsByTagName('select')[0].value;
        // Calcular el total a pagar después de actualizar cantidad y precio
    calcularTotalAPagar();

    });

    function precioOriginalazo(articuloId, tipoVentaSeleccionado, callback) {
    $.ajax({
        url: '/obtener-cantidad-tipo-venta/' + articuloId + '/' + tipoVentaSeleccionado,
        method: 'GET',
        success: function (data) {
            // Actualizar el precio original en la estructura de DataTable
            tableArticulosSeleccionados.row(numeroDeFila).data().precioOriginal = data.cantidadTipoVenta;
            console.log("precio original multiplicado" + data.cantidadTipoVenta);
               
       
            // Llamar al callback con el valor actualizado
            callback(data.cantidadTipoVenta);
       
        },
        error: function () {
            console.log('Error al obtener la cantidadTipoVenta');
            // Llamar al callback con un valor predeterminado o manejar el error
            callback(0);
        }
    });
}

$(document).on('change', '[id^="cantidad"]', function () {
    var fila = $(this).closest('tr');
    numeroDeFila = tableArticulosSeleccionados.row(fila).index();

    var cell = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 3 });
    var articuloId = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 0 }).data();
    
    // Obtener el tipo de venta seleccionado
    var tipoVentaSeleccionado = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 5 }).node().getElementsByTagName('select')[0];
    var valorTipoVenta = $(tipoVentaSeleccionado).val();

    // Obtener el precio original guardado en la estructura de DataTable
    var precioOriginal = tableArticulosSeleccionados.row(numeroDeFila).data().precioOriginal;

    // Llamar a la función para obtener el precio actualizado
    precioOriginalazo(articuloId, valorTipoVenta, function (precioUso) {
        console.log(precioUso);
          // Obtener la cantidad ingresada as a floating-point number
        var cantidad = parseFloat($(this).val());

        // Calcular el nuevo precio y actualizar la celda
        cell.data(precioUso * cantidad).draw();
   
        calcularTotalAPagar();
    }.bind(this));
    actualizarCamposOcultos();
});


   
    $(document).on('change', '[id^="fkTipoVenta"]', function () {
        var tipoVentaSeleccionado = $(this).val();
        var articuloId = $(this).data('articulo-id');
        var fila = $(this).closest('tr');

        // Obtiene el número de fila
        var numeroDeFila = tableArticulosSeleccionados.row(fila).index();
        console.log("Número de fila: " + numeroDeFila);

        // Obtener referencia al input número
        var inputCantidad = $('#cantidad' + articuloId);

        // Asignar valor 1
        inputCantidad.val(1);

        // Actualizar el precio y cantidad
        actualizarPrecioYCantidad(articuloId, tipoVentaSeleccionado, numeroDeFila);
        calcularTotalAPagar();
        actualizarCamposOcultos();
    });
    $('#articulos-lista tbody').on('click', 'button.cancelar-articulo', function () {
        
    var filaCancelada = $(this).closest('tr');
    var cantidadCancelada = parseFloat(filaCancelada.find('[id^="cantidad"]').val()) || 0;
    var precioOriginal = parseFloat(tableArticulosSeleccionados.row(filaCancelada).data().precioOriginal) || 0;
    var enganche1 = parseFloat(tableArticulosSeleccionados.row(filaCancelada).data().enganche) || 0;

    // Restar la cantidad cancelada del total
    var totalActual = parseFloat($('.totalPago').text().replace('$', '')) || 0;
    var nuevoTotal = totalActual - (cantidadCancelada * precioOriginal);
    $('.totalPago').text('$' + nuevoTotal.toFixed(2));

    // Restar la cantidad cancelada del enganche si es aplicable
    if (tipoVentaSelected !== "1") {
        var engancheActual = parseFloat($('.totalEnganche').text().replace('$', '')) || 0;
        var nuevoEnganche = engancheActual - (cantidadCancelada * enganche1);
        $('.totalEnganche').text('$' + nuevoEnganche.toFixed(2));
    }



        var articuloId = $(this).data('articulo-id');
        tableArticulosSeleccionados.row($(this).closest('tr')).remove().draw();
        actualizarCamposOcultos(articuloId);
        
      
    });

    function actualizarPrecioYCantidad(articuloId, tipoVentaSeleccionado) {
    $.ajax({
        url: '/obtener-cantidad-tipo-venta/' + articuloId + '/' + tipoVentaSeleccionado,
        method: 'GET',
        success: function (data) {
       
                        // Asegúrate de obtener correctamente el artículoId
          // O cualquier otra forma de obtenerlo
        console.log("la fila"+numeroDeFila)
        
        // Encuentra la celda correspondiente a cantidadTipoVenta en la fila actual
        var cellCantidadTipoVenta = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 3 });
    
        // Cambia el contenido de la celda con el nuevo valor de cantidadTipoVenta
        cellCantidadTipoVenta.data(data.cantidadTipoVenta).draw();
        tableArticulosSeleccionados.row(numeroDeFila).data().precioOriginal = data.cantidadTipoVenta;
        actualizarCamposOcultos();
            // Calcular el total a pagar después de actualizar cantidad y precio
        calcularTotalAPagar();
                console.log(data.cantidadTipoVenta);
                console.log('Elemento buscado:', '.precio-' + articuloId);
           

            // Puedes llamar a calcularTotales() aquí si es necesario
        },
        error: function () {
            console.log('Error al obtener la cantidadTipoVenta');
        }
    });
}
function actualizarCamposOcultos() {
  // Limpiar campos ocultos existentes antes de agregar nuevos
  $('#formulario').find('input[name^="producto_id"]').remove();
  $('#formulario').find('input[name^="cantidadotas"]').remove();
  $('#formulario').find('input[name^="tipoVenta"]').remove();

  $('#articulos-lista tbody tr').each(function () {
    var articuloId = $(this).find("[id^=fkTipoVenta]").data("articulo-id");
    var cantidad = $(this).find("[id^=cantidad]").val() || 0;
    var tipoVenta =  $(this).find("[id^=fkTipoVenta]").val() || 0;
 
    // Agregar nuevos campos ocultos
    $('#formulario').append(
      "<input type='hidden' name='producto_id[]' value='" + articuloId + "'>",
      "<input type='hidden' name='cantidadotas[]' value='" + cantidad + "'>",
      "<input type='hidden' name='tipoVenta[]' value='" + tipoVenta + "'>"
    );
  });

  
}

$('#completar').click(function () {
  actualizarCamposOcultos();
  $('#formulario').submit();
});


});



 


 

////////////////FILTRO DE UBICACIONES ////////////////////////////////////////////



  //////////////////// FILTRO DE COLONIAS ///////////////////////////////////////////
  $('#fkMunicipio').on('change', function () {
            var municipioSeleccionado = $(this).val();
            obtenerColonias(municipioSeleccionado);
        });

        // Llamada inicial con la opción "Seleccionar colonia"
        obtenerColonias();

        function obtenerColonias(municipioSeleccionado) {
            var selectColonia = $('#fkColonia');
            selectColonia.empty(); // Limpia las opciones actuales

            // Agregar la opción "Seleccionar colonia" al inicio
            selectColonia.append('<option value="">Seleccionar colonia</option>');

            if (municipioSeleccionado) {
                // Realizar la petición AJAX para obtener las colonias
                $.get('/opcionesColoniasId?dato=' + municipioSeleccionado, function (colonias) {
                    actualizarSelectColonias(colonias);
                });
            } else {
                // Si no se seleccionó un municipio, reinicia el select de colonias
                actualizarSelectColonias([]);
            }
        }

        function actualizarSelectColonias(colonias) {
            var selectColonia = $('#fkColonia');

            if (colonias.length > 0) {
                $.each(colonias, function (index, colonia) {
                    selectColonia.append('<option value="' + colonia.pkColonia + '">' + colonia.nombreColonia + '</option>');
                });
            } else {
                // Si no hay colonias disponibles, mostrar un mensaje
                selectColonia.append('<option value="">No hay colonias disponibles en este municipio</option>');
            }
        }




</script>
    <style>
		/* estilos input de imagenes */
		input[type="file"]::file-selector-button {
			background: rgb(14 159 110);
		}
		input:hover[type="file"]::file-selector-button {
			background: rgb(49 196 141);
		}
        /* estilos checkbox */
        input[type=checkbox], [type=radio] {
            color: rgb(49 196 141) ;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: .25rem;
            border-color: rgb(209 213 219);
        }   
        input:focus[type=checkbox], [type=radio] {
            --tw-ring-opacity: 1;
            --tw-ring-color: rgb(49 196 141/var(--tw-ring-opacity));
        }
        [type="checkbox"]:checked {
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg viewBox='0 0 16 16' fill='%23fff' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='8' cy='8' r='3'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: .55em .55em;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        background-size: 1em 1em;
        }   
	 </style>
</body>












