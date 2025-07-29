<div class="container mt-4">
    <h3>Tareas de sincronización pendientes</h3>
    <div class="form-group">
        <label for="dispositivo">Sucursal/Dispositivo:</label>
        <select id="dispositivo" class="form-control">
            <option value="">Selecciona una sucursal/dispositivo</option>
            <?php foreach ($dispositivos as $disp): ?>
                <option value="<?= htmlspecialchars($disp['dispositivo']) ?>">
                    <?= htmlspecialchars($disp['dispositivo']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button id="btnBuscar" class="btn btn-primary mt-2">Buscar</button>
    </div>
    <table class="table table-bordered" id="tablaPendientes">
        <thead>
            <tr>
                <th>ID</th>
                <th>Clave Producto</th>
                <th>Fecha Registro</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
function cargarPendientes(dispositivo) {
    $.getJSON(API_URL + 'prods_download/pendientes/' + encodeURIComponent(dispositivo), function(data) {
        var tbody = '';
        if (data.length === 0) {
            tbody = '<tr><td colspan="4" class="text-center">No hay tareas pendientes</td></tr>';
        } else {
            $.each(data, function(i, tarea) {
                tbody += '<tr>' +
                    '<td>' + tarea.id + '</td>' +
                    '<td>' + tarea.clave + '</td>' +
                    '<td>' + tarea.fecha_registro + '</td>' +
                    '<td><button class="btn btn-success btn-aplicar" data-id="' + tarea.id + '">Marcar aplicado</button></td>' +
                '</tr>';
            });
        }
        $('#tablaPendientes tbody').html(tbody);
    });
}

$(document).on('click', '#btnBuscar', function() {
    var dispositivo = $('#dispositivo').val().trim();
    if (dispositivo) cargarPendientes(dispositivo);
});

$(document).on('click', '.btn-aplicar', function() {
    var id = $(this).data('id');
    $.ajax({
        url: API_URL + 'prods_download/aplicar',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({id: id}),
        success: function(resp) {
            alert('Tarea marcada como aplicada');
            $('#btnBuscar').click();
        },
        error: function() {
            alert('Error al marcar como aplicado');
        }
    });
});
</script>
</body>
</html>
