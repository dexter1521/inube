<input type="hidden" id="api_url" value="<?php echo $_ENV['API_URL']; ?>">
<div class="main-content d-flex flex-column">

    <script>
        const BASE_URL = '<?php echo base_url(); ?>';
        const API_URL = $("#api_url").val();
        const token = localStorage.getItem('token');

        $(document).ready(function() {
            validarSesion();
        });

        function validarSesion() {
            var token = localStorage.getItem('token');
            if (token && token !== 'undefined') {
                try {
                    var decodedToken = atob(token.split('.')[1]);
                    var tokenData = JSON.parse(decodedToken);
                    var expiracion = tokenData.exp * 1000;
                    var fechaActual = new Date().getTime();
                    if (expiracion < fechaActual) {
                        console.log('El token ha caducado. Redirigir al login.');
                        window.location.href = BASE_URL;
                        return;
                    }
                    // Mostrar datos de usuario si existen
                    if (tokenData.email) {
                        $(".email").text(tokenData.email);
                    }
                    if (tokenData.nombre) {
                        $(".name").text(tokenData.nombre);
                    }
                    console.log('El token aún es válido vaquero!');
                } catch (e) {
                    console.log('Token corrupto o mal formado, redirigiendo al login.');
                    window.location.href = BASE_URL;
                }
            } else {
                console.log('No hay token vaquero, adios!');
                window.location.href = BASE_URL;
            }
        }

        function logout() {
            // Eliminar token de localStorage
            localStorage.removeItem('token');
            // Eliminar cookie 'token' (expirándola)
            document.cookie = 'token=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            // Redirigir al inicio
            window.location.replace(BASE_URL);
        }

        function verificarToken() {
            // Obtener el token del localStorage
            var token = localStorage.getItem('token');

            if (token && token !== 'undefined') {
                try {
                    var decodedToken = atob(token.split('.')[1]); // Decodificar el token JWT
                    var tokenData = JSON.parse(decodedToken);
                    // Obtener la fecha de expiración del token
                    var expiracion = tokenData.exp * 1000; // Convertir a milisegundos
                    var fechaActual = new Date().getTime();
                    // Verificar si el token ha caducado
                    if (expiracion < fechaActual) {
                        console.log('El token ha caducado. Redirigir al login.');
                        window.location.href = BASE_URL;
                    } else {
                        console.log('El token aún es válido vaquero!');
                    }
                } catch (e) {
                    console.log('Token corrupto o mal formado, redirigiendo al login.');
                    window.location.href = BASE_URL;
                }
            } else {
                // No hay token, realizar acciones alternativas o redirigir al inicio de sesión
                console.log('No hay token vaquero, adios!');
                window.location.href = BASE_URL;
            }

        }
    </script>