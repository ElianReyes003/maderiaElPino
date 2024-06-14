<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
  <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
 
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

<div class="p-4 sm:ml-64 mt-16 md:mt-10">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div class="flex justify-center">
				<h1 class="text-center font-bold md:text-[2rem]">Lista de articulos</h1>
			</div>
			<div>
				<div class="flex ml-[3rem] items-center mt-10">
                    <form class="w-[13rem] md:w-[30rem]">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" name="busqueda" id="busqueda" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
                        </div>
                    </form>
                 </div>
			</div>
			<div class="mt-10 grid grid-cols-2 gap-4 mb-5">
     
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
          <option value="2">Por Agotarse</option>
          <option value="3">No Disponible</option>
				</select>
                <div class="flex mt-3">
                        <button  type="button"id="limpiarFiltros"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                                Limpiar filtros
                        </button>
                    </div>
			</div>
		   </div>
           
		   <div class="bg-white rounded-lg shadow-lg mt-10">

			<div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5">

            @if(session('fkTipoUsuario')==1)
				<div>
					<a href="{{ route('articleAgg') }}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
						<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10ZM12 7a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H8a1 1 0 1 1 0-2h3V8a1 1 0 0 1 1-1Z" fill="rgb(255 255 255)"/></svg>
						<span class="flex-1 ms-3 whitespace-nowrap">Agregar Articulo</span>
					 </a>	
				</div>
                 <div>
					<a href="/categoriaArticuloVision" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
						<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10ZM12 7a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H8a1 1 0 1 1 0-2h3V8a1 1 0 0 1 1-1Z" fill="rgb(255 255 255)"/></svg>
						<span class="flex-1 ms-3 whitespace-nowrap">Agregar Categoria Articulo</span>
					 </a>	
				</div>
                 <div>
					<a href="/movimientosVision" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
						<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10ZM12 7a1 1 0 0 1 1 1v3h3a1 1 0 1 1 0 2h-3v3a1 1 0 1 1-2 0v-3H8a1 1 0 1 1 0-2h3V8a1 1 0 0 1 1-1Z" fill="rgb(255 255 255)"/></svg>
						<span class="flex-1 ms-3 whitespace-nowrap">Lista de movimientos Inventario</span>
					 </a>	
				</div>
                @endif

            </div>
     
			<table class="w-full table-auto mt-[1rem]" id="tablaArticulos"  class=" tablaArticulos display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
             
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Estatus</th>
                <th>Seleccionar</th>
            
					</tr>
					<tbody>
          @foreach ($datosArticulos as $dato )   
						<tr class="h-20">
          
                        <th>{{$dato->nombreArticulo}}</th>
                        <th id="Categoria" class="Categoria">{{$dato->nombreCategoriaArticulo}}</th>
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

							<td class="items-center flex justify-center">
								<a href="{{ route('articulo.detalle', ['pkArticulo' => $dato->pkArticulo]) }}" class="flex w-11 h-11 items-center mt-2 bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
									<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 4.6A2.6 2.6 0 0 1 2.6 2h18.8A2.6 2.6 0 0 1 24 4.6v.8A2.6 2.6 0 0 1 21.4 8H21v10.6c0 1.33-1.07 2.4-2.4 2.4H5.4C4.07 21 3 19.93 3 18.6V8h-.4A2.6 2.6 0 0 1 0 5.4v-.8ZM2.6 4a.6.6 0 0 0-.6.6v.8a.6.6 0 0 0 .6.6h18.8a.6.6 0 0 0 .6-.6v-.8a.6.6 0 0 0-.6-.6H2.6ZM8 10a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z" fill="rgb(255 255 255)"/></svg>
								 </a>
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
							<button id="previousBtn" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button   id="nextBtn"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Siguiente
							</button>
						  </div>
					</div>
				</div>
			</div>
        </div>
     </div>

   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
   <script  src="https://cdn.datatables.net/plug-ins/1.13.7/api/fnMultiFilter.js"></script>
    <script>


$(document).ready(function() {
        var tableArticulos = $('#tablaArticulos').DataTable({
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
    });
     // Agrega evento de clic al botón Previous
     $('#previousBtn').on('click', function(e) {
      e.preventDefault();
      tableArticulos.page('previous').draw(false);
    });

    // Agrega evento de clic al botón Next
    $('#nextBtn').on('click', function(e) {
      e.preventDefault();
      tableArticulos.page('next').draw(false);
    });

   

    $('#fkEstatus, #fkCategoria').change(function () {
    var estatus = $('#fkEstatus').val();
    if (estatus === '1') {
        estatus = 'Disponible';
    } else if (estatus === '2') {
        estatus = 'Por Agotarse';
    }
    else if (estatus === '3') {
        estatus = 'No Disponible';
    }

    var categoria = $('#fkCategoria').val();
    tableArticulos.column(1).search(categoria).draw();
    // Buscar en la columna 2 (índice 1) y hacer la búsqueda insensible a mayúsculas y minúsculas
    tableArticulos.column(3).search(estatus).draw(); // No necesitas insensibilidad a mayúsculas y minúsculas para el estatus
});

    $('#busqueda').on('keyup', function (e) {
        var filtroBusqueda = $('#busqueda').val();
        tableArticulos.search(filtroBusqueda).draw();
    });

    $('#limpiarFiltros').on('click', function () {
        $('#fkEstatus, #fkCategoria').val('');
        tableArticulos.search('').columns().search('').draw();
    });
  });

    </script>
</body>
</html>