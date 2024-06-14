<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
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

<form  id="formulario"  action="{{ route('compraCExistente.insertar') }}" enctype="multipart/form-data"  method="post" >

    @csrf
    @php
        use App\Models\TipoVenta;
        $datosTipoVenta = TipoVenta::all();
    @endphp

<input type="search"  id="searchTermCliente" name="searchTermCliente" value="">
  <select name="fkMunicipio" id="fkMunicipio">
  @php
    use App\Models\Municipio;
    $datosMunicipio=Municipio::all();
  @endphp
  <option value="">Selecciona Municipio</option>
  @foreach ($datosMunicipio as $dato)
    <option value="{{$dato->pkMunicipio}}">{{$dato->nombreMunicipio}}</option>
  @endforeach
</select>
<select name="fkColonia" id="fkColonia">
 

    <option value=""></option>

</select>
<select name="fkCalle" id="fkCalle">
 
  
    <option value=""></option>
  
</select>
<table id="clientes">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Municipio</th>
                <th>Colonia</th>
                <th>Calle</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody id="resultadosBusquedaCliente" class="resultadosBusqueda">
       

            <!-- Puedes agregar más filas según sea necesario -->
        </tbody>
</table>


<input type="busqueda"  id="busqueda" name="busqueda" value="">

<select name="fkCategoria" id="fkCategoria">
  @php
    use App\Models\categoriaArticulo;
    $datosCategoria=categoriaArticulo::all();
  @endphp
  <option value="">Selecciona Categoria Articulo</option>
  @foreach ($datosCategoria as $dato)
    <option value="{{$dato->nombreCategoriaArticulo}}">{{$dato->nombreCategoriaArticulo}}</option>
  @endforeach
</select>
<select name="fkEstatus" id="fkEstatus">

    <option value="">Estatus</option>
    <option value="Disponible">Disponible</option>
    <option value="No Disponible">No Disponible</option>
</select>
<h2>Selecciona articulos</h2>



</div>

<table id="tablaArticulos" class="tablaArticulos">
        <thead>
            <tr>
            <td class="oculto">ID</td>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Estatus</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody id="resultadosBusqueda" class="resultadosBusqueda">
        @foreach ($datosArticulos as $dato )   
                <tr>
                        <td class="oculto">{{$dato->pkArticulo}}</td>
                        <th>{{$dato->nombreArticulo}}</th>
                        <th>{{$dato->nombreCategoriaArticulo}}</th>
                        <th>{{$dato->cantidadTipoVenta}}</th>
                        <th>{{$dato->ESTATUSARTICULO}}</th>
                        <th>
                            <input type="checkbox" name="articulo-seleccionado" class="w-6 h-6 rounded text-green-400 bg-gray-100 border-gray-300 focus:ring-green-400 focus:ring-2" class="seleccionar-articulo" data-articulo-id="{{$dato->pkArticulo}}">
                        </th>
                </tr>
        @endforeach

            <!-- Puedes agregar más filas según sea necesario -->
        </tbody>
    </table>

    <h2>Articulos</h2>
<table id="articulos-lista" class="articulos-lista">
    <thead>
        <tr>  
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Precio</th>
            <th>Ingresa cantidad</th>
            <th>Tipo de compra</th>
            <th>Cancelar</th>
        </tr>
    </thead>
    <tbody id="detalle-articulos-body"></tbody>
</table>

<label for="">total a pagar <label class="totalPago" for="">$$$</label></label>
<label for="">total enganche <label class="totalEnganche" for="">$$$</label></label>

<input type="hidden" name="producto_id[]" value="">
<input type="hidden" name="cantidadotas[]" value="">
<input type="hidden" name="tipoVenta[]" value="">
<input type="hidden" name="cliente" id="cliente" value="">
<input type="submit" id="completar" class="completar"value="Completar">
<input type="submit" value="Cancelar">



</form>



<script>


var fila=0;
    var numeroDeFila=0;
    var precioOriginal=0;
    var tipoVentaSelected = 0;
   
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

        total += isNaN(cantidad) ? 0 : cantidad * precioOriginal;

        // Calcular el enganche solo si el tipo de venta es diferente de 1
        if (tipoVentaSelected!== "1") {
            enganche += isNaN(cantidad) ? 0 : cantidad * (precioOriginal * 0.10); // 10% del precio original
        }
       
    });

    $('.totalPago').text('$' + total.toFixed(2));

    // Mostrar el total del enganche solo si tipoVentaSeleccionado es diferente de 1
    if (tipoVentaSelected !== "1") {
        $('.totalEnganche').text('$' + enganche.toFixed(2));
    } else {
        $('.totalEnganche').text('$0.00');
    }
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

    var tableArticulosSeleccionados = $('#articulos-lista').DataTable({
        responsive: true,
        "language": {
            "emptyTable": "No hay datos disponibles en la tabla",
        },
    });

    $('#fkEstatus, #fkCategoria').change(function () {
        var estatus = $('#fkEstatus').val();
        var categoria = $('#fkCategoria').val();

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

        var data = tableArticulos.row(this).data();
        var articuloId = data[0];
         
 
   // Move this line above to define precioCell before using it

   var row =tableArticulosSeleccionados.row.add([
            data[0],
            data[1],
            data[2], 
            data[3],
            `<td><input type="number" class="cantidad${articuloId}" id="cantidad${articuloId}" name="cantidades[]" value="1" min="1"></td>`,
            `<td> <select  data-articulo-id="${articuloId}" id="fkTipoVenta' + articuloId + '" name="fkTipoVenta" class="p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" required> <?php foreach ($datosTipoVenta as $opcion): ?>
            newRow += '<option value="<?= $opcion->pkTipoVenta ?>"><?= $opcion->nombreTipoVenta ?></option>';
          <?php endforeach; ?>
>
newRow += '</select></td>`,
            `<button class="cancelar-articulo" data-articulo-id="${articuloId}">Cancelar</button>`

        ]).draw();
    
        actualizarCamposOcultos();
            // Guardar precio original en la estructura de DataTable
        var rowData = row.data();
        rowData.precioOriginal = data[3];
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
    tipoVentaSelected=$(this).val();
    var articuloId = $(this).data('articulo-id');
   
    var fila = $(this).closest('tr');
    // Obtener referencia al input número
    var inputCantidad = $('#cantidad' + articuloId); 

    // Asignar valor 1
    inputCantidad.val(1);

        // Obtiene el número de fila
        numeroDeFila = tableArticulosSeleccionados.row(fila).index();

        console.log("Número de fila: " + numeroDeFila);
        
    actualizarPrecioYCantidad(articuloId, tipoVentaSeleccionado);
    calcularTotalAPagar();
    actualizarCamposOcultos();
});
    $('#articulos-lista tbody').on('click', 'button.cancelar-articulo', function () {
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
function actualizarCamposOcultos() {
  // Limpiar campos ocultos existentes antes de agregar nuevos
  $('#formulario').find('input[name^="producto_id"]').remove();
  $('#formulario').find('input[name^="cantidadotas"]').remove();
  $('#formulario').find('input[name^="tipoVenta"]').remove();

  $('#articulos-lista tbody tr').each(function () {
    var articuloId = $(this).find("[id^=fkTipoVenta]").data("articulo-id");
    var cantidad = $(this).find("[id^=cantidad]").val() || 0;
    var tipoVenta =  $(this).find("[id^=fkTipoVenta]").val() || 0;

    // Agregar nuevos campos ocultos
    $('#formulario').append(
      "<input type='hidden' name='producto_id[]' value='" + articuloId + "'>",
      "<input type='hidden' name='cantidadotas[]' value='" + cantidad + "'>",
      "<input type='hidden' name='tipoVenta[]' value='" + tipoVenta + "'>"
    );
  });
}

$('#completar').click(function () {
  actualizarCamposOcultos();
  clienteSeleccionado = $('input[name="cliente-seleccionado"]:checked').data('cliente-id');
        console.log("cliente seleccionado pk: " + clienteSeleccionado);

        // Puedes asignar el valor al campo oculto aquí si es necesario
        $('#cliente').val(clienteSeleccionado);
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



  //////////////////// FILTRO DE CALLES///////////////////////////////////////////
  $('#fkColonia').on('change', function () {
    var coloniaSeleccionado = $(this).val();
    obtenerCalles(coloniaSeleccionado);
});

// Llamada inicial con la opción "Seleccionar colonia"
obtenerCalles();

function obtenerCalles(coloniaSeleccionado) {
    var selectCalle = $('#fkCalle');
    selectCalle.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar calle" al inicio
    selectCalle.append('<option value="">Seleccionar calle</option>');

    if (coloniaSeleccionado) {
        // Realizar la petición AJAX para obtener las calles
        $.get('/opcionesCallesId?dato=' + coloniaSeleccionado, function (calles) {
            actualizarSelectCalles(calles);
        });
    } else {
        // Si no se seleccionó una colonia, reinicia el select de calles
        actualizarSelectCalles([]);
    }
}

  

  

function actualizarSelectCalles(calles) {
    var selectCalles = $('#fkCalle');
    
    selectCalles.empty(); // Limpia las opciones actuales

    // Agregar la opción "Seleccionar calle" al inicio
    selectCalles.append('<option value="">Seleccionar calle</option>');

    if (calles.length > 0) {
        $.each(calles, function (index, calle) {
            selectCalles.append('<option value="' + calle.pkCalle + '">' + calle.nombreCalle + '</option>');
        });
    } else {
        // Si no hay calles disponibles, mostrar un mensaje
        selectCalles.append('<option value="">No hay calles disponibles en esta colonia</option>');
    }
}


////////////////////////////FILTRO DE CLIENTES EN TIEMPO REAL ////////////////////////////////////////////
$(document).ready(function () {
    // Inicializar DataTables al cargar la página
    var dataTable = $('#clientes').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true
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
                            <td>${dato.nombreCalle}</td>
                            <td><input type="radio" name="cliente-seleccionado" class="w-6 h-6 rounded text-green-400 bg-gray-100 border-gray-300 focus:ring-green-400 focus:ring-2" class="seleccionar-cliente" data-cliente-id="${dato.pkCliente}"></td>
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







</body>