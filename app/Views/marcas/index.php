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
                "url": API_URL + 'Marca/lista',
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "marca"
                },
                {
                    "data": "descrip"
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
                                    <a class="dropdown-item btn-edit" href="#" >Editar</a>
                                    <a class="dropdown-item" href="#" >Eliminar</a>
                                </div>
                            </div>
                        `;
                    }
                }
            ]
        });

        $('#tablaDatos').on('click', '.btn-edit', function() {
            var data = tablaDatos.row($(this).parents('tr')).data();
            console.log('Editar:', data.marca);

            $('#myModal .modal-title').text('Actualizar Marca');
            $('#myModal').modal('show');
            $.ajax({
                url: API_URL + 'marca/seleccionar?marca=' + data.marca,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if (response.status === 200) {

                        $('#marca').val(response.response.Marca);
                        $('#marca').prop('readonly', true);
                        $('#marca_descrip').val(response.response.Descrip);

                        isUpdating = true; // Cambiar el estado a actualización
                    } else {
                        console.error('Error en respuesta: ' + response.message);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    var errorMessage = JSON.stringify(xhr.responseJSON);
                    $('#loader').hide();
                    handleAjaxError(xhr)
                }
            });
        });

        $('#btnGuardar').click(function() {

            var formData = $('#frmMarcas').serialize();

            if (isUpdating === true) {

                $.ajax({
                    url: API_URL + 'marca/actualizar',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        if (response.status == 200 && response.success === false) {
                            handleValidationErrors(response.messages)

                        } else if (response.status == 200 && response.success === true) {

                            myMessages('success', 'Datos actualizados!', response.messages)

                            $('#myModal').modal('hide');
                            $('#tablaDatos').DataTable().ajax.reload();
                            isUpdating = false;

                        }

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        $('#loader').hide();
                        handleAjaxError(xhr)
                    }
                });

            } else {

                $.ajax({
                    url: API_URL + 'marca/registrar',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        $('#loader').hide();
                        if (response.status == 200 && response.success === false) {
                            handleValidationErrors(response.messages)

                        } else if (response.success === true && response.status == 200) {
                            handleSuccess('¡Registro exitoso!', response.messages)
                            $('#tablaDatos').DataTable().ajax.reload();
                            $('#frmMarcas')[0].reset();
                            $('#myModal').modal('hide');
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        $('#loader').hide();
                        handleAjaxError(xhr)
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