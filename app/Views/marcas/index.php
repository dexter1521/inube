<!-- Start -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3><i class="fa fa-th-large"></i> Marcas</h3>
                <button type="button" class="btn btn-primary" id="btn-nuevo" data-toggle="modal" data-target="#myModal">
                    Nuevo
                </button>
            </div>

            <div class="card-body d-flex flex-column">
                <div class="w-100 h-100">
                    <table class="table table-hover" id="tablaDatos">
                        <thead>
                            <tr>
                                <th scope="col">Marca</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col"> --- </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
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
                <h5 class="modal-title">Marcas</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <span id="messages"></span>
                <form action="" method="post" id="frmMarcas">

                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" onkeyup="mayusculas(this);">
                    </div>

                    <div class="form-group">
                        <label for="marca-descrip">Descripción</label>
                        <input type="text" class="form-control" id="marca_descrip" name="marca_descrip" onkeyup="mayusculas(this);">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-cerrar" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<script>
    $(document).ready(function() {

        var isUpdating = false;

        var tablaDatos = $('#tablaDatos').DataTable({
            "ajax": {
                "url": BASE_URL + 'api/marcas',
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "marca"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return `
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item btn-edit" href="#">Editar</a>
                                    <a class="dropdown-item btn-delete" href="#">Eliminar</a>
                                </div>
                            </div>
                        `;
                    }
                }
            ]
        });

        $('#tablaDatos').on('click', '.btn-edit', function() {
            var data = tablaDatos.row($(this).parents('tr')).data();
            $('#myModal .modal-title').text('Actualizar Marca');
            $('#myModal').modal('show');
            $('#marca').val(data.marca).prop('readonly', true);
            $('#marca_descrip').val(data.descripcion);
            isUpdating = data.marca;
        });

        // Eliminar marca
        $('#tablaDatos').on('click', '.btn-delete', function() {
            var data = tablaDatos.row($(this).parents('tr')).data();
            if (confirm('¿Seguro que deseas eliminar la marca "' + data.marca + '"?')) {
                $.ajax({
                    url: BASE_URL + 'api/marcas/' + data.marca,
                    type: 'DELETE',
                    success: function(response) {
                        $('#tablaDatos').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Error al eliminar');
                    }
                });
            }
        });

        $('#btnGuardar').click(function() {
            var marca = $('#marca').val();
            var descripcion = $('#marca_descrip').val();
            var data = {
                marca: marca,
                descripcion: descripcion
            };

            if (isUpdating) {
                // Actualizar
                $.ajax({
                    url: BASE_URL + 'api/marcas/' + isUpdating,
                    type: 'PUT',
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        $('#myModal').modal('hide');
                        $('#tablaDatos').DataTable().ajax.reload();
                        isUpdating = false;
                        $('#frmMarcas')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error al actualizar');
                    }
                });
            } else {
                // Crear
                $.ajax({
                    url: BASE_URL + 'api/marcas',
                    type: 'POST',
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(response) {
                        $('#tablaDatos').DataTable().ajax.reload();
                        $('#frmMarcas')[0].reset();
                        $('#myModal').modal('hide');
                    },
                    error: function(xhr) {
                        let msg = 'Error al crear';
                        if (xhr.responseJSON && xhr.responseJSON.messages) {
                            msg += ': ' + JSON.stringify(xhr.responseJSON.messages);
                        } else if (xhr.responseText) {
                            msg += ': ' + xhr.responseText;
                        }
                        alert(msg);
                    }
                });
            }
        });

        $('.btn-cerrar').click(function() {
            $('#frmMarcas')[0].reset();
            isUpdating = false;
        });

        $('#btn-nuevo').click(function() {
            $('#myModal .modal-title').text('Nueva Marca');
            $('#frmMarcas')[0].reset();
            $('#marca').prop('readonly', false);
            isUpdating = false;
        });
    });
</script>