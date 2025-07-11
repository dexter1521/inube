<!-- Start -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3><i class="fa fa-th-large"></i> Lineas | Categorias</h3>
                <button type="button" class="btn btn-primary" id="btn-nuevo" data-toggle="modal" data-target="#myModal">
                    Nuevo
                </button>
            </div>

            <div class="card-body d-flex flex-column">
                <div class="w-100 h-100">
                    <table class="table table-hover" id="tablaDatos">
                        <thead>
                            <tr>
                                <th scope="col">Linea</th>
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
                <h5 class="modal-title">Lineas</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <span id="messages"></span>
                <form action="" method="post" id="frmLineas">

                    <div class="form-group">
                        <label for="linea">Linea</label>
                        <input type="text" class="form-control" id="linea" name="linea" onkeyup="mayusculas(this);">
                    </div>

                    <div class="form-group">
                        <label for="linea-descrip">Descripción</label>
                        <input type="text" class="form-control" id="linea_descrip" name="linea_descrip" onkeyup="mayusculas(this);">
                    </div>


                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="picture1" id="picture1" onchange="previewImage(this, 'preview1')" accept="image/*">
                            <label class="custom-file-label" for="picture1">Adjuntar archivo (Fotografía)</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i> Buscar</button>
                        </div>
                    </div>

                    <img id="preview1" src="#" alt="Vista previa de la imagen">


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
                "url": BASE_URL + 'api/lineas',
                "type": "GET",
                "dataSrc": ""
            },
            "columns": [{
                    "data": "linea"
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
            console.log('Editar:', data.linea);

            $('#myModal .modal-title').text('Actualizar Línea');
            $('#myModal').modal('show');
            $.ajax({
                url: API_URL + 'linea/seleccionar?linea=' + data.linea,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    if (response.status === 200) {

                        $('#linea').val(response.response.Linea);
                        $('#linea').prop('readonly', true);
                        $('#linea_descrip').val(response.response.Descrip);
                        $("#preview1").attr("src", response.response.url);
                        $("#preview1").css("display", "block");

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

            var formData = new FormData($('#frmLineas')[0]);

            if (isUpdating === true) {

                $.ajax({
                    url: API_URL + 'linea/actualizar',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);

                        if (response.status == 200 && response.success === false) {
                            handleValidationErrors(response.messages)

                        } else if (response.status == 200 && response.success === true) {

                            myMessages('success', 'Datos actuliazados!', response.messages)

                            $('#myModal').modal('hide'); // Cierra el modal al recibir una respuesta exitosa
                            $('#tablaDatos').DataTable().ajax.reload();
                            isUpdating = false; // Reiniciar el estado a registro
                            $('#frmLineas')[0].reset();

                        }

                    },
                    error: function(xhr, textStatus, errorThrown) {
                        $('#loader').hide();
                        handleAjaxError(xhr)
                    }
                });

            } else {
                $.ajax({
                    url: API_URL + 'linea/registrar',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        $('#loader').hide();
                        if (response.status == 200 && response.success === false) {
                            handleValidationErrors(response.messages)

                        } else if (response.success === true && response.status == 200) {
                            handleSuccess('¡Registro exitoso!', response.messages)
                            $('#tablaDatos').DataTable().ajax.reload();
                            $('#frmLineas')[0].reset();
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
            $('#frmLineas')[0].reset();
            isUpdating = false;
        });

        $('#btn-nuevo').click(function() {
            $('#frmLineas')[0].reset();
            $('#myModal .modal-title').text('Nueva Línea');
            $('#linea').prop('readonly', false);
            isUpdating = false;
            $('#preview1').attr('src', '');
        });
    });
</script>