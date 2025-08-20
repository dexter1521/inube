<!doctype html>
<html lang="es-MX">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vendors.min.css') ?>">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css') ?>">
    <title><?php echo $_ENV['NAME_SITIO']; ?></title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
</head>
<script>
    const BASE_URL = '<?php echo base_url(); ?>';
    const API_URL = '<?php echo $_ENV['API_URL']; ?>';
</script>

<body>

    <span id="message"></span>

    <!-- Start Login Area -->
    <div class="login-area d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="login-form w-100" style="max-width: 400px;">
            <div class="logo text-center mb-3">
                <img src="<?php echo base_url('assets/img/logo.jpg') ?>" alt="image" class="img-fluid rounded shadow" style="max-width: 220px; height: auto;">
            </div>
            <h2 class="text-center">Bienvenido</h2>
            <form method="post" autocomplete="off">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Usuario">
                            <span class="label-title"><i class='bx bx-user'></i></span>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="Password">
                            <span class="label-title"><i class='bx bx-lock'></i></span>
                        </div>

                        <div class="form-group">
                            <div class="remember-forgot">
                                <label class="checkbox-box">Recordarme
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>

                                <a href="#" class="forgot-password">recuperar password?</a>
                            </div>
                        </div>

                        <button type="button" id="submit" class="login-btn">Entrar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Area -->
    <!-- Vendors Min JS -->
    <script src="<?php echo base_url('assets/js/vendors.min.js') ?>"></script>
    <!-- Custom JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://lib.morelos.gob.mx/fontawesome/css/all5.7.2.css" crossorigin="anonymous">
    <script type="text/javascript">
        $(document).ready(function() {

            // Limpiar mensajes previos al cargar la página
            $('#message').empty();
            $('.text-danger, .text-info, .text-warning, .text-success').remove();

            // Limpiar token al cargar la página
            localStorage.removeItem('token');

            $('#submit').click(function(event) {
                event.preventDefault();

                // Limpiar mensajes de error previos
                $('.text-danger').remove();
                $('#message').empty();

                var email = $('#email').val().trim();
                var password = $('#contrasenia').val();

                // Validación simple en el cliente
                if (!email || !password) {
                    if (!email) {
                        $('#email').after('<span class="text-danger">El usuario es requerido</span>');
                    }
                    if (!password) {
                        $('#contrasenia').after('<span class="text-danger">La contraseña es requerida</span>');
                    }
                    emptyText();
                    return;
                }

                $.ajax({
                    url: API_URL + 'auth/login',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: email,
                        password: password
                    }),
                    beforeSend: function() {
                        $('#submit').html('<i class="fas fa-spinner fa-pulse"></i>&nbsp;Iniciando sesión...');
                        $('#submit').prop("disabled", true);
                    },
                    success: function(data) {
                        if (data.success === false && data.status == 200 && data.messages) {
                            // Mostrar mensajes de error de campos específicos
                            $.each(data.messages, function(key, message) {
                                if (message) {
                                    $('#' + key).after('<span class="text-danger">' + message + '</span>');
                                }
                            });
                            emptyText();
                        } else if (data.token) {
                            // Guardar solo el token sin 'Bearer'
                            var token = data.token.startsWith('Bearer ') ? data.token.substring(7) : data.token;
                            localStorage.setItem('token', token);
                            document.cookie = "token=" + token + "; path=/";
                            $.ajaxSetup({
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                }
                            });
                            window.location.replace(BASE_URL + "administrator");
                        } else {
                            $("#message").html('<div class="text-white bg-danger text-center">Respuesta inesperada del servidor</div>');
                            emptyText();
                        }
                    },
                    error: function(xhr) {
                        var val = xhr.responseJSON || {};
                        var errorMessage = 'Ocurrió un error inesperado';

                        if (val.messages) {
                            if (typeof val.messages === 'string') {
                                errorMessage = val.messages;
                            } else if (val.messages.error) {
                                errorMessage = val.messages.error;
                            } else {
                                errorMessage = JSON.stringify(val.messages);
                            }
                        }

                        if ([400, 401, 403].includes(xhr.status)) {
                            $("#message").html('<div class="text-white bg-danger text-center">' + errorMessage + '</div>');
                        } else {
                            $("#message").html('<div class="text-white bg-danger text-center">Error: ' + xhr.status + '</div>');
                        }
                        emptyText();
                    },
                    complete: function() {
                        $('#submit').html('Acceder');
                        $('#submit').prop("disabled", false);
                    }
                });
            });

            function emptyText() {
                setTimeout(function() {
                    $('.text-danger, .text-info, .text-warning, .text-success').fadeOut(300, function() {
                        $(this).remove();
                    });
                    $('#message').fadeOut(300, function() {
                        $(this).empty().show();
                    });
                }, 3000);
            }
        });
    </script>
</body>

</html>