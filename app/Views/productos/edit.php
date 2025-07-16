<!-- Start -->
<div class="card-body">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="producto-tab" data-toggle="tab" href="#producto" role="tab" aria-controls="producto" aria-selected="true">Editar Producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="imagen-tab" data-toggle="tab" href="#imagen" role="tab" aria-controls="imagen" aria-selected="false">Imagen</a>
        </li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="producto" role="tabpanel" aria-labelledby="producto-tab">
            <form id="frmprods-edit" method="post">

                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="clave" class="form-label">Clave</label>
                        <input type="text" class="form-control" id="clave" name="clave" onkeyup="mayusculas(this);">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="descripcion" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" onkeyup="mayusculas(this);">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="linea" class="form-label">Línea</label>
                        <select class="form-control select2" id="linea" name="linea"></select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="unidad" class="form-label">Unidad</label>
                        <select class="form-control" id="unidad" name="unidad">
                            <option value="PZA">PZA</option>
                            <option value="KG">KG</option>
                            <option value="T">T</option>
                            <option value="LTR">LTR</option>
                            <option value="GAL">GAL</option>
                            <option value="JGO">JGO</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <label for="impuesto" class="form-label">Impuesto</label>
                        <select class="form-control select2" id="impuesto" name="impuesto"></select>
                    </div>
                </div>

                <!-- Precios y utilidades y opciones -->
                <div class="row g-3 mt-3">
                    <div class="col-12 col-md-8">
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">Precios y utilidades</div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-12 col-md-4">
                                        <label for="costoultimo" class="form-label">Costo Último</label>
                                        <input type="text" class="form-control" id="costoultimo" name="costoultimo" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="precio" class="form-label">Precio predeterminado</label>
                                        <input type="text" class="form-control" id="precio" name="precio" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="u1" class="form-label">Utilidad</label>
                                        <input type="text" class="form-control" name="u1" id="u1" readonly>
                                    </div>
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col-12 col-md-4">
                                        <label for="c2" class="form-label">Mayoreo 1 a partir de</label>
                                        <input type="text" class="form-control" id="c2" name="c2" onkeyup="validarNumerosDecimales(this);">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="precio2" class="form-label">Precio mayoreo 1</label>
                                        <input type="text" class="form-control" id="precio2" name="precio2" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="u2" class="form-label">Utilidad mayoreo 1</label>
                                        <input type="text" class="form-control" name="u2" id="u2" readonly>
                                    </div>
                                </div>
                                <div class="row g-2 mt-2">
                                    <div class="col-12 col-md-4">
                                        <label for="c3" class="form-label">Mayoreo 2 a partir de</label>
                                        <input type="text" class="form-control" id="c3" name="c3" onkeyup="validarNumerosDecimales(this);">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="precio3" class="form-label">Precio mayoreo 2</label>
                                        <input type="text" class="form-control" id="precio3" name="precio3" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="u3" class="form-label">Utilidad mayoreo 2</label>
                                        <input type="text" class="form-control" name="u3" id="u3" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">Opciones</div>
                            <div class="card-body">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="paraventa" name="paraventa">
                                    <label class="form-check-label" for="paraventa">Artículo para venta</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="invent" name="invent">
                                    <label class="form-check-label" for="invent">Control de inventario</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="granel" name="granel">
                                    <label class="form-check-label" for="granel">Venta a granel</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="speso" name="speso">
                                    <label class="form-check-label" for="speso">Solicitud de peso</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="bajocosto" name="bajocosto">
                                    <label class="form-check-label" for="bajocosto">Debajo del costo</label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="bloqueado" name="bloqueado">
                                    <label class="form-check-label" for="bloqueado">Artículo bloqueado</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datos del SAT -->
                <div class="row g-3 mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info text-white">Requerimientos SAT</div>
                            <div class="card-body">
                                <div class="row g-2">
                                    <div class="col-12 col-md-4">
                                        <label for="claveprodserv" class="form-label">Clave de producto o servicio</label>
                                        <input type="text" class="form-control" id="claveprodserv" name="claveprodserv">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="claveunidad" class="form-label">Unidad</label>
                                        <select class="form-control" id="claveunidad" name="claveunidad">
                                            <option value="H87">H87 - Pieza</option>
                                            <option value="E48">E48 - Servicio</option>
                                            <option value="KGM">KGM - Kilogramo</option>
                                            <option value="MTR">MTR - Metro</option>
                                            <option value="LTR">LTR - Litro</option>
                                            <option value="F52">F52 - Unidad de servicio</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="objimpuesto" class="form-label">Objeto de Impuesto</label>
                                        <select class="form-control" id="objimpuesto" name="objimpuesto">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-12">
                        <button type="button" id="prod-update" class="btn btn-primary btn-lg w-100">
                            <i class="bx bx-save" aria-hidden="true"></i> Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="imagen" role="tabpanel" aria-labelledby="imagen-tab">
            <!-- Puedes reutilizar la lógica de imágenes aquí -->
        </div>
    </div>
</div>
<script>
    // Obtener el ID del producto desde PHP
    var productoId = <?= json_encode($id ?? null) ?>;

    $(document).ready(function() {
        getLineas();
        getImpuestos();
        getObjetoImpuesto();

        // Cargar datos del producto
        if (productoId) {
            $.ajax({
                url: API_URL + 'productos/' + productoId,
                type: 'GET',
                headers: {
                    'token': token
                },
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(response) {
                    $('#loader').hide();
                    if (response.status === true && response.data) {
                        renderEditForm(response.data);
                    } else {
                        showMessage('danger', 'No se pudo cargar el producto.');
                    }
                },
                error: function() {
                    $('#loader').hide();
                    showMessage('danger', 'Error al cargar el producto.');
                }
            });
        }

        // Actualizar producto
        $(document).on('click', '#prod-update', function() {
            var formArray = $('#frmprods-edit').serializeArray();
            var data = {};
            formArray.forEach(function(item) {
                data[item.name] = item.value;
            });
            // Incluir los checkboxes con valor correcto
            $('#frmprods-edit input[type="checkbox"]').each(function() {
                data[this.name] = $(this).is(':checked') ? 1 : 0;
            });
            // Validar que línea e impuesto no envíen '#'
            if (data.linea === "#") data.linea = "";
            if (data.impuesto === "#") data.impuesto = "";
            $('#prod-update').prop('disabled', true);
            $.ajax({
                url: API_URL + 'productos/' + productoId,
                type: 'PUT',
                contentType: 'application/json',
                headers: {
                    'token': token
                },
                data: JSON.stringify(data),
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(response) {
                    $('#loader').hide();
                    $('#prod-update').prop('disabled', false);
                    if (response.status === true) {
                        handleSuccess('¡Actualizado!', response.messages || 'Producto actualizado correctamente.');
                        myMessages('success', '¡Actualizado!', response.messages || response.message || 'Producto actualizado correctamente.');
                    } else {
                        handleValidationErrors(response.errors || response.messages || response);
                    }
                },
                error: function(xhr) {
                     $('#loader').hide();
                    $('#prod-update').prop('disabled', false);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        handleValidationErrors(xhr.responseJSON);
                    } else {
                        handleAjaxError(xhr);
                    }
                }
            });
        });
    });

    function renderEditForm(data) {
        // Mapear todos los datos del backend a los campos del formulario
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                var $field = $('#frmprods-edit [name="' + key + '"]');
                if ($field.length) {
                    if ($field.is(':checkbox')) {
                        // Asegura que el valor sea booleano (1/0, true/false)
                        $field.prop('checked', data[key] == 1 || data[key] === true || data[key] === '1');
                    } else {
                        $field.val(data[key]);
                    }
                }
            }
        }
        // Si usas select2, refresca los selects
        $('#linea, #impuesto').trigger('change');
    }
</script>
<!-- End -->