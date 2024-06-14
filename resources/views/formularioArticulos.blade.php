

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/input.css" rel="stylesheet">
  <link href="../dist/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<title>Maderas El Pino</title>
<link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
  
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
			<div class="flex justify-start">
				<a href="{{ url('/articulesList') }}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
					Regresar
                </a>
			</div>		
				<h1 class="text-center font-bold text-2xl">Agregue un nuevo articulo</h1>
			<form id="formulario"  action="{{ route('articulo.insertar') }}" enctype="multipart/form-data"  method="post" >
			@csrf   	
            <div class="grid gap-6 mb-6 md:grid-cols-2 mt-10">
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del articulo</label>
						<input  name="nombreArticulo" type="text" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria Articulo</label>
						
                        <select name="fkCategoriaArticulo"  id="fkCategoriaArticul"id="countries" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5">
                                    @php
                        use App\Models\categoriaArticulo;
                        $datosCategorias=categoriaArticulo::where('estatus', 1)->get();
                    @endphp
                    <option value="">Selecciona Categoria</option>
                    @foreach ($datosCategorias as $dato)
                        <option value="{{$dato->pkCategoriaArticulo}}">{{$dato->nombreCategoriaArticulo}}</option>
                    @endforeach
						</select>
					</div> 
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio al contado</label>
						<input type="number" id="" name="precioAlContado" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					 
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio al mes</label>
						<input type="number"   name="precioAlMes" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					
                    <div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Enganche al mes</label>
						<input type="number"  name="EngancheprecioAlMes" " id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio a dos meses</label>
						<input type="number"  name="precioADosMeses" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Enganche a dos meses</label>
						<input type="number" name="EngancheADosMeses" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Precio a un año </label>
						<input type="number"  name="precioUnAño" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Enganche a un año</label>
						<input type="number" name="EngancheUnAño" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>		
						<label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Sube un archivo</label>
						<input id="imagenArticulo" name="imagenArticulo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-green-50 focus:outline-none" aria-describedby="file_input_help" id="" type="file">
						<p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG</p>
					</div>
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad minima</label>
						<input type="number" name="cantidadMinima" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>
					
					
                  
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad actual</label>
						<input type="number"   name="cantidadActual" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
					</div>

				
				</div>
			
		   </div>
		   <div class="bg-white rounded-lg shadow-lg p-4 mt-10">
			<div class="grid grid-cols-3 gap-4">

				<div>
					<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad de cada 8 dias</label>
					<input type="number" name="abonoOchoDias" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
				</div>
				<div>
					<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad de cada 15 dias</label>
					<input type="number" id=""  name="abonoQuinceDias" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
				</div>
				<div>
					<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad de cada 30 dias</label>
					<input type="number" id="" name="abonoTreintaDias" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
				</div>
			</div>	
			<div class="flex justify-center	mt-16">
				<div class="md:p-10 p-5">
					  <div class="flex">
						<!-- Previous Button -->
						<a  href="{{ url('/articulesList') }}"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
						  Cancelar
						</a>
						<!-- Next Button -->
						<input type="submit" id="completar"  href="#" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
					
						</input>
					  </div>
				</div>
			</div>
		   </div>
        </div>
     </div>
     </form>
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
