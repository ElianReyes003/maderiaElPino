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
                <th>Cantidad</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Estatus</th>
                <th>Seleccionar</th>
            
					</tr>
					<tbody>
          @foreach ($datosArticulos as $dato )   
						<tr class="h-20">
          
                        <th>{{$dato->nombreArticulo}}</th>
                        <th>{{$dato->cantidadActual}}</th>
                        <th id="Categoria" class="Categoria">{{$dato->nombreCategoriaArticulo}}</th>
                        <th>{{$dato->cantidadTipoVenta}}</th>
                        <th>
                            @if($dato->ESTATUSARTICULO == 1)
                            <span class="inline-flex items-center justify-center px-2 text-sm font-medium text-gray-800 bg-green-400 rounded-md">Disponible
                                <svg class="flex-shrink-0 w-7 text-white ml-2 h-7 transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM16.0303 8.96967C16.3232 9.26256 16.3232 9.73744 16.0303 10.0303L11.0303 15.0303C10.7374 15.3232 10.2626 15.3232 9.96967 15.0303L7.96967 13.0303C7.67678 12.7374 7.67678 12.2626 7.96967 11.9697C8.26256 11.6768 8.73744 11.6768 9.03033 11.9697L10.5 13.4393L14.9697 8.96967C15.2626 8.67678 15.7374 8.67678 16.0303 8.96967Z" fill="currentColor"/>
                                </svg>
                            </span>
                            @elseif($dato->ESTATUSARTICULO == 2)
                            <span class="inline-flex items-center justify-center px-2 text-sm font-medium text-gray-800 bg-yellow-400 rounded-md">Por agotarse
                                <svg class="flex-shrink-0 w-7 text-white ml-2 h-7 transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 7.28595 22 4.92893 20.5355 3.46447C19.0711 2 16.714 2 12 2ZM12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V7C11.25 6.58579 11.5858 6.25 12 6.25ZM12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="currentColor"/>
                                </svg>  
                            </span>
                            @elseif($dato->ESTATUSARTICULO == 0)
                            <span class="inline-flex items-center justify-center px-2 text-sm font-medium text-gray-800 bg-red-400 rounded-md">Agotado
                                <svg class="flex-shrink-0 w-7 text-white ml-2 h-7 transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM8.96965 8.96967C9.26254 8.67678 9.73742 8.67678 10.0303 8.96967L12 10.9394L13.9696 8.96969C14.2625 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0303L13.0606 12L15.0303 13.9697C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0303 15.0303C9.73744 15.3232 9.26256 15.3232 8.96967 15.0303C8.67678 14.7374 8.67678 14.2626 8.96967 13.9697L10.9393 12L8.96965 10.0303C8.67676 9.73744 8.67676 9.26256 8.96965 8.96967Z" fill="currentColor"/>
                                </svg>                  
                            </span>
                            @else
                            <span class="inline-flex items-center justify-center px-2 text-sm font-medium text-gray-800 bg-slate-900 rounded-md">Estado desconocido
                                <svg class="flex-shrink-0 w-7 text-white ml-2 h-7 transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM12 7.75C11.3787 7.75 10.875 8.25368 10.875 8.875C10.875 9.28921 10.5392 9.625 10.125 9.625C9.71079 9.625 9.375 9.28921 9.375 8.875C9.375 7.42525 10.5503 6.25 12 6.25C13.4497 6.25 14.625 7.42525 14.625 8.875C14.625 9.58584 14.3415 10.232 13.883 10.704C13.7907 10.7989 13.7027 10.8869 13.6187 10.9708C13.4029 11.1864 13.2138 11.3753 13.0479 11.5885C12.8289 11.8699 12.75 12.0768 12.75 12.25V13C12.75 13.4142 12.4142 13.75 12 13.75C11.5858 13.75 11.25 13.4142 11.25 13V12.25C11.25 11.5948 11.555 11.0644 11.8642 10.6672C12.0929 10.3733 12.3804 10.0863 12.6138 9.85346C12.6842 9.78321 12.7496 9.71789 12.807 9.65877C13.0046 9.45543 13.125 9.18004 13.125 8.875C13.125 8.25368 12.6213 7.75 12 7.75ZM12 17C12.5523 17 13 16.5523 13 16C13 15.4477 12.5523 15 12 15C11.4477 15 11 15.4477 11 16C11 16.5523 11.4477 17 12 17Z" fill="currentColor"/>
                                </svg>
                            </span>
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