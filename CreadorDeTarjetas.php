<?php
// Funciones PHP

// Conectar a la base de datos (cambiar estos valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tarjetas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

function agregarTarjeta($contenido, $conn) {
    // Añade la tarjeta a la base de datos
    $sql = "INSERT INTO tarjetas (contenido) VALUES ('$contenido')";
    $conn->query($sql);
}

function quitarTarjeta($idTarjeta, $conn) {
    // Elimina la tarjeta de la base de datos
    $sql = "DELETE FROM tarjetas WHERE id = $idTarjeta";
    $conn->query($sql);
}

function obtenerTarjetas($conn) {
    // Obtiene todas las tarjetas almacenadas en la base de datos
    $tarjetas = array();
    $sql = "SELECT id, contenido FROM tarjetas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tarjetas[] = $row;
        }
    }

    return $tarjetas;
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agregarTarjeta'])) {
        // Agrega tarjeta a la base de datos
        $contenidoTarjeta = "Contenido de la tarjeta"; // Puedes cambiar esto según tu necesidad
        agregarTarjeta($contenidoTarjeta, $conn);
    } elseif (isset($_POST['quitarTarjeta'])) {
        // Elimina tarjeta de la base de datos
        $idTarjeta = $_POST['quitarTarjeta'];
        quitarTarjeta($idTarjeta, $conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/da4a5b6f37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botones Tarjetas</title>
</head>
<body>

<!-- Formulario con botones -->
<form method="post">
    <button type="submit" name="agregarTarjeta">Agregar Tarjeta</button>
</form>
<div class="content">
    <div class="cards">
<?php
// Mostrar todas las tarjetas
$tarjetas = obtenerTarjetas($conn);
foreach ($tarjetas as $tarjeta) {
    echo '<div class="card">';
    echo '<div class="card-header">';
    echo '<h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_' . $tarjeta['id'] . '</h3>';
    echo '</div>';
    echo '<h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURA</h4>';
    echo '<p class="temperatureColor"><span class="reading"><span id="ESP32_' . $tarjeta['id'] . '_Temp"></span> &deg;C</span></p>';
    echo '<h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>';
    echo '<p class="humidityColor"><span class="reading"><span id="ESP32_' . $tarjeta['id'] . '_Humd"></span> &percnt;</span></p>';
    echo '<h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i> VELOCIDAD VIENTO</h4>';
    echo '<p class="anemometro"><span class="temperatureColor" ><span id="ESP32_' . $tarjeta['id'] . '_anemometro"></span> km/h </span></p>';
    echo '<h4 class="veleta_title"><i class="fa-regular fa-compass"></i> DIRECCION VIENTO</h4>';
    echo '<p class="veleta"><span class="reading"><span id="ESP32_' . $tarjeta['id'] . '_veleta"></span></span></p>';
    echo '<h4 class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> CAUDAL DE LLUVIA </h4>';
    echo '<p class="pluviometro"><span class="reading"><span id="ESP32_' . $tarjeta['id'] . '_pluviometro"></span> ml</span></p>';
    echo '<p class="statusreadColor"><span>Estado Read Sensor DHT11 : </span><span id="ESP32_' . $tarjeta['id'] . '_Status_Read_DHT11"></span></p>';
    echo '<form method="post"><button type="submit" name="quitarTarjeta" value="' . $tarjeta['id'] . '">Quitar Tarjeta</button></form>';
    echo '</div>';
}
?>

<?php

?>
    </div>
</div>
</body>
</html>
