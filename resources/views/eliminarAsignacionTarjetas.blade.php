<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    @if(session('fkTipoUsuario')==1)
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
<h2>{{$datosUsuario->nombreEmpleado}}</h2>


<div class="p-4 sm:ml-64 mt-16 md:mt-10">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div class="flex justify-center">
				<h1 class="text-center font-bold text-2xl">Lista de clientes</h1>
			</div>
            <form  id="formulario"  action="/deinsercionOrden" enctype="multipart/form-data"  method="post" >
            @csrf
         @php
            use App\Models\tipoVenta;
                $datosTipoVenta = tipoventa::all();
            @endphp
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
			</div>
            <div class="flex mt-5">
                <button  type="button"id="limpiarFiltros2" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">Limpiar filtros</button>
            </div>
            <table class="w-full table-auto mt-[1rem]" name="tablaClientes" id="tablaClientes"  class="tablaClientes" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
					<th class="oculto">id</th>
                    <th>Nombre</th>
                    <th>Municipio</th>
                    <th>Colonia</th>
                    <th>Calle</th>
                    <th>Articulo</th>
                    <th>Asignar</th>
					</tr>
					<tbody>
                    @foreach ($compras as $dato )    
						<tr class="h-20">
                            <td class="oculto">{{$dato->pkcomprasCliente}}</td>
                            <td>{{$dato->nombreCliente}}</td>
                            <td>{{$dato->nombreMunicipio}}</td>
                            <td>{{$dato->nombreColonia}}</td>
                            <td>{{$dato->nombreCalle}}</td>
                            <td>{{$dato->nombreArticulo}}</td>
                            <td class="items-center flex mt-3 justify-center">									
								<div class="flex mt-2 md:mt-5">
                                    <input type="checkbox" name="cliente-seleccionado" class="seleccionar-cliente" data-cliente-id="{{$dato->pkcomprasCliente}}">
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
     </div>

     <div class="p-4 sm:ml-64">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div class="flex justify-center">
				<h1 class="text-center font-bold text-2xl">Lista de clientes designados</h1>
			</div>
            <table class="w-full table-auto mt-[1rem]" class="clientes-lista" id="clientesLista" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Municipio</th>
                        <th>Colonia</th>
                        <th>Calle</th>
                        <th>Articulo</th>
                        <th>Cancelar</th>
					</tr>
                    <tbody id="contenidoClientesSeleccionados-body"></tbody>
					</thead>
				</table>
                <div class="flex justify-center	mt-16">
					<div class="md:p-10 p-5">
						  <div class="flex">
							<!-- Previous Button -->
                            <button id="previousBtn2"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button id="nextBtn2"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Siguiente
							</button>
						  </div>
					</div>
				</div>
			</div>
		   </div>
        </div>
     </div>
     <input type="hidden" name="filasSeleccionadas[]" id="filasSeleccionadas" value="">
    <input type="hidden" name="fkEmpleado" id="fkEmpleado" value="{{$datosUsuario->pkEmpleado}}">

     <div class="flex p-4 sm:ml-64 justify-center">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="flex justify-center">
                <div class="md:p-10 p-5 mt-5">
                      <div class="flex">
                        <!-- Previous Button -->
                        <a href="#" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                          Cancelar
                        </a>
                        <!-- Next Button -->
                        <button type="submit" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                          Aceptar
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
    // Mueve el script de DataTables aquí o a otro bloque que se ejecute después de que la tabla esté cargada
    $(document).ready(function () {
        // Configuración de DataTables en la tabla principal
        var tableClientes = $('#tablaClientes').DataTable({
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
            // ... Configuración adicional según tus necesidades ...
        });

        $('#fkMunicipio, #fkColonia, #fkCalle').change(function () {
            var municipio = $('#fkMunicipio').val();
            var colonia = $('#fkColonia').val();
            var calle = $('#fkCalle').val();

            tableClientes.column(2).search(municipio).draw(); // Filtro para Municipio
            tableClientes.column(3).search(colonia).draw(); // Filtro para Colonia
            tableClientes.column(4).search(calle).draw(); // Filtro para Calle
        });
        $('#previousBtn').on('click', function(e) {
      e.preventDefault();
      tableClientes.page('previous').draw(false);
    });

    // Agrega evento de clic al botón Next
    $('#nextBtn').on('click', function(e) {
      e.preventDefault();
      tableClientes.page('next').draw(false);
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
                "emptyTable": "No hay datos disponibles en la tabla",
            },
        });

        $('#previousBtn2').on('click', function(e) {
            e.preventDefault();
            tableClientesSeleccionados.page('previous').draw(false);
        });

        // Agrega evento de clic al botón Next
        $('#nextBtn2').on('click', function(e) {
            e.preventDefault();
            tableClientesSeleccionados.page('next').draw(false);
        });

// ... Tu código JavaScript anterior ...

            $('#tablaClientes tbody').on('click', 'tr', function () {
                var checkbox = $(this).find('.seleccionar-cliente');

                // Cambiar el estado de la casilla de verificación al hacer clic en la fila
                checkbox.prop('checked', !checkbox.prop('checked'));

                // Añadir la fila seleccionada a la tabla secundaria
                var data = tableClientes.row(this).data();
                tableClientesSeleccionados.row.add([
                    data[0],
                    data[1],
                    data[2],
                    data[3],
                    data[4],
                    data[5],
                    ` 
                    <button class="cancelar-cliente flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400" data-cliente-id="${data[5]}">Cancelar</button>
                    
                    `
                ]).draw();

                // Actualizar campos ocultos con la información de las filas seleccionadas
                actualizarCamposOcultos();
            });

            $('#clientesLista tbody').on('click', 'button.cancelar-cliente', function () {
        var clienteId = $(this).data('cliente-id');
        // Obtener el valor de la columna 0 (ID) de la fila actual
        var clienteListaId = tableClientesSeleccionados.row($(this).closest('tr')).data()[0];

        // Eliminar la fila correspondiente de la tabla secundaria
        tableClientesSeleccionados.row($(this).closest('tr')).remove().draw();
        
        // Actualizar campos ocultos con la información de las filas seleccionadas
        actualizarCamposOcultos(clienteListaId);
    });

    function actualizarCamposOcultos(clienteListaId) {
        var filasSeleccionadas = tableClientesSeleccionados.rows().data().toArray();
        var datosActualizados = [];

        $.each(filasSeleccionadas, function(index, fila) {
            var clienteId = $(fila[5]).find('.seleccionar-cliente').data('cliente-id'); // Obtener clienteId del checkbox

            // Añadir el valor de la columna 0 (ID) al array
            datosActualizados.push({
                id: fila[0],
                nombre: fila[1],
                municipio: fila[2],
                colonia: fila[3],
                calle: fila[4],
                articulo: fila[5]
            });
        });

        $('#filasSeleccionadas').val(JSON.stringify(datosActualizados));
    }

            // ... Tu código JavaScript anterior ...

            $('#fkMunicipio, #fkColonia, #fkCalle').change(function () {
            var municipio = $('#fkMunicipio').val();
            var colonia = $('#fkColonia').val();
            var calle = $('#fkCalle').val();

            tableClientes.column(2).search(municipio).draw(); // Filtro para Municipio
            tableClientes.column(3).search(colonia).draw(); // Filtro para Colonia
            tableClientes.column(4).search(calle).draw(); // Filtro para Calle
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


////////////////////////////FILTRO DE CLIENTES EN TIEMPO REAL ////////////////////////////////////////////


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