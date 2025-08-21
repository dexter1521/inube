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
                        <div id="messages" style="display:none;"></div>
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
                            <option value="1">Supervisor</option>
                            <option value="2">Administrador</option>
                            <option value="3">Usuario</option>
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

            // Usar API_URL dinámico
            const url = id == 0 ? `${API_URL}/usuarios` : `${API_URL}/usuarios/${id}`;
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
                        handleSuccess('¡Éxito!', response.messages || (id == 0 ? 'Usuario creado exitosamente' : 'Usuario actualizado exitosamente'));
                        $('#myModal').modal('hide');
                        $('#frmUsuario')[0].reset();
                        cargarUsuarios();
                        if (response.data) {
                            console.log('Datos adicionales:', response.data);
                        }
                    } else {
                        handleValidationErrors(response);
                    }
                },
                error: function(xhr) {
                    $('#loader').hide();
                    handleAjaxError(xhr);
                }
            });
        });


        // Confirmar cierre del modal si hay cambios sin guardar
        let formOriginal = null;
        $('#myModal').on('show.bs.modal', function() {
            formOriginal = $('#frmUsuario').serialize();
        });
        $(document).on('click', '.btn-cerrar, .close', function(e) {
            const formActual = $('#frmUsuario').serialize();
            if (formOriginal !== null && formOriginal !== formActual) {
                e.preventDefault();
                Swal.fire({
                    title: '¿Cerrar sin guardar?',
                    text: 'Tienes cambios sin guardar. ¿Deseas cerrar el formulario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, cerrar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#myModal').modal('hide');
                        $('#frmUsuario')[0].reset();
                        formOriginal = null;
                    }
                });
            }
        });

        $('#btn-nuevo').click(function() {
            nuevoUsuario();
        });

    });

    function cargarUsuarios() {
        $.ajax({
            url: BASE_URL + 'api/usuarios',
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
        $.get(`${API_URL}/usuarios/${id}`, function(response) {
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

    function desactivarUsuario(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Seguro que deseas desactivar este usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loader').show();
                $.ajax({
                    url: `${API_URL}/usuarios/${id}`,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        $('#loader').hide();
                        if (response.status) {
                            handleSuccess('¡Éxito!', response.messages || 'Usuario desactivado correctamente');
                            cargarUsuarios();
                        } else {
                            handleValidationErrors(response);
                        }
                    },
                    error: function(xhr) {
                        $('#loader').hide();
                        handleAjaxError(xhr);
                    }
                });
            }
        });
    }

    function nuevoUsuario() {
        $('#frmUsuario')[0].reset(); // Limpia el formulario
        $('#id').val(0); // Asegura que el ID esté en cero (crear)
        $('#myModal').modal('show');
    }
</script>