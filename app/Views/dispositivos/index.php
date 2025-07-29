<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3><i class="fa fa-th-large"></i> Dispositivos</h3>
                <button class="btn btn-primary mb-3" id="btn-nuevo">Nuevo dispositivo</button>
            </div>
            <!-- Listado de Dispositivos -->
            <div class="card-body d-flex flex-column">
                <div class="w-100 h-100">
                    <table class="table table-bordered" id="tablaDispositivos">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Ubicación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Cargar dispositivos
        function cargarDispositivos() {
            $('#loader').show();
            $.getJSON(API_URL + 'dispositivos', function(data) {
                var rows = '';
                data.forEach(function(d) {
                    rows += '<tr>' +
                        '<td>' + d.id + '</td>' +
                        '<td>' + d.nombre + '</td>' +
                        '<td>' + d.tipo + '</td>' +
                        '<td>' + (d.estado ? 'Activo' : 'Inactivo') + '</td>' +
                        '<td>' + d.ubicacion + '</td>' +
                        '<td>' +
                        '<div class="dropdown">' +
                        '  <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu' + d.id + '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Acciones</button>' +
                        '  <div class="dropdown-menu" aria-labelledby="dropdownMenu' + d.id + '">' +
                        '    <a class="dropdown-item btn-editar" href="#" data-id="' + d.id + '">Editar</a>' +
                        '    <a class="dropdown-item btn-eliminar" href="#" data-id="' + d.id + '">Eliminar</a>' +
                        '  </div>' +
                        '</div>' +
                        '</td>' +
                        '</tr>';
                });
                $('#tablaDispositivos tbody').html(rows);
                $('#loader').hide();
            }).fail(function(xhr) {
                $('#loader').hide();
                myMessages('error', 'Error al cargar dispositivos', xhr.responseJSON?.messages || xhr.responseJSON?.message || 'Error desconocido');
            });
        }
        cargarDispositivos();

        // Botón Nuevo dispositivo
        $('#btn-nuevo').click(function() {
            window.location.href = BASE_URL + 'administrator/crear_dispositivos';
        });

        // Botón Editar
        $(document).on('click', '.btn-editar', function() {
            var id = $(this).data('id');
            window.location.href = BASE_URL + 'administrator/editar_dispositivos/' + id;
        });

        // Botón Eliminar con SweetAlert2
        $(document).on('click', '.btn-eliminar', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: '¿Seguro que deseas eliminar este dispositivo?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: API_URL + 'dispositivos/' + id,
                        type: 'DELETE',
                        success: function() {
                            Swal.fire(
                                '¡Eliminado!',
                                'Dispositivo eliminado correctamente.',
                                'success'
                            );
                            cargarDispositivos();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error',
                                xhr.responseJSON?.messages || xhr.responseJSON?.message || 'Error desconocido',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>