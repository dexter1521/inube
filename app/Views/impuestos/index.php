<!-- Vista homologada de gestión de impuestos -->
<div class="container-fluid px-2 px-md-4 py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                    <h3 class="mb-2 mb-md-0"><i class="fa fa-percent"></i> Gestión de Impuestos</h3>
                    <button class="btn btn-primary" id="btnNuevoImpuesto"><i class="fa fa-plus"></i> Nuevo impuesto</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablaImpuestos">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Porcentaje</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Ámbito</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 576px) {
        .card-header h3 {
            font-size: 1.1rem;
        }

        .btn {
            font-size: 0.95rem;
        }
    }
</style>


<!-- Modal homologado para crear/editar impuesto -->
<div class="modal fade" id="modalImpuesto" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalImpuestoLabel"><i class="fa fa-percent"></i> <span id="modalTitulo">Nuevo impuesto</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="formImpuesto">
                    <input type="hidden" id="impuestoID">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label for="nombreImpuesto" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombreImpuesto" required onkeyup="mayusculas(this);">
                        </div>
                        <div class="col-md-6">
                            <label for="porcentajeImpuesto" class="form-label">Porcentaje</label>
                            <input type="number" class="form-control" id="porcentajeImpuesto" step="0.01">
                        </div>
                        <div class="col-md-6">
                            <label for="tipoImpuesto" class="form-label">Tipo</label>
                            <input type="number" class="form-control" id="tipoImpuesto">
                        </div>
                        <div class="col-md-6">
                            <label for="ambito" class="form-label">Ámbito</label>
                            <input type="text" class="form-control" id="ambito" onkeyup="mayusculas(this);">
                        </div>
                        <div class="col-md-6">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="sku" onkeyup="mayusculas(this);">
                        </div>
                    </div>
                    <div id="impuestoError" class="alert alert-danger d-none mt-2"></div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger me-2" id="btnCancelarModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        let tabla = $('#tablaImpuestos').DataTable({
            ajax: {
                url: '/api/impuestos',
                dataSrc: ''
            },
            columns: [{
                    data: 'ID'
                },
                {
                    data: 'nombreImpuesto'
                },
                {
                    data: 'porcentajeImpuesto'
                },
                {
                    data: 'tipoImpuesto'
                },
                {
                    data: 'ambito'
                },
                {
                    data: 'sku'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton${row.ID}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.ID}">
                                <a class="dropdown-item btn-editar" href="#" data-id="${row.ID}" data-toggle="tooltip" title="Editar impuesto"><i class="fa fa-edit"></i> Editar</a>
                                <a class="dropdown-item btn-eliminar" href="#" data-id="${row.ID}" data-toggle="tooltip" title="Eliminar impuesto"><i class="fa fa-trash"></i> Eliminar</a>
                            </div>
                        </div>
                    `;
                    }
                }
            ]
        });

        $('#btnNuevoImpuesto').click(function() {
            $('#formImpuesto')[0].reset();
            $('#impuestoID').val('');
            $('#modalImpuestoLabel').text('Nuevo impuesto');
            $('#impuestoError').addClass('d-none').text('');
            $('#modalImpuesto').modal('show');
        });

        // Editar
        $('#tablaImpuestos tbody').on('click', '.btn-editar', function() {
            let data = tabla.row($(this).parents('tr')).data();
            $('#impuestoID').val(data.ID);
            $('#nombreImpuesto').val(data.nombreImpuesto).prop('readonly', true);;
            $('#porcentajeImpuesto').val(data.porcentajeImpuesto);
            $('#tipoImpuesto').val(data.tipoImpuesto);
            $('#ambito').val(data.ambito);
            $('#sku').val(data.sku);
            $('#modalImpuestoLabel').text('Editar impuesto');
            $('#impuestoError').addClass('d-none').text('');
            $('#modalImpuesto').modal('show');
        });

        // Eliminar
        $('#tablaImpuestos tbody').on('click', '.btn-eliminar', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: '¿Eliminar impuesto?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/api/impuestos/${id}`,
                        type: 'DELETE',
                        success: function(res) {
                            Swal.fire('Eliminado', res.messages, 'success');
                            tabla.ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire('Error', xhr.responseJSON?.messages || 'No se pudo eliminar', 'error');
                        }
                    });
                }
            });
        });

        // Guardar (crear/editar)
        $('#formImpuesto').submit(function(e) {
            e.preventDefault();
            let id = $('#impuestoID').val();
            let data = {
                nombreImpuesto: $('#nombreImpuesto').val(),
                porcentajeImpuesto: $('#porcentajeImpuesto').val(),
                tipoImpuesto: $('#tipoImpuesto').val(),
                ambito: $('#ambito').val(),
                sku: $('#sku').val()
            };
            let method = id ? 'PUT' : 'POST';
            let url = id ? `/api/impuestos/${id}` : '/api/impuestos';
            if (method === 'PUT') {
                // Limpiar datos: eliminar campos undefined y vacíos
                Object.keys(data).forEach(key => {
                    if (typeof data[key] === 'undefined' || data[key] === '') {
                        delete data[key];
                    }
                });
                console.log('JSON enviado (PUT):', JSON.stringify(data));
                $.ajax({
                    url: url,
                    type: method,
                    data: JSON.stringify(data),
                    contentType: 'application/json',
                    success: function(res) {
                        $('#modalImpuesto').modal('hide');
                        tabla.ajax.reload();
                        showMessage('success', res.messages || 'Operación exitosa');
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON?.errors) {
                            handleValidationErrors(xhr.responseJSON.errors);
                        } else {
                            showMessage('danger', xhr.responseJSON?.messages || 'Error al guardar');
                        }
                    }
                });
            } else {
                // Limpiar datos: eliminar campos undefined
                Object.keys(data).forEach(key => {
                    if (typeof data[key] === 'undefined') {
                        delete data[key];
                    }
                });
                $.ajax({
                    url: url,
                    type: method,
                    contentType: 'application/json',
                    dataType: 'json',
                    processData: false,
                    data: JSON.stringify(data),
                    success: function(res) {
                        $('#modalImpuesto').modal('hide');
                        Swal.fire('Éxito', res.messages, 'success');
                        tabla.ajax.reload();
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.messages || 'Error al guardar';
                        if (xhr.responseJSON?.errors?.nombreImpuesto) {
                            msg = xhr.responseJSON.errors.nombreImpuesto;
                        }
                        $('#impuestoError').removeClass('d-none').text(msg);
                    }
                });
            }
        });

        // Cerrar modal al hacer clic en Cancelar
        $('#btnCancelarModal').click(function() {
            $('#modalImpuesto').modal('hide');
        });
    });
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />