<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Saldo en Tiempo Real</title>
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <title>Maderas El Pino</title>
    <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
</head>
<body>

@if(session('id'))
    @if(session('fkTipoUsuario')==1||session('fkTipoUsuario')==2)
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
			
            <h1 class="text-center font-bold text-2xl p-5">{{$compra->nombreCliente}}</h1>
                <div>
                    <div class="flex justify-center font-semibold p-1"><h2>Domicilio: <h3 class="ml-2">
                    {{$compra->nombreMunicipio}}, {{$compra->nombreColonia}}, {{$compra->calle}}, {{$compra->numCasa}}
                    </h3></h2></div>
                    <div class="flex justify-center font-semibold p-1"><h2>Telefono: <h3 class="ml-2">{{$compra->telefono}}</h3></h2></div>  
                    <div class="flex justify-center font-semibold p-1"><h2>Domicilio: <h3 class="ml-2">
                    {{$compra->descripcionDomicilio}}
                    </h3></h2></div>
                        
                    <div class="flex justify-center p-5">
                        @if($compra->imagenDomicilio)
                        <img class="md:h-[15rem] h-[10rem] w-[15rem] rounded-sm md:w-[30rem]"
                        src="{{ asset('storage/' . $compra->imagenDomicilio) }}"
                            alt="image description">
                        @else
                        <img class="md:h-[15rem] h-[10rem] w-[15rem] rounded-sm md:w-[30rem]"
                            src="{{ asset('images/default.png') }}"
                            alt="default image">
                        @endif
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
            <h1 class="text-center font-bold text-2xl">Nuevo abono</h1>
                <div>
                    <div class="ml-2 p-2 pt-5">
                    <div class="grid grid-cols-2 text-justify">
                        <h2 class="font-semibold">Fecha: <p class="font-normal">{{$compra->fecha}}</p></h2>
                        <h2 class="font-semibold md:ml-[20rem] ml-10">Por saldar: <p class="font-normal">{{$compra->cantidadASaldar}}</p></h2>
                        <h2 class="font-semibold">Articulo(s): <p class="font-normal">{{$compra->nombreArticulo}}</p></h2>
                        <h2 class="font-semibold md:ml-[20rem] ml-10">Enganche: <p class="font-normal">{{$compra->enganche}}</p></h2>
                        <h2 class="font-semibold">Valor: <p class="font-normal">{{$compra->cantidadTipoVenta}}</p></h2>
                        <h2 class="font-semibold md:ml-[20rem] ml-10">Folio: <p class="font-normal">{{$compra->folioCompra}}</p></h2>
                        <h2 class="font-semibold">Semanas Deuda: <p class="font-normal">{{$compra->diasDeuda}}</p></h2>
                    </div>
                </div>
            
<form id="formulario" action="{{ route('abono.insertar') }}" enctype="multipart/form-data"  method="post" >
@csrf
				<div class="flex justify-center">
					<h1 class="text-center font-semibold text-xl mt-10">Seleccione cantidad a abonar</h1>
			</div>
            <label for="cantidad" class="block mb-2 text-sm font-medium text-gray-900">Cantidad de Dinero:</label>
            <!-- Utiliza el atributo pattern para permitir solo números y decimales -->
            <input type="number" id="cantidad" name="cantidad" class="bg-green-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full p-2.5" pattern="^\d+(\.\d{1,2})?$" title="Ingresa una cantidad válida" required>
            <input hidden type="number" id="pkComprasCliente" name="pkComprasCliente" value="{{$compra->pkcomprasCliente}}">
                   
				<div class="flex p-5 justify-center mt-10">
					<h2 class="font-semibold">Saldo restante:</h2><p class="ml-1" id="saldo">{{$compra->cantidadASaldar}}</p>
				</div>
				<div class="md:p-10 p-5 mt-5 flex justify-center">
					<div class="flex">
					  <!-- Previous Button -->
					  <a href="{{ URL::previous() }}" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
						Cancelar
					  </a>
					  <!-- Next Button -->
					  <button type="submit" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-green-500 border rounded-lg hover:bg-green-400">
						Aceptar
					  </button>
					</div>
			  </div>
            </div>
        </div>
     </div>
           </div>
        </div>
    </div>
</form>








<script>
    // Espera a que el DOM esté listo
    $(document).ready(function () {
        // Captura el evento de entrada del usuario en el campo de cantidad
        $('#cantidad').on('input', function () {
            // Obtiene el valor ingresado por el usuario
            var cantidadIngresada = parseFloat($(this).val()) || 0;

            // Obtiene el saldo actual
            var saldoActual = parseFloat('{{$compra->cantidadASaldar}}');

            // Calcula el nuevo saldo restando la cantidad ingresada
            var nuevoSaldo = saldoActual - cantidadIngresada;

            // Actualiza el texto en la etiqueta strong
            $('#saldo').text(  nuevoSaldo.toFixed(2));
        });
    });
</script>

</body>
</html>
