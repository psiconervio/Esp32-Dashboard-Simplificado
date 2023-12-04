<!--  updateDHT11data_and_recordtable.phpsss
// PHP code to update and record DHT11 sensor data and LEDs state in table. -->
<?php
  require 'database.php';
  
  //Condición para verificar que el valor POST no esté vacío// Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    //realizar un seguimiento de los valores POST/ keep track POST values
    $id = $_POST['id'];
    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $status_read_sensor_dht11 = $_POST['status_read_sensor_dht11'];
    $led_01 = isset($_POST['led_01']) ? $_POST['led_01'] : ''; // O proporciona un valor predeterminado apropiado
    $led_02 = isset($_POST['led_02']) ? $_POST['led_02'] : ''; // O proporciona un valor predeterminado apropiado
    //$led_01 = $_POST['led_01'];
    //$led_02 = $_POST['led_02'];
    $anemometro = $_POST['anemometro'];
    //$led_01 = isset($_POST['led_01']) ? $_POST['led_01'] : null;
    //$led_02 = isset($_POST['led_02']) ? $_POST['led_02'] : null;
    
    // Get the time and date.
    date_default_timezone_set("America/Argentina/Catamarca"); // Look here for your timezone : https://www.php.net/manual/en/timezones.php
    $tm = date("H:i:s");
    $dt = date("Y-m-d");
    
    //Actualizando los datos en la tabla. Updating the data in the table.
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // reemplazar_con_tu_nombre_tabla, en este proyecto uso el nombre de la tabla 'esp32_table_dht11_leds_update'.                                  // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
    // Esta tabla se utiliza para almacenar datos del sensor DHT11 actualizados por ESP32                                                           .// This table is used to store DHT11 sensor data updated by ESP32. 
    // Esta tabla también se utiliza para almacenar el estado de los LED, el estado de los LED se controla desde la página "home.php".               //This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // Esta tabla se opera con el comando "ACTUALIZAR", por lo que esta tabla solo contendrá una fila.                                               // This table is operated with the "UPDATE" command, so this table will only contain one row.
    // estructurar bien los datos como el anemometro 
    $sql3 = "UPDATE esp32_table_dht11_leds_update2 SET temperature = ?, humidity = ?, status_read_sensor_dht11 = ?,anemometro = ?,  time = ?, date = ? WHERE id = ?";
    $q = $pdo->prepare($sql3);
    //agregar nuevos sensores dps del anemometro
    $q->execute(array($temperature,$humidity,$status_read_sensor_dht11,$anemometro,$tm,$dt,$id));
    Database::disconnect();
    
    //........................................ Entering data into a table.
    $id_key;
    $board = $_POST['id'];
    $found_empty = false;
    
    $pdo = Database::connect();
    
    // Proceso para verificar si "id" ya está en uso./Process to check if "id" is already in use.
    while ($found_empty == false) {
      $id_key = generate_string_id(10);
     // reemplazar_con_tu_nombre_tabla, en este proyecto uso el nombre de la tabla 'esp32_table_dht11_leds_update'. // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
      // Esta tabla se utiliza para almacenar y registrar datos del sensor DHT11 actualizados por ESP32.// This table is used to store and record DHT11 sensor data updated by ESP32. 
      // Esta tabla también se utiliza para almacenar y registrar el estado de los LED, el estado de los LED se controla desde la página "home.php".// This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
      // Esta tabla se opera con el comando "INSERT", por lo que esta tabla contendrá muchas filas.// This table is operated with the "INSERT" command, so this table will contain many rows.
      // Antes de guardar y registrar datos en esta tabla, primero se verificará el "id" para garantizar que el "id" que se ha creado no se haya utilizado en la tabla.// Before saving and recording data in this table, the "id" will be checked first, to ensure that the "id" that has been created has not been used in the table.
      $sql3 = 'SELECT * FROM esp32_table_dht11_leds_update2 WHERE id="' . $id_key . '"';
      $q = $pdo->prepare($sql3);
      $q->execute();
    }
//      if (!$data = $q->fetch()) {
//        $found_empty = true;
//      }
//    }
//    //:::::::: El proceso de ingresar datos en la tabla record.php
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
//    // This table is used to store and record DHT11 sensor data updated by ESP32. 
//    // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
//    // This table is operated with the "INSERT" command, so this table will contain many rows.
//		$sql3 = "INSERT INTO esp32_table_dht11_leds_update2 (id,board,temperature,humidity,status_read_sensor_dht11,LED_01,LED_02,time,date/*,anemometro*/) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
//		$q = $pdo->prepare($sql3);
//    $q->execute(array($id_key,$board,$temperature,$humidity,$status_read_sensor_dht11,$led_01,$led_02,$tm,$dt,/*$anemometro*/));
    //::::::::
    
    Database::disconnect();
  }
  //Function to create "id" based on numbers and characters.
  function generate_string_id($strength = 16) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
      $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }
    return $random_string;
  }
?>
