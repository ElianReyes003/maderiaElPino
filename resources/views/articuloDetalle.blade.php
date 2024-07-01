
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Maderas El Pino</title>


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
        <div class="p-4 flex justify-center">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4 md:w-[80rem]">
			<div class="flex justify-start">
				<a href="{{ url('/articulesList') }}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
					Regresar
        		</a>	
			</div>
			<div class="flex justify-end">
			@if($datosArticulos->ESTATUSARTICULO == 1)
				<span class="px-2 text-sm font-medium text-gray-800 bg-green-100 rounded-full">Disponibles</span> 
			@elseif($datosArticulos->ESTATUSARTICULO == 0)
				<span class="px-2 text-sm font-medium text-gray-800 bg-red-100 rounded-full">Sin disponibilidad</span> 
			@elseif($datosArticulos->ESTATUSARTICULO == 2)
				<span class="px-2 text-sm font-medium text-gray-800 bg-yellow-100 rounded-full">Por agotarse</span>
			@endif

			</div>
                <div class="grid grid-cols-1 md:grid-cols-3">
				<div class="rounded-lg shadow-lg flex justify-center items-center md:mt-5 p-5">
				@if($datosArticulos->imagenArticulo)
					<img class="md:h-[15rem] h-[10rem] w-[15rem] rounded-sm md:w-[30rem]"
					src="{{ asset('storage/' . $datosArticulos->imagenArticulo) }}"
						alt="image description">
				@else
					<img class="md:h-[15rem] h-[10rem] w-[15rem] rounded-sm md:w-[30rem]"
						src="{{ asset('images/default.png') }}"
						alt="default image">
				@endif
				</div	>
					<div class="rounded-lg shadow-lg col-span-1 md:col-span-2 mt-5 md:ml-5">
						<div class="ml-2 md:ml-5 p-2">
							<h2 class="font-bold">Nombre del producto: <p class="font-normal">{{$datosArticulos->nombreArticulo}}</p></h2>
							<h2 class="font-bold">Categoria: <p class="font-normal">{{$datosArticulos->nombreCategoriaArticulo}}</p></h2>
							<h2 class="font-bold">Cantidad actual: <p class="font-normal">{{$datosArticulos->cantidadActual}}</p></h2>
							<h2 class="font-bold">Cantidad minima: <p class="font-normal">{{$datosArticulos->cantidadMinima}}</p></h2>
						</div>
						<div class="ml-2 md:ml-5 p-2">
							<h2 class="font-bold">Precio al contado: <p class="font-normal">{{$datosEngancheYCosto1->cantidadTipoVenta}}</p></h2>
							<h2 class="font-bold">Precio al mes: <p class="font-normal">{{$datosEngancheYCosto2->cantidadTipoVenta}}</p></h2>
							<h2 class="font-bold">Precio a dos meses: <p class="font-normal">{{$datosEngancheYCosto3->cantidadTipoVenta}}</p></h2>
							<h2 class="font-bold">Precio a un año: <p class="font-normal">{{$datosEngancheYCosto4->cantidadTipoVenta}}</p></h2>
						</div>
						<div class="ml-2 md:ml-5 p-2">
							<h2 class="font-bold">Enganche a un año: <p class="font-normal">{{$datosEngancheYCosto4->enganche}}</p></h2>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-center mt-5 p-4">
		<div class="bg-white rounded-lg shadow-lg w-[20rem] p-4 md:w-[80rem]">
				<h1 class="font-bold text-2xl text-center"> Cantidades por dias</h1>
				<div class="grid-cols-2 md:grid-cols-3 grid md:text-center mt-10 gap-4 md:hidden">
					<h3 class="font-bold">Cada 8 dias</h3>
					<p class="text-center">{{$datosArticulos->abonoOchoDias}}</p>
					<h3 class="font-bold">Cada 15 dias</h3>
					<P class="text-center">{{$datosArticulos->abonoQuinceDias}}</P>
					<h3 class="font-bold">Cada 30 dias</h3>
					<P class="text-center">{{$datosArticulos->abonoTreintaDias}}</P>
				</div>
				<div class="hidden mt-10 grid-cols-3 md:grid text-center gap-4">
					<h3 class="font-bold">Cada 8 dias</h3>
					<h3 class="font-bold">Cada 15 dias</h3>
					<h3 class="font-bold">Cada 30 dias</h3>
					<p class="text-center">{{$datosArticulos->abonoOchoDias}}</p>
					<P class="text-center">{{$datosArticulos->abonoQuinceDias}}</P>
					<P class="text-center">{{$datosArticulos->abonoTreintaDias}}</P>
				</div>
            <form id="formulario"  action="{{ route('articulo.Movimiento', ['pkArticulo' => $datosArticulos->pkArticulo]) }}" enctype="multipart/form-data"  method="post" ><!-- Botones abastecer y desabasteser -->
            @csrf 
                <div class="mt-16 border-t border-gray-200">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-5 mt-10">
						<div class="md:mt-2">
							<label for="underline_select" class="sr-only">Tipo Movimiento</label>
							<select name="tipoMovimiento"  id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
								<option selected>Tipo de movimiento</option>
                                     @php
                                        use App\Models\TipoMovimiento;
                                        $datosCategoria=tipomovimiento::take(2)->get();
                                    @endphp
                                 
                                    @foreach ($datosCategoria as $dato)
                                        <option value="{{$dato->pktipoMovimiento}}">{{$dato->nombreTipoMovimiento}}</option>
                                    @endforeach
									<option value="5">Conversion de articulo</option>
							</select>
						</div>
						<div>
							<label for="" class="block mb-2 text-sm font-medium text-gray-900"></label>
							<input type="number"  name="cantidadSeleccionada" id="" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
						</div>
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
                        <option value="0">No Disponible</option>
                        <option value="2">Por Agotarse</option>
                    </select>
                 </div>
                 <div class="flex mt-3   ">
                        <button type="button"id="limpiarFiltros" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                            Limpiar filtros
                        </button>    
                    </div>
		

		   <div class="bg-white rounded-lg shadow-lg mt-10">
			<div class="flex justify-center mb-[1rem]">
				<div class="">
					<h1 class="text-center font-bold text-2xl mt-5">Selecciona articulos</h1>
				</div>
			</div>
            <div>
				<div class="flex justify-center md:justify-normal items-center mt-10">
                    <form class="w-[13rem]">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search"  id="busqueda"  class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
                        </div>
                    </form>
                   
                 </div>
			<table class="w-full table-auto mt-[1rem]"  id="tablaArticulos" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
                        <td class="oculto">ID</td>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Estatus</th>
                        <th>Stock</th>
                        <th>Seleccionar</th>
					</tr>
					<tbody>
                    @foreach ($datosArticulosGenerales as $dato ) 
						<tr class="h-20">
                        <td class="oculto">{{$dato->pkArticulo}}</td>
                        <th>{{$dato->nombreArticulo}}</th>
                        <th>{{$dato->nombreCategoriaArticulo}}</th>
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
                            <span class="inline-flex items-center justify-center px-2 text-sm font-medium text-gray-800 bg-red-400 rounded-md">No disponible
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
                        <th>{{$dato->cantidadActual}}</th>
							<td class="items-center flex justify-center">									
								<div class="mt-2 md:mt-5">
									<input type="checkbox" name="articulo-seleccionado" class="seleccionar-articulo" data-articulo-id="{{$dato->pkArticulo}}" class="w-6 h-6 rounded text-green-400 bg-gray-100 border-gray-300 focus:ring-green-400 focus:ring-2">
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


				<input type="hidden" name="subarticulo[]" id="subarticulo" value="">

						<div class="md:mt-2 flex">
							<button type="submit" class=" w-full flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
								<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" width="800px" height="800px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="m16 0c8.836556 0 16 7.163444 16 16s-7.163444 16-16 16-16-7.163444-16-16 7.163444-16 16-16zm6.4350288 11.7071068c-.3905242-.3905243-1.0236892-.3905243-1.4142135 0l-6.3646682 6.3632539-3.5348268-3.5348268c-.3905242-.3905243-1.0236892-.3905243-1.41421352 0-.39052429.3905243-.39052429 1.0236893 0 1.4142136l4.24264072 4.2426407c.3905243.3905242 1.0236892.3905242 1.4142135 0 .0040531-.0040531.0080641-.0081323.012033-.0122371l7.0590348-7.0588308c.3905243-.3905242.3905243-1.0236892 0-1.4142135z" fill="currentColor" fill-rule="evenodd"/></svg>
								<p type="submit" class="flex-1 ms-3 whitespace-nowrap">Aplicar</p>
							 </button>	
						</div>
					</div>
				</div>
            </form>
			  <!-- botones eliminar y editar -->
			  <div class="flex justify-between md:mt-16 mt-10">
				<div class="ml-10">
					<a href="{{ route('articulo.detalle', ['pkArticulo' => $datosArticulos->pkArticulo, 'vista' => 'editarArticulo']) }}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
						<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" fill="currentColor" width="800px" height="800px" viewBox="0 0 32 32" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M12.965,5.462c0,-0 -2.584,0.004 -4.979,0.008c-3.034,0.006 -5.49,2.467 -5.49,5.5l0,13.03c0,1.459 0.579,2.858 1.611,3.889c1.031,1.032 2.43,1.611 3.889,1.611l13.003,0c3.038,-0 5.5,-2.462 5.5,-5.5c0,-2.405 0,-5.004 0,-5.004c0,-0.828 -0.672,-1.5 -1.5,-1.5c-0.827,-0 -1.5,0.672 -1.5,1.5l0,5.004c0,1.381 -1.119,2.5 -2.5,2.5l-13.003,0c-0.663,-0 -1.299,-0.263 -1.768,-0.732c-0.469,-0.469 -0.732,-1.105 -0.732,-1.768l0,-13.03c0,-1.379 1.117,-2.497 2.496,-2.5c2.394,-0.004 4.979,-0.008 4.979,-0.008c0.828,-0.002 1.498,-0.675 1.497,-1.503c-0.001,-0.828 -0.675,-1.499 -1.503,-1.497Z"/><path d="M20.046,6.411l-6.845,6.846c-0.137,0.137 -0.232,0.311 -0.271,0.501l-1.081,5.152c-0.069,0.329 0.032,0.671 0.268,0.909c0.237,0.239 0.577,0.343 0.907,0.277l5.194,-1.038c0.193,-0.039 0.371,-0.134 0.511,-0.274l6.845,-6.845l-5.528,-5.528Zm1.415,-1.414l5.527,5.528l1.112,-1.111c1.526,-1.527 1.526,-4.001 -0,-5.527c-0.001,-0 -0.001,-0.001 -0.001,-0.001c-1.527,-1.526 -4.001,-1.526 -5.527,-0l-1.111,1.111Z"/><g id="Icon"/></svg>
					 </a>	
				</div>
				<div class="mr-10">
					<form action="{{ route('articulo.baja', ['pkArticulo' => $datosArticulos->pkArticulo]) }}"  id="bajaForm" method="POST">
						@csrf <!-- Agrega el token CSRF para protección contra falsificación de solicitudes -->
						<button type="submit" id="completar" onclick="confirmarBaja(event)" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
							<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="800px" height="800px" viewBox="0 0 24 24">
								<path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/>
							</svg>
						</button>
					</form>
	
				</div>
			  </div>
			</div>
		</div>
     </div>

   <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>	
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
   <script  src="https://cdn.datatables.net/plug-ins/1.13.7/api/fnMultiFilter.js"></script>
   <script>

var tableArticulos = $('#tablaArticulos').DataTable({
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
    });
	var  clienteSeleccionadoGlobal =0;
	  // Maneja el evento de cambio de los checkboxes
	  $('.seleccionar-articulo').on('change', function() {
        var selectedArticles = [];
		
        $('input[name="articulo-seleccionado"]:checked').each(function() {
            selectedArticles.push($(this).data('articulo-id'));
			var articuloId = $(this).data('articulo-id');
			clienteSeleccionadoGlobal=articuloId;
        });
        $('#subarticulo').val(selectedArticles.join(','));
        console.log('Artículos seleccionados:', selectedArticles);
    });




    $('#previousBtn').on('click', function(e) {
      e.preventDefault();
      tableArticulos.page('previous').draw(false);
    });

    // Agrega evento de clic al botón Next
    $('#nextBtn').on('click', function(e) {
      e.preventDefault();
      tableArticulos.page('next').draw(false);
    });
    $('#limpiarFiltros').on('click', function () {
        $('#fkEstatus, #fkCategoria').val('');
        tableArticulos.search('').columns().search('').draw();
    });

    var tableArticulosSeleccionados = $('#articulos-lista').DataTable({
        responsive: true,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
        },
    });
    $('#previousBtn2').on('click', function(e) {
      e.preventDefault();
      tableArticulosSeleccionados.page('previous').draw(false);
    });

    // Agrega evento de clic al botón Next
    $('#nextBtn2').on('click', function(e) {
      e.preventDefault();
      tableArticulosSeleccionados.page('next').draw(false);
    });

    $('#fkEstatus, #fkCategoria').change(function () {
        var estatus = $('#fkEstatus').val();
        var categoria = $('#fkCategoria').val();
            if (estatus === '1') {
            estatus = 'Disponible';
        } else if (estatus === '2') {
            estatus = 'Por Agotarse';
        }
        else if (estatus === '0') {
            estatus = 'No Disponible';
        }

        tableArticulos.column(3).search(estatus).draw();
        tableArticulos.column(2).search(categoria).draw();
    });

    $('#busqueda').on('keyup', function (e) {
        var filtroBusqueda = $('#busqueda').val();
        tableArticulos.search(filtroBusqueda).draw();
    });

    $('#limpiarFiltros').on('click', function () {
        $('#fkEstatus, #fkCategoria').val('');
        tableArticulos.search('').columns().search('').draw();
    });




	
function actualizarCamposOcultos() {
    // Elimina el campo oculto #cliente existente
   
    $('#formulario').find('input[name="subarticulo[]"]').remove();

    // Agrega nuevos campos ocultos con los valores de los artículos seleccionados
    $('input[name="articulo-seleccionado"]:checked').each(function() {
        var articuloId = $(this).data('articulo-id');
        $('#formulario').append("<input type='hidden' name='subarticulo[]' value='" + articuloId + "'>");
    });
   
}


$('#completar').click(function () {
    // Obtiene el cliente seleccionado
    
	e.preventDefault(); // Evita el envío del formulario por defecto
    actualizarCamposOcultos();
    $('#formulario').submit();
});


function confirmarBaja(event) {
    event.preventDefault();

    Swal.fire({
        title: '¿Seguro?',
        text: '¿Desea dar de baja este articulo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, dar de baja',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('bajaForm').submit();
        }
    });
}
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
</html>