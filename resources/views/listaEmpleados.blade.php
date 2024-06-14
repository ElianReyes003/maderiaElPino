<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
        <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <title>Maderas El Pino</title>
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

<div class="p-4 sm:ml-64 mt-16 md:mt-10">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div class="flex justify-center">
				<h1 class="text-center font-bold md:text-[2rem]">Lista de empleados</h1>
			</div>
			<div>
				<div class="flex ml-[3rem] items-center mt-10">
                    <form class="w-[13rem] md:w-[30rem]">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="busqueda"  name="busqueda" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
                        </div>
                    </form>
                 </div>
			</div>
		   </div>
		   <div class="bg-white rounded-lg shadow-lg mt-10">
			<div class="flex justify-center md:justify-end mb-[1rem]">
				<div class="flex mt-10 md:mr-10">
                <a href="{{ route('formEmpleado') }}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">

						    <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" fill="currentColor" height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 370.126 370.126" xml:space="preserve">
                                    <g>
                                        <path d="M142.046,176.296c48.594,0,88.128-39.542,88.128-88.146C230.174,39.544,190.64,0,142.046,0
                                            C93.445,0,53.904,39.544,53.904,88.149C53.904,136.754,93.445,176.296,142.046,176.296z"/>
                                        <path d="M285.366,257.497h-7.547c-0.158,0-0.336-0.069-0.453-0.144v-7.856c0-5.607-4.193-10-9.547-10h-1.28
                                            c-5.515,0-10.173,4.579-10.173,10l-0.003,8h-7.997c-5.421,0-10,4.658-10,10.173v1.28c0,5.354,4.393,9.547,10,9.547h7.856
                                            c0.074,0.117,0.144,0.295,0.144,0.453v7.547c0,5.421,4.658,10,10.173,10h1.28c5.353,0,9.547-4.393,9.547-10v-7.456
                                            c0.078-0.186,0.357-0.466,0.544-0.544h7.456c5.607,0,10-4.193,10-9.547v-1.28C295.366,262.155,290.787,257.497,285.366,257.497z"/>
                                        <path d="M267.211,185.921c-15.334,0-29.692,4.242-41.98,11.6c-0.191-0.006-0.382-0.023-0.573-0.023H59.419
                                            c-10.711,0-20.73,8.256-22.811,18.797l-15.229,77.209c-1.97,9.978,2.857,22.581,10.99,28.692
                                            c2.604,1.957,64.315,47.931,109.669,47.931c27.654,0,61.771-17.389,84.432-31.142c12.012,6.911,25.917,10.886,40.741,10.886
                                            c45.201,0,81.975-36.773,81.975-81.975C349.186,222.694,312.413,185.921,267.211,185.921z M267.211,319.87
                                            c-28.659,0-51.975-23.315-51.975-51.975c0-28.659,23.315-51.975,51.975-51.975s51.975,23.316,51.975,51.975
                                            C319.186,296.555,295.871,319.87,267.211,319.87z"/>
                                        </g>
                            </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Agregar Usuario</span>
					 </a>	
				</div>
			</div>
			<table class="w-full table-auto mt-[1rem]" id="tablaCobradores" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
						<th>Nombre</th>
                        <th>Tipo de Usuario</th>
						<th>Nombre de usuario</th>
						<th>Contraseña</th>
                        <th>Telefono</th>
                       
						<th>Opciones</th>
					</tr>
					<tbody>
                    @foreach ($datosUsuarios as $dato )
						<tr class="h-20">
                            <td>{{$dato->nombreEmpleado}}</td>
                            <td>{{$dato->nombreTipoUsuario}}</td>
							<td>{{$dato->nombreUsuario}}</td>
							<td>{{$dato->contraseña}}</td>
                            <td>{{$dato->telefono}}</td>
							<td class="items-center flex justify-center">
								<a href="{{ route('empleado.mostrarPorId', ['pkEmpleado' => $dato->pkEmpleado]) }}" class="flex w-11 h-11 items-center mt-2 bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
									<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75" fill="currentColor" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<g>
											<path fill="none" d="M0 0h24v24H0z"/>
											<path d="M12 14v8H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm9.446 7.032l1.504 1.504-1.414 1.414-1.504-1.504a4 4 0 1 1 1.414-1.414zM18 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
										</g>
									</svg>
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

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
 
<script>
$(document).ready(function () {
    var table = $('#tablaCobradores').DataTable({
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
            }
    });

    $('#previousBtn').on('click', function(e) {
      e.preventDefault();
      table.page('previous').draw(false);
    });

    // Agrega evento de clic al botón Next
    $('#nextBtn').on('click', function(e) {
      e.preventDefault();
      table.page('next').draw(false);
    });
 

    $('#busqueda').on('keyup', function (e) {
        var filtroBusqueda = $('#busqueda').val();
        table.search(filtroBusqueda).draw();
    });

  
});


</script>

</body>
</html>
