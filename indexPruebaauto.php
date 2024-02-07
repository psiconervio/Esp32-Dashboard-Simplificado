<!-- // home.php PHP/HTML code to display DHT11 sensor data and control LEDs state.*/ -->
<!DOCTYPE HTML>
<html>

<head>
  <title>Laboratorio de Innovacion Social</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://kit.fontawesome.com/da4a5b6f37.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="icon" href="data:,">
  <style>
    html {
      font-family: Arial;
      display: inline-block;
      text-align: center;
    }

    p {
      font-size: 1.2rem;
    }

    h4 {
      font-size: 0.8rem;
    }

    body {
      margin: 0;
    }

    .topnav {
      overflow: hidden;
      background-color: #00BAFA;
      color: white;
      font-size: 1.2rem;
    }

    .content {
      padding: 5px;
    }

    .card {
      background-color: white;
      box-shadow: 0px 0px 10px 1px rgba(140, 140, 140, .5);
      border: 1px solid #0c6980;
      border-radius: 15px;
    }

    .card.header {
      background-color: #0c6980;
      color: white;
      border-bottom-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-top-right-radius: 12px;
      border-top-left-radius: 12px;
    }

    .cards {
      max-width: 700px;
      margin: 0 auto;
      display: grid;
      grid-gap: 2rem;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    #cardContainer {
      max-width: 700px;
      margin: 0 auto;
      display: grid;
      grid-gap: 2rem;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    .reading {
      font-size: 1.3rem;
    }

    .packet {
      color: #bebebe;
    }

    .temperatureColor {
      color: #fd7e14;
    }

    .humidityColor {
      color: #1b78e2;
    }

    .statusreadColor {
      color: #702963;
      font-size: 12px;
    }

    .LEDColor {
      color: #183153;
    }

    /*Interruptor de palanca / Toggle Switch */
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
    }

    .switch input {
      display: none;
    }

    .sliderTS {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #D3D3D3;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 34px;
    }

    .sliderTS:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 4px;
      bottom: 4px;
      background-color: #f7f7f7;
      -webkit-transition: .4s;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked+.sliderTS {
      background-color: #00878F;
    }

    input:focus+.sliderTS {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.sliderTS:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    .sliderTS:after {
      content: 'OFF';
      color: white;
      display: block;
      position: absolute;
      transform: translate(-50%, -50%);
      top: 50%;
      left: 70%;
      font-size: 10px;
      font-family: Verdana, sans-serif;
    }

    input:checked+.sliderTS:after {
      left: 25%;
      content: 'ON';
    }

    input:disabled+.sliderTS {
      opacity: 0.3;
      cursor: not-allowed;
      pointer-events: none;
    }

    /* ----------------------------------- */
  </style>
</head>

<body>
  <div class="topnav">
    <h3>Laboratorio de Innovacion Social</h3>
  </div>
  <br>

  <!-- MONITOREO Y CONTROL DE PANTALLAS (content es el contenedor main, cards son cada uno de los bloques) -->
  <div class="content">
    <div class="cards">

      <!-- ==Primer card MONITOREO_ESP32_01== izquierda -->
      <div class="card">
        <div class="card header">
          <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_01</h3>
        </div>

        <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->
        <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURA</h4>
        <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span></p>
        <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
        <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span></p>
        <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i>Anemometro</h4>
        <p class="anemometro"><span id="ESP32_01_anemometro"></span></p>
        <p class="statusreadColor"><span>Estado lectura Sensor DHT11 : </span><span
            id="ESP32_01_Status_Read_DHT11"></span></p>
      </div>

      <!-- ==Segundo card MONITOREO_ESP32_02 == derecha-->
      <div class="card">
        <div class="card header">
          <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_02</h3>
        </div>

        <!-- Muestra los valores de humedad y temperatura recibidos de ESP32. *** -->
        <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> Temperatura</h4>
        <p class="temperatureColor"><span class="reading"><span id="ESP32_02_Temp"></span> &deg;C</span></p>
        <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
        <p class="humidityColor"><span class="reading"><span id="ESP32_02_Humd"></span> &percnt;</span></p>
        <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i>Anemometro</h4>
        <p class="anemometro"><span id="ESP32_02_anemometro"></span></p>
        <p class="statusreadColor"><span>Estado Read Sensor DHT11 : </span><span id="ESP32_02_Status_Read_DHT11"></span>
        </p>
      </div>
    </div>
    <br>

    <!-- == Segundo contenedor == -->
    <div class="cards">
      <!-- == MONITOREO_ESP32_02 == -->
      <div class="card">
        <div class="card header">
          <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_03</h3>
        </div>
        <!-- Muestra los valores de humedad y temperatura recibidos de ESP32_03. *** -->
        <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> Temperatura</h4>
        <p class="temperatureColor"><span class="reading"><span id="ESP32_03_Temp"></span> &deg;C</span></p>
        <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
        <p class="humidityColor"><span class="reading"><span id="ESP32_03_Humd"></span> &percnt;</span></p>
        <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i>Anemometro</h4>
        <p class="anemometro"><span id="ESP32_03_anemometro"></span></p>
        <p class="statusreadColor"><span>Estado Read Sensor DHT11 : </span><span id="ESP32_03_Status_Read_DHT11"></span>
        </p>
      </div>
    </div>
    <div id="cardContainer"></div>
    <button onclick="agregarTarjeta()">Agregar Tarjeta</button>
    <button onclick="quitarTarjeta()">Quitar Tarjeta</button>

    <body>

      /*
      <script> //para CREAR LA TARJETA EN EL FRONT END
 //       let contadorTarjetas = 3;
//
 //       function agregarTarjeta() {
 //           // Crea un nuevo elemento div para la tarjeta
 //           const nuevaTarjeta = document.createElement('div');
 //           nuevaTarjeta.classList.add('card');
//
 //           // Añade el contenido de la tarjeta
 //           nuevaTarjeta.innerHTML = `
 //               <div class="card header">
 //                   <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_0${contadorTarjetas}</h3>
 //               </div>
 //               <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURA</h4>
 //               <p class="temperatureColor"><span class="reading"><span id="ESP32_0${contadorTarjetas}_Temp"></span> &deg;C</span></p>
 //               <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
 //               <p class="humidityColor"><span class="reading"><span id="ESP32_0${contadorTarjetas}_Humd"></span> &percnt;</span></p>
 //               <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i>Anemometro</h4>
 //               <p class="anemometro"><span id="ESP32_0${contadorTarjetas}_anemometro"></span></p>
 //               <p class="statusreadColor"><span>Estado lectura Sensor DHT11 : </span><span id="ESP32_0${contadorTarjetas}_Status_Read_DHT11"></span></p>
 //           `;
//
 //           // Agrega la tarjeta al contenedor
 //           document.getElementById('cardContainer').appendChild(nuevaTarjeta);
//
 //           // Incrementa el contador para el siguiente ESP32
 //           contadorTarjetas++;
 //
 //        document.getElementById("ESP32_0${contadorTarjetas_Temp").innerHTML = "NN";
 //        document.getElementById("ESP32_0${contadorTarjetas_Humd").innerHTML = "NN";
 //        document.getElementById("ESP32_0${contadorTarjetas_Status_Read_DHT11").innerHTML = "NN";
 //         }
 //
 //       function quitarTarjeta() {
 //           const contenedor = document.getElementById('cardContainer');
 //           // Verifica si hay tarjetas para quitar
 //           if (contenedor.children.length > 0) {
 //               // Elimina la última tarjeta agregada
 //               contenedor.removeChild(contenedor.lastChild);
 //               // Decrementa el contador
 //               contadorTarjetas--;
 //           }
 //       }
      </script>
  </div>

  <br>
  <footer>
    <div class="content">
      <div class="cards">
        <div class="card header" style="border-radius: 15px;">
          <h3 style="font-size: 0.7rem;">ÚLTIMA VEZ RECIBIDO DATOS DE ESP32 [ <span id="ESP32_01_LTRD"></span> ]</h3>
          <button onclick="window.open('recordtable.php', '_blank');">Abrir tabla de registros</button>
          <h3 style="font-size: 0.7rem;"></h3>
        </div>
      </div>
    </div>
  </footer>
  <script>
//        function agregarTarjeta() {  en msql
//    // Tu lógica para crear una tarjeta
//
//    // Ejemplo de cómo enviar datos al servidor utilizando XMLHttpRequest
//    var xmlhttp = new XMLHttpRequest();
//    xmlhttp.onreadystatechange = function() {
//        if (this.readyState == 4 && this.status == 200) {
//            // Manejar la respuesta del servidor si es necesario
//            console.log(this.responseText);
//        }
//    };
//    xmlhttp.open("POST", "guardar_tarjeta.php", true);
//    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//    xmlhttp.send("esp32_id=esp32_01&temperatura=25&humedad=50&status_read_sensor_dht11=OK");
//}
//
  </script>

  <script>
    //-script para actualizar valores del esp32
    //-PONE LOS VALORES EN NULL
    //-IMPORTANTE-Cada vez que se agrega un esp32 se debe crear otra variable xmlhttp para las demas peticiones
    document.getElementById("ESP32_01_Temp").innerHTML = "NN";
    document.getElementById("ESP32_01_Humd").innerHTML = "NN";
    document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
    //-llama a la funcion obtenerdatos y pasa el parametro esp32 que es  id del POST que recibimos de la base de datos con getdata.php
    Get_Data("esp32_01");
    //-llama a la funcion setInterval de js, para que itere la funcion myTimer cada 10seg
    setInterval(myTimer, 10000);
    //-mytimer ejecuta la funcion obtener datos
    function myTimer() {
      Get_Data("esp32_01");
    }
    //-get_data obtiene los datos de getdata.php y actualiza los datos en la pagina index       
    function Get_Data(id) {
      //-cada vez que se agrega un esp32 se debe crear otra variable xmlhttp para las demas peticiones
      var xmlhttp;
      // Verifica la compatibilidad del navegador para crear la instancia XMLHttpRequest
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      // Define la función que se ejecutará cuando cambie el estado de la solicitud
      xmlhttp.onreadystatechange = function () {
        // Verifica si la solicitud se ha completado correctamente y el código de estado es 200 (OK)
        if (this.readyState == 4 && this.status == 200) {
          // Parsea la respuesta JSON del servidor
          const myObj = JSON.parse(this.responseText);
          if (myObj.id == "esp32_01") {
            // Actualiza elementos del DOM con la información recibida
            document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
            document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
            document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
          }
        }
      };
      // Configura la solicitud HTTP (POST) al archivo "getdata.php" de manera asíncrona
      xmlhttp.open("POST", "getdata.php", true);
      // Configura el tipo de contenido de la solicitud
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      // Envía la solicitud con el parámetro "id"
      xmlhttp.send("id=" + id);
    }
  </script>

  <script> // segundo script
    //-script para actualizar valores del esp32
    //-PONE LOS VALORES EN NULL 
    document.getElementById("ESP32_02_Temp").innerHTML = "NN";
    document.getElementById("ESP32_02_Humd").innerHTML = "NN";
    document.getElementById("ESP32_02_Status_Read_DHT11").innerHTML = "NN";
    document.getElementByid("ESP32_02_anemometro").innerHTML = "NN";
    //se necesita usar otra variable xmlhttp a xmlhttpp

    obtenerData("esp32_02");

    setInterval(myTimer1, 10000);

    function myTimer1() {
      obtenerData("esp32_02");
    }

    function obtenerData(id) {
      var xmlhttpp;
      if (window.XMLHttpRequest) {
        xmlhttpp = new XMLHttpRequest();
      } else {
        xmlhttpp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttpp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log("Respuesta del servidor:", this.responseText);
          var myObjDOS = JSON.parse(this.responseText);
          if (myObjDOS.id == "esp32_02") {
            document.getElementById("ESP32_02_Temp").innerHTML = myObjDOS.temperature;
            document.getElementById("ESP32_02_Humd").innerHTML = myObjDOS.humidity;
            document.getElementById("ESP32_02_Status_Read_DHT11").innerHTML = myObjDOS.status_read_sensor_dht11;
            document.getElementByid("ESP32_02_anemometro").innerHTML = myObjDOS.anemometro;
            //document.getElementById("ESP32_02_LTRD").innerHTML = "Time : " + myObjDOS.ls_time + " | Date : " + myObjDOS  .ls_date + " (dd-mm-yyyy)";
          }
        }
      };
      xmlhttpp.open("POST", "getdataDOS.php", true);
      xmlhttpp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttpp.send("id=" + id);
    }

  </script>

  <script> //------------------------/ tercer script/------------------------------------------------ 
    //trabajar con este script para enviar bien los datos, del anemometro
    document.getElementById("ESP32_03_Temp").innerHTML = "NN";
    document.getElementById("ESP32_03_Humd").innerHTML = "NN";
    document.getElementById("ESP32_03_Status_Read_DHT11").innerHTML = "NN";
    document.getElementById("ESP32_03_anemometro").innerHTML = "NN";


    //se necesita usar otra variable xmlhttp a xmlhttpp
    obtenerDataa("esp32_03");

    setInterval(myTimer2, 10000);

    function myTimer2() {
      obtenerDataa("esp32_03");
    }

    function obtenerDataa(id) {
      var xmlhttppp;
      if (window.XMLHttpRequest) {
        xmlhttppp = new XMLHttpRequest();
      } else {
        xmlhttppp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttppp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log("Respuesta del servidor:", this.responseText);
          var myObjTRES = JSON.parse(this.responseText);
          if (myObjTRES.id == "esp32_03") {
            document.getElementById("ESP32_03_Temp").innerHTML = myObjTRES.temperature;
            document.getElementById("ESP32_03_Humd").innerHTML = myObjTRES.humidity;
            document.getElementById("ESP32_03_Status_Read_DHT11").innerHTML = myObjTRES.status_read_sensor_dht11;
            //se agrego esta linea de abajo
            document.getElementById("ESP32_03_anemometro").innerHTML = myObjTRES.anemometro;
            //document.getElementById("ESP32_03_LTRD").innerHTML = "Time : " + myObjTRES.ls_time + " | Date : " + myObjTRES  .ls_date + " (dd-mm-yyyy)";
          }
        }
      };
      xmlhttppp.open("POST", "getdataTRES.php", true);
      xmlhttppp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttppp.send("id=" + id);
    }
  </script>
</body>

</html>