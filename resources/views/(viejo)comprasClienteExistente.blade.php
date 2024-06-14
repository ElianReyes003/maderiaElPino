<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maderas El Pino</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>

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
<table>
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

<input type="search"  id="default-search" name="searchTerm" value="">

<select name="fkCategoria" id="fkCategoria">
  @php
    use App\Models\categoriaArticulo;
    $datosCategoria=categoriaArticulo::all();
  @endphp
  <option value="">Selecciona Categoria Articulo</option>
  @foreach ($datosCategoria as $dato)
    <option value="{{$dato->pkCategoriaArticulo}}">{{$dato->nombreCategoriaArticulo}}</option>
  @endforeach
</select>
<select name="fkEstatus" id="fkEstatus">

    <option value="1">Estatus</option>
    <option value="1">Disponible</option>
    <option value="0">No Disponible</option>
</select>
<h2>Selecciona articulos</h2>



</div>

<table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Estatus</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody id="resultadosBusqueda" class="resultadosBusqueda">
       

            <!-- Puedes agregar más filas según sea necesario -->
        </tbody>
    </table>

    <div id="controlesPaginacion"></div>
    <h2>Articulos</h2>
<table class="articulos-lista">
    <thead>
        <tr>
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
    <input type="date" id="" name="" value="">
    <input type="hidden" name="articulos" id="articulos" value="">
    <input type="hidden" name="cliente" id="cliente" value="">
<input type="submit" id="completar" class="completar"value="Completar">
<input type="submit" value="Cancelar">
</form>



<script>
///INSERTAR ARREGLO DE ARTICULOS Y CLIENTE SELECCIONADO
$('#completar').click(function () {
    // Actualiza los valores de los campos ocultos
   
    // Serializa el arreglo de artículos y almacénalo en el campo oculto
    var articulos = [];
    var cantidades = [];
    var contador=0;
    var clienteSeleccionado = 0;

    // Evento del formulario al enviar
    $('#formulario').submit(function (event) {
        // Obtén el pkCliente seleccionado
        clienteSeleccionado = $('input[name="cliente-seleccionado"]:checked').data('cliente-id');
        console.log("cliente seleccionado pk: " + clienteSeleccionado);

        // Puedes asignar el valor al campo oculto aquí si es necesario
        $('#cliente').val(clienteSeleccionado);

        // Continúa con el envío del formulario si es necesario
    });

    $('input[name="cantidades\[\]"]').each(function() {
  
        var cantidad = $(this).val();
       cantidades.push({
        cantidad:cantidad
    })
    });
    $('.articulo-seleccionado').each(function () {
        var articuloId = $(this).data('articulo-id');
        var tipoVenta = $(this).find('[name="fkTipoVenta"]').val();

      
        articulos.push({
            id: articuloId,
            cantidad: cantidades[contador].cantidad,
            tipoVenta:tipoVenta
        });
        contador++;
    });

    $('#articulos').val(JSON.stringify(articulos));
    $('#cliente').val(JSON.stringify(clienteSeleccionado));
    // Envía el formulario
    $('#formulario').submit();
});

/////////////////////////
   
   var tipoVentaSeleccionado = 1;
   var totalPago = 0;
   var totalEnganche = 0;
   function calcularTotales() {
  var totalEnganche = 0;
  var total = 0;

$('.articulo-seleccionado').each(function() {
  var precio = parseFloat($('.precio-articulo'+$(this).data('articulo-id')).text()) || 0;
  var enganche = parseFloat($('.enganchesito'+$(this).data('articulo-id')).text()) || 0;
  total += precio;
  totalEnganche += enganche;
});

$('.totalPago').text(total.toFixed(2));
$('.totalEnganche').text(totalEnganche.toFixed(2));

}

$(document).ready(function () {
  $(document).on('change', '.seleccionar-articulo', function () {
    $('#detalle-articulos-body').empty();
  
    $('.seleccionar-articulo:checked').each(function () {
      var articuloId = $(this).data('articulo-id');

      $.ajax({
        url: '/obtener-detalle-articulo/' + articuloId + '/' + tipoVentaSeleccionado,
        method: 'GET',
        success: function (data) {
          console.log("enganche original "+data.enganche);
          var newRow = '<tr class="articulo-seleccionado" data-articulo-id="' + articuloId + '">' +
            '<td class="nombre-articulo">' + data.nombreArticulo + '</td>' +
            '<td class="categoria-articulo'+ articuloId +'">' + data.categoriaArticulo + '</td>' +
            '<td class="precio-articulo' + articuloId + '" data-cantidad="' + data.cantidadTipoVenta + '">' + data.cantidadTipoVenta + '</td>'+
            '<td><input type="number" class="cantidad'  + articuloId + '" id="cantidad' + articuloId + '" name="cantidades[]" value="1" min="1"> </td>' +
            '<td>' +
            '<select id="fkTipoVenta' + articuloId + '" name="fkTipoVenta" class="p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" required>';
            

          <?php foreach ($datosTipoVenta as $opcion): ?>
            newRow += '<option value="<?= $opcion->pkTipoVenta ?>"><?= $opcion->nombreTipoVenta ?></option>';
          <?php endforeach; ?>

          newRow += '</select></td>' +
            '<td><input type="button" class="cancelar-articulo" value="Cancelar"></td>' +'<td class="enganchesito' + articuloId + '" data-enganche="' + data.enganche + '" >'+
            '</tr>';
          $('#detalle-articulos-body').append(newRow);
          $('.articulos-lista').show();
          var precioOriginal = data.cantidadTipoVenta;
          var engancheOriginal = data.enganche;
        $('.precio-articulo'+articuloId).data('precio-original', precioOriginal);
        $('.enganchesito'+articuloId).data('enganche-original', engancheOriginal);
          calcularTotales();
        },
        error: function () {
          console.log('Error al obtener detalles del artículo');
        }
      });
    });

    updateArticulosListaVisibility();
  });
  var totalPago = 0; // Declara totalPago fuera del evento change

$(document).on('change', '[id^="fkTipoVenta"]', function () {
    tipoVentaSeleccionado = $(this).val();
    var articuloId = $(this).closest('.articulo-seleccionado').data('articulo-id');

    $.ajax({
        url: '/obtener-cantidad-tipo-venta/' + articuloId + '/' + tipoVentaSeleccionado,
        method: 'GET',
        success: function (data) {
            console.log(data.cantidadTipoVenta);
            console.log('Elemento buscado:', '.precio-articulo' + articuloId);
            console.log("enganche con select:"+data.enganche);
            // Asegúrate de que el elemento exista antes de intentar actualizarlo
            var elementoPrecio = $('.precio-articulo' + articuloId);
            var elementoEnganche = $('.enganchesito' + articuloId);
            var inputCantidad = $('.cantidad' + articuloId);
            inputCantidad.val(1);

            if (elementoPrecio.length > 0) {
                // Actualiza el contenido del elemento
                elementoPrecio.text(data.cantidadTipoVenta);
                elementoEnganche.text(data.enganche);
                $(document).on('change','[id^="cantidad"]', function() {

                  var cantidad = parseInt($(this).val());

                  var articuloId = $(this).closest('.articulo-seleccionado').data('articulo-id');

                  var precioUnitario = $('.precio-articulo'+articuloId).data('precio-original');
                  var engancheUnitario = $('.enganchesito'+articuloId).data('enganche-original');
                  var precioTotal = cantidad *data.cantidadTipoVenta;
                  var engancheTotal = cantidad * data.enganche;
                  $('.precio-articulo'+articuloId).text(precioTotal);
                  $('.enganchesito'+articuloId).text(engancheTotal);
                  calcularTotales();

                  });



                calcularTotales();
                console.log('Contenido actualizado:', elementoPrecio.text());
            } else {
                console.log('Elemento no encontrado. Comprueba la estructura HTML y la carga diferida.');
            }
        },
        error: function () {
            console.log('Error al obtener la cantidadTipoVenta');
        }
    });
});
$(document).on('change','[id^="cantidad"]', function() {

var cantidad = parseInt($(this).val());

var articuloId = $(this).closest('.articulo-seleccionado').data('articulo-id');

var precioUnitario = $('.precio-articulo'+articuloId).data('precio-original');
var engancheUnitario = $('.enganchesito'+articuloId).data('enganche-original');
var precioTotal = cantidad * precioUnitario;
var engancheTotal = cantidad * engancheUnitario;
$('.precio-articulo'+articuloId).text(precioTotal);
$('.enganchesito'+articuloId).text(engancheTotal);

calcularTotales();

});


//boton de BORRAR-------------------------------------------------------------
$(document).on('click', '.cancelar-articulo', function(e) {
        e.preventDefault();

        // Obtener el ID del artículo desde el atributo data
        var articuloId = $(this).closest('.articulo-seleccionado').data('articulo-id');

        // Quitar la fila correspondiente
        $('.articulo-seleccionado[data-articulo-id="' + articuloId + '"]').remove();

        // Deseleccionar el checkbox de selección de artículo original
        $('.seleccionar-articulo[data-articulo-id="' + articuloId + '"]').prop('checked', false);
      
        calcularTotales();
        // Ocultar la sección "Articulos" si no hay artículos seleccionados
        if ($('.seleccionar-articulo:checked').length === 0) {
            $('.articulos-lista').hide();
        }
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
            url += (searchTermCliente ? '&' : '?') + 'fkColonia=' + fkColonia;
        }

        if (fkCalle) {
            url += (searchTermCliente ? '&' : '?') + 'fkCalle=' + fkCalle;
        }

        console.log(url);
        // Realizar la nueva solicitud Ajax
  
            currentAjaxRequest = $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
                    // Limpiar resultados anteriores
                    $('#resultadosBusquedaCliente').empty();

                    // Agregar nuevos resultados
                    data.forEach(function (dato) {
                        var resultadoHtml = `
                            <tr>
                                <td>${dato.nombreCliente}</td>
                                <td>${dato.nombreMunicipio}</td>
                                <td>${dato.nombreColonia}</td>
                                <td>${dato.nombreCalle}</td>
                                <td><input type="radio" name="cliente-seleccionado" class="seleccionar-cliente" data-cliente-id="${dato.pkCliente}"></td>
                            </tr>`;

                        resultadoHtml = resultadoHtml.replace(/:pkCliente/g, dato.pkCliente);
                        $('#resultadosBusquedaCliente').append(resultadoHtml);
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

     // Manejar cambios en los select
        $('#fkMunicipio, #fkColonia, #fkCalle').on('change', function () {
            var searchTermCliente = $('#searchTermCliente').val();
            var fkMunicipio = $('#fkMunicipio').val();
            var fkColonia = $('#fkColonia').val();
            var fkCalle = $('#fkCalle').val();
            cargarDatosYMostrarResultadosCliente(searchTermCliente, fkMunicipio, fkColonia, fkCalle);
        });

});

////////////////////////////FILTRO DE ARTICULOS EN TIEMPO REAL ////////////////////////////////////////////
$(document).ready(function () {
    // Variable para almacenar la solicitud Ajax actual
    var currentAjaxRequest = null;

    $('#default-search').keypress(function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });

    // Función para cargar datos iniciales y mostrar resultados
    function cargarDatosYMostrarResultados(searchTerm = null, fkCategoria = null, fkEstatus = null) {
        // Cancelar la solicitud Ajax actual si existe
        if (currentAjaxRequest) {
            currentAjaxRequest.abort();
        }

        var url = '{{ route("buscarArticulo") }}';

        // Si se proporciona un término de búsqueda, ajustar la URL
        if (searchTerm) {
            url += '?searchTerm=' + searchTerm;
        }

        // Agregar los valores de los select como parámetros adicionales
        if (fkCategoria) {
            url += (searchTerm ? '&' : '?') + 'fkCategoria=' + fkCategoria;
        }

        if (fkEstatus !== null && fkEstatus !== '') {
            url += ((searchTerm || fkCategoria) ? '&' : '?') + 'fkEstatus=' + fkEstatus;
        }

        // Realizar la nueva solicitud Ajax
        currentAjaxRequest = $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                // Limpiar resultados anteriores
                $('#resultadosBusqueda').empty();

                // Agregar nuevos resultados
                data.forEach(function (dato) {
                    var resultadoHtml = `
                        <tr>
                            <td>${dato.nombreArticulo}</td>
                            <td>${dato.nombreCategoriaArticulo}</td>
                            <td>${dato.cantidadTipoVenta}</td>
                            <td>${dato.estatus == 1 ? 'Disponible' : (dato.estatus == 2 ? 'No Disponible' : 'Otro estado')}</td>
                            <td><input type="checkbox" class="seleccionar-articulo" data-articulo-id="${dato.pkArticulo}"></td>
                        </tr>`;

                    resultadoHtml = resultadoHtml.replace(/:pkArticulo/g, dato.pkArticulo);
                    $('#resultadosBusqueda').append(resultadoHtml);
                });
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }

    // Cargar datos iniciales al iniciar la página
    cargarDatosYMostrarResultados();

    // Manejar la presentación de resultados mientras se escribe en el campo de búsqueda
    $('#default-search').on('input', function () {
        var searchTerm = $(this).val();
        var fkCategoria = $('#fkCategoria').val();
        var fkEstatus = $('#fkEstatus').val();
        cargarDatosYMostrarResultados(searchTerm, fkCategoria, fkEstatus);
    });

    // Manejar cambios en los select
    $('#fkCategoria, #fkEstatus').on('change', function () {
        var searchTerm = $('#default-search').val();
        var fkCategoria = $('#fkCategoria').val();
        var fkEstatus = $('#fkEstatus').val();
        cargarDatosYMostrarResultados(searchTerm, fkCategoria, fkEstatus);
    });
});

</script>







</body>