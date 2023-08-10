@extends('layouts.app')

@section('title', 'Editar Pedido')
@section('content')

    {{-- <section class="section"> --}}
    <section class="" style="">
        <div
            style="
        padding: 40px;
        background-color: #ffffff;
        border: 1px solid #ffffff;
        margin-bottom: 20px;
        height: 5em;
        position: relative;
        width: 180%;
        right: 2.3em;
        bottom: 1em;
        ">
            <div class="section-header">
                <div style="display: flex;position: relative;bottom: 1em">

                    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <h3 class="page__heading ml-3 mb-0">Editar Pedido</h3>
                </div>
            </div>

        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="container">
                                <ul class="product-list">
                                    <li>
                                        <h2>Productos</h2>
                                    </li>
                                    <div class="form-group">
                                        <label for="busqueda">Buscar producto:</label>
                                        <input type="text" id="busqueda" class="form-control"
                                            placeholder="Ingrese el nombre del producto">
                                    </div>
                                    <button class="btn btn-info btn-sm " data-toggle="modal"
                                        data-target="#Personalizados">Personalizados</button>
                                    <!-- Modal Personalizados-->
                                    <div class="modal fade my-modal" id="Personalizados" tabindex="-1" role="dialog"
                                        aria-labelledby="Personalizados" aria-hidden="true"
                                        style="position: absolute; z-index: 1050;">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 style="" class="modal-title" id="Personalizados">Producto
                                                        Personalizados</h2>

                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4>Selecciona 3 insumos para crear un producto personalizado.</h4>
                                                    </div>
                                                    <div style="display: flex">
                                                        <div class="insumos"
                                                            style="flex: 1; margin-right: 20px; overflow-y: scroll; max-height: 200px;">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="buscarInsumo"
                                                                    placeholder="Ingresa el nombre del insumo">
                                                            </div>
                                                            @foreach ($Insumo as $Insumos)
                                                                <div style="margin: 1em" class="insumo"
                                                                    data-id="{{ $Insumos->id }}">
                                                                    <img src="{{ asset($Insumos->imagen) }}"
                                                                        alt="Imagen del producto" width="40em">
                                                                    <span>{{ $Insumos->id }} : {{ $Insumos->nombre }} $:
                                                                        {{ $Insumos->precio_unitario }}</span>
                                                                    <button type="button"
                                                                        class="btn btn-success agregar-insumo"
                                                                        style="max-width: 1em; max-height: 1.5em;">
                                                                        <i class="fas fa-plus fa-xs"
                                                                            style="position: relative; bottom: 8.5px;right: 5px"></i>
                                                                        <!-- Icono de Font Awesome para el botón -->
                                                                    </button>
                                                                    <br>
                                                                </div>
                                                            @endforeach
                                                        </div>


                                                        <div class="insumos_selecionados"
                                                            style="flex: 1; margin-top: 10px; overflow-y: scroll; max-height: 200px;">
                                                            <h3>Insumo seleccionados</h3>
                                                            <ul class="lista-insumos-seleccionados"></ul>
                                                            <!-- Usaremos una lista para mostrar los insumos seleccionados -->
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Agrega aquí más detalles del producto Personalizados si es necesario -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" id="crearPersonalizados"
                                                        data-dismiss="modal"
                                                        onclick="actualizarTotalCarrito(true); mostrarAlertaExitosa('Producto agregado al carrito exitosamente');">Crear</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            // Obtener referencia al campo de búsqueda
                                            const inputBuscarInsumo = document.getElementById('buscarInsumo');

                                            // Obtener todas las filas de insumos para poder mostrar/ocultar según el filtro
                                            const insumosFila = document.querySelectorAll('.insumos .insumo');

                                            // Agregar evento de input para el campo de búsqueda
                                            inputBuscarInsumo.addEventListener('input', function() {
                                                const terminoBusqueda = inputBuscarInsumo.value.trim().toLowerCase();

                                                // Mostrar solo los insumos que coinciden con el término de búsqueda
                                                insumosFila.forEach(function(filaInsumo) {
                                                    const textoInsumo = filaInsumo.querySelector('span').textContent.toLowerCase();
                                                    if (textoInsumo.includes(terminoBusqueda)) {
                                                        filaInsumo.style.display = 'block';
                                                    } else {
                                                        filaInsumo.style.display = 'none';
                                                    }
                                                });
                                            });
                                        });
                                    </script>
                                    <!-- Modal Personalizados-->
                                    @foreach ($productos as $producto)
                                        @if ($producto->activo)
                                            <li>

                                                <img src="{{ asset($producto->imagen) }}" alt="Imagen del producto"
                                                    width="40em">
                                                <span>{{ $producto->id }}:{{ $producto->nombre }}
                                                    <br>$: {{ number_format($producto->precio, 0, ',', '.') }} </span>
                                                <button class="btn btn-primary btn-sm float-right"
                                                    onclick="agregarProducto('{{ $producto->id }}', '{{ $producto->nombre }}','{{ $producto->precio }}')">Agregar</button>
                                                <button class="btn btn-info btn-sm float-right" data-toggle="modal"
                                                    data-target="#productModal_{{ $producto->id }}">Detalles</button>
                                            </li>

                                            <!-- Modal -->
                                            <div class="modal fade my-modal" id="productModal_{{ $producto->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="productModalLabel_{{ $producto->id }}" aria-hidden="true"
                                                style="position: absolute; z-index: 1050;">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="productModalLabel_{{ $producto->id }}">
                                                                Detalles del producto</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>ID: {{ $producto->id }}</p>
                                                            <p>Nombre: {{ $producto->nombre }}</p>
                                                            <p>Precio: ${{ $producto->precio }}</p>
                                                            <!-- Agrega aquí más detalles del producto si es necesario -->
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>


                            <div class="selected-products-container">
                                <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="">
                                        <div class="col-md-6">

                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Usuario">Usuario:</label>
                                                        <select name="Usuario" id="Usuario"
                                                            class="form-control select2" data-live-search="true" required>
                                                            @foreach ($users as $user)
                                                                @if ($pedido->id_users == $user->id)
                                                                    <option value="{{ $user->id }}" selected>
                                                                        {{ $user->name }}</option>
                                                                @else
                                                                    <option value="{{ $user->id }}">
                                                                        {{ $user->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Estado">Estado</label>
                                                        <select name="Estado" id="Estado"
                                                            class="form-control select2" data-live-search="true" required>

                                                            <option value="">Seleccionar Estado</option>
                                                            <option value="En_proceso"
                                                                {{ $pedido->Estado == 'En_proceso' ? 'selected' : '' }}>En
                                                                proceso</option>
                                                            <option value="Finalizado"
                                                                {{ $pedido->Estado == 'Finalizado' ? 'selected' : '' }}>
                                                                Finalizado
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <h2>Productos Seleccionados:</h2>
                                                <input type="hidden" name="Productos[]"
                                                    id="productos-seleccionados-input">
                                                <div class="table" style="width: 48em">

                                                    <table style="width: 48em" id="selected-products-table"
                                                        class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Producto</th>
                                                                <th>Cantidad</th>
                                                                <th>Subtotal</th>
                                                                <th>Opciones</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="selected-products-list">
                                                            @foreach ($pedido->productos as $producto)
                                                                <tr data-producto-id="{{ $producto->id }}"
                                                                    data-cantidad="{{ $producto->pivot->cantidad }}"
                                                                    data-subtotal="{{ $producto->precio * $producto->pivot->cantidad }}">
                                                                    <td>{{ $producto->nombre }}</td>
                                                                    <td>{{ $producto->pivot->cantidad }}</td>
                                                                    <td>$
                                                                        {{ number_format($producto->precio * $producto->pivot->cantidad, 0, ',', '.') }}
                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-sm quitar-btn"
                                                                            onclick="quitarProducto('{{ $producto->id }}')"> <li class="fas fa-trash"></li>  </button>
                                                                    </td>
                                                                    <input type="hidden" name="Cantidad[]"
                                                                        value="{{ $producto->pivot->cantidad }}">
                                                                    <input type="hidden" name="ProductoID[]"
                                                                        value="{{ $producto->id }}">
                                                                </tr>
                                                            @endforeach
                                                            <?php $per = 'Personalizado '; ?>
                                                            @foreach ($personaliza as $personalizas)
                                                                @if (!($personalizas->nombre == $per))
                                                                    <?php
                                                                    $per = $personalizas->nombre;
                                                                    $lastSubtotal = null; // Initialize the variable to store the last Subtotal for the current $per
                                                                    ?>
                                                                    @foreach ($personaliza as $personalizaInner)
                                                                        <!-- Loop through the personaliza array again to find the last Subtotal for the current $per -->
                                                                        @if ($personalizaInner->nombre == $per)
                                                                            <?php $lastSubtotal = $personalizaInner->Subtotal; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    <tr>
                                                                        <td>{{ $personalizas->nombre }}</td>
                                                                        <td>{{ $personalizas->cantidad }}</td>
                                                                        <td>{{ number_format($lastSubtotal, 0, ',', '.') }}
                                                                        </td>
                                                                        <!-- Print the last Subtotal for the current $per -->
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm quitar-btn"
                                                                                onclick="quitarProductoPersonalizados2(this)"> <li class="fas fa-trash"></li> </button>

                                                                            <button type="button"
                                                                                class="btn btn-info btn-sm float-right"
                                                                                data-toggle="modal"
                                                                                data-target="#productModalper_{{ $personalizas->insumos }}"
                                                                                data-details="{{ json_encode($personalizas) }}"><i class="fas fa-eye"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach




                                                        </tbody>
                                                        <input type="hidden" name="personalizadosArray"
                                                            id="personalizadosArray">

                                                        <input type="hidden" name="personalizadosArray2"
                                                            id="personalizadosArray2">
                                                    </table>
                                                </div>


                                                <h4>Total: $<span id="total">{{ $pedido->Total }}</span></h4>
                                                <input type="hidden" name="Total" id="total-input"
                                                    value="{{ $pedido->Total }}">



                                            </div>

                                            <div class="form-group">
                                                <label for="Nombre">Descripción:</label>
                                                <input type="text" value="{{ $pedido->Nombre }}" name="Nombre"
                                                    id="Nombre" class="form-control">
                                            </div>
                                            <Script>
                                                let nombreInput = document.getElementById('Nombre');

                                                // Add event listener for 'blur' event to trim the input value
                                                nombreInput.addEventListener('blur', function() {
                                                    nombreInput.value = nombreInput.value.trim();
                                                });
                                            </Script>

                                            <div class="d-flex justify-content-between">
                                                <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
                                                {{-- <a class="btn btn-dark" href="{{ route('pedidos.index') }}">Regresar</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @foreach ($personaliza as $personalizas)
                                <div class="modal fade my-modal" id="productModalper_{{ $personalizas->insumos }}"
                                    tabindex="-1" role="dialog"
                                    aria-labelledby="productModalLabel_{{ $personalizas->insumos }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="productModalLabelper_{{ $personalizas->insumos }}">
                                                    Detalles del producto</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="Nombre">Nombre:
                                                </h6>
                                                <div id="productModalIngredients_{{ $personalizas->insumos }}"
                                                    class="list-group" style="width: 100%; position: relative;right: 2em">
                                                    <!-- Ingredientes se agregarán aquí -->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- JS para cargar los ingredientes en el modal -->
                                <script>
                                    $(document).ready(function() {
                                        $('#productModalper_{{ $personalizas->insumos }}').on('show.bs.modal', function(event) {
                                            var button = $(event.relatedTarget);
                                            var details = button.data('details');
                                            var modal = $(this);

                                            modal.find('.modal-title').text('Detalles del producto: ' + details.nombre);
                                            modal.find('.Nombre').text('Nombre: ' + details.nombre);

                                            var ingredientList = '<ul>';
                                            @foreach ($personaliza as $q)
                                                if ("{{ $q->nombre }}" == details.nombre) {
                                                    ingredientList +=
                                                        '<li class="list-group-item">Insumo: {{ $q->insumos }} - {{ optional(App\Models\Insumo::find($q->insumos))->nombre ?? 'Nombre no encontrado' }}</li>';
                                                }
                                            @endforeach
                                            ingredientList += '</ul>';
                                            modal.find('#productModalIngredients_{{ $personalizas->insumos }}').html(ingredientList);
                                        });
                                    });
                                </script>
                            @endforeach

                            <!-- Modal para mostrar detalles del producto personalizado -->
                            <div class="modal fade my-modal" id="personalizadoDetallesModal" tabindex="-1"
                                role="dialog" aria-labelledby="personalizadoDetallesModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="personalizadoDetallesModalLabel">Detalles del
                                                Producto Personalizado</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 class="modal-nombre">Nombre:</h6>
                                            <ul id="modalPersonalizadoInsumos" class="list-group">
                                                <!-- Insumos se agregarán aquí -->
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#personalizadoDetallesModal').on('show.bs.modal', function(event) {
                                        var button = $(event.relatedTarget);
                                        var index = button.data('index'); // Índice del producto personalizado
                                        var productoPersonalizado = personalizadosArray[index]; // Obtener el producto personalizado

                                        var modal = $(this);
                                        modal.find('.modal-title').text('Detalles del Producto Personalizado');
                                        modal.find('.modal-nombre').text('Nombre: ' + productoPersonalizado.Nombre);

                                        var insumosList = modal.find('#modalPersonalizadoInsumos');
                                        insumosList.empty();

                                        productoPersonalizado.insumos.forEach(function(insumo) {
                                            var insumoItem = $('<li>').addClass('list-group-item').text(insumo);
                                            insumosList.append(insumoItem);
                                        });
                                    });
                                });
                            </script>











                            <script>
                                function calcularTotalInicial() {
                                    var totalElement = document.getElementById('total');
                                    var total = 0; // Restablecer el total a cero antes de recalcularlo
                                    var totalInput = document.getElementById('total-input');

                                    // Sumar los subtotales de los productos
                                    var productos = document.querySelectorAll('#selected-products-list tr');
                                    productos.forEach(function(producto) {
                                        var subtotal = parseFloat(producto.getAttribute('data-subtotal'));
                                        if (!isNaN(subtotal)) {
                                            total += subtotal;
                                        }
                                    });

                                    // Sumar los subtotales de los productos personalizados
                                    var personalizados = document.querySelectorAll('#selected-products-list tr');
                                    personalizados.forEach(function(personalizado) {
                                        var subtotal = parseFloat(personalizado.cells[2].textContent.replace(/\./g, '').replace(',', '.'));
                                        if (!isNaN(subtotal)) {
                                            total += subtotal;
                                        }
                                    });

                                    var totalFormateado = total.toLocaleString(undefined, {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado;
                                    totalInput.value = total.toFixed(2);
                                }
                                // Llamamos a la función al cargar la página
                                window.addEventListener('load', calcularTotalInicial);
                            </script>

                            <script>
                                var totalElement = document.getElementById('total');
                                var totalInput = document.getElementById('total-input');
                                var total = parseFloat(totalElement.textContent);

                                function agregarProducto(id, nombre, precio) {
                                    var cantidad = prompt('Ingrese la cantidad del producto "' + nombre + '":');
                                    if (cantidad !== null && cantidad !== '') {
                                        cantidad = parseInt(cantidad);
                                        var subtotal = cantidad * precio;

                                        var productosSeleccionados = document.getElementById('selected-products-list');
                                        var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');

                                        var tr = document.createElement('tr');
                                        tr.setAttribute('data-producto-id', id);
                                        tr.setAttribute('data-cantidad', cantidad);
                                        tr.setAttribute('data-subtotal', subtotal);
                                        tr.innerHTML = `
                                            <td>${nombre}</td>
                                            <td>${cantidad}</td>
                                            <td>$${subtotal.toLocaleString('en-US')}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm quitar-btn" onclick="quitarProducto('${id}')"><li class="fas fa-trash"></li></button>
                                            </td>
                                        `;
                                        productosSeleccionados.appendChild(tr);

                                        var inputCantidad = document.createElement('input');
                                        inputCantidad.type = 'hidden';
                                        inputCantidad.name = 'Cantidad[]';
                                        inputCantidad.value = cantidad;
                                        productosSeleccionados.appendChild(inputCantidad);

                                        var inputProductoID = document.createElement('input');
                                        inputProductoID.type = 'hidden';
                                        inputProductoID.name = 'ProductoID[]';
                                        inputProductoID.value = id;
                                        productosSeleccionados.appendChild(inputProductoID);

                                        var productosSeleccionadosArray = Array.from(productosSeleccionados.querySelectorAll('tr')).map(function(
                                            tr) {
                                            return tr.textContent.split('\t');
                                        });
                                        inputProductosSeleccionados.value = JSON.stringify(productosSeleccionadosArray);



                                        var totalElement = document.getElementById('total');
                                        var totalActual = parseFloat(totalElement.textContent.replace(/\./g, '').replace(',', '.'));
                                        var totalNuevo = totalActual + subtotal; // Sumamos el subtotal al total actual para obtener el nuevo total

                                        // Actualizar el elemento de visualización del total
                                        var totalFormateado = totalNuevo.toLocaleString(undefined, {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        });
                                        totalElement.textContent = totalFormateado;

                                        var totalInput = document.getElementById('total-input');
                                        totalInput.value = totalNuevo.toFixed(2);
                                    }
                                }



                                function quitarProducto(id) {
                                    var producto = document.querySelector(`tr[data-producto-id="${id}"]`);
                                    var cantidad = parseInt(producto.getAttribute('data-cantidad'));
                                    var subtotal = parseFloat(producto.getAttribute('data-subtotal'));

                                    producto.remove();

                                    var totalElement = document.getElementById('total');
                                    var totalInput = document.getElementById('total-input');
                                    var total = parseFloat(totalElement.textContent.replace(/\./g, '').replace(',', '.'));

                                    total -= subtotal; // Restamos el subtotal del producto eliminado al total

                                    // Actualizar el elemento de visualización del total
                                    var totalFormateado = total.toLocaleString(undefined, {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado;

                                    // Actualizar el campo oculto con los datos actualizados
                                    totalInput.value = total.toFixed(2);

                                    var inputProductosSeleccionados = document.getElementById('productos-seleccionados-input');
                                    var productosSeleccionados = Array.from(document.querySelectorAll('#selected-products-list tr')).map(function(
                                        tr) {
                                        return {
                                            id: tr.getAttribute('data-producto-id'),
                                            cantidad: parseInt(tr.getAttribute('data-cantidad')),
                                            subtotal: parseFloat(tr.getAttribute('data-subtotal'))
                                        };
                                    });

                                    inputProductosSeleccionados.value = JSON.stringify(productosSeleccionados);
                                }

                                const busquedaInput = document.getElementById('busqueda');
                                const productItems = document.querySelectorAll('.product-list li');

                                busquedaInput.addEventListener('input', function() {
                                    const searchTerm = busquedaInput.value.toLowerCase();

                                    productItems.forEach(function(item) {
                                        const nombreProducto = item.textContent.toLowerCase();

                                        if (nombreProducto.includes(searchTerm)) {
                                            item.style.display = 'block';
                                        } else {
                                            item.style.display = 'none';
                                        }
                                    });
                                });
                            </script>

                            <script>
                                const busquedaInput = document.getElementById('busqueda');
                                const productItems = document.querySelectorAll('.product-list li');

                                busquedaInput.addEventListener('input', function() {
                                    const searchTerm = busquedaInput.value.toLowerCase();

                                    productItems.forEach(function(item) {
                                        const nombreProducto = item.textContent.toLowerCase();

                                        if (nombreProducto.includes(searchTerm)) {
                                            item.style.display = 'block';
                                        } else {
                                            item.style.display = 'none';
                                        }
                                    });
                                });
                            </script>



                            <script>
                                $(document).ready(function() {
                                    var maxSeleccionados = 3; // Cantidad máxima de productos seleccionados
                                    var insumosSeleccionadosSet = new Set();

                                    $('.agregar-insumo').click(function() {
                                        if ($('.insumos_selecionados li').length < maxSeleccionados) {
                                            var insumoId = $(this).closest('.insumo').data('id');
                                            var insumoNombre = $(this).siblings('span').text();

                                            if (!insumosSeleccionadosSet.has(insumoId)) {
                                                // Agrega el insumo al conjunto de IDs de insumos seleccionados
                                                insumosSeleccionadosSet.add(insumoId);

                                                // Crea un elemento de lista con el nombre del insumo seleccionado
                                                var listItem = $('<li>').text(insumoNombre);

                                                // Agrega un botón para eliminar el insumo seleccionado
                                                // var removeButton = $('<button>').text('Quitar').addClass(
                                                //     'btn btn-danger quitar-insumo');
                                                var removeButton = $('<button>').html('<i class="fas fa-trash"></i>').addClass(
                                                    'btn btn-danger quitar-insumo').css({
                                                    margin: '8px',



                                                });
                                                // Agrega el insumo seleccionado a la lista de insumos seleccionados
                                                $('.lista-insumos-seleccionados').append(listItem.append(removeButton));
                                            } else {
                                                alert('El insumo ya ha sido seleccionado anteriormente.');
                                            }
                                        } else {
                                            alert('Ya has seleccionado la cantidad máxima de productos.');
                                        }
                                    });

                                    // Función para quitar un insumo seleccionado
                                    $(document).on('click', '.quitar-insumo', function() {
                                        var insumoId = $(this).closest('.insumo').data('id');

                                        // Elimina el insumo del conjunto de IDs de insumos seleccionados
                                        insumosSeleccionadosSet.delete(insumoId);

                                        $(this).closest('li').remove();
                                    });

                                    $('#Personalizados').on('hidden.bs.modal', function() {
                                        // Elimina todos los insumos seleccionados y vacía el conjunto de IDs
                                        $('.lista-insumos-seleccionados').empty();
                                        insumosSeleccionadosSet.clear();
                                    });
                                });
                            </script>

                            <script>
                                var personalizadosArray = [];
                                // personalizadosArray2
                                function obtenerNumeroMayorPersonalizadosArray() {
                                    var maxNum = 0;

                                    personalizadosArray.forEach(function(personalizado) {
                                        var numStr = personalizado.Nombre.match(/\d+/); // Extraer el número del nombre
                                        if (numStr) {
                                            var num = parseInt(numStr[0]);
                                            if (num > maxNum) {
                                                maxNum += num;
                                            }
                                        }
                                    });

                                    personalizadosArray2.forEach(function(personalizado) {
                                        var numStr = personalizado.Nombre.match(/\d+/); // Extraer el número del nombre
                                        if (numStr) {
                                            var num = parseInt(numStr[0]);
                                            if (num > maxNum) {
                                                maxNum += num;
                                            }
                                        }
                                    });

                                    return maxNum;
                                }

                                function obtenerNumeroMayorPersonalizadosTabla() {
                                    var maxNum = 0;

                                    var rows = document.querySelectorAll('#selected-products-list tr');
                                    rows.forEach(function(row) {
                                        var nombreCell = row.querySelector('td:nth-child(1)');
                                        if (nombreCell) {
                                            var numStr = nombreCell.textContent.match(/\d+/); // Extraer el número del nombre
                                            if (numStr) {
                                                var num = parseInt(numStr[0]);
                                                if (num > maxNum) {
                                                    maxNum = num;
                                                }
                                            }
                                        }
                                    });

                                    return maxNum;
                                }

                                document.getElementById('crearPersonalizados').addEventListener('click', function() {
                                    var insumosSeleccionados = Array.from(document.querySelectorAll('.insumos_selecionados li')).map(
                                        function(li) {
                                            return li.textContent.trim();
                                        }
                                    );

                                    var cantidad = prompt('Ingrese la cantidad para el producto personalizado:', '1');
                                    if (cantidad === null || cantidad === '') {
                                        return; // Si el usuario cancela o no ingresa un valor, no se agrega el producto
                                    }

                                    cantidad = parseInt(cantidad);

                                    var tableBody = document.getElementById('selected-products-list');
                                    var subtotal = 0;

                                    insumosSeleccionados.forEach(function(insumo) {
                                        var data = insumo.split(':');
                                        var precio = parseFloat(data[2].trim());
                                        subtotal += parseFloat(precio) * cantidad;
                                    });

                                    var personalizado = {}; // Crear un objeto para almacenar los datos del personalizado
                                    var numMaxTabla = obtenerNumeroMayorPersonalizadosTabla();
                                    var numMaxArray = obtenerNumeroMayorPersonalizadosArray();
                                    var maxNum = Math.max(numMaxTabla, numMaxArray);

                                    personalizado['Nombre'] = "Personalizado " + (maxNum + 1);
                                    personalizado['insumos'] = insumosSeleccionados;
                                    personalizado['Subtotal'] = subtotal;
                                    personalizado['Cantidad'] = cantidad; // Agregar la cantidad al objeto personalizado

                                    personalizadosArray.push(personalizado);

                                    var row = document.createElement('tr');
                                    var uniqueId = personalizadosArray.length - 1; // Obtener el índice único del personalizado
                                    row.innerHTML = `
            <td>${personalizado.Nombre}</td>
            <td>${cantidad}</td>
            <td>${subtotal.toLocaleString('en-US')}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm quitar-btn" onclick="quitarProductoPersonalizados(${uniqueId})"> <i class="fas fa-trash"></i> </button>
                <button type="button" class="btn btn-info btn-sm float-right"  data-index="${uniqueId}" data-toggle="modal" data-target="#personalizadoDetallesModal"><i class="fas fa-eye"></i></button>
            </td>
        `;
                                    row.setAttribute('data-id', uniqueId); // Asignar el índice único como el atributo data-id
                                    tableBody.appendChild(row);

                                    var totalElement = document.getElementById('total');
                                    var total = parseFloat(totalElement.textContent.replace(/\./g, '').replace(',', '.')) + parseFloat(
                                        subtotal);

                                    var totalFormateado = total.toLocaleString('es-ES', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado; // Actualizar el contenido con el total formateado

                                    var totalInput = document.getElementById('total-input');
                                    totalInput.value = total.toFixed(2);

                                    var totalSection = document.getElementById('total-section');
                                    if (totalSection) {
                                        totalSection.style.display = 'block';
                                    }

                                    console.log('Datos personalizados:', personalizadosArray);

                                    var personalizadosArrayInput = document.getElementById('personalizadosArray');
                                    personalizadosArrayInput.value = JSON.stringify(personalizadosArray);
                                });


                                function quitarProductoPersonalizados(id) {
                                    // Obtener el personalizado correspondiente al ID
                                    var personalizado = personalizadosArray[id];

                                    // Restar el subtotal del producto personalizado al total general
                                    var subtotalEliminado = personalizado.Subtotal;
                                    var totalElement = document.getElementById('total');

                                    var total = parseFloat(totalElement.textContent.replace(/\./g, '').replace(',', '.'));

                                    total -= subtotalEliminado; // Restamos el subtotal del producto personalizado al total general

                                    // Actualizar el elemento de visualización del total
                                    var totalFormateado = total.toLocaleString('es-ES', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado;

                                    var totalInput = document.getElementById('total-input');
                                    totalInput.value = total.toFixed(2);

                                    // Eliminar el personalizado del array
                                    personalizadosArray.splice(id, 1);

                                    // Eliminar la fila de la tabla
                                    var row = document.querySelector(`#selected-products-list tr[data-id="${id}"]`);
                                    if (row) {
                                        row.remove();
                                    }

                                    // Actualizar el campo oculto con los datos actualizados
                                    var personalizadosArrayInput = document.getElementById('personalizadosArray');
                                    personalizadosArrayInput.value = JSON.stringify(personalizadosArray);
                                }










                                var personalizadosArray2 = [];
                                var nombresRepetidos = [];

                                @foreach ($personaliza as $personalizas)
                                    var personalizado = {};
                                    personalizado['Nombre'] = '{{ $personalizas->nombre }}';
                                    personalizado['Insumos'] = [];

                                    @foreach (\App\Models\ProducPerz::where('id', $personalizas->id)->get() as $producPerz)
                                        var insumoObj = {
                                            'id': {{ $producPerz->insumos }},
                                            'cantidad': {{ $producPerz->cantidad }},
                                        };

                                        personalizado['Insumos'].push(insumoObj);
                                    @endforeach

                                    personalizado['Subtotal'] = '{{ $personalizas->Subtotal }}';

                                    personalizadosArray2.push(personalizado);

                                    // Verificar si el nombre de pedido ya ha sido registrado
                                    if (nombresRepetidos.indexOf('{{ $personalizas->nombre }}') === -1) {
                                        nombresRepetidos.push('{{ $personalizas->nombre }}');
                                    }
                                @endforeach

                                var totalPorNombre = {};
                                var totalGeneral = 0;

                                personalizadosArray2.forEach(function(personalizado) {
                                    var nombre = personalizado['Nombre'];
                                    var subtotal = parseFloat(personalizado['Subtotal']);

                                    if (nombresRepetidos.indexOf(nombre) !== -1) {
                                        // Solo tomar el primer total de un nombre de pedido repetido
                                        if (!totalPorNombre.hasOwnProperty(nombre)) {
                                            totalPorNombre[nombre] = subtotal;
                                            totalGeneral += subtotal;
                                        }
                                    } else {
                                        totalPorNombre[nombre] = subtotal;
                                        totalGeneral += subtotal;
                                    }
                                });
                                // Actualizar el campo oculto con los datos actualizados
                                var personalizadosArray2Input = document.getElementById('personalizadosArray2');
                                personalizadosArray2Input.value = JSON.stringify(personalizadosArray2);

                                var totalInput = document.getElementById('total-input');
                                var totalValue = parseFloat(totalInput.value);

                                // Obtener el elemento del total en el encabezado
                                var totalElement = document.getElementById('total');

                                // Obtener el valor existente en el elemento del total en el encabezado
                                var existingTotal = parseFloat(totalElement.textContent);

                                // Calcular el nuevo total sumando el valor del campo oculto al valor existente
                                var newTotal = totalValue;

                                // Actualizar el contenido del elemento del total en el encabezado con el nuevo total calculado

                                var totalFormateado = total.toLocaleString(undefined, {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });
                                totalElement.textContent = totalFormateado;

                                totalInput.value = totalNuevo.toFixed(2);



                                console.log(personalizadosArray2)

                                function quitarProductoPersonalizados2(button) {
                                    var row = button.closest('tr'); // Obtener la fila que contiene el botón

                                    // Obtener los datos de la fila
                                    var nombre = row.cells[0].textContent;
                                    var cantidad = row.cells[1].textContent;
                                    var subtotal = row.cells[2].textContent.replace(/\./g, '').replace(',', '.');

                                    // Eliminar la fila de la tabla
                                    row.remove();

                                    // Actualizar el campo oculto con los datos actualizados
                                    var personalizadosArray2Input = document.getElementById('personalizadosArray2');
                                    personalizadosArray2Input.value = obtenerPersonalizadosArray2Actualizado();

                                    // Recalcular el total restando el subtotal eliminado
                                    var totalInput = document.getElementById('total-input');
                                    var total = parseFloat(totalInput.value) - parseFloat(subtotal);
                                    total = total < 0 ? 0 : total; // Verificar si el total es menor que cero y establecerlo en cero si es así
                                    totalInput.value = total.toFixed(2);

                                    // Actualizar el elemento de visualización del total
                                    var totalElement = document.getElementById('total');
                                    var totalFormateado = total.toLocaleString(undefined, {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    });
                                    totalElement.textContent = totalFormateado;





                                }


                                function obtenerPersonalizadosArray2Actualizado() {
                                    var personalizadosArray2Actualizado = [];

                                    // Recorrer las filas de la tabla de personalizados
                                    var filas = document.querySelectorAll('tr[data-producto-id]');
                                    filas.forEach(function(row) {
                                        var nombre = row.cells[0].textContent;
                                        var cantidad = row.cells[1].textContent;
                                        var subtotal = row.cells[2].textContent;

                                        var personalizado = {
                                            'Nombre': nombre,
                                            'Insumos': [],
                                            'Subtotal': subtotal
                                        };

                                        personalizadosArray2Actualizado.push(personalizado);
                                    });

                                    return JSON.stringify(personalizadosArray2Actualizado);
                                }
                            </script>






                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .container {
            width: 20em;
            height: 100vh;
            overflow-y: scroll;
            float: right;
        }

        .product-list {
            list-style-type: none;
            padding: 0;
        }

        .product-list li {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
    </style>
@endsection
