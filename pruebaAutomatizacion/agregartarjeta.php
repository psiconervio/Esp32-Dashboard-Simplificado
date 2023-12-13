<?php
//include indexCreadorDeTarjetas.php

function agregarTarjeta($contenido, $contraseña, $conn) {
    // Añade la tarjeta a la base de datos
    $sql = "INSERT INTO tarjetas (contenido, contraseña) VALUES ('$contenido', '$contraseña')";
    $conn->query($sql);
}

// Obtiene la información enviada por la solicitud AJAX
$contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
$contraseña = isset($_POST['contraseña']) ? $_POST['contraseña'] : '';

// Llama a la función para agregar la tarjeta
agregarTarjeta($contenido, $contraseña, $conn);

// Puedes devolver una respuesta si es necesario
echo "Tarjeta agregada con éxito.";
?>