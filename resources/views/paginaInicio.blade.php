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
        <div class="p-4">
    <!-- PON EL CODIGO DEL MODULO AQUI-->
    <div class="bg-white rounded-lg shadow-lg p-4">
        <div class="flex justify-center">
            <h1 class="text-center font-bold text-2xl">Madererias y ensambles el pino</h1>
        </div>
                @php
            // Importar los modelos si no lo has hecho previamente
            use App\Models\Cliente;
            use App\Models\ComprasClientes; // Corregí el nombre del modelo
            use App\Models\Articulo; 
            // Consultar la cantidad de compras vencidas
            $comprasVencidas = Cliente::join('comprascliente', 'comprascliente.fkCliente', '=', 'cliente.pkCliente')
                ->where('comprascliente.estatus', '=', 2) // Filtrar compras con estatus 2 (vencidas)
                ->count();

                $datosArticulos = Articulo::join('articulotipoventa', 'articulotipoventa.fkArticulo', '=', 'articulo.pkArticulo')
                ->join('categoriaarticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaarticulo.pkCategoriaArticulo')
                ->select('categoriaarticulo.*', 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
                ->where('articulotipoventa.fkTipoVenta', 1) 
                ->where('articulo.estatus', 2)
                ->count();


            // Consultar la cantidad de compras del día
            $comprasDia = ComprasClientes::whereDate('fecha', now()->toDateString())->count();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 ml-10 md:ml-0 p-5">
            <div class="flex p-5 md:justify-end">
                <h1 class="font-semibold">Pagos vencidos:</h1><p class="ml-1">{{$comprasVencidas}}</p>
            </div>
            <div class="flex p-5 md:justify-end">
                <h1 class="font-semibold">Articulos por Abastecer:</h1><p class="ml-1">{{$datosArticulos}}</p>
            </div>
            <div class="flex p-5">
                <h2 class="font-semibold">Compras del día:</h2><p class="ml-1">{{$comprasDia}}</p>
            </div>
        </div>
    </div>
</div>

    </div>  
   <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
   <script src="../node_modules/flowbite/dist/datepicker.js"></script>

</body>
</html>