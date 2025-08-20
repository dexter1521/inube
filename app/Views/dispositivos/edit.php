<!-- Formulario para editar dispositivo -->
<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm w-100" style="max-width: 480px; background: #fff; border-radius: 12px;">
        <div class="card-header bg-white border-bottom-0 text-center py-3">
            <h4 class="mb-0" style="font-weight:600;"><i class="fa fa-edit text-primary mr-2"></i>Editar Dispositivo</h4>
        </div>
        <div class="card-body px-4 py-4">
            <form id="formEditDispositivo">
                <input type="hidden" id="id" name="id">
                <div class="mb-3">
                    <label for="nombre" class="font-weight-bold">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="almacen" class="font-weight-bold">Almacén</label>
                    <input type="number" class="form-control" id="almacen" name="almacen">
                </div>
                <div class="mb-3">
                    <label for="macaddress" class="font-weight-bold">MAC Address</label>
                    <input type="text" class="form-control" id="macaddress" name="macaddress">
                </div>
                <div class="mb-3">
                    <label for="tipo" class="font-weight-bold">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo">
                </div>
                <div class="mb-3">
                    <label for="tipoconcentrador" class="font-weight-bold">Tipo Concentrador</label>
                    <input type="text" class="form-control" id="tipoconcentrador" name="tipoconcentrador">
                </div>
                <div class="mb-3">
                    <label for="zona" class="font-weight-bold">Zona</label>
                    <input type="text" class="form-control" id="zona" name="zona">
                </div>
                <div class="mb-3">
                    <label for="ventas" class="font-weight-bold">Ventas</label>
                    <input type="number" class="form-control" id="ventas" name="ventas">
                </div>
                <div class="mb-3">
                    <label for="facturas" class="font-weight-bold">Facturas</label>
                    <input type="number" class="form-control" id="facturas" name="facturas">
                </div>
                <div class="mb-3">
                    <label for="pedidos" class="font-weight-bold">Pedidos</label>
                    <input type="number" class="form-control" id="pedidos" name="pedidos">
                </div>
                <div class="mb-3">
                    <label for="productos" class="font-weight-bold">Productos</label>
                    <input type="number" class="form-control" id="productos" name="productos">
                </div>
                <div class="mb-3">
                    <label for="masterproductos" class="font-weight-bold">Master Productos</label>
                    <input type="number" class="form-control" id="masterproductos" name="masterproductos">
                </div>
                <div class="mb-3">
                    <label for="token" class="font-weight-bold">Token</label>
                    <input type="text" class="form-control" id="token" name="token">
                </div>
                <div class="mb-3">
                    <label for="activo" class="font-weight-bold">Activo</label>
                    <select class="form-control" id="activo" name="activo">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="expiracion" class="font-weight-bold">Expiración</label>
                    <input type="datetime-local" class="form-control" id="expiracion" name="expiracion">
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 mt-3" style="font-weight:600;">Actualizar</button>
            </form>
        </div>
    </div>
</div>
<script>
    // Cargar datos del dispositivo
    function cargarDispositivo(id) {
        $.getJSON(API_URL + 'dispositivos/' + id, function(data) {
            $('#id').val(data.id);
            $('#dispositivo').val(data.dispositivo);
            $('#nombre').val(data.nombre);
            $('#almacen').val(data.almacen);
            $('#macaddress').val(data.macaddress);
            $('#tipo').val(data.tipo);
            $('#tipoconcentrador').val(data.tipoconcentrador);
            $('#zona').val(data.zona);
            $('#ventas').val(data.ventas);
            $('#facturas').val(data.facturas);
            $('#pedidos').val(data.pedidos);
            $('#productos').val(data.productos);
            $('#masterproductos').val(data.masterproductos);
            $('#token').val(data.token);
            $('#activo').val(data.activo);
            if (data.expiracion) {
                // Formatear a datetime-local
                let dt = new Date(data.expiracion);
                let local = dt.toISOString().slice(0, 16);
                $('#expiracion').val(local);
            }
        });
    }
    $(document).ready(function() {
        cargarDispositivo(<?php echo json_encode($id ?? ''); ?>);
        $('#formEditDispositivo').submit(function(e) {
            e.preventDefault();
            var id = $('#id').val();
            var data = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            // Formatear expiracion si existe
            if (data.expiracion) {
                // Si viene como 'YYYY-MM-DDTHH:mm', convertir a 'YYYY-MM-DD HH:mm:ss'
                data.expiracion = data.expiracion.replace('T', ' ') + ':00';
            }
            $.ajax({
                url: API_URL + 'dispositivos/' + id,
                type: 'PUT',
                contentType: 'application/json',
                data: JSON.stringify(data),
                success: function(response) {
                    myMessages('success', '¡Felicidades!', response.messages || response.message || 'Dispositivo actualizado correctamente.');
                    window.location.href = BASE_URL + 'administrator/list_dispositivos';
                },
                error: function(xhr) {
                    $('.text-danger').remove();
                    if (xhr.responseJSON && xhr.responseJSON.messages) {
                        var msgs = xhr.responseJSON.messages;
                        if (typeof msgs === 'object') {
                            Object.keys(msgs).forEach(function(key) {
                                var field = $('#' + key);
                                if (field.length) {
                                    field.after('<span class="text-danger">' + msgs[key] + '</span>');
                                }
                            });
                            myMessages('error', 'Error al actualizar dispositivo', 'Corrige los campos marcados en rojo.');
                        } else {
                            myMessages('error', 'Error al actualizar dispositivo', msgs);
                        }
                    } else {
                        myMessages('error', 'Error al actualizar dispositivo', xhr.responseJSON.message || 'Error desconocido');
                    }
                }
            });
        });
    });
</script>