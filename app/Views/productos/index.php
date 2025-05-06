<!-- Start -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-30">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3><i class="fa fa-th-large"></i> Catalogo General de Productos</h3>
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
                                <th>Articulo</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Precio</th>
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

<script>
    $(document).ready(function() {
        $('#tablaDatos').DataTable({
            "ajax": {
                "url": API_URL  + "productos",
                "type": "GET",
                "dataSrc": function(json) {
                    // Map the backend response to match the DataTable columns
                    return json.map(function(item) {
                        return {
                            id: item.ID,
                            nombre: item.clave,
                            descripcion: item.descripcion,
                            precio: item.precio,
                            activo: item.bloqueado ? 'No' : 'Sí',
                            categoria: item.linea
                        };
                    });
                }
            },
            "columns": [
                { "data": "id" },
                { "data": "nombre" },
                { "data": "descripcion" },
                { "data": "categoria" },
                { "data": "precio" },
                { "data": "activo" },
                { 
                    data: null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-primary btn-sm btn-editar" data-id="' + row.id + '">Editar</button>' +
                               '<button class="btn btn-danger btn-sm btn-eliminar" data-id="' + row.id + '">Eliminar</button>';
                    }
                }
            ]
        });
    });
</script>