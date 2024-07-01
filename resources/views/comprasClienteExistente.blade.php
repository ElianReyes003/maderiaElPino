<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
    <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <!-- Incluir List.js y su extensión List.pagination.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/list.pagination.js/0.1.1/list.pagination.min.js"></script>
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
<form  id="formulario"  action="{{ route('compraCExistente.insertar') }}" enctype="multipart/form-data"  method="post" >
@csrf
    @php
        use App\Models\tipoVenta;
        $datosTipoVenta = tipoventa::all();
    @endphp
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
                            <input type="search"  id="searchTermCliente" name="searchTermCliente" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" >
                        </div>
                    </form>
                 </div>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10">
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
                    <label for="underline_select" class="sr-only">Seleccionar Colonia</label>
                    <select name="fkColonia" id="fkColonia" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
                        <option value=""></option>
                    </select> 
                 </div>
                 <div class="flex mt-5">
                    <button  type="button"id="limpiarFiltros" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">Limpiar filtros</button>
                 </div>
			</div>
		   </div>
		   <div class="bg-white rounded-lg shadow-lg mt-10">
			<div class="flex justify-center mb-[1rem]">
			</div>
			<table id="clientes" class="w-full table-auto mt-[1rem]" class="display nowrap" width="90%">
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
							<button type="button" id="previousBtn"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button  type="button" id="nextBtn"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Siguiente
							</button>
						  </div>
					</div>
				</div>
			</div>
        </div>
     </div>

     <div class="p-4 sm:ml-64">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
		   <div class="bg-white rounded-lg shadow-lg p-4">
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
                            <input type="search"  id="busqueda"  class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
                        </div>
                    </form>
                 </div>
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-10">
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
                    <div class="flex mt-3   ">
                        <button type="button"id="limpiarFiltros" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
                            Limpiar filtros
                        </button>    
                    </div>
                 </div>
			</div>
		   </div>
		   <div class="bg-white rounded-lg shadow-lg mt-10">
			<div class="flex justify-center mb-[1rem]">
				<div class="">
					<h1 class="text-center font-bold text-2xl mt-5">Selecciona articulos</h1>
				</div>
			</div>
			<table class="w-full table-auto mt-[1rem]"  id="tablaArticulos" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
                        <td class="oculto">ID</td>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th>Estatus</th>
                        <th>Enganche</th>
                        <th>Seleccionar</th>
					</tr>
					<tbody>
                    @foreach ($datosArticulos as $dato ) 
						<tr class="h-20">
                        <td class="oculto">{{$dato->pkArticulo}}</td>
                        <th>{{$dato->nombreArticulo}}</th>
                        <th>{{$dato->nombreCategoriaArticulo}}</th>
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
                        <th>{{$dato->enganche}}</th>
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
			</div>
        </div>
     </div>
	 <div class="p-4 sm:ml-64">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
           <!-- PON EL CODIGO DEL MODULO AQUI-->
	 <div class="bg-white rounded-lg shadow-lg">
		<div class="flex justify-center mb-[1rem]">
		
		</div>
		<table class="w-full table-auto mt-[1rem]" id="articulos-lista" class="display nowrap" width="90%">
			<thead class="text-center">
				<tr class="h-24 text-center">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Ingresa cantidad</th>
                    <th>Tipo de compra</th>
                    <th>Enganche</th>
                    <th>Cancelar</th>
				</tr>
				<tbody id="detalle-articulos-body">
					
				</tbody>
				</thead>
			</table>
			<div class="flex justify-center	mt-16">
				<div class="md:p-10 p-5">
					  <div class="flex">
						<!-- Previous Button -->
                            <button id="previousBtn2" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button   id="nextBtn2"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
							  Siguiente
							</button>
					  </div>
				</div>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 ml-10 md:ml-0 p-5">
				<div class="flex p-5 md:justify-end">
					<h1 class="font-semibold">Total a pagar:</h1><label class="totalPago" for="">$$$</label>
				</div>
				<div class="flex p-5">
					<h2 class="font-semibold">Total enganche:</h2> <label class="totalEnganche" for="">$$$</label>
				</div>
			</div>
			
		</div>
	</div>
 </div> 
        <input type="hidden" name="producto_id[]" value="">
        <input type="hidden" name="cantidadotas[]" value="">
        <input type="hidden" name="tipoVenta[]" value="">
        <input type="hidden" name="cliente" id="cliente" value="">

 <div class="flex p-4 sm:ml-64 justify-center">
	<div class="bg-white rounded-lg shadow-lg">
		<div class="flex justify-center">
			<div class="md:p-10 p-10 mt-5">
				  <div class="flex">
					<!-- Previous Button -->
					<a href="{{ url()->previous() }}"  class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
					  Cancelar
					</a>
					<!-- Next Button -->
					<button type="submit"   id="completar" value="Completar"class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
					  Completar
					</button>
				  </div>
			</div>
		</div>	
	</div>
 </div>

</form>



<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>

   


var fila=0;
    var numeroDeFila=0;
    var precioOriginal=0;
    var tipoVentaSelected = 0;
    var paraEnganche = 0;
    var contador=0;
    var precioAño=0;
    // Función para calcular el precio total
    function calcularPrecioTotal(cantidad) {
        return cantidad * precioOriginal;
    }
  
   

    //SELECCION DE ARTICULO Y LISTA 
$(document).ready(function () {

    function calcularTotalAPagar() {
  var total = 0;
  var enganche = 0;
    
  $('#articulos-lista tbody tr').each(function () {
    var cantidad = parseFloat($(this).find('[id^="cantidad"]').val()) || 0;

    
    var precioOriginal = tableArticulosSeleccionados.row(this).data().precioOriginal;
    var enganche1 = tableArticulosSeleccionados.row(this).data().enganche;
    var tipoVenta = $(this).find("[id^=fkTipoVenta]").val();


    total += isNaN(cantidad) ? 0 : cantidad * precioOriginal;
    console.log(precioAño);
    // Establecer paraEnganche al 10% del precioOriginal si el tipoVenta es 4 (primera vez)

    // Calcular el enganche basado en el valor de paraEnganche
    if (tipoVenta === "1") {
      // Si el tipo de venta es 1, el enganche es 0
      enganche += 0;
    } else {
      // De lo contrario, calcular el enganche usando el valor de paraEnganche
      enganche += isNaN(cantidad) ? 0 : cantidad * enganche1;
    }
  });

  $('.totalPago').text('$' + total.toFixed(2));
  $('.totalEnganche').text('$' + enganche.toFixed(2));
}


    calcularTotalAPagar();
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

        tableArticulos.column(4).search(estatus).draw();
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

     $('#tablaArticulos tbody').on('click', 'tr', function () {
        var checkbox = $(this).find('.seleccionar-articulo');
        checkbox.prop('checked', !checkbox.prop('checked'));
        var tipoVentaSeleccionado = $(this).find("[id^='fkTipoVenta']").val();
        var fila = $(this);
        var data = tableArticulos.row(this).data();
        

 
        var articuloId = data[0];
         
 
   // Move this line above to define precioCell before using it
   var row = tableArticulosSeleccionados.row.add([
    data[0],
    data[1],
    data[2],
    data[3],
 
    `<td><input type="number" class="cantidad${articuloId} bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" id="cantidad${articuloId}" name="cantidades[]" value="1" min="1"></td>`,
   
    `<td>
        <select data-articulo-id="${articuloId}" id="fkTipoVenta${articuloId}" name="fkTipoVenta" class="p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" required>
            <?php foreach ($datosTipoVenta as $opcion): ?>
                <option value="<?= $opcion->pkTipoVenta ?>" <?= $opcion->pkTipoVenta == 4 ? 'selected' : '' ?>><?= $opcion->nombreTipoVenta ?></option>
            <?php endforeach; ?>
        </select>
    </td>`,
    data[5],
    `<button class="cancelar-articulo flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400" data-articulo-id="${articuloId}">Cancelar</button>`
]).draw();
    
        actualizarCamposOcultos();
            // Guardar precio original en la estructura de DataTable
        var rowData = row.data();
        rowData.precioOriginal = data[3];
        rowData.enganche = data[5];
        tipoVentaSeleccionado = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 5 }).node().getElementsByTagName('select')[0].value;
        // Calcular el total a pagar después de actualizar cantidad y precio
    calcularTotalAPagar();

    });

    function precioOriginalazo(articuloId, tipoVentaSeleccionado, callback) {
    $.ajax({
        url: '/obtener-cantidad-tipo-venta/' + articuloId + '/' + tipoVentaSeleccionado,
        method: 'GET',
        success: function (data) {
            // Actualizar el precio original en la estructura de DataTable
            tableArticulosSeleccionados.row(numeroDeFila).data().precioOriginal = data.cantidadTipoVenta;
            console.log("precio original multiplicado" + data.cantidadTipoVenta);
               
       
            // Llamar al callback con el valor actualizado
            callback(data.cantidadTipoVenta);
       
        },
        error: function () {
            console.log('Error al obtener la cantidadTipoVenta');
            // Llamar al callback con un valor predeterminado o manejar el error
            callback(0);
        }
    });
}

$(document).on('change', '[id^="cantidad"]', function () {
    var fila = $(this).closest('tr');
    numeroDeFila = tableArticulosSeleccionados.row(fila).index();

    var cell = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 3 });
    var articuloId = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 0 }).data();
    
    // Obtener el tipo de venta seleccionado
    var tipoVentaSeleccionado = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 5 }).node().getElementsByTagName('select')[0];
    var valorTipoVenta = $(tipoVentaSeleccionado).val();

    // Obtener el precio original guardado en la estructura de DataTable
    var precioOriginal = tableArticulosSeleccionados.row(numeroDeFila).data().precioOriginal;

    // Llamar a la función para obtener el precio actualizado
    precioOriginalazo(articuloId, valorTipoVenta, function (precioUso) {
        console.log(precioUso);
          // Obtener la cantidad ingresada as a floating-point number
        var cantidad = parseFloat($(this).val());

        // Calcular el nuevo precio y actualizar la celda
        cell.data(precioUso * cantidad).draw();
   
        calcularTotalAPagar();
    }.bind(this));
    actualizarCamposOcultos();
});


   
    $(document).on('change', '[id^="fkTipoVenta"]', function () {
        var tipoVentaSeleccionado = $(this).val();
        var articuloId = $(this).data('articulo-id');
        var fila = $(this).closest('tr');

        // Obtiene el número de fila
        var numeroDeFila = tableArticulosSeleccionados.row(fila).index();
        console.log("Número de fila: " + numeroDeFila);

        // Obtener referencia al input número
        var inputCantidad = $('#cantidad' + articuloId);

        // Asignar valor 1
        inputCantidad.val(1);

        // Actualizar el precio y cantidad
        actualizarPrecioYCantidad(articuloId, tipoVentaSeleccionado, numeroDeFila);
        calcularTotalAPagar();
        actualizarCamposOcultos();
    });
    $('#articulos-lista tbody').on('click', 'button.cancelar-articulo', function () {
        
    var filaCancelada = $(this).closest('tr');
    var cantidadCancelada = parseFloat(filaCancelada.find('[id^="cantidad"]').val()) || 0;
    var precioOriginal = parseFloat(tableArticulosSeleccionados.row(filaCancelada).data().precioOriginal) || 0;
    var enganche1 = parseFloat(tableArticulosSeleccionados.row(filaCancelada).data().enganche) || 0;

    // Restar la cantidad cancelada del total
    var totalActual = parseFloat($('.totalPago').text().replace('$', '')) || 0;
    var nuevoTotal = totalActual - (cantidadCancelada * precioOriginal);
    $('.totalPago').text('$' + nuevoTotal.toFixed(2));

    // Restar la cantidad cancelada del enganche si es aplicable
    if (tipoVentaSelected !== "1") {
        var engancheActual = parseFloat($('.totalEnganche').text().replace('$', '')) || 0;
        var nuevoEnganche = engancheActual - (cantidadCancelada * enganche1);
        $('.totalEnganche').text('$' + nuevoEnganche.toFixed(2));
    }



        var articuloId = $(this).data('articulo-id');
        tableArticulosSeleccionados.row($(this).closest('tr')).remove().draw();
        actualizarCamposOcultos(articuloId);
        
      
    });


 
   


    function actualizarPrecioYCantidad(articuloId, tipoVentaSeleccionado) {
    $.ajax({
        url: '/obtener-cantidad-tipo-venta/' + articuloId + '/' + tipoVentaSeleccionado,
        method: 'GET',
        success: function (data) {
       
                        // Asegúrate de obtener correctamente el artículoId
          // O cualquier otra forma de obtenerlo
        console.log("la fila"+numeroDeFila)
        
        // Encuentra la celda correspondiente a cantidadTipoVenta en la fila actual
        var cellCantidadTipoVenta = tableArticulosSeleccionados.cell({ row: numeroDeFila, column: 3 });
    
        // Cambia el contenido de la celda con el nuevo valor de cantidadTipoVenta
        cellCantidadTipoVenta.data(data.cantidadTipoVenta).draw();
        tableArticulosSeleccionados.row(numeroDeFila).data().precioOriginal = data.cantidadTipoVenta;
        actualizarCamposOcultos();
            // Calcular el total a pagar después de actualizar cantidad y precio
        calcularTotalAPagar();
                console.log(data.cantidadTipoVenta);
                console.log('Elemento buscado:', '.precio-' + articuloId);
           

            // Puedes llamar a calcularTotales() aquí si es necesario
        },
        error: function () {
            console.log('Error al obtener la cantidadTipoVenta');
        }
    });
}
var clienteSeleccionadoGlobal = null;

function actualizarCamposOcultos() {
    // Elimina el campo oculto #cliente existente
    $('#formulario').find('input[name="cliente[]"]').remove();

    // Limpia campos ocultos existentes antes de agregar nuevos
    $('#formulario').find('input[name^="producto_id"]').remove();
    $('#formulario').find('input[name^="cantidadotas"]').remove();
    $('#formulario').find('input[name^="tipoVenta"]').remove();

    // Agrega los nuevos campos ocultos
    $('#articulos-lista tbody tr').each(function () {
        var articuloId = $(this).find("[id^=fkTipoVenta]").data("articulo-id");
        var cantidad = $(this).find("[id^=cantidad]").val() || 0;
        var tipoVenta =  $(this).find("[id^=fkTipoVenta]").val() || 0;

        // Agrega nuevos campos ocultos al formulario
        $('#formulario').append(
            "<input type='hidden' name='producto_id[]' value='" + articuloId + "'>",
            "<input type='hidden' name='cantidadotas[]' value='" + cantidad + "'>",
            "<input type='hidden' name='tipoVenta[]' value='" + tipoVenta + "'>",
            "<input type='hidden' name='cliente[]' value='" + clienteSeleccionadoGlobal + "'>"
        );
    });
}

$('#completar').click(function () {
    // Obtiene el cliente seleccionado
    clienteSeleccionadoGlobal = $('input[name="cliente-seleccionado"]:checked').data('cliente-id');
    console.log("cliente seleccionado pk: " + clienteSeleccionadoGlobal);

    // Asigna el valor del cliente al campo oculto #cliente
    console.log('el valor enviado:'+ clienteSeleccionadoGlobal);
    actualizarCamposOcultos();

    // Envía el formulario
    $('#formulario').submit();
});
});



////////////////FILTRO DE UBICACIONES ////////////////////////////////////////////



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
        "responsive":true,
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "pageLength": 10, 
        "autoWidth": true
    });
    $('#limpiarFiltros').on('click', function () {
            $('#fkMunicipio, #fkColonia, #fkCalle').val('');
            dataTable.search('').columns().search('').draw();
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
                console.log(fkColonia, fkCalle);
                dataTable.clear().draw();

                // Agregar nuevos resultados
                data.forEach(function (dato) {
                    var resultadoHtml = `
                        <tr>
                            <td>${dato.nombreCliente}</td>
                            <td>${dato.nombreMunicipio}</td>
                            <td>${dato.nombreColonia}</td>
                            <td>${dato.calle}</td>
                            <div>
                            <td>
                                <div class="flex md:justify-center mt-5 md:mt-0">
                                    <input type="radio" class="w-6 h-6 rounded text-green-400 bg-gray-100 border-gray-300 focus:ring-green-400 focus:ring-2" name="cliente-seleccionado" class="seleccionar-cliente" data-cliente-id="${dato.pkCliente}"></td>
                                </div>
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
});

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
</body>