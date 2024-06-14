<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <title>Maderas El Pino</title>
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
        <div class="flex justify-center">
            <h1 class="text-center font-bold text-2xl">Madererias y ensambles el pino</h1>
        </div>
        @php
            use App\Models\ComprasClientes; // Corregí el nombre del modelo

            // Consultar la cantidad de tarjetas pendientes, hechas y totales
            $tarjetasPendientes =  ComprasClientes::where('fkEmpleado', session('id'))
                ->where('estatusDeCobro', 1)
                ->count();

            $tarjetasHechas = ComprasClientes::where('fkEmpleado', session('id'))
                ->where('estatusDeCobro', 0)
                ->count();

            $tarjetasTotales =  ComprasClientes::where('fkEmpleado', session('id'))
                ->count();

            // Consultar la cantidad de compras del día
            $comprasDia = ComprasClientes::whereDate('fecha', now()->toDateString())->count();
        @endphp

<div class="grid grid-cols-1 md:grid-cols-2 ml-10 md:ml-0 p-5">
    <div class="flex p-5 md:justify-end">
        <h1 class="font-semibold">Total Tarjetas:</h1><p class="ml-1">{{$tarjetasTotales}}</p>
    </div>
    <div class="flex p-5 md:justify-end">
        <h1 class="font-semibold">Abonos pendientes:</h1><p class="ml-1">{{$tarjetasPendientes}}</p>
    </div>
    <div class="flex p-5">
        <h2 class="font-semibold">Abonos Hechos:</h2><p class="ml-1">{{$tarjetasHechas}}</p>
    </div>
</div>

    </div>
</div>

    </div>  
   <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
   <script src="../node_modules/flowbite/dist/datepicker.js"></script>

</body>
</html>