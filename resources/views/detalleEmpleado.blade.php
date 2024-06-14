<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
    <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
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
@include('mensaje')
<div class="p-4 sm:ml-64 mt-16 md:mt-10">
    <!-- Guias del tamaño del contenedor -->
    <div class="p-4">
       <!-- PON EL CODIGO DEL MODULO AQUI-->
       <div class="flex justify-center">
        <div class="bg-white rounded-lg shadow-lg p-4 md:w-[50rem]">
            <div class="flex justify-start">
                <a href="{{ url('/allEmployees')}}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
                    Regresar
                </a>    
            </div>
            <h1 class="text-center font-bold text-2xl p-5">{{$dato->nombreEmpleado}}</h1>
            <div>
                <div class="flex justify-end">
                    <span class="px-2 text-sm font-medium text-gray-800 bg-green-100 rounded-full">Activo</span>
                </div>
                <div class="ml-2 md:ml-5 p-2 pt-5">
                    <h2 class="font-bold">Domicilio: <p class="font-normal">{{$dato->nombreMunicipio . ', ' . $dato->nombreColonia . ', ' . $dato->calle . ', ' .$dato->numCasa }}</p></h2>
                    <h2 class="font-bold">Nombre empleado: <span class="font-normal">{{$dato->nombreEmpleado}}</span></h2>
                    <h2 class="font-bold">Nombre Usuario: <span class="font-normal">{{$dato->telefono}}</span></h2>
                    <h2 class="font-bold">Tipo de usuario: <span class="font-normal">{{$dato->nombreTipoUsuario}}</span></h2>
                    <h2 class="font-bold">Contraseña: <span class="font-normal">{{$dato->contraseña}}</span></h2>
                </div>
            </div>
            <div class="flex justify-between md:mt-16 mt-10">
                <div class="ml-10">
                    <a href="{{ route('empleado.mostrarPorId', ['pkEmpleado' => $dato->pkEmpleado, 'vista' => 'editarEmpleado']) }}" class="flex items-center bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
                        <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" fill="currentColor" width="800px" height="800px" viewBox="0 0 32 32" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M12.965,5.462c0,-0 -2.584,0.004 -4.979,0.008c-3.034,0.006 -5.49,2.467 -5.49,5.5l0,13.03c0,1.459 0.579,2.858 1.611,3.889c1.031,1.032 2.43,1.611 3.889,1.611l13.003,0c3.038,-0 5.5,-2.462 5.5,-5.5c0,-2.405 0,-5.004 0,-5.004c0,-0.828 -0.672,-1.5 -1.5,-1.5c-0.827,-0 -1.5,0.672 -1.5,1.5l0,5.004c0,1.381 -1.119,2.5 -2.5,2.5l-13.003,0c-0.663,-0 -1.299,-0.263 -1.768,-0.732c-0.469,-0.469 -0.732,-1.105 -0.732,-1.768l0,-13.03c0,-1.379 1.117,-2.497 2.496,-2.5c2.394,-0.004 4.979,-0.008 4.979,-0.008c0.828,-0.002 1.498,-0.675 1.497,-1.503c-0.001,-0.828 -0.675,-1.499 -1.503,-1.497Z"/><path d="M20.046,6.411l-6.845,6.846c-0.137,0.137 -0.232,0.311 -0.271,0.501l-1.081,5.152c-0.069,0.329 0.032,0.671 0.268,0.909c0.237,0.239 0.577,0.343 0.907,0.277l5.194,-1.038c0.193,-0.039 0.371,-0.134 0.511,-0.274l6.845,-6.845l-5.528,-5.528Zm1.415,-1.414l5.527,5.528l1.112,-1.111c1.526,-1.527 1.526,-4.001 -0,-5.527c-0.001,-0 -0.001,-0.001 -0.001,-0.001c-1.527,-1.526 -4.001,-1.526 -5.527,-0l-1.111,1.111Z"/><g id="Icon"/></svg>
                    </a>    
                </div>
                <div class="mr-10">
                    <button onclick="confirmarBaja(event)" title="Dar de baja" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                        <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-green-" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="800px" height="800px" viewBox="0 0 24 24">
                            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/>
                        </svg>
                    </button>
                    <form id="bajaForm" action="{{ route('empleado.baja', ['pkEmpleado' => $dato->pkEmpleado]) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>
<script>
function confirmarBaja(event) {
    event.preventDefault();

    Swal.fire({
        title: '¿Seguro?',
        text: '¿Desea dar de baja este usuario?',
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
</body>
</html>
