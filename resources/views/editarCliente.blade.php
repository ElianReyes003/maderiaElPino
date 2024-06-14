<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <title>Maderas El Pino</title>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

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

@php
        use App\Models\tipoVenta;
        $datosTipoVenta = tipoventa::all();
        
@endphp
<div class="p-4 sm:ml-64 mt-16 md:mt-10">
<form  id="formulario" action="{{ route('cliente.actualizar', ['pkCliente' => $cliente->pkCliente]) }}"
 enctype="multipart/form-data"  method="post" >

    @csrf
 <!-- Guias del tamaño del contenedor -->
 <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			
		
			<div class="flex justify-center mt-5 md:mt-10">
                    <h1 class="text-center font-bold text-2xl">Actualiza los datos del cliente</h1>
			</div>
			<div class="mt-10">
			
				<div class="grid gap-6 mb-6 md:grid-cols-2 mt-10">
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre Cliente</label>
						<input type="text" name="nombreCliente"  value="{{$cliente->nombreCliente}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">telefono</label>
						<input type="number" name="telefono"  value="{{$cliente->telefono}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
                        <select name="fkMunicipio" id="fkMunicipio" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                            @php
                                use App\Models\Municipio;
                                $datosMunicipio=Municipio::where('estatus', 1)->get();
                            @endphp
                            <option value="">Selecciona Ciudad</option>
                            @foreach ($datosMunicipio as $municipio)
                                <option  @if ($municipio->pkMunicipio == $cliente->pkMunicipio) selected @endif value="{{ $municipio->pkMunicipio }}"> {{ $municipio->nombreMunicipio }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="underline_select" class="sr-only">Selecciona Colonia</label>
                        <select name="fkColonia" id="fkColonia" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                        <option value=""></option>
                        </select>
                    </div>
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Calle</label>
                        <input type="text" name="calle"  value="{{$cliente->calle}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Sube un archivo</label>
                        <input   name="imagenDomicilio" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none" aria-describedby="file_input_help" id="" type="file">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Actualiza documentos</label>
                        <input type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none" id="documentos" name="documentos[]" multiple>
                    </div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Numero de casa</label>
						<input type="text" name="numCasa"  value="{{$cliente->numCasa}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
				</div>
                <div>			
			        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Descripccion del domicilio</label>
			        <textarea  id="message" type="text" value="{{$cliente->descripcionDomicilio}}" name="descripcionDomicilio" value="cliente->descripcionDomicilio" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-400 focus:border-green-400" ></textarea>
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
		   </div>
		</div>
	</div>
		</div>
    
</form>
</div>


<script>
    
/////////////////// FILTRO DE COLONIAS ///////////////////////////////////////////
$(document).ready(function () {
    $('#fkMunicipio').on('change', function () {
        var municipioSeleccionado = $(this).val();
        obtenerColonias(municipioSeleccionado);
    });

    // Llamada inicial con el primer valor detectado
    obtenerColonias($('#fkMunicipio').val());
});

function obtenerColonias(municipioSeleccionado) {
    var selectColonia = $('#fkColonia');
    selectColonia.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar colonia" al inicio
    selectColonia.append('<option value="">Seleccionar colonia</option>');

    if (municipioSeleccionado) {
        // Realizar la petición AJAX para obtener las colonias
        $.get('/opcionesColoniasId?dato=' + municipioSeleccionado, function (colonias) {
            actualizarSelectColonias(colonias);

            // Desencadenar el evento de cambio en el select de colonias para asegurar la actualización de las calles
            selectColonia.change();
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

        // Seleccionar automáticamente la primera colonia
        selectColonia.val(colonias[0].pkColonia);

        // Obtener y aplicar automáticamente las calles para la primera colonia
        obtenerCalles(colonias[0].pkColonia);
    } else {
        // Si no hay colonias disponibles, mostrar un mensaje
        selectColonia.append('<option value="">No hay colonias disponibles en este municipio</option>');
    }
}

//////////////////// FILTRO DE CALLES /////////////////////////////////////////////
$(document).ready(function () {
    $('#fkColonia').on('change', function () {
        var coloniaSeleccionado = $(this).val();
        obtenerCalles(coloniaSeleccionado);
    });

    // Llamada inicial con el primer valor detectado
    obtenerCalles($('#fkColonia').val());
});

function obtenerCalles(coloniaSeleccionado) {
    var selectCalle = $('#fkCalle');
    selectCalle.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar calle" al inicio
    selectCalle.append('<option value="">Seleccionar calle</option>');

    if (coloniaSeleccionado) {
        // Realizar la petición AJAX para obtener las calles
        $.get('/opcionesCallesId?dato=' + coloniaSeleccionado, function (calles) {
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
            selectCalles.append('<option value="' + calle.pkCalle + '">' + calle.nombreCalle + '</option>');
        });

        // Seleccionar automáticamente la primera calle
        selectCalles.val(calles[0].pkCalle);
    } else {
        // Si no hay calles disponibles, mostrar un mensaje
        selectCalles.append('<option value="">No hay calles disponibles en esta colonia</option>');
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
	 </style>
</body>