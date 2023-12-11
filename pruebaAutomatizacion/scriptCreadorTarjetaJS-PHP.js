    // Asegúrate de ejecutar el código después de que el DOM se haya cargado
    $(document).ready(function() {
        // Agrega un evento de clic al botón "Agregar Tarjeta"
        $("#btnAgregarTarjeta").click(function() {
            // Solicita la contraseña al usuario mediante un prompt
            var contraseña = prompt("Ingrese la contraseña para la nueva tarjeta:");

            // Si el usuario ingresó una contraseña
            if (contraseña !== null) {
                // Hacer una solicitud AJAX para agregar la tarjeta con la contraseña
                $.ajax({
                    type: 'POST',
                    url: 'tuscript.php',
                    data: { contenido: 'Contenido de la tarjeta', contraseña: contraseña },
                    success: function(data) {
                        // La solicitud AJAX se completó con éxito
                        console.log('La tarjeta se agregó con éxito:', data);
                    },
                    error: function(error) {
                        // La solicitud AJAX falló
                        console.error('Error al agregar la tarjeta:', error);
                    }
                });
            }
        });
    });
