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
    <title>Distribuciones Zúñiga v2</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
</head>
<script>
    const BASE_URL = '<?php echo base_url(); ?>';
    const API_URL = '<?php echo $_ENV['API_URL']; ?>';
</script>

<body>

    <span id="message"></span>

    <!-- Start Login Area -->
    <div class="login-area">

        <div class="d-table">
            <div class="d-table-cell">
                <div class="login-form">
                    <div class="logo">
                        <img src="<?php echo base_url('assets/img/logo.jpg') ?>" alt="image">
                    </div>

                    <h2>Bienvenido</h2>

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

            localStorage.setItem('token', '');

            $('#submit').click(function(event) {
                event.preventDefault();
                var email = $('#email').val();
                var password = $('#contrasenia').val();

                $.ajax({
                    url: API_URL + 'auth/login',
                    method: 'POST',
                    processData: false,
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
                        console.log(data);

                        if (data.success === false && data.status == 200) {
                            // Manejar mensajes de error de campos específicos
                            var fieldMessages = data.messages;
                            for (var key in fieldMessages) {
                                if (fieldMessages.hasOwnProperty(key)) {
                                    var message = fieldMessages[key];
                                    if (message) {
                                        $('#' + key).after('<span class="text-danger">' + message + '</span>');
                                    }
                                }
                            }
                            emptyText();
                        } else {
                            // Asegurarse de guardar solo el token sin 'Bearer'
                            var token = data.token;
                            if (token.startsWith('Bearer ')) {
                                token = token.substring(7);
                            }
                            localStorage.setItem('token', token);
                            document.cookie = "token=" + token + "; path=/";
                            $.ajaxSetup({
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                }
                            });
                            window.location.replace(BASE_URL + "Administrator");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr.responseJSON);
                        var val = xhr.responseJSON;
                        var errorMessage = '';

                        // Manejar estructura de mensajes como { "messages": { "error": "Credenciales inválidas" } }
                        if (val && val.messages) {
                            if (typeof val.messages === 'string') {
                                errorMessage = val.messages;
                            } else if (val.messages.error) {
                                errorMessage = val.messages.error;
                            } else {
                                errorMessage = JSON.stringify(val.messages);
                            }
                        } else {
                            errorMessage = 'Ocurrió un error inesperado';
                        }

                        switch (xhr.status) {
                            case 400:
                            case 401:
                            case 403:
                                $("#message").html('<div class="text-white bg-danger text-center">' + errorMessage + '</div>');
                                break;
                            default:
                                $("#message").html('<div class="text-white bg-danger text-center">' + 'Error: ' + xhr.status + '</div>');
                                break;
                        }

                        setTimeout(function() {
                            $("#message").empty();
                        }, 5000);
                    },
                    complete: function() {
                        // Restaurar el botón después de la respuesta
                        $('#submit').html('Acceder');
                        $('#submit').prop("disabled", false);
                    }

                });

            });

            function emptyText() {

                $('.text-info').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                })

                $('.text-warning').delay(2000).show(30, function() {
                    $(this).delay(6000).hide(30, function() {
                        $(this).remove();
                    });
                })

                $('.text-danger').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).removeClass();
                    });
                });

                $('.text-success').delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).removeClass();
                    });
                });
            }
        });
    </script>
</body>

</html>