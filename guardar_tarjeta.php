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
$time = $_POST["time"];
$date = $_POST["date"];
$anemometro = $_POST["anemometro"];

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

// Crear una nueva tabla si no existe
$tabla_nueva = "esp32_table_" . $esp32_id;
$sql_nueva_tabla = "CREATE TABLE IF NOT EXISTS $tabla_nueva (
    id INT AUTO_INCREMENT PRIMARY KEY,
    temperature FLOAT(10,2) NOT NULL,
    humidity INT NOT NULL,
    status_read_sensor_dht11 VARCHAR(255) NOT NULL,
    time TIME NOT NULL,
    date DATE NOT NULL,
    anemometro INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";

if ($conn->query($sql_nueva_tabla) === TRUE) {
    echo "Tabla creada correctamente";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

// Insertar los datos en la tabla correspondiente
$sql_insertar_datos = "INSERT INTO $tabla_nueva (temperature, humidity, status_read_sensor_dht11, time, date, anemometro) VALUES ($temperatura, $humedad, '$status_read_sensor_dht11', '$time', '$date', $anemometro)";

if ($conn->query($sql_insertar_datos) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error al insertar datos: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>