<?php
  include 'database.php';
  //  prueba pool github visual estudio asd
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];
    $myObj = (object)array();
    
    //........................................ 
    $pdo = Database::connect();
    // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_update'.
    // This table is used to store DHT11 sensor data updated by ESP32. 
    // This table is also used to store the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
    // To store data, this table is operated with the "UPDATE" command, so this table contains only one row.
    $sql = 'SELECT * FROM esp32_table_dht11_leds_update WHERE id="' . $id . '"';
  //  if( $id == "ESP32_02"){
    foreach ($pdo->query($sql) as $row) {
      $date = date_create($row['date']);
      $dateFormat = date_format($date,"d-m-Y");
      
      $myObj->id = $row['id'];
      $myObj->temperature = $row['temperature'];
      $myObj->humidity = $row['humidity'];
      $myObj->status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
      $myObj->LED_01 = $row['LED_01'];
      $myObj->LED_02 = $row['LED_02'];
      $myObj->ls_time = $row['time'];
      $myObj->ls_date = $dateFormat;
      
      $myJSON = json_encode($myObj);
      
      echo $myJSON;
//      MODIFICAR ID Y TODO ESTE POST
//      envio del segundo post 
   //   $id1 = $_POST['id1'];
    //  $myObj1 = (object)array();
//    //ACA EMPIEZA EL CONFLICTO
    // $sqldos = 'SELECT * FROM esp32_table_dht11_leds_update1 WHERE id="' . $id . '"';
   //  //ACA EMPIEZA EL CONFLICTO
   //  foreach ($pdo->query($sqldos) as $row) {
   //  $date = date_create($row['date']);
   //  $dateFormat = date_format($date,"d-m-Y");
//      
    //  $myObj1->id = $row['id'];
    //  $myObj1->temperature = $row['temperature'];
    //  $myObj1->humidity = $row['humidity'];
    //  $myObj1->status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
    //  $myObj1->LED_01 = $row['LED_01'];
    //  $myObj1->LED_02 = $row['LED_02'];
    //  $myObj1->ls_time = $row['time'];
    //  $myObj1->ls_date = $dateFormat;
    //  
    //  $myJSON1 = json_encode($myObj1);
    //  
    //  echo $myJSON1;
  //   }
//    
     }}
    Database::disconnect();
    //........................................ 
  
  // }---------------------------------------
  /*
  // codigo chat gpt
  include 'database.php';
  
  //---------------------------------------- Condition to check that POST value is not empty.
  if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];
    
    $myObj1 = (object)array();
    $myObj2 = (object)array();
    
    // Initialize PDO connection
    $pdo = Database::connect();

    // First ESP32 Data
    $sql1 = 'SELECT * FROM esp32_table_dht11_leds_update WHERE id="' . $id . '"';
    foreach ($pdo->query($sql1) as $row) {
      $date = date_create($row['date']);
      $dateFormat = date_format($date, "d-m-Y");
      
      $myObj1->id = $row['id'];
      $myObj1->temperature = $row['temperature'];
      $myObj1->humidity = $row['humidity'];
      $myObj1->status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
      $myObj1->LED_01 = $row['LED_01'];
      $myObj1->LED_02 = $row['LED_02'];
      $myObj1->ls_time = $row['time'];
      $myObj1->ls_date = $dateFormat;
    }

    // Second ESP32 Data
    $sql2 = 'SELECT * FROM esp32_table_dht11_leds_update1 WHERE id="' . $id . '"';
    foreach ($pdo->query($sql2) as $row) {
      $date = date_create($row['date']);
      $dateFormat = date_format($date, "d-m-Y");
      
      $myObj2->id = $row['id'];
      $myObj2->temperature = $row['temperature'];
      $myObj2->humidity = $row['humidity'];
      $myObj2->status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
      $myObj2->LED_01 = $row['LED_01'];
      $myObj2->LED_02 = $row['LED_02'];
      $myObj2->ls_time = $row['time'];
      $myObj2->ls_date = $dateFormat;
    }

    // Combine the data into an array
    $combinedData = array("esp32_01" => $myObj1, "esp32_02" => $myObj2);

    // Encode the array as JSON
    $jsonResponse = json_encode($combinedData);

    // Send the JSON response to the client
    echo $jsonResponse;

    // Disconnect from the database
    Database::disconnect();
  }
*/

?>