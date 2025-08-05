
<!-- SweetAlert2 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <h2>Ejecutar Migraciones</h2>
    <div class="alert alert-info">
        Este proceso aplicará todas las migraciones pendientes en la base de datos.<br>
        Úsalo solo si has realizado cambios estructurales y necesitas actualizar el esquema.
    </div>
    <form method="post" id="formMigrate">
        <button type="submit" class="btn btn-primary">Ejecutar Migraciones</button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Mostrar resultado con SweetAlert2 solo si la petición es POST y existe mensaje
    <?php if (isset($success) && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        Swal.fire({
            icon: '<?php echo $success ? "success" : "error"; ?>',
            title: '<?php echo $success ? "¡Migración exitosa!" : "Error en la migración"; ?>',
            text: '<?php echo addslashes($message); ?>',
            confirmButtonText: 'Aceptar'
        });
    <?php endif; ?>
});
</script>
