<!-- Vista mejorada y responsiva -->
<div class="container-fluid px-2 px-md-4 py-3">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                    <h3 class="mb-2 mb-md-0"><i class="fa fa-th-large"></i> Catálogo General de Productos</h3>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tablaDatos">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Artículo</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Activo</th>
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
            padding: 0.5rem 0.75rem;
        }

        th,
        td {
            font-size: 0.95rem;
        }

        td:nth-child(3) {
            white-space: normal !important;
            word-break: break-word;
            max-width: 180px;
        }
    }

    /* Mejoras para escritorio */
    @media (min-width: 992px) {
        .table thead th {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 2;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
            transition: background 0.2s;
        }

        .table td,
        .table th {
            vertical-align: middle;
            white-space: nowrap;
        }

        .table td:nth-child(3) {
            white-space: normal !important;
            word-break: break-word;
            max-width: 350px;
        }
    }
</style>

<script>
    $(document).ready(function() {
        var table = $('#tablaDatos').DataTable({
            "ajax": {
                "url": API_URL + "productos",
                "type": "GET",
                "dataSrc": function(json) {
                    //console.log('Datos recibidos del backend:', json);
                    return json.map(function(item) {
                        //console.log('Producto:', item.clave, 'bloqueado:', item.bloqueado);
                        return {
                            id: item.ID,
                            nombre: item.clave,
                            descripcion: item.descripcion,
                            precio: item.precio,
                            activo: item.bloqueado ? 'No' : 'Sí',
                            categoria: item.linea,
                            bloqueado: item.bloqueado
                        };
                    });
                }
            },
            "columns": [{
                    "data": "id",
                    "width": "5%"
                },
                {
                    "data": "nombre",
                    "width": "15%"
                },
                {
                    "data": "descripcion",
                    "width": "30%"
                },
                {
                    "data": "categoria",
                    "width": "15%"
                },
                {
                    "data": "precio",
                    "width": "10%"
                },
                {
                    "data": "activo",
                    "width": "10%"
                },
                {
                    data: null,
                    width: "15%",
                    render: function(data, type, row) {
                        return `
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton${row.id}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${row.id}">
                                    <a class="dropdown-item btn-editar" href="#" data-id="${row.id}" data-toggle="tooltip" title="Editar producto"><i class="fa fa-edit"></i> Editar</a>
                                    <a class="dropdown-item btn-eliminar" href="#" data-id="${row.id}" data-toggle="tooltip" title="Eliminar producto"><i class="fa fa-trash"></i> Eliminar</a>
                                </div>
                            </div>
                        `;
                    }
                }
            ],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            },
            "responsive": true,
            "rowCallback": function(row, data) {
                if (data.bloqueado == 1) {
                    $(row).css('background-color', '#ffcccc');
                }
            }
        });
        // Inicializar tooltips de Bootstrap
        setTimeout(function() {
            $('[data-toggle="tooltip"]').tooltip();
        }, 500);
        // Redirigir a la vista de edición al hacer clic en Editar
        $('#tablaDatos').on('click', '.btn-editar', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            window.location.href = 'edit-product/' + id;
        });
    });
</script>