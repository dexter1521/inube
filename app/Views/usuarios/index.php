<!-- Start -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3><i class="fa fa-th-large"></i> Catalogo General de Usuarios</h3>
                <button type="button" class="btn btn-primary" id="btn-nuevo" data-toggle="modal" data-target="#myModal">
                    Nuevo
                </button>
            </div>

            <div class="card-body d-flex flex-column">
                <div class="w-100 h-100">
                    <table class="table table-hover" id="tablaDatos">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Activo</th>
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
<!-- End -->

<!-- modal -->
<div class="modal fade" id="myModal" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <form action="" method="post" id="frmUsuario">

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control mb-2" id="nombre" name="nombre" onkeyup="mayusculas(this);">
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo electronico</label>
                        <input type="email" class="form-control mb-2" id="correo" name="correo" onkeyup="isValidEmail(this);">
                    </div>

                    <div class="form-group">
                        <label for="activo">Activo</label>
                        <select class="form-control mb-2" id="activo" name="activo">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="perfil">Perfil</label>
                        <select class="form-control mb-2" id="perfil" name="perfil">
                            <option value="1">Administrador</option>
                            <option value="2">Usuario</option>
                            <option value="3">Invitado</option>
                            <option value="4">Desarrollador</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="is_admin">Super Admin</label>
                        <select class="form-control mb-2" id="is_admin" name="is_admin">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <input type="hidden" id="id" name="id" value="0">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-cerrar" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- End -->





<script>
    $(document).ready(function() {
        cargarUsuarios();

        $('#btnGuardar').click(function() {
            // Obtener datos del formulario
            const id = $('#id').val();
            const usuario = {
                nombre: $('#nombre').val().trim(),
                email: $('#correo').val().trim(),
                activo: $('#activo').val(),
                is_admin: $('#is_admin').val(),
                perfil: $('#perfil').val()
            };

            // Validación básica del lado del cliente (opcional)
            if (!usuario.nombre || !usuario.email) {
                showMessage('warning', 'Nombre y email son campos obligatorios');
                return;
            }

            // Configurar la petición AJAX
            const url = id == 0 ? 'http://localhost:8080/api/usuarios' : `http://localhost:8080/api/usuarios/${id}`;
            const metodo = id == 0 ? 'POST' : 'PUT';

            // Mostrar loader
            $('#loader').show();

            $.ajax({
                url: url,
                type: metodo,
                contentType: 'application/json',
                data: JSON.stringify(usuario),
                dataType: 'json',
                success: function(response) {
                    $('#loader').hide();

                    if (response.status) {
                        // Éxito - mostrar mensaje y limpiar formulario
                        const successMessage = Array.isArray(response.messages) ?
                            response.messages.join('<br>') :
                            response.messages ||
                            (id == 0 ? 'Usuario creado exitosamente' : 'Usuario actualizado exitosamente');

                        showMessage('success', successMessage);
                        $('#myModal').modal('hide');
                        $('#frmUsuario')[0].reset();
                        cargarUsuarios(); // Refrescar tabla

                        // Opcional: Manejar datos adicionales de respuesta
                        if (response.data) {
                            console.log('Datos adicionales:', response.data);
                        }
                    } else {
                        // El API devolvió status:false pero no necesariamente es un error HTTP
                        handleValidationErrors(response);
                    }
                },
                error: function(xhr) {
                    $('#loader').hide();

                    // Intentar parsear la respuesta de error
                    let errorResponse;
                    try {
                        errorResponse = xhr.responseJSON || JSON.parse(xhr.responseText);
                    } catch (e) {
                        errorResponse = {
                            status: false,
                            messages: 'Error en el servidor',
                            errors: {}
                        };
                    }

                    // Manejar diferentes tipos de errores
                    if (xhr.status === 422 || (errorResponse && errorResponse.errors)) {
                        // Errores de validación
                        handleValidationErrors(errorResponse);
                    } else if (xhr.status === 409) {
                        // Conflicto (ej. email duplicado)
                        showMessage('warning', errorResponse.messages || 'El email ya está registrado');
                    } else {
                        // Otros errores
                        handleAjaxError(xhr);
                    }
                }
            });
        });

        $('#btn-nuevo').click(function() {
            nuevoUsuario();
        });

    });

    function cargarUsuarios() {
        $.ajax({
            url: 'http://localhost:8080/api/usuarios',
            type: 'GET',
            success: function(response) {
                let rows = '';
                response.forEach(function(usuario) {
                    rows += `
                    <tr>
                        <td>${usuario.id}</td>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.email}</td>
                        <td>${usuario.activo == 1 ? 'Sí' : 'No'}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="editarUsuario(${usuario.id})">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="desactivarUsuario(${usuario.id})">Desactivar</button>
                        </td>
                    </tr>`;
                });
                $('#tablaDatos tbody').html(rows);
            },
            error: function(xhr) {
                $('#loader').hide();
                handleAjaxError(xhr);
            }
        });
    }

    function editarUsuario(id) {
        $.get(`http://localhost:8080/api/usuarios/${id}`, function(response) {
            const usuario = response.data;
            $('#nombre').val(usuario.nombre);
            $('#correo').val(usuario.email);
            $('#activo').val(usuario.activo);
            $('#perfil').val(usuario.perfil);
            $('#is_admin').val(usuario.is_admin);
            $('#id').val(usuario.id);
            $('#myModal').modal('show');
        });
    }

    function nuevoUsuario() {
        $('#frmUsuario')[0].reset(); // Limpia el formulario
        $('#id').val(0); // Asegura que el ID esté en cero (crear)
        $('#myModal').modal('show');
    }
</script>