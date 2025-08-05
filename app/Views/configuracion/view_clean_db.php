<div class="container mt-4">
    <h2>Limpieza de Base de Datos</h2>
    <div class="alert alert-warning">
        <strong>¡Advertencia!</strong> Esta acción eliminará todos los datos de las tablas seleccionadas. Úsalo solo en entornos de prueba o bajo supervisión.
    </div>
    <button id="btnLimpiar" class="btn btn-danger">Limpiar Base de Datos</button>
</div>

<script>
$(document).ready(function() {
    $('#btnLimpiar').click(function() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará todos los datos y no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, limpiar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.showLoading();
                $.ajax({
                    url: '/api/maintenance/clean',
                    type: 'POST',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Listo!',
                            text: response.message
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al limpiar la base de datos.'
                        });
                    }
                });
            }
        });
    });
});
</script>
