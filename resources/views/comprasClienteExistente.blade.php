<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
    <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- Incluir List.js y su extensión List.pagination.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>
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
<form  id="formulario"  action="{{ route('compraCExistente.insertar') }}" enctype="multipart/form-data"  method="post" >
@csrf
    @php
        use App\Models\tipoVenta;
        $datosTipoVenta = tipoventa::all();
    @endphp
<div class="p-4 sm:ml-64 mt-16 md:mt-10">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div class="flex justify-center">
				<h1 class="text-center font-bold text-2xl">Lista de clientes</h1>
			</div>
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
                            <input type="search"  id="searchTermCliente" name="searchTermCliente" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" >
                        </div>
                    </form>
                 </div>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10">
                    <label for="underline_select" class="sr-only">Underline select</label>
                    <select name="fkMunicipio" id="fkMunicipio" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">

                  
                            @php
                                use App\Models\Municipio;
                                $datosMunicipio=Municipio::where('estatus', 1)->get();
                            @endphp
                            <option value="">Selecciona Municipio</option>
                            @foreach ($datosMunicipio as $dato)
                                <option value="{{$dato->pkMunicipio}}">{{$dato->nombreMunicipio}}</option>
                            @endforeach
         
                    </select>
                    <label for="underline_select" class="sr-only">Seleccionar Colonia</label>
                    <select name="fkColonia" id="fkColonia" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                        <option value=""></option>
                    </select> 
                 </div>
                 <div class="flex mt-5">
                    <button  type="button"id="limpiarFiltros" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">Limpiar filtros</button>
                 </div>
			</div>
		   </div>
		   <div class="bg-white rounded-lg shadow-lg mt-10">
			<div class="flex justify-center mb-[1rem]">
			</div>
			<table id="clientes" class="w-full table-auto mt-[1rem]" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
                    <th>Nombre</th>
                    <th>Municipio</th>
                    <th>Colonia</th>
                    <th>Calle</th>
                    <th>Seleccionar</th>
					</tr>
					<tbody id="resultadosBusquedaCliente" class="resultadosBusqueda">
						
					</tbody>
					</thead>
				</table>
				<div class="flex justify-center	mt-16">
					<div class="md:p-10 p-5">
						  <div class="flex">
							<!-- Previous Button -->
							<button type="button" id="previousBtn"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button  type="button" id="nextBtn"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
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
                    <div class="flex mt-5">
                        <button  type="button"id="limpiarFiltros2" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">Limpiar filtros</button>
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
			<table class="w-full table-auto mt-[1rem]"  id="tablaArticulos" c class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
                        <td class="oculto">ID</td>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Estatus</th>
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
							<td class="items-center flex mt-3 justify-center">									
								<div class="flex mt-2 md:mt-5">
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
                            <button type="button" id="previousBtn2"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button type="button" id="nextBtn2"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
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
                        <button type="button" id="previousBtn3"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button type="button" id="nextBtn3"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
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
        <input type="hidden" name="cliente" id="cliente" value="">

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
   
    // Función para calcular el precio total
    function calcularPrecioTotal(cantidad) {
        return cantidad * precioOriginal;
    }
  
   

    var fila=0;
    var numeroDeFila=0;
    var precioOriginal=0;
    var tipoVentaSelected = 0;
   
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
        var tipoVenta = $(this).find("[id^=fkTipoVenta]").val();

        total += isNaN(cantidad) ? 0 : cantidad * precioOriginal;

        if (tipoVenta === "1") {
            // Si el tipo de venta es 1, el enganche es 0
            enganche += 0;
        } else {
            // De lo contrario, calcula el 10% del precio original como enganche
            enganche += isNaN(cantidad) ? 0 : cantidad * (precioOriginal * 0.10);
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
    $('#limpiarFiltros2').on('click', function () {
        $('#fkEstatus, #fkCategoria').val('');
        tableArticulos.search('').columns().search('').draw();
    });
     // Agrega evento de clic al botón Previous
     $('#previousBtn2').on('click', function(e) {
        e.preventDefault();
        tableArticulos.page('previous').draw(false);
        });

        // Agrega evento de clic al botón Next
        $('#nextBtn2').on('click', function(e) {
        e.preventDefault();
        tableArticulos.page('next').draw(false);
        });
    var tableArticulosSeleccionados = $('#articulos-lista').DataTable({
        responsive: true,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
        },
    });
    $('#previousBtn3').on('click', function(e) {
        e.preventDefault();
        tableArticulosSeleccionados.page('previous').draw(false);
        });

        // Agrega evento de clic al botón Next
        $('#nextBtn3').on('click', function(e) {
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

    
    $('#tablaArticulos tbody').on('click', 'tr', function () {
        var checkbox = $(this).find('.seleccionar-articulo');
        checkbox.prop('checked', !checkbox.prop('checked'));

        var data = tableArticulos.row(this).data();
        var articuloId = data[0];
         
 
   // Move this line above to define precioCell before using it

   var row =tableArticulosSeleccionados.row.add([
            data[0],
            data[1],
            data[2], 
            data[3],
            `<td><input type="number" class="cantidad${articuloId} bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" id="cantidad${articuloId}" name="cantidades[]" value="1" min="1"></td>`,
            `<td> <select  data-articulo-id="${articuloId}" id="fkTipoVenta' + articuloId + '" name="fkTipoVenta" class="p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" required> <?php foreach ($datosTipoVenta as $opcion): ?>
            newRow += '<option value="<?= $opcion->pkTipoVenta ?>"><?= $opcion->nombreTipoVenta ?></option>';
          <?php endforeach; ?>
>
newRow += '</select></td>`,
            `<button class="cancelar-articulo flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400" data-articulo-id="${articuloId}">Cancelar</button>`

        ]).draw();
    
        actualizarCamposOcultos();
            // Guardar precio original en la estructura de DataTable
        var rowData = row.data();
        rowData.precioOriginal = data[3];
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
    tipoVentaSelected=$(this).val();
    var articuloId = $(this).data('articulo-id');
   
    var fila = $(this).closest('tr');
    // Obtener referencia al input número
    var inputCantidad = $('#cantidad' + articuloId); 

    // Asignar valor 1
    inputCantidad.val(1);

        // Obtiene el número de fila
        numeroDeFila = tableArticulosSeleccionados.row(fila).index();

        console.log("Número de fila: " + numeroDeFila);
        
    actualizarPrecioYCantidad(articuloId, tipoVentaSeleccionado);
    calcularTotalAPagar();
    actualizarCamposOcultos();
});
    $('#articulos-lista tbody').on('click', 'button.cancelar-articulo', function () {
        
        var filaCancelada = $(this).closest('tr');
    var cantidadCancelada = parseFloat(filaCancelada.find('[id^="cantidad"]').val()) || 0;
    var precioOriginal = parseFloat(tableArticulosSeleccionados.row(filaCancelada).data().precioOriginal) || 0;

    // Restar la cantidad cancelada del total
    var totalActual = parseFloat($('.totalPago').text().replace('$', '')) || 0;
    var nuevoTotal = totalActual - (cantidadCancelada * precioOriginal);
    $('.totalPago').text('$' + nuevoTotal.toFixed(2));

    // Restar la cantidad cancelada del enganche si es aplicable
    if (tipoVentaSelected !== "1") {
        var engancheActual = parseFloat($('.totalEnganche').text().replace('$', '')) || 0;
        var nuevoEnganche = engancheActual - (cantidadCancelada * (precioOriginal * 0.10));
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
var clienteSeleccionadoGlobal = null;

function actualizarCamposOcultos() {
    // Elimina el campo oculto #cliente existente
    $('#formulario').find('input[name="cliente[]"]').remove();

    // Limpia campos ocultos existentes antes de agregar nuevos
    $('#formulario').find('input[name^="producto_id"]').remove();
    $('#formulario').find('input[name^="cantidadotas"]').remove();
    $('#formulario').find('input[name^="tipoVenta"]').remove();

    // Agrega los nuevos campos ocultos
    $('#articulos-lista tbody tr').each(function () {
        var articuloId = $(this).find("[id^=fkTipoVenta]").data("articulo-id");
        var cantidad = $(this).find("[id^=cantidad]").val() || 0;
        var tipoVenta =  $(this).find("[id^=fkTipoVenta]").val() || 0;

        // Agrega nuevos campos ocultos al formulario
        $('#formulario').append(
            "<input type='hidden' name='producto_id[]' value='" + articuloId + "'>",
            "<input type='hidden' name='cantidadotas[]' value='" + cantidad + "'>",
            "<input type='hidden' name='tipoVenta[]' value='" + tipoVenta + "'>",
            "<input type='hidden' name='cliente[]' value='" + clienteSeleccionadoGlobal + "'>"
        );
    });
}

$('#completar').click(function () {
    // Obtiene el cliente seleccionado
    clienteSeleccionadoGlobal = $('input[name="cliente-seleccionado"]:checked').data('cliente-id');
    console.log("cliente seleccionado pk: " + clienteSeleccionadoGlobal);

    // Asigna el valor del cliente al campo oculto #cliente
    console.log('el valor enviado:'+ clienteSeleccionadoGlobal);
    actualizarCamposOcultos();

    // Envía el formulario
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


////////////////////////////FILTRO DE CLIENTES EN TIEMPO REAL ////////////////////////////////////////////
$(document).ready(function () {
    // Inicializar DataTables al cargar la página
    var dataTable = $('#clientes').DataTable({
        "responsive":true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "pageLength": 10, 
        "autoWidth": true
    });
    $('#limpiarFiltros').on('click', function () {
            $('#fkMunicipio, #fkColonia, #fkCalle').val('');
            dataTable.search('').columns().search('').draw();
        });
      

      // Agrega evento de clic al botón Previous
      $('#previousBtn').on('click', function(e) {
        e.preventDefault();
        dataTable.page('previous').draw(false);
        });

        // Agrega evento de clic al botón Next
        $('#nextBtn').on('click', function(e) {
        e.preventDefault();
        dataTable.page('next').draw(false);
        });
    // Variable para almacenar la solicitud Ajax actual
    var currentAjaxRequest = null;

    $('#searchTermCliente').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });

    // Función para cargar datos iniciales y mostrar resultados
    function cargarDatosYMostrarResultadosCliente(searchTermCliente = null, fkMunicipio = null, fkColonia = null, fkCalle = null) {
        // Cancelar la solicitud Ajax actual si existe
        if (currentAjaxRequest) {
            currentAjaxRequest.abort();
        }

        var url = '{{ route("buscarCliente") }}';

        // Si se proporciona un término de búsqueda, ajustar la URL
        if (searchTermCliente) {
            url += '?searchTermCliente=' + searchTermCliente;
            console.log(url);
        }

        // Agregar los valores de los select como parámetros adicionales
        if (fkMunicipio) {
            url += (searchTermCliente ? '&' : '?') + 'fkMunicipio=' + fkMunicipio;
        }

                    if (fkColonia) {
            url += '&fkColonia=' + fkColonia;
            }

            // calle
            if (fkCalle) {
            url += '&fkCalle=' + fkCalle;
            }

        console.log(url);
        // Realizar la nueva solicitud Ajax
        currentAjaxRequest = $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                // Limpiar resultados anteriores
                console.log(fkColonia, fkCalle);
                dataTable.clear().draw();

                // Agregar nuevos resultados
                data.forEach(function (dato) {
                    var resultadoHtml = `
                        <tr>
                            <td>${dato.nombreCliente}</td>
                            <td>${dato.nombreMunicipio}</td>
                            <td>${dato.nombreColonia}</td>
                            <td>${dato.calle}</td>
                            <div>
                            <td>
                                <div class="flex md:justify-center mt-5 md:mt-0">
                                    <input type="radio" class="w-6 h-6 rounded text-green-400 bg-gray-100 border-gray-300 focus:ring-green-400 focus:ring-2" name="cliente-seleccionado" class="seleccionar-cliente" data-cliente-id="${dato.pkCliente}"></td>
                                </div>
                        </tr>`;

                    resultadoHtml = resultadoHtml.replace(/:pkCliente/g, dato.pkCliente);
                    dataTable.row.add($(resultadoHtml)[0]).draw();
                });
            },
            error: function (error) {
                console.log('Error:', error.responseText);
            }
        });
    }

    // Cargar datos iniciales al iniciar la página
    cargarDatosYMostrarResultadosCliente();

    $('#searchTermCliente').on('input', function () {
        var searchTermCliente = $(this).val();
        var fkMunicipio = $('#fkMunicipio').val();
        var fkColonia = $('#fkColonia').val();
        var fkCalle = $('#fkCalle').val();
        cargarDatosYMostrarResultadosCliente(searchTermCliente, fkMunicipio, fkColonia, fkCalle);
    });
  
    // Manejar cambios en los select
    $('#fkMunicipio, #fkColonia, #fkCalle').on('change', function () {
        var searchTermCliente = $('#searchTermCliente').val();
        var fkMunicipio = $('#fkMunicipio').val();
        var fkColonia = $('#fkColonia').val();
        var fkCalle = $('#fkCalle').val();
        cargarDatosYMostrarResultadosCliente(searchTermCliente, fkMunicipio, fkColonia, fkCalle);
    });
});

</script>
<style>
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