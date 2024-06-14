<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
   
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
                            <input type="search"  id="searchTermCliente" name="searchTermCliente" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
                        </div>
                    </form>
                 </div>
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-10">
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
                    <label for="underline_select" class="sr-only">Underline select</label>
                    <select name="fkColonia" id="fkColonia" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                        <option value=""></option>
                    </select>
                    <div class="flex mt-3">
                        <button  type="button"id="limpiarFiltros"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                                Limpiar filtros
                        </button>
                    </div>
                 </div>
			</div>
		   </div>
		   <div class="bg-white rounded-lg shadow-lg mt-10">
			<div class="flex justify-center mb-[1rem]">
			</div>
			<table id="clientes" class="w-full table-auto mt-[1rem]" class=" tablaArticulos display nowrap" width="90%">
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

function confirmarBaja(event, id) {
    event.preventDefault();

    Swal.fire({
        title: '¿Seguro?',
        text: '¿Desea dar de baja este usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, dar de baja',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('bajaForm-' + id).submit();
        }
    });
}
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
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true
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
                var clienteMostrarUrl = '/clienteEspecifico/:pkCliente';
                var clienteEditarUrl = '/edicionCliente/:pkCliente';
                var clienteBajaUrl = '/bajaCliente/:pkCliente';
                var clientePk = ':pkCliente';
                dataTable.clear().draw();

                // Agregar nuevos resultados
                data.forEach(function (dato) {
                    var resultadoHtml = `
                        <tr>
                            <td>${dato.nombreCliente}</td>
                            <td>${dato.nombreMunicipio}</td>
                            <td>${dato.nombreColonia}</td>
                            <td>${dato.calle}</td>
                         
                            
                            <td class="items-center flex justify-center">
								<div class="flex">
                                    <div class="p-3">
                                        <a href="${clienteMostrarUrl.replace(':pkCliente', dato.pkCliente)}"  data-pkCliente="${dato.pkCliente}" class="flex w-11 h-11 items-center mt-2 bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
                                            <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75" fill="currentColor" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <path fill="none" d="M0 0h24v24H0z"/>
                                                    <path d="M12 14v8H4a8 8 0 0 1 8-8zm0-1c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm9.446 7.032l1.504 1.504-1.414 1.414-1.504-1.504a4 4 0 1 1 1.414-1.414zM18 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="p-3">
                                        <a href="${clienteEditarUrl.replace(':pkCliente', dato.pkCliente)}"  data-pkCliente="${dato.pkCliente}" class="flex w-11 h-11 items-center mt-2 bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
                                            <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75" fill="currentColor" width="800px" height="800px" viewBox="0 0 14 14" role="img" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path d="m 5.2001642,6.9998885 c 1.3256768,0 2.4000937,-1.07442 2.4000937,-2.4001 0,-1.32567 -1.0744169,-2.40009 -2.4000937,-2.40009 -1.3256768,0 -2.4000938,1.07442 -2.4000938,2.40009 0,1.32568 1.074417,2.4001 2.4000938,2.4001 z m 1.6800656,0.60002 -0.3131372,0 c -0.4162663,0.19126 -0.8794094,0.30001 -1.3669284,0.30001 -0.4875191,0 -0.9487871,-0.10875 -1.3669284,-0.30001 l -0.3131373,0 c -1.3913043,0 -2.5200984,1.12879 -2.5200984,2.5201005 l 0,0.78003 c 0,0.49689 0.4031408,0.90003 0.9000352,0.90003 l 5.1545763,0 c -0.045002,-0.1275 -0.063752,-0.26251 -0.048752,-0.39939 l 0.127505,-1.14192 0.022501,-0.20813 0.1481307,-0.1481305 1.4494317,-1.44943 c -0.459393,-0.5194 -1.125044,-0.85316 -1.8731982,-0.85316 z m 0.8494082,2.7244805 -0.127505,1.1438 c -0.020626,0.19125 0.1406305,0.35251 0.3300129,0.33001 l 1.1419196,-0.12751 2.5857255,-2.5857205 -1.344427,-1.34443 -2.585726,2.5838505 z m 5.139576,-3.0826205 -0.710653,-0.71065 c -0.174382,-0.17438 -0.459393,-0.17438 -0.633775,0 l -0.708777,0.70878 -0.07688,0.0769 1.346302,1.34443 0.783781,-0.78378 c 0.174381,-0.17626 0.174381,-0.45939 0,-0.63565 z"/></svg>
                                        </a>
                                    </div>
								<div class="p-3">
                                    <form action="${clienteBajaUrl.replace(':pkCliente', dato.pkCliente)}" method="POST"  id="bajaForm-${clientePk.replace(':pkCliente', dato.pkCliente)}"  class="inline">
                                        @csrf
                                        <button type="submit"    onclick="confirmarBaja(event, '${clientePk.replace(':pkCliente', dato.pkCliente)}')" class="flex w-11 h-11 items-center mt-2 bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
                                            <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="6" r="4" fill="currentColor"/>
                                                <path d="M15.4147 13.5074C14.4046 13.1842 13.24 13 12 13C8.13401 13 5 14.7909 5 17C5 19.1406 7.94244 20.8884 11.6421 20.9949C11.615 20.8686 11.594 20.7432 11.5775 20.6201C11.4998 20.0424 11.4999 19.3365 11.5 18.586V18.414C11.4999 17.6635 11.4998 16.9576 11.5775 16.3799C11.6639 15.737 11.8705 15.0333 12.4519 14.4519C13.0334 13.8705 13.737 13.6639 14.3799 13.5774C14.6919 13.5355 15.0412 13.5162 15.4147 13.5074Z" fill="currentColor"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M16.5 22C14.8501 22 14.0251 22 13.5126 21.4874C13 20.9749 13 20.1499 13 18.5C13 16.8501 13 16.0251 13.5126 15.5126C14.0251 15 14.8501 15 16.5 15C18.1499 15 18.9749 15 19.4874 15.5126C20 16.0251 20 16.8501 20 18.5C20 20.1499 20 20.9749 19.4874 21.4874C18.9749 22 18.1499 22 16.5 22ZM15.3569 16.532C15.1291 16.3042 14.7598 16.3042 14.532 16.532C14.3042 16.7598 14.3042 17.1291 14.532 17.3569L15.675 18.5L14.532 19.6431C14.3042 19.8709 14.3042 20.2402 14.532 20.468C14.7598 20.6958 15.1291 20.6958 15.3569 20.468L16.5 19.325L17.6431 20.468C17.8709 20.6958 18.2402 20.6958 18.468 20.468C18.6958 20.2402 18.6958 19.8709 18.468 19.6431L17.325 18.5L18.468 17.3569C18.6958 17.1291 18.6958 16.7598 18.468 16.532C18.2402 16.3042 17.8709 16.3042 17.6431 16.532L16.5 17.675L15.3569 16.532Z" fill="currentColor"/>
                                            </svg>
                                        </button>
                                    </form>

                                    </div>
                                </div>
							</td>


                            

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
    
    $('#limpiarFiltros').on('click', function () {
        $('#fkMunicipio, #fkColonia, #fkCalle').val('');
        tableMovimientos.search('').columns().search('').draw();
    });
});
</script>
</body>
</html>


