<!-- Formulario para editar dispositivo -->
<div class="container mt-4">
    <h4>Editar Dispositivo</h4>
    <form id="formEditDispositivo">
        <input type="hidden" id="id" name="id">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="almacen">Almacén</label>
            <input type="number" class="form-control" id="almacen" name="almacen">
        </div>
        <div class="form-group">
            <label for="macaddress">MAC Address</label>
            <input type="text" class="form-control" id="macaddress" name="macaddress">
        </div>
        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo">
        </div>
        <div class="form-group">
            <label for="tipoconcentrador">Tipo Concentrador</label>
            <input type="text" class="form-control" id="tipoconcentrador" name="tipoconcentrador">
        </div>
        <div class="form-group">
            <label for="zona">Zona</label>
            <input type="text" class="form-control" id="zona" name="zona">
        </div>
        <div class="form-group">
            <label for="ventas">Ventas</label>
            <input type="number" class="form-control" id="ventas" name="ventas">
        </div>
        <div class="form-group">
            <label for="facturas">Facturas</label>
            <input type="number" class="form-control" id="facturas" name="facturas">
        </div>
        <div class="form-group">
            <label for="pedidos">Pedidos</label>
            <input type="number" class="form-control" id="pedidos" name="pedidos">
        </div>
        <div class="form-group">
            <label for="productos">Productos</label>
            <input type="number" class="form-control" id="productos" name="productos">
        </div>
        <div class="form-group">
            <label for="masterproductos">Master Productos</label>
            <input type="number" class="form-control" id="masterproductos" name="masterproductos">
        </div>
        <div class="form-group">
            <label for="token">Token</label>
            <input type="text" class="form-control" id="token" name="token">
        </div>
        <div class="form-group">
            <label for="activo">Activo</label>
            <select class="form-control" id="activo" name="activo">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="expiracion">Expiración</label>
            <input type="datetime-local" class="form-control" id="expiracion" name="expiracion">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
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
        if(data.expiracion) {
            // Formatear a datetime-local
            let dt = new Date(data.expiracion);
            let local = dt.toISOString().slice(0,16);
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
                alert('Dispositivo actualizado correctamente');
                window.location.href = BASE_URL + 'administrator/list_dispositivos';
            },
            error: function(xhr) {
                let msg = 'Error al actualizar dispositivo';
                if (xhr && xhr.responseText) {
                    msg += '\n' + xhr.responseText;
                }
                alert(msg);
            }
        });
    });
});
</script>
