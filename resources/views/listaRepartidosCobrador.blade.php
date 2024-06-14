<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <title>Maderas El Pino</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    
    <style>
        div.container { 
            max-width: 1200px;
        }
        .dataTables_wrapper .dataTables_filter {
            display: none;
        }
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 5px;
            background-color: transparent;
            color: inherit;
            padding: 4px;
            width: 60px;
            margin-bottom: 20px;
        }
       
        .seleccionar-cliente:checked {
    outline: 2px solid #007bff; /* Cambia el color del contorno para resaltar */
    background-color: #e6f7ff; /* Cambia el color de fondo para resaltar */
}
.oculto {
            display: none;
        }
    </style>
</head>
<body>
@if(session('id'))
    @if(session('fkTipoUsuario')==1||session('fkTipoUsuario')==2)
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
</div>
<div class="p-4 sm:ml-64 mt-16 md:mt-10">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
           <div class="mt-5">
        <div class="flex justify-center">
            <h2 class="font-semibold text-2xl text-center">{{$datosUsuario->nombreEmpleado}}</h2>
        </div>
        <div class="flex justify-between mt-10 p-5">         
            <a href="{{ route('cobrador.Tarjetas', ['pkEmpleado' => $datosUsuario->pkEmpleado, 'vista' => 'seleccionarOrdenTarjetas']) }}" class="baja-usuario mt-4 flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400" data-pkCompra="">
                ordena la reparticion
            </a>
                @if(session('fkTipoUsuario') == 1 )
            <a href="{{ route('cobrador.FormAbono', ['pkEmpleado' => $datosUsuario->pkEmpleado, 'vista' => 'eliminarAsignacionTarjetas']) }}" class="baja-usuario mt-4 flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400" data-pkCompra="">
                quitar tarjetas
            </a>
        </div>
        @endif
    </div>
			<div class="flex justify-center">
				<h1 class="text-center font-bold text-2xl">Lista para abono</h1>
			</div>
            <div>
				<div class="flex justify-center md:justify-normal items-center mt-10">
                    <div class="w-[13rem] md:w-[30rem]">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="busqueda" name="busqueda"  class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" >
                        </div>
                    </div>
                 </div>
			</div>
            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <label for="underline_select" class="sr-only">Underline select</label>
				<select name="fkMunicipio" id="fkMunicipio" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                @php
                        use App\Models\Municipio;
                        $datosMunicipio=Municipio::all();
                    @endphp
                    <option value="">Selecciona Municipio</option>
                    @foreach ($datosMunicipio as $dato)
                        <option value="{{$dato->nombreMunicipio}}">{{$dato->nombreMunicipio}}</option>
                    @endforeach
					
				</select>
                <label for="underline_select" class="sr-only">Colonia</label>
				<select name="fkColonia" id="fkColonia" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                    <option value=""></option>
				</select>
				<div class="flex mt-3">
                    <button  type="button"id="limpiarFiltros"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                            Limpiar filtros
                    </button>
                </div>
			</div>
            <table class="w-full table-auto mt-[1rem]" id="tablaClientes" class="display nowrap" width="90%">
				<thead>
					<tr class="h-24 ">
                        <th>Orden de reparto</th>
                        <th class="oculto">id</th>
                        <th>Folio</th>
                        <th>Nombre</th>
                        <th>Municipio</th>
                        <th>Colonia</th>
                        <th>Calle</th>
                        <th>Articulo</th>
                        <th>Abonar</th>
					</tr>
					<tbody>
                    @foreach ($compras as $dato)
                    <tr class="h-20">
                        <td>{{$dato->ordenReparto}}</td>
                        <td class="oculto">{{$dato->pkcomprasCliente}}</td>
                        <th>{{$dato->folioCompra}}</th>
                        <th>{{$dato->nombreCliente}}</th>
                        <th>{{$dato->nombreMunicipio}}</th>
                        <th>{{$dato->nombreColonia}}</th>
                        <th>{{ $dato->calle . ' ' . $dato->numCasa }}</th>
                        <th>{{$dato->nombreArticulo}}</th>
                        <th>
                            <div class="flex mt-3 md:mt-0">
                                <a class="w-full flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400" href="{{ route('cliente.abonos', ['pkCompra' => $dato->pkcomprasCliente, 'vista' => 'formularioAbono']) }}">
                                    <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" fill="currentColor" width="800px" height="800px" viewBox="-2 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg"><path d="M13.112 7.798a1.112 1.112 0 0 1 1.108 1.108v.674a1.112 1.112 0 0 1-1.108 1.108h-.52a4.657 4.657 0 0 1-1.134 1.848q-.118.117-.243.226v1.966a.476.476 0 0 1-.475.475H9.281a.476.476 0 0 1-.475-.475v-.873a4.664 4.664 0 0 1-.64.044H6.212a4.664 4.664 0 0 1-.641-.044v.873a.476.476 0 0 1-.475.475H3.637a.476.476 0 0 1-.475-.475v-1.966q-.125-.109-.243-.226a4.656 4.656 0 0 1-1.275-2.39.904.904 0 0 1 0-1.806 4.656 4.656 0 0 1 4.568-3.754h1.954a4.653 4.653 0 0 1 .939.096l2.545-1.481a.253.253 0 0 1 .378.25.256.256 0 0 1-.027.087 4.345 4.345 0 0 0-.47 2.486 4.657 4.657 0 0 1 1.061 1.774h.52zM9.037 5.876a.475.475 0 0 0-.475-.475H5.984a.475.475 0 1 0 0 .95h2.578a.475.475 0 0 0 .475-.475zm-.248 5.141a1.142 1.142 0 0 0-.283-.75 1.533 1.533 0 0 0-.426-.34 1.792 1.792 0 0 0-.441-.16 1.924 1.924 0 0 0-.405-.041 1.475 1.475 0 0 1-.245-.02.936.936 0 0 1-.256-.082.606.606 0 0 1-.193-.155.385.385 0 0 1-.091-.232.392.392 0 0 1 .22-.329 1.114 1.114 0 0 1 .571-.153 1.168 1.168 0 0 1 .203.033l.024.006a1.28 1.28 0 0 1 .244.085.683.683 0 0 1 .198.136.396.396 0 1 0 .56-.561 1.477 1.477 0 0 0-.433-.297 2.035 2.035 0 0 0-.4-.137l-.011-.002v-.3a.396.396 0 0 0-.792 0v.288a1.813 1.813 0 0 0-.588.233 1.182 1.182 0 0 0-.588.998 1.166 1.166 0 0 0 .268.731 1.388 1.388 0 0 0 .454.364 1.71 1.71 0 0 0 .48.156 2.262 2.262 0 0 0 .375.03 1.128 1.128 0 0 1 .237.023.975.975 0 0 1 .24.087.746.746 0 0 1 .2.16.355.355 0 0 1 .086.229c0 .051 0 .17-.2.3a1.128 1.128 0 0 1-.585.163 1.832 1.832 0 0 1-.254-.031 1.24 1.24 0 0 1-.237-.076.497.497 0 0 1-.186-.143.396.396 0 0 0-.599.518 1.276 1.276 0 0 0 .49.36 1.926 1.926 0 0 0 .396.12l.01.003v.295a.396.396 0 1 0 .793 0v-.3a1.827 1.827 0 0 0 .602-.244 1.125 1.125 0 0 0 .562-.965z"/></svg>
                                    <p class="flex-1 ms-3 whitespace-nowrap">Abonar</p>
                                </a>
                            </div>
                        </th>
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
     </div>




    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
 
    <script>
    $(document).ready(function () {
        // Configuración de DataTables en la tabla principal
        var tableClientes = $('#tablaClientes').DataTable({
            responsive: true,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            "order": [
                [0, 'asc'] // Ordenar por la primera columna (Orden de reparto) de forma ascendente
            ]
            // ... Configuración adicional según tus necesidades ...
        });

        // Agregar evento de clic al botón Previous
        $('#previousBtn').on('click', function(e) {
            e.preventDefault();
            tableClientes.page('previous').draw(false);
        });

        // Agregar evento de clic al botón Next
        $('#nextBtn').on('click', function(e) {
            e.preventDefault();
            tableClientes.page('next').draw(false);
        });

        // Filtrar por municipio, colonia y calle
        $('#fkMunicipio, #fkColonia').change(function () {
            var municipio = $('#fkMunicipio').val();
            var colonia = $('#fkColonia').val();
     

            tableClientes.column(4).search(municipio).draw(); // Filtro para Municipio
            tableClientes.column(5).search(colonia).draw(); // Filtro para Colonia
    // Filtro para Calle
        });

        $('#busqueda').on('keyup', function (e) {
            var filtroBusqueda = $('#busqueda').val();
            tableClientes.search(filtroBusqueda).draw();
        });

        // Limpiar los filtros al hacer clic en el botón "Limpiar Filtros"
        $('#limpiarFiltros').on('click', function () {
            $('#fkMunicipio, #fkColonia, #fkCalle').val('');
            tableClientes.search('').columns().search('').draw();
        });

        // Configuración de DataTables en la tabla secundaria
        var tableClientesSeleccionados = $('#clientesLista').DataTable({
            responsive: true,
            // ... Configuración adicional según tus necesidades ...
            "language": {
                "emptyTable": "No hay datos disponibles en la tabla"
            }
        });

        // Filtrar por municipio, colonia y calle en la tabla secundaria
        $('#fkMunicipio, #fkColonia, #fkCalle').change(function () {
            var municipio = $('#fkMunicipio').val();
            var colonia = $('#fkColonia').val();
            var calle = $('#fkCalle').val();

            tableClientesSeleccionados.column(2).search(municipio).draw(); // Filtro para Municipio
            tableClientesSeleccionados.column(3).search(colonia).draw(); // Filtro para Colonia
            tableClientesSeleccionados.column(4).search(calle).draw(); // Filtro para Calle
        });

        $('#busqueda').on('keyup', function (e) {
            var filtroBusqueda = $('#busqueda').val();
            tableClientesSeleccionados.search(filtroBusqueda).draw();
        });

        // Limpiar los filtros al hacer clic en el botón "Limpiar Filtros" en la tabla secundaria
        $('#limpiarFiltros').on('click', function () {
            $('#fkMunicipio, #fkColonia, #fkCalle').val('');
            tableClientesSeleccionados.search('').columns().search('').draw();
        });
    });
</script>


<script>


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
                $.get('/opcionesColoniasString?dato=' + municipioSeleccionado, function (colonias) {
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
                    selectColonia.append('<option value="' + colonia.nombreColonia + '">' + colonia.nombreColonia + '</option>');
                });
            } else {
                // Si no hay colonias disponibles, mostrar un mensaje
                selectColonia.append('<option value="">No hay colonias disponibles en este municipio</option>');
            }
        }



//////////////////// FILTRO DE CALLES///////////////////////////////////////////
  $('#fkColonia').on('change', function () {
    var coloniaSeleccionado = $(this).val();
    obtenerCalles(coloniaSeleccionado);
});

// Llamada inicial con la opción "Seleccionar colonia"
obtenerCalles();

function obtenerCalles(coloniaSeleccionado) {
    var selectCalle = $('#fkCalle');
    selectCalle.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar calle" al inicio
    selectCalle.append('<option value="">Seleccionar calle</option>');

    if (coloniaSeleccionado) {
        // Realizar la petición AJAX para obtener las calles
        $.get('/opcionesCallesString?dato=' + coloniaSeleccionado, function (calles) {
            actualizarSelectCalles(calles);
        });
    } else {
        // Si no se seleccionó una colonia, reinicia el select de calles
        actualizarSelectCalles([]);
    }
}

  

  

function actualizarSelectCalles(calles) {
    var selectCalles = $('#fkCalle');
    
    selectCalles.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar calle" al inicio
    selectCalles.append('<option value="">Seleccionar calle</option>');

    if (calles.length > 0) {
        $.each(calles, function (index, calle) {
            selectCalles.append('<option value="' + calle.nombreCalle + '">' + calle.nombreCalle + '</option>');
        });
    } else {
        // Si no hay calles disponibles, mostrar un mensaje
        selectCalles.append('<option value="">No hay calles disponibles en esta colonia</option>');
    }
}




</script>







</body>