<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esp32_mc_db";

// Obtener datos de la solicitud POST
$esp32_id = $_POST["esp32_id"];
$temperatura = $_POST["temperatura"];
$humedad = $_POST["humedad"];
$status_read_sensor_dht11 = $_POST["status_read_sensor_dht11"];

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO tarjetas (esp32_id, temperatura, humedad, status_read_sensor_dht11) VALUES ('$esp32_id', $temperatura, $humedad, '$status_read_sensor_dht11')";
if ($conn->query($sql) === TRUE) {
    echo "Tarjeta guardada correctamente";
} else {
    echo "Error al guardar la tarjeta: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
