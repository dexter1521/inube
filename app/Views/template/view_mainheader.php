<input type="hidden" id="api_url" value="<?php echo $_ENV['API_URL']; ?>">
<div class="main-content d-flex flex-column">

    <script>
        const BASE_URL = '<?php echo base_url(); ?>';
        const API_URL = $("#api_url").val();
		const token = localStorage.getItem('token');
		
        $(document).ready(function() {

            //verificarToken();
            //getUSerDecode();


           /*  $(".nav-item").click(function() {
                // Remove the active class from all menu options
                $(".nav-item").removeClass("mm-active");

                // Add the active class to the clicked menu option
                $(this).addClass("mm-active");
            }); */

        });

        function getUSerDecode() {
            var token = localStorage.getItem('token'); // Obtener el token del localStorage

            if (token) {
                var decodedToken = atob(token.split('.')[1]); // Decodificar el token JWT
                var tokenData = JSON.parse(decodedToken); // Convertir la cadena decodificada a un objeto JavaScript

                $(".email").text("" + tokenData.usuario);
                $(".name").text("" + tokenData.nombre);

                var url = window.location;
                //console.log(url)
            } else {
                console.log('No hay token vaquero!');
                window.location.replace(BASE_URL);
            }
        }

        function logout() {
            var token = localStorage.getItem('token');
            $.ajax({
                url: API_URL + 'auth/logout',
                type: 'POST',
                headers: {
                    'token': token
                },
                success: function(response) {
                    localStorage.setItem('token', '');
                    window.location.replace(BASE_URL);
                },
                error: function(xhr, status, error) {
                    var errorMessage = JSON.stringify(xhr.responseJSON);
                    handleAjaxError(errorMessage)
                }
            });
        }

        function verificarToken() {
            // Obtener el token del localStorage
            var token = localStorage.getItem('token');

            if (token && token !== 'undefined') {
                var decodedToken = atob(token.split('.')[1]); // Decodificar el token JWT
                var tokenData = JSON.parse(decodedToken);
				//console.log(tokenData);
                // Obtener la fecha de expiración del token
                var expiracion = tokenData.expiration * 1000; // Convertir a milisegundos

                // Obtener la fecha actual en milisegundos
                var fechaActual = new Date().getTime();

                // Verificar si el token ha caducado
                if (expiracion < fechaActual) {
                    console.log('El token ha caducado. Redirigir al login.');

                    // Redirigir al usuario al login u otra página de inicio de sesión
                    window.location.href = BASE_URL;
                } else {
                    console.log('El token aún es válido vaquero!');
                }

            } else {
                // No hay token, realizar acciones alternativas o redirigir al inicio de sesión
                console.log('No hay token vaquero, adios!');
                window.location.href = BASE_URL;
            }

        }

        
    </script>
