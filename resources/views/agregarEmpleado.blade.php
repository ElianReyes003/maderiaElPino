<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
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
				<h1 class="text-center font-bold text-2xl">Nuevo empleado</h1>
			<form id="formulario"  action="{{ route('empleado.insertar') }}" enctype="multipart/form-data"  method="post">
			@csrf   	
           
            <div class="grid gap-6 mb-6 md:grid-cols-2 mt-10">
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del empleado</label>
						<input  type="text" name="nombreEmpleado" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre de usuario</label>
						<input type="text" name="nombreUsuario" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
						<input type="text" name="contraseña" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Telefono</label>
						<input type="number" name="telefono" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div> 
                    
					<div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de usuario</label>
                        @php
                        use App\Models\tipoUsuario;
                            $datosTipoUsuario=tipousuario::all();
                        @endphp
                        <select name="fkTipoUsuario" id="fkTipoUsuario" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
                        <option value=""></option>
                        @foreach ($datosTipoUsuario as $dato)
                            <option value="{{$dato->pkTipoUsuario}}">{{$dato->nombreTipoUsuario}}</option>
                        @endforeach
					
						</select>
					</div>
				</div>
			
            <!-- RESPONSIVE MOVIL -->
            <div class="mt-5">
                <div class="grid-cols-2 md:hidden">
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ciudad</label>
						<select name="fkMunicipio" id="fkMunicipio" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
						@php
                            use App\Models\Municipio;
                            $datosMunicipio=Municipio::where('estatus', 1)->get();
                        @endphp
                        <option value=""></option>
                            @foreach ($datosMunicipio as $dato)
                                <option value="{{$dato->pkMunicipio}}">{{$dato->nombreMunicipio}}</option>
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
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Calle</label>
						<input type="text" name="calle" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
					</div> 
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero</label>
						<input type="number" name="num" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
					</div> 

					</div> 
            </div>	
            <!-- RESPONSIVE DESKTOP -->
            <div class="p-4 mt-10">
                <div class="hidden grid-cols-3 gap-4 md:grid">
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipio</label>
						<select name="fkMunicipio" id="fkMunicipio2" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
						
                        <option value=""></option>
                            @foreach ($datosMunicipio as $dato)
                                <option value="{{$dato->pkMunicipio}}">{{$dato->nombreMunicipio}}</option>
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
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Calle</label>
						<input type="text" name="calle" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
					</div> 
                    <div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero</label>
						<input type="number" name="numCasa" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
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
                              Agregar
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
function initFiltroColonias(selectorMunicipio, selectorColonia) {
    $(selectorMunicipio).on('change', function () {
        var municipioSeleccionado = $(this).val();
        obtenerColonias(municipioSeleccionado, selectorColonia);
    });

    // Llamada inicial con la opción "Seleccionar colonia"
    obtenerColonias(null, selectorColonia);

    function obtenerColonias(municipioSeleccionado, selectColonia) {
        var selectColonia = $(selectColonia);
        selectColonia.empty(); // Limpia las opciones actuales

        // Agregar la opción "Seleccionar colonia" al inicio
        selectColonia.append('<option value="">Seleccionar colonia</option>');

        if (municipioSeleccionado) {
            // Realizar la petición AJAX para obtener las colonias
            $.get('/opcionesColoniasId?dato=' + municipioSeleccionado, function (colonias) {
                actualizarSelectColonias(colonias, selectColonia);
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
        } else {
            // Si no hay colonias disponibles, mostrar un mensaje
            selectColonia.append('<option value="">No hay colonias disponibles en este municipio</option>');
        }
    }

    

  
}

// Llamada para el conjunto de selects responsivos para dispositivos móviles
initFiltroColonias('#fkMunicipio', '#fkColonia');

// Llamada para el conjunto de selects para dispositivos de escritorio
initFiltroColonias('#fkMunicipio2', '#fkColonia2');
</script>
</script>

</body>
</html>