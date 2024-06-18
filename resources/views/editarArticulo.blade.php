
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maderas El Pino</title>
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
				<h1 class="text-center font-bold text-2xl">Edite el artículo</h1>
			<form  id="formulario"  action="{{ route('articulo.actualizar') }}" enctype="multipart/form-data"  method="post">
			@csrf	
            <div class="grid gap-6 mb-6 md:grid-cols-2 mt-10">
					<div>
                         <input type="hidden" name="pkArticulo" value="{{ $datosArticulos->pkArticulo }}">
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del articulo</label>
						<input type="text" id="" name="nombreArticulo" value="{{$datosArticulos->nombreArticulo}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio al contado</label>
						<input type="number" name="precioAlContado" value="{{$datosEngancheYCosto1->cantidadTipoVenta}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecciona categoria articulo</label>
                        <select  id="fkCategoriaArticulo" name="fkCategoriaArticulo"  class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
                         <!--consulta y despligue de tipos de usuarios -->
                            <option selected value="">Categoria</option>
                                @php
                                    use App\Models\categoriaArticulo;
                                    $datosTipo = categoriaArticulo::where('estatus', 1)->get();
                                @endphp
                                @foreach ($datosTipo as $datoU)
                                    <option value="{{ $datoU->pkCategoriaArticulo }}" {{ $datoU->pkCategoriaArticulo == $datosArticulos->fkCategoriaArticulo ? 'selected' : '' }}>{{ $datoU->nombreCategoriaArticulo}}</option>
                                @endforeach
                        </select>
                                    
					</div>  
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio al mes</label>
						<input type="number" id="" name="precioAlMes" value="{{$datosEngancheYCosto2->cantidadTipoVenta}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Enganche al mes</label>
						<input type="number" id="" name="EngancheprecioAlMes" value="{{$datosEngancheYCosto2->enganche}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad minima</label>
						<input type="number"  name="cantidadMinima" value="{{$datosArticulos->cantidadMinima}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio a dos meses</label>
						<input type="number" name="precioADosMeses" value="{{$datosEngancheYCosto3->cantidadTipoVenta}}"class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Enganche a dos meses </label>
						<input type="number" id=""  name="EngancheADosMeses" value="{{$datosEngancheYCosto3->enganche}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio a un año</label>
						<input type="number" name="precioUnAño" value="{{$datosEngancheYCosto4->cantidadTipoVenta}}"class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Enganche a un año </label>
						<input type="number" id=""  name="EngancheUnAño" value="{{$datosEngancheYCosto4->enganche}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad actual</label>
						<input type="number" id="" name="cantidadActual"value="{{$datosArticulos->cantidadActual}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>		
						<label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Cambia imagen</label>
						<input  id="imagenArticulo" name="imagenArticulo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none" aria-describedby="file_input_help" id="" type="file">
						<p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG</p>
					</div>
				</div>
			
		   </div>
		   <div class="bg-white rounded-lg shadow-lg p-4 mt-10">
			<div class="grid grid-cols-3 gap-4">
				<div>
					<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad de cada 8 dias</label>
					<input type="number" name="abonoOchoDias" value="{{$datosArticulos->abonoOchoDias}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
				</div>
				<div>
					<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad de cada 15 dias</label>
					<input type="number"  name="abonoQuinceDias" value="{{$datosArticulos->abonoQuinceDias}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
				</div>
				<div>
					<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad de cada 30 dias</label>
					<input type="number" name="abonoTreintaDias"value="{{$datosArticulos->abonoTreintaDias}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
				</div>
			</div>	
			<div class="flex justify-center	mt-16">
				<div class="md:p-10 p-5">
					  <div class="flex">
						<!-- Previous Button -->
						<a  href="{{ url()->previous() }}" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
						  Cancelar
						</a>
						<!-- Next Button -->
						<button type="submit" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
						  Guardar cambios
						</button>
					  </div>
				</div>
			</div>
            </form>
		   </div>
        </div>
     </div>
	 <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
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
</html>