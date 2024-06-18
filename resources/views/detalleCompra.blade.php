<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Maderas El Pino</title>
	<link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
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
		window.location.href = "{{url('/')}}";
	</script>
	@endif
	@else
	<script>
		window.location.href = "{{url('/')}}";
	</script>
	@endif


	<div class="p-4 sm:ml-64 mt-16 md:mt-10">
		<!-- Guias del tamaño del contenedor -->
		<div class="p-4">
			<!-- PON EL CODIGO DEL MODULO AQUI-->
			<div class="bg-white rounded-lg shadow-lg p-4">
				<div class="flex justify-start">
					<a href="{{ url()->previous() }}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
						Regresar
					</a>
				</div>
				<h1 class="text-center font-bold text-2xl p-5">{{$compra->nombreCliente}}</h1>
				<div>
					<div class="flex justify-center font-semibold">
						<h2>Domicilio: <h3 class="ml-2"> {{ $compra->nombreMunicipio }} {{ $compra->nombreColonia }} {{ $compra->nombreCalle }}{{ $compra->numCasa }}</h3>
						</h2>
					</div>
					<div class="flex justify-center font-semibold">
						<h2>Descripcion Domicilio: <h3 class="ml-2">{{$compra->descripcionDomicilio}}</h3>
						</h2>
					</div>
					<div class="flex justify-center font-semibold">
						<h2>Telefono: <h3 class="ml-2">{{$compra->telefono}}</h3>
						</h2>
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
				<h1 class="text-center font-bold text-2xl">Compra</h1>
				<div class="mt-10">
					@php
					use App\Models\tipoVenta;
					$datosVenta = tipoVenta::all();
					@endphp
					@if(session('fkTipoUsuario') == 1)

					<div class="bg-white rounded-lg shadow-lg p-4">
						<form id="formulario" action="{{ route('compra.actualizar', ['pkCompra' => $compra->pkcomprasCliente]) }}" enctype="multipart/form-data" method="post">
							@csrf
							<div class="ml-2 p-2 pt-5 mt-10">
								<h2 class="font-semibold text-2xl text-center">Actualizar Compra </h2>
								<div class="grid grid-cols-1 gap-4 text-justify">
									<div class="p-2">
										<label for="" class="block mb-2 text-sm font-medium text-gray-900">Tiempo De Pago</label>
										<div>
											<select name="fkTipoVenta" id="tipoVenta" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
												<option value="">Selecciona Tipo de Venta</option>
												@foreach ($datosVenta as $ventita)
												<option {{ $ventita->pkTipoVenta == $compra->pkTipoVenta ? 'selected' : '' }} value="{{ $ventita->pkTipoVenta }}">
													{{ $ventita->nombreTipoVenta }}
												</option>
												@endforeach
											</select>
										</div>
									</div>
									<input type="hidden" value="{{$compra->pkArticulo}}" name="articulito">
									<div class="p-2">
										<label for="" class="block mb-2 text-sm font-medium text-gray-900">Semanas de deuda</label>
										<input type="number" value="{{$compra->diasDeuda}}" name="deuda" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" placeholder="" required>
									</div>
									<div class="p-2">
										<div class="p-2">
											<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad a Saldar</label>
											<input type="number" value="{{$compra->cantidadASaldar}}" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" name="saldar">
										</div>
										<div class="p-2">
											<label for="underline_select" class="sr-only">Selecciona estatus</label>
											<select name="estatus" id="estatus" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
												@foreach ([1, 0, 2] as $valor)
												<option value="{{ $valor }}" {{ $compra->ESTATUSCOMPRA == $valor ? 'selected' : '' }}>
													@if ($valor === 1)
													Pago Pendiente
													@elseif ($valor === 0)
													Pago Completado
													@else
													Pago Vencido
													@endif
												</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="flex md:justify-end justify-center">
									<div class="mt-5 flex md:justify-end justify-center">
										<button type="submit" class="w-full flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
											<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" width="800px" height="800px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
												<path d="m16 0c8.836556 0 16 7.163444 16 16s-7.163444 16-16 16-16-7.163444-16-16 7.163444-16 16-16zm6.4350288 11.7071068c-.3905242-.3905243-1.0236892-.3905243-1.4142135 0l-6.3646682 6.3632539-3.5348268-3.5348268c-.3905242-.3905243-1.0236892-.3905243-1.41421352 0-.39052429.3905243-.39052429 1.0236893 0 1.4142136l4.24264072 4.2426407c.3905243.3905242 1.0236892.3905242 1.4142135 0 .0040531-.0040531.0080641-.0081323.012033-.0122371l7.0590348-7.0588308c.3905243-.3905242.3905243-1.0236892 0-1.4142135z" fill="currentColor" fill-rule="evenodd" />
											</svg>
											<p class="flex-1 ms-3 whitespace-nowrap">Aplicar</p>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					@endif


					<div class="grid grid-cols-2 text-justify mt-10">
						<h2 class="font-semibold">Fecha: 
							<p class="font-normal">{{$compra->fecha}}</p>
						</h2>
						<h2 class="font-semibold md:ml-[20rem] ml-10">Tiempo de pago: 
							<p class="font-normal"> @if($compra->pkTipoVenta == 1)
								Al contado
								@elseif($compra->pkTipoVenta == 2)
								Al Mes
								@elseif($compra->pkTipoVenta == 3)
								A dos meses

								@elseif($compra->pkTipoVenta == 4)
								A un Año
								@endif
							</p>
						</h2>
						<h2 class="font-semibold ">Por saldar: 
							<p class="font-normal">{{$compra->cantidadASaldar}}</p>
						</h2>
						<h2 class="font-semibold md:ml-[20rem] ml-10">Semanas Deuda: 
							<p class="font-normal">{{$compra->diasDeuda}}</p>
						</h2>
						<h2 class="font-semibold">Articulo(s): 
							<p class="font-normal">{{$compra->nombreArticulo}}</p>
						</h2>
						<h2 class="font-semibold md:ml-[20rem] ml-10">Enganche:
							<p class="font-normal">{{$compra->enganche}}</p>
						</h2>
						<h2 class="font-semibold">Valor: 
							<p class="font-normal">{{$compra->cantidadTipoVenta}}</p>
						</h2>
						<h2 class="font-semibold md:ml-[20rem] ml-10">Folio: 
							<p class="font-normal">{{$compra->folioCompra}}</p>
						</h2>
						<h2 class="font-semibold">Estatus: 
							<p class="font-normal">
								@if($compra->ESTATUSCOMPRA == 1)
								Pago pendiente
								@elseif($compra->ESTATUSCOMPRA == 2)
								Vencido
								@else
								Pago completado
								@endif
							</p>
						</h2>
					</div>
				</div>
				<div class="grid grid-cols-1 md:grid-cols-3 mt-10 border border-gray-200 p-5 rounded-lg">
					<div class="flex justify-center">
						<div class="mt-5 md:-mt-0">
							<div>
								<h1>Cada 8 dias</h1>
							</div>
							<div class="text-center">
								<p>100</p>
							</div>
						</div>
					</div>
					<div class="flex justify-center mt-5 md:-mt-0">
						<div class="">
							<div>
								<h1>Cada 8 dias</h1>
							</div>
							<div class="text-center">
								<p>100</p>
							</div>
						</div>
					</div>
					<div class="flex justify-center mt-5 md:-mt-0">
						<div class="">
							<div>
								<h1>Cada 8 dias</h1>
							</div>
							<div class="text-center">
								<p>100</p>
							</div>
						</div>
					</div>
				</div>
				<div class="flex mt-5 justify-start">
					<div class="md:mt-5">
						<a href="{{ route('cliente.abonos', ['pkCompra' => $compra->pkComprasCliente, 'vista' => 'formularioAbono']) }}" class="w-full flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
							<svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" fill="currentColor" width="800px" height="800px" viewBox="-2 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
								<path d="M13.112 7.798a1.112 1.112 0 0 1 1.108 1.108v.674a1.112 1.112 0 0 1-1.108 1.108h-.52a4.657 4.657 0 0 1-1.134 1.848q-.118.117-.243.226v1.966a.476.476 0 0 1-.475.475H9.281a.476.476 0 0 1-.475-.475v-.873a4.664 4.664 0 0 1-.64.044H6.212a4.664 4.664 0 0 1-.641-.044v.873a.476.476 0 0 1-.475.475H3.637a.476.476 0 0 1-.475-.475v-1.966q-.125-.109-.243-.226a4.656 4.656 0 0 1-1.275-2.39.904.904 0 0 1 0-1.806 4.656 4.656 0 0 1 4.568-3.754h1.954a4.653 4.653 0 0 1 .939.096l2.545-1.481a.253.253 0 0 1 .378.25.256.256 0 0 1-.027.087 4.345 4.345 0 0 0-.47 2.486 4.657 4.657 0 0 1 1.061 1.774h.52zM9.037 5.876a.475.475 0 0 0-.475-.475H5.984a.475.475 0 1 0 0 .95h2.578a.475.475 0 0 0 .475-.475zm-.248 5.141a1.142 1.142 0 0 0-.283-.75 1.533 1.533 0 0 0-.426-.34 1.792 1.792 0 0 0-.441-.16 1.924 1.924 0 0 0-.405-.041 1.475 1.475 0 0 1-.245-.02.936.936 0 0 1-.256-.082.606.606 0 0 1-.193-.155.385.385 0 0 1-.091-.232.392.392 0 0 1 .22-.329 1.114 1.114 0 0 1 .571-.153 1.168 1.168 0 0 1 .203.033l.024.006a1.28 1.28 0 0 1 .244.085.683.683 0 0 1 .198.136.396.396 0 1 0 .56-.561 1.477 1.477 0 0 0-.433-.297 2.035 2.035 0 0 0-.4-.137l-.011-.002v-.3a.396.396 0 0 0-.792 0v.288a1.813 1.813 0 0 0-.588.233 1.182 1.182 0 0 0-.588.998 1.166 1.166 0 0 0 .268.731 1.388 1.388 0 0 0 .454.364 1.71 1.71 0 0 0 .48.156 2.262 2.262 0 0 0 .375.03 1.128 1.128 0 0 1 .237.023.975.975 0 0 1 .24.087.746.746 0 0 1 .2.16.355.355 0 0 1 .086.229c0 .051 0 .17-.2.3a1.128 1.128 0 0 1-.585.163 1.832 1.832 0 0 1-.254-.031 1.24 1.24 0 0 1-.237-.076.497.497 0 0 1-.186-.143.396.396 0 0 0-.599.518 1.276 1.276 0 0 0 .49.36 1.926 1.926 0 0 0 .396.12l.01.003v.295a.396.396 0 1 0 .793 0v-.3a1.827 1.827 0 0 0 .602-.244 1.125 1.125 0 0 0 .562-.965z" />
							</svg>
							<p class="flex-1 ms-3 whitespace-nowrap">Abonar</p>
						</a>
					</div>
				</div>
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
				<div>

					<div class="p-5">
						<div class="flex justify-center md:justify-normal items-center mt-8">
							<form class="w-[13rem] md:w-[30rem]">
								<label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
								<div class="relative">
									<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
										<svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
											<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
										</svg>
									</div>
									<input id="busqueda" name="busqueda" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
								</div>
							</form>
						</div>
						<div class="grid grid-cols-1 gap-4 mt-10">
							<div class="relative w-full">
								<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
									<svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
										<path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
									</svg>
								</div>
								<input datepicker type="date" id="dia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full ps-10 p-2.5" placeholder="Fecha">
							</div>

							<div class="relative w-full">
								<div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
									<svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
										<path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
									</svg>
								</div>
								<input datepicker type="date" id="mes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full ps-10 p-2.5" placeholder="Fecha">
							</div>
							<label for="underline_select" class="sr-only">Cobrador</label>
							<select name="cobrador" id="cobrador" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-green-400 peer">
								@php
								use App\Models\Empleado;
								$datosEmpleado=Empleado::all();
								@endphp
								<option value="">Selecciona Municipio</option>
								@foreach ($datosEmpleado as $dato)
								<option value="{{$dato->nombreEmpleado}}">{{$dato->nombreEmpleado}}</option>
								@endforeach
							</select>
							<div class="flex mt-3">
								<button type="button" id="limpiarFiltros" class="limpiarFiltros flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
									Limpiar filtros
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="flex justify-end mt-5">
					<button id="imprimir" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
						imprimir
					</button>
				</div>
				<table id="tablaAbonos" class="tablaCompras" class="w-full table-auto mt-[1rem]" id="miTabla" class="display nowrap" width="90%">
					<thead class="text-center">
						<tr class="h-24 text-center">
							<th>Fecha</th>
							<th>Folio</th>
							<th>Abono</th>
							<th>Saldo</th>
							<th>Cobrador</th>
						</tr>
					<tbody>
						@foreach ($abonos as $dato )
						<tr class="h-20">
							<td>{{$dato->FECHAABONO}}</td>
							<td>{{$dato->folioAbono}}</td>
							<td>{{$dato->abono}}</td>
							<td>{{$dato->Saldo}}</td>
							<td>
								{{$dato->nombreEmpleado}}
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
							<button id="nextBtn" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
								Siguiente
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
	<script src="../node_modules/flowbite/dist/datepicker.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			$('#imprimir').on('click', function() {
				// Abre una nueva ventana para imprimir
				var printWindow = window.open('', '_blank');
				printWindow.document.write('<!DOCTYPE html>');
				printWindow.document.write('<html><head>');
				printWindow.document.write('<title>Imprimir</title>');
				printWindow.document.write('<style>');
				// Estilos generales
				printWindow.document.write('body { font-family: Arial, sans-serif; color: #333; }');
				printWindow.document.write('.container { max-width: 800px; margin: 0 auto; padding: 20px; border: 2px solid #0E9F6E; border-radius: 10px; background-color: #f9f9f9; }');
				printWindow.document.write('.header { text-align: center; font-size: 10px; margin-bottom: 10px; color: black; }');
				printWindow.document.write('.info { border: 2px solid #0E9F6E; padding: 10px; margin-bottom: 20px; border-radius: 10px; background-color: #fff; }');
				printWindow.document.write('.info p { margin: 5px 0; }');
				printWindow.document.write('table { width: 100%; border-collapse: collapse; border: 2px solid #0E9F6E; border-radius: 10px; background-color: #fff; }');
				printWindow.document.write('table, th, td { border: 1px solid #ddd; padding: 8px; }');
				printWindow.document.write('th, td { text-align: left; }');
				// Estilos específicos
				printWindow.document.write('.highlight { color: black; }');
				printWindow.document.write('.svg-container { position: absolute; top: 20px; left: 20px; }');
				printWindow.document.write('</style>');
				printWindow.document.write('</head><body>');
				printWindow.document.write('<div class="container">');

				// Espacio para el SVG
				printWindow.document.write('<div class="svg-container">');
				printWindow.document.write(`<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="100" height="100" viewBox="0 0 720 720" enable-background="new 0 0 720 720" xml:space="preserve">
	   <path fill="#0E9F6E" opacity="1.000000" stroke="none" 
		   d="
	   M269.999939,547.320068 
		   C229.261429,547.320618 189.022903,547.320618 148.914673,547.320618 
		   C148.203094,543.960266 149.703812,542.226013 150.748672,540.414612 
		   C174.875854,498.586212 199.009735,456.761688 223.194489,414.966553 
		   C241.203979,383.843292 259.330109,352.787476 277.326599,321.656708 
		   C303.496552,276.387238 329.597748,231.078003 355.720886,185.781479 
		   C356.464813,184.491547 356.946503,182.785522 358.616608,182.592621 
		   C360.796875,182.340775 361.084320,184.450439 361.880676,185.825882 
		   C391.080048,236.258804 420.245941,286.711151 449.475403,337.126617 
		   C474.940277,381.048889 500.511169,424.909698 525.966248,468.837646 
		   C540.075928,493.186768 554.046814,517.616333 568.068542,542.016357 
		   C568.798950,543.287415 569.770630,544.499512 569.376648,547.319580 
		   C469.842865,547.319580 370.171417,547.319580 269.999939,547.320068 
	   M262.663727,500.868195 
		   C268.358337,510.266022 274.160126,519.601257 279.696655,529.091309 
		   C282.031158,533.092834 284.896393,534.831970 289.733612,534.813904 
		   C335.550598,534.642273 381.369049,534.607422 427.185577,534.835815 
		   C433.335510,534.866455 436.807037,532.822144 439.777863,527.437744 
		   C455.782684,498.429688 472.048706,469.563538 488.512817,440.813416 
		   C491.100983,436.293884 490.422607,432.948303 488.001190,428.927643 
		   C481.646301,418.375671 475.507141,407.692841 469.346191,397.025116 
		   C450.527771,364.440857 431.680817,331.872711 413.010620,299.203613 
		   C410.549713,294.897491 407.539978,293.119202 402.596588,293.273438 
		   C389.448944,293.683746 376.283051,294.053741 363.136200,293.808044 
		   C346.331940,293.494019 329.539490,293.833313 312.741821,293.853729 
		   C309.108521,293.858154 306.956055,295.388916 305.206421,298.455353 
		   C292.171906,321.299255 279.052368,344.094818 265.912537,366.878448 
		   C253.186371,388.944824 240.418579,410.987183 227.630814,433.017883 
		   C225.778183,436.209595 224.953217,439.000824 227.216599,442.655029 
		   C239.051346,461.762115 250.616364,481.036285 262.663727,500.868195 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M456.971039,159.016708 
		   C463.897400,154.641159 469.861694,149.032333 475.863556,143.567657 
		   C479.867218,139.922348 482.871307,140.930176 486.902588,143.121048 
		   C491.003326,145.349686 491.904968,147.982529 491.030243,152.412415 
		   C489.781189,158.738159 488.176575,165.053452 488.024139,172.238739 
		   C493.426575,167.858139 497.107635,162.610748 500.844604,157.520950 
		   C503.375305,154.074036 505.263702,153.964554 508.437897,156.647064 
		   C516.297424,163.289337 516.360046,163.156448 512.465027,172.916473 
		   C511.821899,174.527969 510.491241,176.065918 511.411774,178.700455 
		   C514.515564,176.473999 517.556396,174.531845 520.313049,172.246887 
		   C522.993347,170.025299 525.218140,170.121765 527.769958,172.416702 
		   C536.922546,180.648041 537.192688,177.531433 529.538879,187.343948 
		   C526.188354,191.639450 521.995422,195.327271 519.295593,201.020584 
		   C522.400513,200.501709 524.054016,198.681000 525.816040,197.153473 
		   C529.842102,193.663345 533.836182,190.134491 537.774170,186.545517 
		   C539.558533,184.919250 541.026672,184.578415 542.787292,186.645294 
		   C546.997009,191.587479 551.583313,196.227676 555.557739,201.346802 
		   C560.564392,207.795395 558.540100,213.826477 550.726746,216.341949 
		   C547.497253,217.381699 546.342163,218.939163 548.010864,222.613861 
		   C552.706848,220.518982 556.827087,217.767548 560.733459,214.806000 
		   C564.230469,212.154816 566.166138,213.098175 568.181213,216.546036 
		   C569.936768,219.549957 572.187927,221.999313 567.556396,224.603363 
		   C563.213623,227.045059 559.214661,230.091934 555.010864,232.789246 
		   C552.225464,234.576523 551.672424,236.745605 553.494324,239.512817 
		   C553.677246,239.790649 553.847717,240.076691 554.023743,240.359070 
		   C560.262634,250.365555 560.262634,250.365570 570.903015,245.287766 
		   C581.708862,240.131027 581.722839,240.123947 587.098816,250.807816 
		   C589.044739,254.675186 590.862122,258.607483 592.820618,262.468292 
		   C594.215149,265.217499 595.094543,267.426086 591.213989,269.215668 
		   C587.742859,270.816406 585.951294,269.971741 584.620239,266.714325 
		   C583.930420,265.026306 583.058594,263.407990 582.198853,261.795593 
		   C581.532288,260.545441 581.196777,258.841644 578.908386,259.141205 
		   C577.616089,261.677948 579.592712,263.456299 580.569519,265.368622 
		   C582.068420,268.303314 582.252686,270.676819 578.845459,272.433441 
		   C575.394287,274.212769 573.796753,272.667786 572.278625,269.636200 
		   C571.079529,267.241760 570.683411,264.087952 566.964905,262.670258 
		   C565.356323,267.413635 569.180542,270.374664 570.197144,274.007843 
		   C571.405579,278.326691 577.219666,277.257812 578.348328,281.421906 
		   C579.021423,281.141541 579.472900,281.102051 579.596008,280.880341 
		   C582.213196,276.166107 585.796021,272.948700 591.582520,273.716553 
		   C597.365356,274.483917 599.644531,278.954498 601.648315,283.697144 
		   C603.393860,287.828766 603.980530,292.062958 602.848267,296.380402 
		   C602.116516,299.171021 600.672119,301.689484 597.622986,302.602112 
		   C594.538635,303.525208 594.960144,299.605194 592.787048,299.006134 
		   C591.019043,299.066681 591.173828,300.786743 590.670410,301.872925 
		   C587.025940,309.737030 577.794739,311.006714 572.436768,304.195282 
		   C568.717712,299.467285 567.158875,293.813110 566.960083,287.895386 
		   C566.866760,285.119141 567.063599,282.718903 564.055054,281.145660 
		   C562.926086,280.555298 562.310608,278.793488 561.684204,277.460846 
		   C554.691895,262.584503 548.381897,247.344604 538.529846,233.998215 
		   C537.326050,232.367401 537.020020,230.760071 537.840515,228.817749 
		   C528.034424,225.003448 523.131287,216.098572 517.006348,208.637253 
		   C514.612549,205.721146 511.743988,203.731369 508.974182,201.506271 
		   C506.343170,199.392746 505.676483,197.659149 508.218475,195.041763 
		   C509.796051,193.417389 510.992950,191.423309 511.751068,188.832169 
		   C509.849701,190.012711 507.783905,190.996567 506.083862,192.417908 
		   C503.226959,194.806427 500.904480,195.034348 497.826294,192.442093 
		   C494.911530,189.987488 495.426514,187.836197 496.774658,185.036789 
		   C497.898895,182.702255 498.649170,180.187637 499.705444,177.379623 
		   C495.848419,179.718613 494.294678,185.328827 490.621979,185.132187 
		   C487.162598,184.946945 483.913513,181.252686 480.525543,179.177963 
		   C477.963593,177.609100 475.394043,176.350311 475.553345,172.500168 
		   C475.640686,170.388443 468.280426,165.600540 466.609741,166.714325 
		   C461.148529,170.355103 458.121857,165.877899 454.402802,163.951950 
		   C453.870544,161.574158 455.951538,160.948227 456.837402,159.279449 
		   C456.994751,158.999786 456.971039,159.016708 456.971039,159.016708 
	   M536.040039,215.190414 
		   C539.594604,211.723328 535.314026,210.611847 533.987549,208.718643 
		   C533.221924,207.625885 531.737915,207.627090 531.063782,208.847031 
		   C529.678955,211.353165 531.811218,212.753159 533.235718,214.233032 
		   C533.761047,214.778793 534.679504,214.946121 536.040039,215.190414 
	   M474.453888,160.495621 
		   C475.547882,161.168442 476.491913,162.281250 478.208099,161.667465 
		   C479.010071,159.696274 480.169464,157.711609 479.082886,154.632141 
		   C477.031464,156.474518 474.344971,156.936584 474.453888,160.495621 
	   M546.014648,203.718811 
		   C545.091492,201.941772 544.152405,200.182129 541.660645,199.787689 
		   C539.445679,201.966354 540.861145,203.624771 542.528442,205.101685 
		   C543.966858,206.375854 545.475952,207.020737 546.014648,203.718811 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M153.012787,267.214478 
		   C148.199036,261.761505 143.728806,256.369354 138.882431,251.339676 
		   C134.833725,247.137802 138.420822,244.130035 139.876221,240.649017 
		   C141.260986,237.336914 143.473877,236.364487 146.993500,236.977997 
		   C154.810226,238.340515 162.679611,239.400925 172.053604,240.814651 
		   C166.745911,235.372101 161.515656,232.187958 156.765182,228.453232 
		   C148.951065,222.309982 149.044250,224.249069 154.996628,216.147614 
		   C157.359131,212.932129 159.581772,209.593811 162.598267,206.908340 
		   C168.989456,201.218506 175.566437,201.357117 183.857040,207.376434 
		   C190.704971,212.348328 192.765091,219.388992 189.301178,226.631287 
		   C188.234161,228.862183 186.793106,230.935394 185.361099,232.966431 
		   C181.531769,238.397537 177.094498,243.414413 174.208252,249.482834 
		   C173.621582,250.716324 172.856628,251.678223 171.427017,252.126312 
		   C164.668854,254.244568 162.992767,257.381653 164.999069,264.162415 
		   C165.430359,265.620087 164.864624,266.745789 164.292252,267.950012 
		   C162.508881,271.702118 160.553604,275.387756 159.031372,279.243774 
		   C157.891373,282.131531 156.311493,282.505798 153.629562,281.486267 
		   C149.958374,280.090637 146.175369,278.989227 141.017059,277.294006 
		   C145.792023,280.534790 149.258820,283.049164 152.889755,285.298645 
		   C155.570374,286.959351 155.771805,288.952667 154.754349,291.672272 
		   C153.724777,294.424255 152.543808,296.339172 149.044540,295.862549 
		   C145.441437,295.371826 141.769547,295.386322 137.945404,295.928680 
		   C141.109604,297.002686 144.253555,298.141815 147.443542,299.132782 
		   C150.775848,300.167908 151.418137,302.166077 150.118362,305.256195 
		   C148.947678,308.039459 148.480194,311.075989 143.981430,309.386292 
		   C136.196945,306.462494 128.258789,303.937622 120.337624,301.393158 
		   C117.264175,300.405884 115.940071,299.050964 117.131416,295.585999 
		   C121.603165,282.580078 119.806450,284.044617 131.506470,285.593353 
		   C133.437561,285.848969 135.431534,285.629364 137.835922,284.747406 
		   C134.483215,282.505646 131.236954,280.077698 127.744263,278.080811 
		   C124.924057,276.468353 124.327431,274.764496 125.304619,271.581604 
		   C128.492081,261.199493 128.342056,261.162872 138.609070,264.421661 
		   C143.202835,265.879761 147.802719,267.319733 152.415146,268.717316 
		   C154.063797,269.216888 154.284576,268.679688 153.012787,267.214478 
	   M180.448532,221.856583 
		   C178.937393,218.012146 175.856659,215.820923 172.186768,214.506332 
		   C169.501312,213.544388 167.288345,214.726440 165.869400,217.127747 
		   C164.432922,219.558701 166.456573,220.758606 167.907150,222.019760 
		   C169.277817,223.211441 170.791229,224.241699 172.263428,225.313324 
		   C177.263474,228.952942 178.367249,228.580063 180.448532,221.856583 
	   M153.121323,251.703323 
		   C156.769608,254.084915 156.769608,254.084915 157.984161,249.708664 
		   C156.374466,249.395798 154.752701,248.755707 153.176666,248.853439 
		   C151.026123,248.986755 152.114059,250.288040 153.121323,251.703323 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M457.004028,158.988800 
		   C445.225281,163.834351 433.469666,159.246704 428.141632,147.638992 
		   C426.716888,149.046463 427.116516,152.415695 424.085266,151.910156 
		   C420.733795,151.351196 416.984924,151.405823 415.172791,147.486435 
		   C413.015808,142.821304 410.612427,138.282089 406.902374,133.168289 
		   C405.922333,137.140396 405.009644,140.225647 404.430878,143.372314 
		   C403.934662,146.070267 402.747040,146.929718 399.958801,146.484283 
		   C390.100098,144.909317 380.103394,144.947998 370.168335,144.253220 
		   C364.203949,143.836105 363.425476,143.278336 363.775970,137.445770 
		   C364.264435,129.316940 365.121124,121.210815 365.685944,113.085632 
		   C365.870880,110.425301 367.281586,109.611473 369.608948,109.794289 
		   C377.070953,110.380394 384.525146,111.073105 391.991486,111.593575 
		   C395.094696,111.809875 395.305573,113.719856 395.141876,116.094002 
		   C394.974030,118.528320 394.207581,120.410263 391.313507,120.205673 
		   C388.162415,119.982903 385.024261,119.482300 381.872589,119.398453 
		   C380.067474,119.350426 377.778381,118.493835 376.520569,121.369484 
		   C379.269958,124.080215 382.932861,123.272057 386.152161,123.627304 
		   C389.356995,123.980949 391.587433,124.529419 391.390930,128.530838 
		   C391.187988,132.662766 388.476929,132.339920 385.776306,132.166534 
		   C383.454224,132.017456 381.148773,131.622467 378.827972,131.435867 
		   C377.203339,131.305252 375.698914,131.698151 375.579773,133.665421 
		   C375.468170,135.508652 376.962769,135.692627 378.323730,135.821625 
		   C381.632446,136.135178 384.939240,136.531372 388.256317,136.674652 
		   C391.160645,136.800110 393.988770,136.748611 394.066223,140.865738 
		   C395.837677,133.266663 397.560150,125.655632 399.412506,118.076332 
		   C399.921753,115.992516 399.237396,112.651924 402.507050,112.643822 
		   C405.894073,112.635422 409.679871,112.847145 411.682068,116.481155 
		   C414.319977,121.268883 416.836273,126.123604 419.714172,131.530716 
		   C421.838928,127.834152 421.975433,124.317879 422.646515,121.008789 
		   C423.259460,117.986435 424.826172,117.027084 427.588837,117.937355 
		   C430.173523,118.788979 434.127289,118.265846 433.077942,123.103134 
		   C431.743988,129.252365 429.919891,135.312042 429.427582,141.835587 
		   C433.892059,143.618607 439.192047,143.886047 441.060944,149.765427 
		   C441.751282,151.937210 444.757538,152.039169 446.994690,152.111496 
		   C447.997253,149.503616 446.379150,148.659027 445.070862,147.702744 
		   C443.189392,146.327484 441.166077,145.130096 439.378998,143.645309 
		   C435.629333,140.529892 432.692413,136.977325 434.637970,131.607361 
		   C436.490845,126.493118 440.095795,124.281052 446.518951,124.738930 
		   C452.370544,125.156052 457.505066,127.593872 461.415619,131.954468 
		   C463.795959,134.608749 465.471191,138.002319 462.866913,141.426926 
		   C461.471344,143.262070 454.596222,140.583984 453.208893,137.462555 
		   C451.930878,134.587067 450.230194,133.347382 446.996429,133.882812 
		   C446.386902,136.890656 448.708099,137.668076 450.346283,138.837097 
		   C452.235657,140.185333 454.440338,141.179703 456.085327,142.766129 
		   C461.219818,147.717636 461.409302,151.433105 457.124390,158.686127 
		   C456.971039,159.016708 456.994751,158.999786 457.004028,158.988800 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M222.570160,193.589798 
		   C214.293961,199.127167 208.310257,206.598145 201.584518,213.254456 
		   C198.513565,216.293686 196.469711,216.458725 193.458191,213.187714 
		   C187.934616,207.188232 182.085236,201.479752 176.211823,195.815735 
		   C173.858276,193.546082 173.893097,191.873840 176.199554,189.628036 
		   C181.208984,184.750305 186.074509,179.722198 190.918488,174.678375 
		   C192.929413,172.584473 194.642334,171.559296 197.091339,174.249466 
		   C199.178024,176.541687 201.016296,178.361176 197.685165,181.119339 
		   C195.257782,183.129211 193.088638,185.467560 190.926407,187.773880 
		   C189.886826,188.882736 188.098404,189.923004 189.694870,192.229294 
		   C193.098923,191.827194 194.735825,188.927063 196.791656,186.783142 
		   C199.292709,184.174866 201.294739,182.042252 204.874588,185.695816 
		   C208.430145,189.324585 205.342133,190.809174 203.311249,192.841507 
		   C201.780945,194.372910 200.215546,195.870667 198.723816,197.438629 
		   C197.871246,198.334747 197.328629,199.435532 198.314377,200.541901 
		   C199.547653,201.926056 200.680313,201.174240 201.721954,200.173645 
		   C204.364380,197.635315 207.055328,195.144592 209.624405,192.533997 
		   C210.933823,191.203476 212.179993,189.996246 214.860703,191.139343 
		   C209.846390,184.369797 205.442657,178.314102 200.908661,172.357513 
		   C199.076569,169.950562 198.747040,168.212036 201.654800,166.261566 
		   C206.628662,162.925217 211.195358,158.965576 216.251709,155.772263 
		   C223.974518,150.894989 233.118790,155.282043 232.564896,164.185211 
		   C232.131561,171.150986 236.345657,171.474213 241.343063,173.492615 
		   C240.166428,164.980484 239.160156,157.162064 237.985886,149.368927 
		   C236.967850,142.612625 240.702194,137.621277 247.521561,136.865814 
		   C248.784363,136.725906 249.807220,137.169952 250.708359,137.980179 
		   C258.723602,145.186813 266.734406,152.398407 275.508728,160.294449 
		   C270.573547,162.371826 267.856049,167.792877 261.785522,163.905853 
		   C259.451447,162.411331 252.770844,167.032211 252.318222,169.931717 
		   C252.267807,170.254745 252.467255,170.671585 252.327271,170.917831 
		   C248.960144,176.841019 241.941727,178.130157 237.395813,182.632843 
		   C235.309555,184.699249 233.094269,182.526230 230.968643,181.748978 
		   C228.069382,180.688843 225.692490,177.585022 221.964188,179.107193 
		   C221.572632,181.644943 223.277725,183.075729 224.496826,184.443298 
		   C227.919418,188.282684 227.371796,191.122833 222.570160,193.589798 
	   M214.468796,167.649841 
		   C212.676498,170.179062 214.844666,171.024490 216.239059,172.447830 
		   C217.562302,171.560196 218.670578,170.863327 219.727829,170.096146 
		   C221.145615,169.067322 222.411621,167.780853 221.285843,165.960190 
		   C220.086548,164.020660 218.449417,164.867920 216.983749,165.800888 
		   C216.286911,166.244461 215.638855,166.764633 214.468796,167.649841 
	   M253.972153,157.022491 
		   C254.032425,153.512817 250.813446,153.071732 248.707764,151.551376 
		   C250.743073,153.213348 245.813583,160.364456 253.972153,157.022491 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M418.004761,609.928711 
		   C414.491058,603.013306 411.151306,596.425232 407.737762,589.691589 
		   C405.761108,591.167480 406.379517,592.576721 406.552460,593.786194 
		   C407.525421,600.591675 406.746399,607.420471 406.880188,614.235168 
		   C407.026917,621.707642 402.467255,624.641296 395.360779,621.994995 
		   C393.408905,621.268188 393.031433,619.778870 393.028473,618.043030 
		   C393.002502,602.727295 393.014343,587.411560 392.975311,572.095947 
		   C392.968048,569.247192 394.114532,567.672668 397.110107,567.785278 
		   C397.276093,567.791565 397.443146,567.781799 397.609253,567.771667 
		   C411.899689,566.896484 411.906860,566.892639 418.472687,579.551392 
		   C420.847351,584.129822 423.098175,588.774780 425.572388,593.298096 
		   C426.465393,594.930664 426.893372,597.064575 429.820862,598.122192 
		   C429.820862,590.003845 429.769897,582.263794 429.853027,574.525146 
		   C429.876831,572.309143 428.934570,569.277283 431.719269,568.343567 
		   C435.167023,567.187439 438.960663,567.163025 442.475800,568.399780 
		   C444.046509,568.952515 444.031921,570.844971 444.030914,572.339417 
		   C444.020599,587.488525 443.957245,602.637634 443.959808,617.786743 
		   C443.960358,620.912415 442.610260,622.452759 439.429260,622.237732 
		   C439.263794,622.226501 439.096344,622.239136 438.930084,622.246216 
		   C424.755707,622.848511 424.755707,622.848572 418.004761,609.928711 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M462.294769,571.099792 
		   C471.315735,565.997131 480.549377,565.547607 489.613922,569.001160 
		   C500.508148,573.151794 505.712891,585.196777 503.988434,599.142212 
		   C501.258270,621.220337 484.429840,625.272705 468.823151,621.710144 
		   C462.330292,620.228027 457.772980,615.981445 454.952423,609.769348 
		   C448.999878,596.658813 452.180939,578.689697 462.294769,571.099792 
	   M477.612732,580.323181 
		   C473.285278,580.575256 470.444580,582.924561 469.229279,586.921875 
		   C467.560638,592.410095 467.509857,598.025208 469.365875,603.494202 
		   C470.869690,607.925354 473.981018,610.034302 478.860321,609.776672 
		   C483.537018,609.529785 485.557281,606.556580 486.795624,602.769775 
		   C488.385498,597.907959 487.927246,592.946167 486.817780,588.044922 
		   C485.800385,583.550537 483.233002,580.667114 477.612732,580.323181 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M354.910095,599.926086 
		   C350.924652,603.313965 346.514801,604.770569 341.775513,605.047546 
		   C338.420807,605.243591 336.880066,606.663757 337.124817,610.015259 
		   C337.173157,610.677429 337.115295,611.347351 337.108734,612.013672 
		   C337.002655,622.814148 336.556366,623.136597 325.723175,622.291748 
		   C322.727844,622.058228 321.656830,620.773804 321.664764,617.914673 
		   C321.707367,602.587402 321.672913,587.260010 321.670105,571.932617 
		   C321.669739,569.973938 321.993225,568.001221 324.420197,567.945190 
		   C331.896576,567.772461 339.501373,566.700623 346.820160,568.443237 
		   C361.087677,571.840454 365.163513,587.615784 354.910095,599.926086 
	   M344.632721,584.831177 
		   C343.906799,581.870361 341.766968,580.486389 339.115509,581.468506 
		   C335.804962,582.694763 337.449677,585.983582 337.233063,588.417847 
		   C337.097198,589.944824 337.463226,591.664001 339.467102,591.547241 
		   C342.196960,591.388123 343.987518,589.790955 344.616211,587.062134 
		   C344.724945,586.589905 344.664337,586.078613 344.632721,584.831177 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M245.845306,567.760986 
		   C252.230453,568.131897 252.106262,568.348755 252.369827,575.322693 
		   C252.555420,580.233459 249.781128,580.819885 246.134521,580.783325 
		   C243.976700,580.761658 241.820343,580.456787 239.663986,580.464478 
		   C237.325439,580.472839 235.872589,581.712036 235.809021,584.125000 
		   C235.743607,586.607849 237.190170,587.714600 239.570984,587.752747 
		   C240.901627,587.774048 242.232452,587.788330 243.563232,587.794189 
		   C250.590225,587.825073 253.219818,591.657471 250.887680,598.314758 
		   C250.193497,600.296326 248.644058,600.642456 246.967850,600.755432 
		   C244.480286,600.922974 241.981537,600.924194 239.487549,600.996216 
		   C236.876785,601.071655 235.374222,602.339417 235.554230,605.024963 
		   C235.722839,607.540771 236.590714,609.614075 239.673676,609.621704 
		   C242.335281,609.628296 245.008026,609.825623 247.655899,609.645386 
		   C252.156387,609.339050 252.386353,612.149536 252.238083,615.435547 
		   C252.090881,618.697266 252.928024,622.400024 247.560028,622.262390 
		   C240.243820,622.074768 232.919388,622.132874 225.599503,622.199158 
		   C222.299484,622.229004 220.797546,620.960266 220.760330,617.490906 
		   C220.603317,602.855835 220.334320,588.221130 219.976517,573.589478 
		   C219.872040,569.317322 221.608459,567.581543 225.901840,567.713074 
		   C232.384567,567.911804 238.877960,567.762695 245.845306,567.760986 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M275.274506,583.005066 
		   C275.289429,589.990417 275.213837,596.478271 275.338928,602.962219 
		   C275.450256,608.732239 276.450531,609.642517 282.053009,609.699158 
		   C284.048340,609.719360 286.044373,609.687988 288.039917,609.666626 
		   C295.268311,609.589355 295.155182,609.679382 295.352264,616.749878 
		   C295.465271,620.803345 294.206848,622.462646 289.992889,622.343079 
		   C281.849945,622.112000 273.694092,622.156738 265.547668,622.307251 
		   C261.764923,622.377136 260.033630,620.946472 260.038422,617.098633 
		   C260.056671,602.463867 260.003418,587.828735 259.907104,573.194153 
		   C259.882904,569.516724 261.283783,567.816345 265.198822,567.708069 
		   C275.355347,567.427307 275.350586,567.294189 275.282288,577.516479 
		   C275.271179,579.179565 275.274597,580.842712 275.274506,583.005066 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M276.674011,123.332794 
		   C282.167206,122.029495 287.255402,121.119072 291.671295,125.163559 
		   C294.350006,127.616982 294.427521,129.532059 290.630157,130.882889 
		   C287.713654,131.920364 285.094604,133.568161 281.745667,131.491898 
		   C280.155304,130.505920 277.812927,131.112061 276.968109,133.884445 
		   C280.137512,135.829056 283.471100,134.600967 286.627655,134.388275 
		   C293.975983,133.893158 297.722076,135.758560 299.351013,141.183701 
		   C301.057465,146.866776 298.626312,151.924683 292.588135,155.087418 
		   C288.551483,157.201782 284.227051,158.306870 279.675415,158.572296 
		   C277.968292,158.671860 276.327087,158.483810 274.848145,157.622955 
		   C272.256592,156.114426 269.292999,154.657410 269.899323,150.976608 
		   C270.232849,148.951874 277.826141,146.993713 279.983948,148.369003 
		   C283.393585,150.542145 285.764709,149.210052 288.383392,146.510208 
		   C285.027008,144.073380 281.671753,145.406891 278.558502,145.582184 
		   C276.017700,145.725235 273.503784,145.756287 271.157562,145.002350 
		   C264.636383,142.906799 262.745941,134.362915 267.480438,128.957504 
		   C269.861786,126.238678 273.028046,124.769058 276.674011,123.332794 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M371.216736,622.194702 
		   C367.999390,622.016602 367.697601,620.126465 367.698639,617.959229 
		   C367.705841,602.813904 367.745941,587.668335 367.654236,572.523560 
		   C367.633636,569.122620 369.000031,567.862488 372.375244,567.708191 
		   C382.961090,567.224121 383.113861,567.263306 383.117035,577.643982 
		   C383.120819,589.959900 383.146759,602.276001 383.097290,614.591736 
		   C383.066406,622.273560 383.000031,622.286194 375.181732,622.264343 
		   C374.016785,622.261047 372.851929,622.238220 371.216736,622.194702 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M325.631409,140.363892 
		   C325.512787,133.930389 321.634369,129.946671 318.036591,125.814224 
		   C315.121185,122.465599 312.199799,119.122208 308.642059,115.043999 
		   C313.174835,113.378044 317.196777,112.302719 320.779327,113.256905 
		   C324.415405,114.225342 325.254608,119.210709 329.213959,121.680634 
		   C331.575806,114.010445 335.077362,107.696640 345.149078,110.597717 
		   C343.851593,115.840492 341.132660,120.411743 338.808411,125.085251 
		   C336.483337,129.760391 335.380280,134.523376 336.881470,139.505753 
		   C338.597015,145.199585 334.814484,145.217987 331.108459,145.978287 
		   C326.507996,146.922073 325.505310,144.579391 325.631409,140.363892 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M588.404175,595.316650 
		   C580.358948,603.531494 573.406494,612.538330 562.041931,617.381104 
		   C561.640015,613.430115 562.609253,610.748169 563.027710,607.965881 
		   C564.149292,600.508911 571.909790,599.171082 574.325317,592.994141 
		   C575.735107,589.389221 581.136780,588.060791 585.404785,587.209595 
		   C587.231689,586.845276 589.148987,587.624084 590.201843,589.304504 
		   C591.670288,591.648193 590.068237,593.371399 588.404175,595.316650 
	   z"/>
	   <path fill="#0E9F6E" opacity="1.000000" stroke="none" 
		   d="
	   M285.705872,451.776581 
		   C295.844452,434.176819 305.770355,416.877502 315.753815,399.611481 
		   C325.983887,381.918976 336.285370,364.267792 346.524323,346.580414 
		   C350.519867,339.678284 354.524811,332.778320 358.339722,325.776154 
		   C360.262909,322.246216 361.695831,322.078339 363.745819,325.658417 
		   C377.954803,350.472839 392.203888,375.264435 406.502136,400.027588 
		   C416.141022,416.721222 425.909912,433.339722 435.565521,450.023712 
		   C441.544434,460.354736 447.420105,470.745483 454.108734,482.451019 
		   C391.889465,483.657166 330.760101,481.823883 268.219116,482.638245 
		   C274.470093,471.600464 279.994263,461.846039 285.705872,451.776581 
	   M281.188965,475.954834 
		   C283.298676,477.409882 285.705200,476.856628 287.987213,476.857910 
		   C336.318176,476.885010 384.649109,476.872131 432.980072,476.864227 
		   C434.646545,476.863983 436.313141,476.811188 437.979431,476.822998 
		   C441.660767,476.849060 442.436951,475.148682 440.745605,472.094452 
		   C438.490509,468.022156 436.192200,463.973114 433.863251,459.942535 
		   C417.130188,430.983704 400.365967,402.042877 383.652710,373.072632 
		   C377.252747,361.979065 371.010193,350.794556 364.592560,339.711365 
		   C362.211487,335.599243 360.263214,335.605743 357.720795,339.648315 
		   C355.510162,343.163239 353.525146,346.820251 351.447021,350.418274 
		   C329.556732,388.317993 307.611145,426.186096 285.872833,464.172791 
		   C283.868591,467.675079 280.739929,470.845734 281.188965,475.954834 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M325.971283,336.968872 
		   C328.685059,340.530762 327.194397,341.885101 323.389191,341.384613 
		   C320.085571,340.950104 317.664337,341.419861 315.832367,344.604767 
		   C314.207764,347.429199 314.940125,349.426666 316.578064,351.857147 
		   C319.225647,355.785919 316.560638,360.709290 311.777954,361.126740 
		   C310.951202,361.198914 310.111725,361.112244 309.280975,361.154877 
		   C307.018982,361.270935 304.060913,360.413055 303.040588,363.051941 
		   C301.825317,366.195160 305.351379,366.448578 306.978180,367.798798 
		   C308.044403,368.683716 309.227997,369.585907 308.488556,371.078125 
		   C307.698395,372.672607 306.183716,372.260956 305.023834,371.562256 
		   C299.468872,368.215759 293.952881,364.803223 288.470825,361.338593 
		   C287.830536,360.933929 287.248047,360.127869 287.046265,359.395599 
		   C286.352417,356.877686 291.577026,349.637115 294.878998,348.612244 
		   C298.877014,347.371307 302.246216,349.034576 303.468842,352.599152 
		   C305.409302,358.256409 309.111359,356.834564 313.671906,356.174438 
		   C311.551453,350.547272 307.216278,346.947021 304.407471,342.386475 
		   C302.995758,340.094330 299.454987,338.235657 301.038422,335.225555 
		   C302.649963,332.161865 305.928894,334.517883 308.370605,334.745056 
		   C313.989685,335.267944 319.564758,336.264008 325.578918,337.033752 
		   C326.000122,336.999451 325.971283,336.968872 325.971283,336.968872 
	   M292.901398,358.585144 
		   C294.863190,359.734619 296.475006,363.435303 299.155609,359.664093 
		   C300.235565,358.144745 300.316742,356.232483 299.317535,354.525665 
		   C298.562805,353.236481 297.210480,352.853699 295.886597,353.236603 
		   C293.590637,353.900635 292.380188,355.505615 292.901398,358.585144 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M259.869141,427.093445 
		   C262.322693,428.562592 264.558380,429.713409 266.580078,431.162720 
		   C268.096161,432.249634 270.659393,433.478424 269.037872,435.772980 
		   C267.600616,437.806854 265.717865,435.859711 264.261200,434.964020 
		   C262.455963,433.854034 260.913635,432.239960 258.111359,432.396942 
		   C258.111755,435.504852 260.449127,437.088013 261.815582,439.176056 
		   C262.871674,440.789795 264.792206,442.371887 263.680328,444.497253 
		   C262.464142,446.822021 260.170776,445.528870 258.261353,445.453949 
		   C255.316879,445.338318 252.528641,443.565948 248.650665,444.818939 
		   C251.678101,446.971893 254.260864,448.812042 256.847717,450.646454 
		   C257.812744,451.330811 258.999451,452.050049 258.213837,453.414825 
		   C257.350830,454.914093 255.933441,454.551605 254.720169,453.836639 
		   C249.417450,450.711731 244.128082,447.563232 238.871292,444.361877 
		   C237.391510,443.460693 236.140457,442.231659 236.946457,440.266663 
		   C237.775406,438.245728 239.476349,437.877472 241.489914,438.122223 
		   C246.010376,438.671692 250.420609,440.787750 255.429321,439.245392 
		   C255.057007,435.692749 252.275681,433.772797 250.676392,431.204803 
		   C249.799805,429.797302 248.666183,428.552490 247.733887,427.176422 
		   C246.695023,425.643066 246.613480,424.026215 247.861374,422.569244 
		   C249.261581,420.934387 250.807755,421.510834 252.329926,422.453156 
		   C254.735962,423.942657 257.149200,425.420532 259.869141,427.093445 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M388.491699,511.487183 
		   C389.946503,513.481140 390.561005,515.721924 393.138123,516.880859 
		   C394.391815,512.422241 393.446320,507.999451 393.804230,503.681488 
		   C393.946381,501.966278 393.287628,499.385406 395.810364,499.278198 
		   C398.769684,499.152466 398.204407,501.901611 398.226166,503.776794 
		   C398.303528,510.432007 398.298615,517.088501 398.277618,523.744385 
		   C398.271484,525.686340 398.720032,528.015076 395.975708,528.571106 
		   C393.513885,529.069885 392.464539,527.153870 391.413208,525.440857 
		   C389.151215,521.755188 386.922485,518.049072 384.670807,514.357056 
		   C383.735718,512.823730 383.110748,511.016144 380.820343,510.137787 
		   C379.628876,514.567383 380.538879,518.993286 380.172028,523.320435 
		   C380.007904,525.255981 381.094482,528.304382 377.652802,528.197449 
		   C374.745453,528.107056 375.369110,525.355164 375.383667,523.499268 
		   C375.437195,516.680359 375.631378,509.862366 375.794434,503.044525 
		   C375.833984,501.388367 375.702576,499.519165 377.834106,499.002136 
		   C379.950714,498.488708 381.263885,499.750305 382.290436,501.424561 
		   C384.287750,504.681976 386.301880,507.929108 388.491699,511.487183 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M404.133911,506.600342 
		   C407.908081,499.758575 413.331482,497.280426 420.067230,499.007782 
		   C425.756378,500.466736 429.089600,505.241638 429.305450,512.241638 
		   C429.670502,524.080566 423.042511,530.744385 413.088287,528.546570 
		   C406.062073,526.995178 402.121338,520.472229 403.083588,511.876190 
		   C403.267944,510.229095 403.686310,508.608154 404.133911,506.600342 
	   M424.203308,512.059387 
		   C423.022247,505.558136 420.486481,502.945953 415.619354,503.216797 
		   C411.118591,503.467285 408.357727,506.904785 408.058716,512.630432 
		   C407.699615,519.506836 410.834137,524.235413 415.888397,524.442078 
		   C421.251343,524.661377 424.017792,520.851929 424.203308,512.059387 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M419.657288,382.727386 
		   C421.640137,379.685425 423.506927,376.995758 425.711426,373.819519 
		   C422.923004,373.624756 421.503845,375.136078 419.839081,375.997131 
		   C418.149261,376.871094 416.538025,378.500977 414.438324,376.754944 
		   C413.884918,374.816162 415.302795,374.020752 416.542755,373.268463 
		   C420.802368,370.684174 425.104523,368.169556 429.404297,365.652008 
		   C431.047058,364.690125 432.744019,363.893921 434.286194,365.813690 
		   C435.636932,367.495148 434.624451,368.845764 433.686737,370.296753 
		   C431.570312,373.571625 428.289642,376.111908 427.104095,380.399231 
		   C431.167725,381.354004 434.822052,380.709686 438.457062,379.588593 
		   C440.476685,378.965637 442.533813,378.686493 443.640198,381.002502 
		   C444.824005,383.480621 442.910095,384.654999 441.192413,385.703979 
		   C436.939331,388.301422 432.643127,390.828339 428.357056,393.371490 
		   C427.076508,394.131287 425.554779,395.260956 424.526428,393.369080 
		   C423.557159,391.585907 425.274628,390.744293 426.489594,389.912994 
		   C428.445770,388.574493 430.431427,387.279053 433.221008,385.421997 
		   C429.023407,384.105103 426.605713,386.519470 423.829346,386.221191 
		   C421.704315,385.992950 419.181702,386.588715 419.657288,382.727386 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M278.165497,406.878113 
		   C273.912750,404.242188 269.975555,401.782166 266.003021,399.380585 
		   C263.508759,397.872742 263.115326,396.116974 264.746185,393.612915 
		   C267.839569,388.863281 270.512543,383.401947 277.357941,383.917725 
		   C283.403992,384.373260 287.974152,387.440979 290.274658,393.330750 
		   C291.686615,396.945648 288.454498,407.094360 285.135590,409.026917 
		   C282.339783,410.654999 280.568420,408.162445 278.165497,406.878113 
	   M279.506470,388.872253 
		   C278.873474,388.690979 278.245605,388.374695 277.606628,388.350433 
		   C273.644165,388.200226 270.761963,390.111359 269.625214,393.752258 
		   C268.497101,397.365295 272.154907,397.779785 274.181458,399.154083 
		   C275.957947,400.358826 277.837524,401.411194 279.666382,402.539246 
		   C282.776306,404.457306 284.547943,403.161163 285.710632,400.118744 
		   C287.533966,395.347778 286.151550,392.549286 279.506470,388.872253 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M295.690430,522.237366 
		   C298.066467,525.484802 301.254303,524.490112 304.154755,524.612305 
		   C305.544281,524.670898 307.063416,524.733826 307.283813,526.388000 
		   C307.572449,528.554504 305.678406,528.506165 304.258423,528.807617 
		   C303.936096,528.876038 303.595612,528.856689 303.263977,528.883972 
		   C291.062347,529.887329 291.066559,529.887451 291.060974,517.744995 
		   C291.058746,512.918945 291.052826,508.092743 291.011139,503.266937 
		   C290.985077,500.248840 292.163391,498.567322 295.450317,498.711304 
		   C298.606201,498.849518 301.773315,498.721680 304.930817,498.838104 
		   C306.145599,498.882935 307.270752,499.439972 307.191742,500.944855 
		   C307.128754,502.145020 306.130646,502.647827 305.140106,502.769897 
		   C303.330597,502.993011 301.496704,503.086639 299.671875,503.101746 
		   C296.792145,503.125610 295.470612,504.488068 295.369202,507.379120 
		   C295.262817,510.411469 296.792847,511.374023 299.563568,511.721405 
		   C301.958160,512.021606 306.239929,510.201080 306.313446,513.587341 
		   C306.400909,517.617188 301.929413,515.832703 299.452454,516.016235 
		   C295.278290,516.325623 295.050507,518.737732 295.690430,522.237366 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M344.524048,528.401489 
		   C341.466827,528.201416 341.762634,526.126465 341.753265,524.347229 
		   C341.716614,517.369995 341.835480,510.390778 341.707031,503.415802 
		   C341.644440,500.018585 342.970947,498.466736 346.403687,498.704742 
		   C348.057556,498.819458 349.729462,498.665436 351.385071,498.766174 
		   C356.499054,499.077423 359.679260,501.676697 360.206055,505.888367 
		   C360.862610,511.137695 358.557373,515.620483 353.430359,516.491577 
		   C348.007843,517.412842 345.818756,519.681213 346.688934,525.078064 
		   C346.903870,526.411316 346.341553,527.714294 344.524048,528.401489 
	   M348.079102,503.745392 
		   C346.808533,505.089508 346.916534,506.794098 346.955048,508.429871 
		   C346.993164,510.047607 346.793976,511.951263 348.866486,512.557495 
		   C350.713745,513.097778 352.480835,512.695190 353.954437,511.366974 
		   C355.446075,510.022491 356.084076,508.374695 355.309631,506.458679 
		   C354.103394,503.474274 351.672150,502.890808 348.079102,503.745392 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M448.664246,389.473175 
		   C450.057190,391.760101 451.417816,393.686981 452.338593,395.805115 
		   C454.100189,399.857483 453.032776,403.042358 448.732727,404.623352 
		   C446.805511,405.331879 445.311584,406.232697 443.986053,407.922180 
		   C441.236755,411.426331 436.640961,411.622498 433.557190,408.418823 
		   C431.848358,406.643616 430.538605,404.455109 429.212036,402.350128 
		   C428.086060,400.563446 428.236420,398.782593 430.187103,397.601837 
		   C435.027954,394.671570 439.900391,391.792847 444.788635,388.942261 
		   C445.999847,388.235931 447.299103,387.986603 448.664246,389.473175 
	   M438.967010,405.883362 
		   C442.058167,403.866699 440.913910,401.316925 439.130951,399.568695 
		   C436.816345,397.299133 435.476532,399.978485 433.837738,401.214661 
		   C434.736450,403.640594 435.434204,405.885895 438.967010,405.883362 
	   M445.677399,393.774048 
		   C443.154480,394.579834 441.863129,395.909485 443.769928,398.482269 
		   C444.656555,399.678528 445.690826,401.273865 447.367096,400.172455 
		   C449.741821,398.612122 448.290802,396.690277 447.308563,394.971100 
		   C447.072296,394.557587 446.619568,394.267761 445.677399,393.774048 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M400.303436,324.205048 
		   C399.286316,326.660950 397.835327,328.589508 398.118439,331.469727 
		   C401.524628,330.818176 403.981293,328.571899 406.805847,327.110931 
		   C407.918549,326.535431 409.322235,325.513062 410.292450,327.161743 
		   C411.195526,328.696289 409.973328,329.585602 408.790741,330.322540 
		   C404.276001,333.136017 399.768219,335.960907 395.239563,338.751923 
		   C394.125702,339.438354 392.969543,340.341187 391.590698,339.338440 
		   C390.083801,338.242493 390.378662,336.705200 390.805298,335.251495 
		   C392.009918,331.146576 395.025909,327.731659 395.606995,323.003937 
		   C392.117371,322.448395 390.067749,325.000610 387.508240,326.125000 
		   C386.184845,326.706390 384.641754,328.004547 383.621674,326.113953 
		   C382.699341,324.404572 384.274689,323.424591 385.567505,322.636047 
		   C389.683044,320.125793 393.809845,317.633759 397.950806,315.165680 
		   C399.337067,314.339447 400.834900,312.874634 402.434052,314.291107 
		   C404.047546,315.720245 403.359528,317.695862 402.669617,319.397797 
		   C402.047546,320.932404 401.193909,322.373199 400.303436,324.205048 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M256.462250,412.532959 
		   C254.490341,408.433075 256.935791,407.614075 259.731567,408.010712 
		   C266.432495,408.961365 273.082794,410.277649 279.741028,411.513580 
		   C281.051239,411.756775 282.555542,412.271393 282.146423,414.029541 
		   C281.764160,415.672180 280.232666,415.708649 278.888245,415.468842 
		   C275.525269,414.869019 272.853912,415.254791 270.910187,418.702423 
		   C269.459351,421.275848 269.523407,423.206787 271.169922,425.503174 
		   C272.145813,426.864258 274.126373,428.726593 272.028564,430.194702 
		   C269.593597,431.898865 268.662811,429.021881 267.587616,427.620331 
		   C263.857056,422.757446 260.290955,417.768433 256.462250,412.532959 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M282.599365,372.388580 
		   C284.535553,377.305542 286.083893,377.633240 288.774719,374.016357 
		   C289.269592,373.351196 289.613617,372.573578 290.110199,371.909912 
		   C290.923615,370.822754 291.851227,369.637543 293.364349,370.700409 
		   C294.560730,371.540710 294.018890,372.726990 293.631653,373.865356 
		   C292.739929,376.486786 288.712769,379.214935 293.476746,381.784851 
		   C297.774353,384.103210 298.188416,379.644836 299.971222,377.668610 
		   C300.852386,376.691864 301.596527,375.186401 303.151154,376.040009 
		   C304.679230,376.879059 304.066223,378.314453 303.468658,379.556702 
		   C303.252502,380.006073 303.023132,380.451874 302.763428,380.877075 
		   C296.948364,390.399323 298.055756,390.247894 289.289215,384.460632 
		   C285.817871,382.169006 282.303833,379.934479 278.725372,377.815582 
		   C276.514801,376.506653 276.201019,374.955139 277.467316,372.852814 
		   C278.755005,370.714874 279.948639,368.519287 281.271606,366.404083 
		   C281.971252,365.285522 282.880585,363.863342 284.403015,364.689545 
		   C286.172485,365.649811 285.417969,367.246857 284.701416,368.606232 
		   C284.081390,369.782471 283.380981,370.916351 282.599365,372.388580 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M326.014679,337.014587 
		   C325.515564,334.083008 328.113556,332.699280 329.236450,330.570679 
		   C330.138306,328.860962 331.610535,326.956329 329.766052,325.116364 
		   C327.977661,323.332397 326.067047,324.484680 324.327301,325.531555 
		   C323.189087,326.216461 322.136353,327.051575 320.970703,327.681274 
		   C316.481628,330.106506 312.336121,328.967468 310.492462,324.859192 
		   C308.918457,321.351807 311.451538,314.576630 314.852844,313.208618 
		   C315.826263,312.817078 316.850250,312.647064 317.592163,313.547546 
		   C318.351196,314.468842 317.858368,315.358612 317.304504,316.256866 
		   C315.933105,318.480774 312.489929,320.654510 315.631073,323.434570 
		   C318.360687,325.850403 320.371643,322.536163 322.519958,321.300629 
		   C325.455322,319.612457 328.276764,317.778076 331.665405,320.362946 
		   C334.295197,322.368958 335.857849,324.997253 334.676147,328.129822 
		   C333.218170,331.994873 332.331085,336.727570 326.356628,337.019592 
		   C325.971283,336.968872 326.000122,336.999451 326.014679,337.014587 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M415.169067,371.258118 
		   C413.987396,372.506775 412.980377,373.572662 411.580963,372.340851 
		   C410.672516,371.541321 411.171051,370.546112 411.519897,369.593536 
		   C414.508972,361.431366 413.659943,360.034088 405.240875,359.231415 
		   C404.193909,359.131592 403.309814,358.845398 402.856873,357.815491 
		   C403.160553,355.595001 404.987061,355.329742 406.534119,355.048004 
		   C411.755188,354.097107 417.008881,353.326904 422.243896,352.450592 
		   C423.767548,352.195526 425.294800,351.967804 426.331635,353.408875 
		   C427.648254,355.238708 426.179718,356.486969 425.213226,357.787994 
		   C421.945557,362.186768 418.661560,366.573456 415.169067,371.258118 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M459.563141,421.571533 
		   C466.406006,417.727539 471.621094,421.369080 471.926666,430.026764 
		   C468.985107,431.132965 468.434082,428.406921 467.153717,426.972260 
		   C466.119476,425.813354 465.527985,423.605255 463.369812,425.047791 
		   C461.692078,426.169250 462.029938,427.881927 462.715393,429.536560 
		   C463.365845,431.106689 465.019226,432.628876 463.064606,434.495361 
		   C460.453552,434.815521 459.971619,432.436096 458.813904,431.005463 
		   C457.554901,429.449585 456.277313,429.009613 454.549805,430.233948 
		   C452.892883,431.408234 452.766632,432.642151 453.636505,434.501434 
		   C454.502777,436.352997 457.665649,438.837494 454.738312,440.337921 
		   C451.883240,441.801361 451.015289,437.918335 449.811523,435.982727 
		   C445.866241,429.638916 445.954071,429.626007 452.482544,425.943115 
		   C454.792664,424.639923 456.994904,423.145477 459.563141,421.571533 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M326.487305,524.774536 
		   C329.840851,526.711243 328.926025,528.202271 326.146240,528.539185 
		   C322.537506,528.976624 318.843079,528.934998 315.199463,528.777588 
		   C312.745453,528.671570 311.947632,526.752930 311.949982,524.524719 
		   C311.957611,517.366882 311.933563,510.208038 312.055237,503.051849 
		   C312.085571,501.267731 312.276886,498.961090 314.809601,499.110870 
		   C317.380829,499.263031 317.040955,501.640015 317.082977,503.384521 
		   C317.179199,507.378204 317.122467,511.375610 317.120697,515.371521 
		   C317.116699,524.530884 317.114960,524.530884 326.487305,524.774536 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M385.636932,302.593079 
		   C388.544739,301.379059 390.992035,297.659515 393.850800,300.398529 
		   C396.459656,302.898071 399.244263,306.032043 398.804535,310.477570 
		   C395.342133,310.723846 394.960938,308.103546 393.701508,306.550629 
		   C392.797485,305.435852 391.885834,304.428406 390.410553,305.418640 
		   C389.111664,306.290466 388.274902,307.429779 388.941162,309.216217 
		   C389.578461,310.924774 391.688629,312.387177 390.046814,314.601166 
		   C387.528564,315.251617 386.983246,313.052734 385.957367,311.731506 
		   C384.668091,310.071106 383.354218,309.240387 381.338867,310.508545 
		   C379.048004,311.950104 379.422943,313.707245 380.638947,315.603851 
		   C380.728455,315.743500 380.826202,315.877899 380.915222,316.017822 
		   C381.865723,317.512177 383.661560,319.382202 381.528748,320.685333 
		   C379.369965,322.004364 378.577271,319.504669 377.646057,318.002441 
		   C376.860016,316.734467 376.005493,315.509094 375.208649,314.247620 
		   C373.704865,311.866974 373.987488,309.940948 376.530060,308.399017 
		   C379.504639,306.595062 382.392853,304.648651 385.636932,302.593079 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M476.377808,435.393860 
		   C478.530853,437.158447 479.755768,439.092316 480.383911,441.405090 
		   C480.692505,442.541382 481.087311,443.767456 479.747498,444.493347 
		   C478.347290,445.251953 477.620667,444.218811 476.975983,443.201874 
		   C475.811340,441.364807 475.407837,437.940277 472.471069,438.978027 
		   C469.551575,440.009644 470.503967,443.066986 470.993927,445.546448 
		   C471.648438,448.858490 470.391968,451.404938 467.581940,453.204773 
		   C465.351440,454.633423 463.064758,454.428558 461.037323,452.951813 
		   C458.118530,450.825684 456.172852,447.979156 455.832153,444.270477 
		   C455.751007,443.386993 456.259430,442.652802 457.177673,442.418060 
		   C458.385864,442.109192 458.866272,442.994537 459.506470,443.805969 
		   C461.128357,445.861786 461.543701,450.264252 465.005066,449.069000 
		   C468.467041,447.873566 466.255066,444.177856 466.130554,441.523438 
		   C465.851685,435.578552 470.171844,432.815399 476.377808,435.393860 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M406.035767,338.018433 
		   C408.325348,334.189240 411.257324,332.722504 414.962708,334.998474 
		   C418.362549,337.086792 420.115509,340.150940 419.186279,344.363922 
		   C416.093719,344.378815 416.077972,342.046021 415.070099,340.696045 
		   C414.138031,339.447601 413.139404,338.212555 411.414398,338.806976 
		   C409.507324,339.464050 409.237854,341.134033 409.478333,342.907990 
		   C409.566925,343.561646 409.786774,344.197021 409.938416,344.842712 
		   C410.750092,348.298370 409.718140,351.076416 406.783447,353.067383 
		   C404.174194,354.837585 401.542175,354.355286 399.539337,352.258606 
		   C397.123779,349.729919 393.853516,347.340759 395.551025,342.974548 
		   C395.645111,342.732483 396.082031,342.623688 396.403687,342.425568 
		   C398.879639,342.797363 398.849823,345.274170 399.980499,346.773560 
		   C401.073212,348.222626 402.064636,350.146027 404.258453,349.360870 
		   C406.371338,348.604736 406.306824,346.655151 406.027313,344.719360 
		   C405.723450,342.614838 404.923279,340.497437 406.035767,338.018433 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M454.129333,411.144531 
		   C452.982574,411.881348 452.166779,412.461456 451.310333,412.973541 
		   C444.735321,416.904968 444.731964,416.901154 447.026459,423.869965 
		   C447.354736,424.867065 447.458740,425.820374 446.058655,427.073486 
		   C442.009949,425.404144 440.532837,421.428711 439.460480,417.691071 
		   C438.594482,414.672699 441.921417,413.823975 443.934692,412.559113 
		   C447.315948,410.434784 450.737762,408.370636 454.201874,406.384735 
		   C455.551178,405.611267 457.307312,404.072418 458.487793,406.216858 
		   C459.603058,408.242859 457.461121,409.010742 456.156921,409.934570 
		   C455.615540,410.318085 455.015076,410.618256 454.129333,411.144531 
	   z"/>
	   <path fill="#000000" opacity="1.000000" stroke="none" 
		   d="
	   M369.277802,502.349976 
		   C369.363281,509.779266 369.473816,516.743530 369.459991,523.707458 
		   C369.456268,525.586792 369.920135,528.323364 367.092163,528.326660 
		   C364.155029,528.330078 364.853455,525.548462 364.836334,523.705933 
		   C364.770203,516.575256 364.811951,509.443390 364.845306,502.312103 
		   C364.851562,500.968292 364.952972,499.407562 366.572998,499.122528 
		   C368.535034,498.777344 369.075409,500.260681 369.277802,502.349976 
	   z"/>
	   <path fill="#0E9F6E" opacity="1.000000" stroke="none" 
		   d="
	   M373.327667,396.524628 
		   C374.450531,399.288116 377.246307,398.584656 378.881927,399.945709 
		   C379.636383,402.019958 376.711121,401.811188 376.784332,403.779663 
		   C377.731934,405.051056 379.931702,406.147400 377.871704,408.784241 
		   C376.667450,410.325775 378.408142,411.876770 380.080872,412.512299 
		   C382.602386,413.470306 383.193298,415.125122 381.966003,417.217743 
		   C383.458649,418.791626 385.908630,418.451782 386.461243,420.735657 
		   C385.779816,423.354248 378.758423,421.918427 382.153503,426.944427 
		   C383.925079,429.566986 387.895233,427.926086 390.538177,429.913147 
		   C389.664124,433.249847 385.738953,431.895386 384.231232,434.119354 
		   C386.445068,436.938385 390.092468,436.064178 392.824432,437.537964 
		   C392.623932,438.220734 392.595856,438.740631 392.342957,439.104034 
		   C391.219788,440.718201 387.784607,441.033905 389.092102,443.945190 
		   C390.396820,446.850372 392.391388,449.286041 396.026184,449.672882 
		   C398.070984,449.890472 400.353821,448.990967 402.192444,450.701538 
		   C402.150360,453.066193 399.042480,453.260040 398.995850,455.661774 
		   C401.109131,458.320496 404.382294,453.919678 406.723175,456.903870 
		   C405.998535,459.740204 403.310150,461.194122 401.093109,461.831543 
		   C392.408813,464.328552 384.740723,469.568512 374.946655,469.515015 
		   C370.497528,469.490692 366.560822,469.754150 362.607056,467.703522 
		   C362.061920,467.420776 361.254028,467.327087 360.666504,467.493805 
		   C355.870026,468.855133 351.164703,471.577606 346.131989,468.231171 
		   C339.918335,471.932739 333.904205,466.541931 327.406097,468.364594 
		   C327.452332,461.545227 320.309631,462.341339 317.651764,458.190338 
		   C320.387909,455.003082 325.890045,457.900330 327.977905,453.422150 
		   C326.098175,451.110657 322.013916,453.202393 320.761566,449.453094 
		   C324.390015,445.758301 330.910767,448.432739 334.185272,444.138855 
		   C333.928864,441.827698 331.518677,442.600098 330.813507,441.047394 
		   C330.883209,438.544128 333.793335,438.824341 335.001373,436.963318 
		   C333.502625,433.953857 328.557343,436.312500 327.539673,432.422058 
		   C328.480591,430.280853 330.579041,431.102448 332.240204,430.763275 
		   C334.813538,430.237885 338.114014,430.295624 339.006195,427.432800 
		   C339.899384,424.566681 338.437744,422.007019 335.462097,420.580627 
		   C334.846985,420.285767 334.560608,419.305084 334.436584,419.116852 
		   C334.425995,414.848877 344.034058,419.266418 339.806885,412.021057 
		   C347.987518,406.865051 347.987518,406.865051 341.104370,402.408936 
		   C341.622070,399.944427 344.951721,401.263062 345.531464,398.786804 
		   C343.730621,394.392334 346.962341,390.610352 348.680786,387.090515 
		   C350.084442,384.215332 350.982452,382.648132 347.861084,380.442169 
		   C354.677032,377.524048 355.020477,369.885620 360.289093,365.376526 
		   C361.779968,367.969879 363.729736,370.188202 364.360596,372.733429 
		   C365.310760,376.566956 366.958466,379.224060 371.815460,379.865540 
		   C368.463593,382.776611 369.833862,385.701965 371.519043,387.506653 
		   C374.110077,390.281464 373.569397,393.112732 373.327667,396.524628 
	   z"/>
	   </svg>
                                        `);
				printWindow.document.write('</div>');

				// Encabezado con los datos de la empresa
				printWindow.document.write('<div class="header">');
				printWindow.document.write('<h2>Maderas y Esamblajes "El Pino"</h2>');
				printWindow.document.write('<p>Ziorely Inda Ibarra</p>');
				printWindow.document.write('<p class="highlight">RFC IAIZ-760804-RW6 </p>');
				printWindow.document.write('<p>Regimen de las personas fisicas con</p>');
				printWindow.document.write('<p>actividades empresariales y prefesionales</p>');
				printWindow.document.write('<p>Allende No.23 COL.CENTRO C.P 82800</p>');
				printWindow.document.write('<p>Tel. 6941166060</p>');
				printWindow.document.write('<p>El Rosario,Sinaloa, México</p>');
				printWindow.document.write('</div>');
				// Datos del cliente
				printWindow.document.write('<div class="info">');
				printWindow.document.write('<strong class="text-center font-bold text-xl p-5">Nombre:</strong> <p>{{$compra->nombreCliente}}</p>');
				printWindow.document.write('<div style="display: flex; justify-content: space-between; margin-left: 2px; padding: 2px; padding-top: 5px;">');
				printWindow.document.write('<div style="width: 50%;">');
				printWindow.document.write('<p style="font-weight: bold; font-size: 16px;">Domicilio:</p>');
				printWindow.document.write('<p style="font-weight: normal; font-size: 14px;">{{$compra->nombreColonia}}, {{$compra->calle}}, {{$compra->numCasa}}</p>');
				printWindow.document.write('<p style="font-weight: bold; font-size: 16px;">Ciudad:</p>');
				printWindow.document.write('<p style="font-weight: normal; font-size: 14px;">{{$compra->nombreMunicipio}}</p>');
				printWindow.document.write('</div>');
				printWindow.document.write('<div style="width: 50%;">');
				printWindow.document.write('<p style="font-weight: bold; font-size: 16px;">Descripcion Domicilio:</p>');
				printWindow.document.write('<p style="font-weight: normal; font-size: 14px;">{{$compra->descripcionDomicilio}}</p>');
				printWindow.document.write('<p style="font-weight: bold; font-size: 16px;">Telefono:</p>');
				printWindow.document.write('<p style="font-weight: normal; font-size: 14px;">{{$compra->telefono}}</p>');
				printWindow.document.write('</div>');
				printWindow.document.write('</div>');
				printWindow.document.write('</div>');

				// Detalles de la compra
				printWindow.document.write('<div class="info"  margin-bottom: 20px;">');
				printWindow.document.write('<h2 style="text-align: center; margin-bottom: 10px;">Detalle de la Compra</h2>');
				printWindow.document.write('<div style="display: flex; justify-content: space-between; text-align: left;">');
				printWindow.document.write('<div>');
				printWindow.document.write('<div style="margin-bottom: 5px;"><strong>Fecha:</strong> {{$compra->fecha}}</div>');
				printWindow.document.write('<div style="margin-bottom: 5px;"><strong>Por saldar: </strong> {{$compra->cantidadASaldar}}</div>');
				printWindow.document.write('<div style="margin-bottom: 5px;"><strong> Articulo(s):</strong>  {{$compra->nombreArticulo}}</div>');
				printWindow.document.write('<div style="margin-bottom: 5px;"><strong> Enganche:</strong>  {{$compra->enganche}}</div>');
				printWindow.document.write('</div>');
				printWindow.document.write('<div>');
				printWindow.document.write('<div style="margin-bottom: 5px;"><strong> Valor: </strong> {{$compra->cantidadTipoVenta}}</div>');
				printWindow.document.write('<div style="margin-bottom: 5px;"><strong> Semanas Deuda:</strong>  {{$compra->diasDeuda}}</div>');
				printWindow.document.write('<div><strong> Folio:</strong>  {{$compra->folioCompra}}</div>');
				printWindow.document.write('</div>');
				printWindow.document.write('</div>');
				printWindow.document.write('</div>');

				// Tabla de abonos
				printWindow.document.write('<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">');

				printWindow.document.write('<tbody>');

				// Obtén las filas de la tabla de abonos
				var tableRows = document.getElementById('tablaAbonos').rows;

				// Recorre cada fila y sus celdas para escribir en la ventana de impresión
				for (var i = 0; i < tableRows.length; i++) {
					var cells = tableRows[i].cells;
					printWindow.document.write('<tr>');
					// Recorre solo las primeras 5 celdas (sin la última)
					for (var j = 0; j < 5; j++) {
						printWindow.document.write('<td style="border: 1px solid #ddd; padding: 8px;">' + cells[j].innerHTML + '</td>');
					}
					printWindow.document.write('</tr>');
				}

				printWindow.document.write('</tbody>');
				printWindow.document.write('</table>');

				printWindow.document.write('</div>');

				// Cierra la escritura del documento y llama al método print para imprimir
				printWindow.document.close();
				printWindow.print();
			});
		});
	</script>

	<script type="text/javascript" charset="utf8">
		$(document).ready(function() {
			var table = $('#tablaAbonos').DataTable({
				responsive: true,
				"language": {
					"sProcessing": "Procesando...",
					"sLengthMenu": "Mostrar _MENU_ registros",
					"sZeroRecords": "No se encontraron resultados",
					"sEmptyTable": "Ningún dato disponible en esta tabla",
					"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix": "",
					"sSearch": "Buscar:",
					"sUrl": "",
					"sInfoThousands": ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst": "Primero",
						"sLast": "Último",
						"sNext": "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				},
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


			$('#dia, #cobrador').change(function() {
				var cobrador = $('#cobrador').val();
				var filtroFecha = $('#dia').val();

				// Aplica filtros en las columnas correspondientes
				table.column(4).search(cobrador).draw(); // Filtro para Area
				table.column(0).search(filtroFecha).draw(); // Filtro para Fecha
			});

			$('#busqueda').on('keyup', function(e) {
				var filtroBusqueda = $('#busqueda').val();
				table.search(filtroBusqueda).draw();
			});

			// Limpiar los filtros al hacer clic en el botón "Limpiar Filtros"
			$('#limpiarFiltros').on('click', function() {
				$('#dia, #mes, #estatus').val('');
				table.search('').columns().search('').draw();
			});
		});
	</script>



</body>

</html>

</body>

</html>