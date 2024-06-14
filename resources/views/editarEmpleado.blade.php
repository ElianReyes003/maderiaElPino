<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
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
		   <!-- Codigo del formulario -->
		   <div class="bg-white rounded-lg shadow-lg p-4">		
				<h1 class="text-center font-bold text-2xl">Editar empleado</h1>
			<form id="formulario" action="{{ route('empleado.actualizar') }}" enctype="multipart/form-data" method="post">
			@csrf   	
            <input type="hidden" name="pkEmpleado"  value="{{ $dato->pkEmpleado}}">
            <div class="grid gap-6 mb-6 md:grid-cols-2 mt-10">
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del empleado</label>
						<input  type="text" value="{{ $dato->nombreEmpleado }}"  name="nombreEmpleado" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre de usuario</label>
						<input type="text" value="{{ $dato->nombreUsuario }}"  name="nombreUsuario" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
						<input type="text"   value="{{ $dato->contraseña }}" name="contraseña" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Telefono</label>
						<input type="number"   value="{{ $dato->telefono }}"  name="telefono" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div> 
                    
					<div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de usuario</label>
                        @php
                        use App\Models\tipoUsuario;
                            $datosTipoUsuario=tipousuario::all();
                        @endphp
                        <select name="fkTipoUsuario" id="fkTipoUsuario" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
                        <option value=""></option>
                        @foreach ($datosTipoUsuario as $tipoUsuario)
                            <option @if ($tipoUsuario->pkTipoUsuario == $dato->fkTipoUsuario) selected @endif value="{{ $tipoUsuario->pkTipoUsuario }}">{{$tipoUsuario->nombreTipoUsuario}}</option>
                        @endforeach
					
						</select>
					</div>
				</div>
			
            <!-- RESPONSIVE MOVIL -->
            <div class="mt-5">
                <div class="grid-cols-2 md:hidden">
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipio</label>
						<select name="fkMunicipio" id="fkMunicipio" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
						@php
                            use App\Models\Municipio;
                            $datosMunicipio=Municipio::all();
                        @endphp
                        @foreach ($datosMunicipio as $municipio)
                            <option @if ($municipio->pkMunicipio == $dato->pkMunicipio) selected @endif value="{{ $municipio->pkMunicipio }}">
                                {{ $municipio->nombreMunicipio }}
                            </option>
                        @endforeach
						</select>
					</div> 
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colonia</label>
						<select name="fkColonia" id="fkColonia" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
						    <option selected></option>
						</select>
					</div> 
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Num. Casa</label>
						<input type="text" name="numCasa"  value="{{ $dato->numCasa }}"id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div> 
                </div>	
		   </div>
            <!-- RESPONSIVE DESKTOP -->
            <div class="p-4 mt-10">
                <div class="hidden grid-cols-3 gap-4 md:grid">
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipio</label>
						<select name="fkMunicipio" id="fkMunicipio2" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
						
                        @foreach ($datosMunicipio as $municipio)
            <option @if ($municipio->pkMunicipio == $dato->pkMunicipio) selected @endif value="{{ $municipio->pkMunicipio }}">
                {{ $municipio->nombreMunicipio }}
            </option>
        @endforeach
                          
						</select>
					</div> 
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colonia</label>
						<select name="fkColonia" id="fkColonia2" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
						    <option selected></option>
						</select>
					</div> 
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Calle</label>
						<input type="text" name="calle"  value="{{ $dato->calle }}"id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div> 
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Num. Casa</label>
						<input type="text" name="numCasa"  value="{{ $dato->numCasa }}"id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div> 
                </div>
                <div class="flex justify-center">
                    <div class="md:p-10 p-5 mt-5">
                          <div class="flex">
                            <!-- Previous Button -->
                            <a  href="{{ url()->previous() }}" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                              Cancelar
                            </a>
                            <!-- Next Button -->
                            <button type="submit" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                              Guardar
                            </button>
                          </div>
                    </div>
                </div>	
                </form>
		   </div>
        </div>
     </div>
	 <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>




<script> 
/////////////////// FILTRO DE COLONIAS ///////////////////////////////////////////
$(document).ready(function () {
    // Versión 1
    $('#fkMunicipio').on('change', function () {
        var municipioSeleccionado = $(this).val();
        obtenerColonias(municipioSeleccionado, '#fkColonia');
    });

    // Llamada inicial con el primer valor detectado
    obtenerColonias($('#fkMunicipio').val(), '#fkColonia');
    
    // Versión 2
    $('#fkMunicipio2').on('change', function () {
        var municipioSeleccionado = $(this).val();
        obtenerColonias(municipioSeleccionado, '#fkColonia2');
    });

    // Llamada inicial con el primer valor detectado
    obtenerColonias($('#fkMunicipio2').val(), '#fkColonia2');
});

function obtenerColonias(municipioSeleccionado, selectColonia) {
    var selectColonia = $(selectColonia);
    selectColonia.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar colonia" al inicio
    selectColonia.append('<option value="">Seleccionar colonia</option>');

    if (municipioSeleccionado) {
        // Realizar la petición AJAX para obtener las colonias
        $.get('/opcionesColoniasId?dato=' + municipioSeleccionado, function (colonias) {
            actualizarSelectColonias(colonias, selectColonia);

            // Desencadenar el evento de cambio en el select de colonias para asegurar la actualización de las calles
            selectColonia.change();
        });
    } else {
        // Si no se seleccionó un municipio, reinicia el select de colonias
        actualizarSelectColonias([], selectColonia);
    }
}

function actualizarSelectColonias(colonias, selectColonia) {
    if (colonias.length > 0) {
        $.each(colonias, function (index, colonia) {
            selectColonia.append('<option value="' + colonia.pkColonia + '">' + colonia.nombreColonia + '</option>');
        });

        // Seleccionar automáticamente la primera colonia
        selectColonia.val(colonias[0].pkColonia);

        // Obtener y aplicar automáticamente las calles para la primera colonia
        obtenerCalles(colonias[0].pkColonia, '#fkCalle');
    } else {
        // Si no hay colonias disponibles, mostrar un mensaje
        selectColonia.append('<option value="">No hay colonias disponibles en este municipio</option>');
    }
}

//////////////////// FILTRO DE CALLES /////////////////////////////////////////////
$(document).ready(function () {
    // Versión 1
    $('#fkColonia').on('change', function () {
        var coloniaSeleccionado = $(this).val();
        obtenerCalles(coloniaSeleccionado, '#fkCalle');
    });

    // Llamada inicial con el primer valor detectado
    obtenerCalles($('#fkColonia').val(), '#fkCalle');

    // Versión 2
    $('#fkColonia2').on('change', function () {
        var coloniaSeleccionado = $(this).val();
        obtenerCalles(coloniaSeleccionado, '#fkCalle2');
    });

    // Llamada inicial con el primer valor detectado
    obtenerCalles($('#fkColonia2').val(), '#fkCalle2');
});

function obtenerCalles(coloniaSeleccionado, selectCalle) {
    var selectCalle = $(selectCalle);
    selectCalle.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar calle" al inicio
    selectCalle.append('<option value="">Seleccionar calle</option>');

    if (coloniaSeleccionado) {
        // Realizar la petición AJAX para obtener las calles
        $.get('/opcionesCallesId?dato=' + coloniaSeleccionado, function (calles) {
            actualizarSelectCalles(calles, selectCalle);
        });
    } else {
        // Si no se seleccionó una colonia, reinicia el select de calles
        actualizarSelectCalles([], selectCalle);
    }
}

function actualizarSelectCalles(calles, selectCalle) {
    selectCalle.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar calle" al inicio
    selectCalle.append('<option value="">Seleccionar calle</option>');

    if (calles.length > 0) {
        $.each(calles, function (index, calle) {
            selectCalle.append('<option value="' + calle.pkCalle + '">' + calle.nombreCalle + '</option>');
        });

        // Seleccionar automáticamente la primera calle
        selectCalle.val(calles[0].pkCalle);
    } else {
        // Si no hay calles disponibles, mostrar un mensaje
        selectCalle.append('<option value="">No hay calles disponibles en esta colonia</option>');
    }
}

</script>

</body>
</html>