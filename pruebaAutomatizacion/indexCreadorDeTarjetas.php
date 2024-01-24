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

function agregarTarjeta($contenido, $contraseña, $conn) {

    // Añade la tarjeta a la base de datos
    $sql = "INSERT INTO tarjetas (contenido) VALUES ('$contenido')";
   //linea para agregar contraseña a la nueva tarjeta
    //$sql = "INSERT INTO tarjetas () VALUES ('$contraseña')";
    $conn->query($sql);
}

      function quitarTarjeta($idTarjeta, $conn, $contraseña) {
          // Elimina la tarjeta de la base de datos
          $sql = "DELETE FROM tarjetas WHERE id = $idTarjeta";
          $conn->query($sql);
      }
//function quitarTarjeta($idTarjeta, $conn, $contrasenaIngresada) {
//    // Verifica la contraseña antes de proceder con la eliminación
//    $contrasenaCorrecta = "12345"; // Reemplaza con tu contraseña real
//
//    if ($contrasenaIngresada == $contrasenaCorrecta) {
//        // Elimina la tarjeta de la base de datos
//        $sql = "DELETE FROM tarjetas WHERE id = $idTarjeta";
//        $conn->query($sql);
//
//        return "Tarjeta eliminada correctamente.";
//    } else {
//        return "Contraseña incorrecta. No se eliminó la tarjeta.";
//    }
//}


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
        agregarTarjeta($contenidoTarjeta,$contraseña, $conn);

        header("Location: {$_SERVER['PHP_SELF']}", true, 303);
        exit();
    } elseif (isset($_POST['quitarTarjeta'])) {
        // Elimina tarjeta de la base de datos
        $idTarjeta = $_POST['quitarTarjeta'];
        quitarTarjeta($idTarjeta, $conn, $contraseña);

        // Redirige después de quitar una tarjeta
        header("Location: {$_SERVER['PHP_SELF']}", true, 303);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <script src="apiclima.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://kit.fontawesome.com/da4a5b6f37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botones Tarjetas</title>
</head>
<script> //funcion para contraseña tarjeta
        // funcion creartarjetas() {
        //const = contraseñaCard = prompt("ingrese una contraseña para esta tarjeta");  }
</script>
<script>
//    function solicitarContrasena(idTarjeta) {
//        // Solicitar contraseña mediante un prompt
//        const contrasenaIngresada = prompt("Ingrese la contraseña para quitar la tarjeta:");
//
//        // Verificar si se ingresó una contraseña
//        if (contrasenaIngresada !== null) {
//            // Agregar la contraseña como un campo oculto al formulario
//            const formulario = document.createElement('form');
//            formulario.method = 'post';
//            formulario.action = ''; // Establece la acción del formulario
//
//            const inputContrasena = document.createElement('input');
//            inputContrasena.type = 'hidden';
//            inputContrasena.name = 'contrasena';
//            inputContrasena.value = contrasenaIngresada;
//
//            formulario.appendChild(inputContrasena);
//
//            // Agregar el ID de la tarjeta como un campo oculto al formulario
//            const inputIdTarjeta = document.createElement('input');
//            inputIdTarjeta.type = 'hidden';
//            inputIdTarjeta.name = 'quitarTarjetaId';
//            inputIdTarjeta.value = idTarjeta;
//
//            formulario.appendChild(inputIdTarjeta);
//
//            // Adjuntar el formulario al cuerpo del documento y enviarlo
//            document.body.appendChild(formulario);
//            formulario.submit();
//        }aver ahora
//    }
</script>

<body>
    
<!-- Formulario con botones -->
<form method="post">
    <button id="btnAgregarTarjeta" type="submit" name="agregarTarjeta">Agregar Tarjeta</button>
</form>
<div class="content">
    <div class="cards">
    <?php
// Mostrar todas las tarjetas
$tarjetas = obtenerTarjetas($conn);
foreach ($tarjetas as $tarjeta) {
    echo '<div class="card">';
    echo '<div class="card header">';
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
    echo '<form method="post"><button type="submit" name="quitarTarjeta" value="' . $tarjeta['id'] . '" onclick="solicitarContrasena(' . $tarjeta['id'] . ')">Quitar Tarjeta</button></form>';
    echo '</div>';

    //parte js
// Parte JavaScript
echo '<script>';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_Temp").innerHTML = "NN";';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_Humd").innerHTML = "NN";';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_Status_Read_DHT11").innerHTML = "NN";';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_anemometro").innerHTML ="NN";';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_veleta").innerHTML="NN";';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_pluviometro").innerHTML="NN";';
echo 'Get_Data' . $tarjeta['id'] . '("esp32_' . $tarjeta['id'] . '");';
echo 'setInterval(myTimer, 10000);';
echo 'function myTimer() { Get_Data' . $tarjeta['id'] . '("esp32_' . $tarjeta['id'] . '"); }';
echo 'function Get_Data' . $tarjeta['id'] . '(id) {';
echo 'var xmlhttp' . $tarjeta['id'] . ';';
echo 'if (window.XMLHttpRequest) {';
echo 'xmlhttp' . $tarjeta['id'] . ' = new XMLHttpRequest();';
echo '} else {';
echo 'xmlhttp' . $tarjeta['id'] . ' = new ActiveXObject("Microsoft.XMLHTTP");';
echo '}';
echo 'xmlhttp' . $tarjeta['id'] . '.onreadystatechange = function() {';
echo 'if (this.readyState == 4 && this.status == 200) {';
echo 'const myObj = JSON.parse(this.responseText);';
echo 'if (myObj.id == "esp32_' . $tarjeta['id'] . '") {';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_Temp").innerHTML = myObj.temperature;';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_Humd").innerHTML = myObj.humidity;';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_anemometro").innerHTML = myObj.anemometro;';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_veleta").innerHTML = myObj.veleta;';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_pluviometro").innerHTML = myObj.pluviometro;';
echo 'document.getElementById("ESP32_' . $tarjeta['id'] . '_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";';
echo '}';
echo '}';
echo '};';
echo 'xmlhttp' . $tarjeta['id'] . '.open("POST","getdata.php",true);';
echo 'xmlhttp' . $tarjeta['id'] . '.setRequestHeader("Content-type", "application/x-www-form-urlencoded");';
echo 'xmlhttp' . $tarjeta['id'] . '.send("id="+id);';
echo '}';
echo '</script>';
}
?>
</div>
</div>
</body>
</html>
