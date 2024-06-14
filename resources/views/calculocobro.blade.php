<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="{{ asset('images/elpino.ico') }}" rel="icon" type="image/x-icon">
    <title>Maderas El Pino</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    
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
       
        .seleccionar-cliente:checked {
    outline: 2px solid #007bff; /* Cambia el color del contorno para resaltar */
    background-color: #e6f7ff; /* Cambia el color de fondo para resaltar */
}
.oculto {
            display: none;
        }
    </style>
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
		   <div class="bg-white rounded-lg shadow-lg p-4">
            <div class="flex justify-center p-5 mb-10">
            <h2 class="font-bold text-2xl">{{$empleado->nombreEmpleado}}</h2>
            </div>
           <input type="hidden" id="pkempleado" name="pkempleado" value="{{ $pkEmpleado }}">
                <form id="formulario">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="p-2">
                                <h1 class="font-bold">Fecha Inicial</h1>
                            </div>
                            <label for="fechainicio" class="sr-only">Fecha y Hora Inicio:</label>
                            <input type="datetime-local" id="fechainicio" name="fechainicio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full ps-10 p-2.5" placeholder="Select date">
                        </div>
                        <div>
                            <div class="p-2">
                                <h1 class="font-bold">Fecha Final</h1>
                            </div>
                            <label for="fechaFin" class="sr-only">Fecha y Hora Fin:</label>
                            <input type="datetime-local" id="fechaFin" name="fechaFin"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-400 focus:border-green-400 block w-full ps-10 p-2.5" placeholder="Select date">
                        </div>
                    </div>
                    <input type="hidden" id="pkempleado" name="pkempleado" value="{{ $pkEmpleado }}">
                </form>

                <!-- Botón para calcular la suma de abonos -->
                <div class="mt-10">
                    <div class="flex justify-center">
                        <h1 class="font-bold">Calcular Bono</h1>
                    </div>
                    <div class="flex justify-center">
                    <button id="calcular" class="flex w-11 h-11 items-center mt-2 bg-green-500 p-2 text-base font-medium text-white rounded-lg hover:bg-green-400">
                        <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 9H19M15 18V15M9 18H9.01M12 18H12.01M12 15H12.01M9 15H9.01M15 12H15.01M12 12H12.01M9 12H9.01M8.2 21H15.8C16.9201 21 17.4802 21 17.908 20.782C18.2843 20.5903 18.5903 20.2843 18.782 19.908C19 19.4802 19 18.9201 19 17.8V6.2C19 5.0799 19 4.51984 18.782 4.09202C18.5903 3.71569 18.2843 3.40973 17.908 3.21799C17.4802 3 16.9201 3 15.8 3H8.2C7.0799 3 6.51984 3 6.09202 3.21799C5.71569 3.40973 5.40973 3.71569 5.21799 4.09202C5 4.51984 5 5.07989 5 6.2V17.8C5 18.9201 5 19.4802 5.21799 19.908C5.40973 20.2843 5.71569 20.5903 6.09202 20.782C6.51984 21 7.07989 21 8.2 21Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
			        </button>
                    </div>
                </div>
                <!-- Resultado de la suma de abonos -->
                <div id="resultado" class="font-bold mt-10 p-5 text-center"></div>
            </div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
 
    <script>
    $(document).ready(function() {
    $('#calcular').click(function() {
        var fechainicio = $('#fechainicio').val();
        var fechaFin = $('#fechaFin').val();
        var pkempleado = $('#pkempleado').val();

        $.ajax({
            url: '/calcular-suma-abonos',
            type: 'GET',
            data: {
                fechainicio: fechainicio,
                fechaFin: fechaFin,
                pkempleado: pkempleado
            },
            success: function(response) {
                $('#resultado').text('La suma de los abonos es: ' + response.sumaAbonos);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>







</body>