<!-- Formulario para agregar dispositivo -->
<div class="container mt-4">
    <h4>Agregar Dispositivo</h4>
    <form id="formAddDispositivo">
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
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
<script>
$('#formAddDispositivo').submit(function(e) {
    e.preventDefault();
    var data = $(this).serializeArray().reduce(function(obj, item) {
        obj[item.name] = item.value;
        return obj;
    }, {});
    $.ajax({
        url: API_URL + 'dispositivos',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            alert('Dispositivo agregado correctamente');
            window.location.href = BASE_URL + 'dispositivos';
        },
        error: function(xhr) {
            alert('Error al agregar dispositivo');
        }
    });
});
</script>
