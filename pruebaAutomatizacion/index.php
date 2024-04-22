<!-- // home.php PHP/HTML code to display DHT11 sensor data and control LEDs state.*/ -->
<!DOCTYPE HTML>
<html>
  <head>
    <title>Laboratorio de Innovacion Sociall</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="funciones/accesibility-hover-moreinfo.js"></script>
    <link rel="stylesheet" href="funciones/style-hover-moreinfo.css">
    <script src="https://kit.fontawesome.com/da4a5b6f37.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="styleindexPrueba.css">  
  </head>
  
  <body>
    <div class="topnav">
      <img src="banernodo.png" width="100%" height="20%" alt="">
      <h3>Laboratorio de Innovacion Social  -   Estacion Metereologica </h3>
    </div>
    <br>

    <!-- MONITOREO Y CONTROL DE PANTALLAS (content es el contenedor main, cards son cada uno de los bloques) -->
    <div class="content">
      <div class="cards">
        
        <!-- ==Primer card MONITOREO_ESP32_01== izquierda -->
        <div class="card video-background" >
          <div class="card header">
            <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
          </div>
           <video src="videos/nublado.mp4" autoplay muted loop></video>
          <div class='contenedorTodosItem'>
          
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->
          <div class="contenedorItem">
            <h4 class="temperatureColor"><span id="ESP32_01_Temp"></span><span id="ESP32_01_Temp"></span> &deg;C</span>
            <div class="icon-container">
            <i id="icono" class="fa-solid fa-circle-info"></i>
            <div class="info" id="info"><p> Temperatura actual de el sensor </p></div>
          </div>
          </div>

         
         <div class="contenedorItem">
          <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD: <span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span></h4>
          </div>
          <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i> VELOCIDAD VIENTO: <span class="temperatureColor" ><span id="ESP32_01_anemometro"></span> km/h </span></h4>
          <h4 class="veleta_title"><i class="fa-regular fa-compass"></i> DIRECCION VIENTO: <span class="reading"><span id="ESP32_01_veleta"></span></span></h4>
          <p class="veleta"><span class="reading"><span id="ESP32_01_veleta"></span></span></p>
          <h4 class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> CAUDAL DE LLUVIA: <span class="reading"><span id="ESP32_01_pluviometro"></span> ml</span> </h4>
          <p class="statusreadColor"><span>Estado lectura Sensor DHT11 : </span><span id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>
        
        </div>




        <!-- ==Segundo card MONITOREO_ESP32_02 == derecha-->
        <div class="card video-background">
          <div class="card header">
            <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
          </div>
          <video src="videos/storm.mp4" autoplay muted loop></video>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURA</h4>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_02_Temp"></span> &deg;C</span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP32_02_Humd"></span> &percnt;</span></p>
          <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i> VELOCIDAD VIENTO</h4>
          <p class="anemometro"><span class="temperatureColor" ><span id="ESP32_02_anemometro"></span> km/h </span></p>
          <h4 class="veleta_title"><i class="fa-regular fa-compass"></i> DIRECCION VIENTO</h4>
          <p class="veleta"><span class="reading"><span id="ESP32_02_veleta"></span></span></p>
          <h4 class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> CAUDAL DE LLUVIA </h4>
          <p class="pluviometro"><span class="reading"><span id="ESP32_02_pluviometro"></span> ml</span></p>
          <p class="statusreadColor"><span>Estado lectura Sensor DHT11 : </span><span id="ESP32_02_Status_Read_DHT11"></span></p>
        </div>
        
      </div>
      <br>

      <!-- == Segundo contenedor == -->
      <div class="cards">   
        <!-- == MONITOREO_ESP32_03 == -->
        <div class="card video-background">
          <div class="card header">
            <h3 style="font-size: 1rem;">MONITOREO SENSOR ESP32_03</h3>
          </div>
          <video src="videos/blue_sky.mp4" autoplay muted loop></video>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32_03. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> Temperatura</h4>
          <p class="temperatureColor"><span class="reading"><span id="ESP32_03_Temp"></span> &deg;C</span></p>
          <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDAD</h4>
          <p class="humidityColor"><span class="reading"><span id="ESP32_03_Humd"></span> &percnt;</span></p>
          <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i> VELOCIDAD VIENTO</h4>
          <p class="anemometro"><span class="temperatureColor" ><span id="ESP32_03_anemometro"></span> km/h </span></p>
          <h4 class="veleta_title"><i class="fa-regular fa-compass"></i> DIRECCION VIENTO</h4>
          <p class="veleta"><span class="reading"><span id="ESP32_03_veleta"></span></span></p>
          <h4 class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> CAUDAL DE LLUVIA </h4>
          <p class="pluviometro"><span class="reading"><span id="ESP32_03_pluviometro"></span> ml</span></p>
          <p class="statusreadColor"><span>Estado Read Sensor DHT11 : </span><span id="ESP32_03_Status_Read_DHT11"></span></p>
        </div>
        <div class="card video-background" >
          <div class="card header">
            <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
          </div>
          <video src="videos/nublado.mp4" autoplay muted loop></video>

          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->
          <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURA: <span id="ESP32_01_Temp"></span><span id="ESP32_01_Temp"></span> &deg;C</span>
          <div class="icon-container">
            <i id="icono" class="fa-solid fa-circle-info"></i>
            <div class="info" id="info"><p> Temperatura actual de el sensor </p></div>

          </div>

          <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMEDADa: <span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span></h4>
          <h4 class="anemometro_title"> <i class="fa-solid fa-gauge-simple-high"></i> VELOCIDAD VIENTO: <span class="temperatureColor" ><span id="ESP32_01_anemometro"></span> km/h </span></h4>
          <h4 class="veleta_title"><i class="fa-regular fa-compass"></i> DIRECCION VIENTO: <span class="reading"><span id="ESP32_01_veleta"></span></span></h4>
          <p class="veleta"><span class="reading"><span id="ESP32_01_veleta"></span></span></p>
          <h4 class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> CAUDAL DE LLUVIA: <span class="reading"><span id="ESP32_01_pluviometro"></span> ml</span> </h4>
          <p class="statusreadColor"><span>Estado lectura Sensor DHT11 : </span><span id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>        
      </div>
      
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
   <!--primer script -->
    <script>
      //-script para actualizar valores del esp32
      //-PONE LOS VALORES EN NULL
      //-IMPORTANTE-Cada vez que se agrega un esp32 se debe crear otra variable xmlhttp para las demas peticiones
      document.getElementById("ESP32_01_Temp").innerHTML = "NN"; 
      document.getElementById("ESP32_01_Humd").innerHTML = "NN";
      document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
      document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
      document.getElementById("ESP32_01_anemometro").innerHTML ="NN";
      document.getElementById("ESP32_01_veleta").innerHTML="NN";
      document.getElementById("ESP32_01_pluviometro").innerHTML="NN";
      //-llama a la funcion obtenerdatos y pasa el parametro esp32 que es  id del POST que recibimos de la base de datos con getdata.php
      Get_Data("esp32_01");
      //-llama a la funcion setInterval de js, para que itere la funcion myTimer cada 10seg
      setInterval(myTimer, 10000);
      //-mytimer ejecuta la funcion obtener datos
      function myTimer() {
        Get_Data("esp32_01");}
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
        xmlhttp.onreadystatechange = function() {
         // Verifica si la solicitud se ha completado correctamente y el código de estado es 200 (OK)
          if (this.readyState == 4 && this.status == 200) {
           // Parsea la respuesta JSON del servidor
            const myObj = JSON.parse(this.responseText);
            if (myObj.id == "esp32_01") {
           // Actualiza elementos del DOM con la información recibida
              document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
              document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
              document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
              document.getElementById("ESP32_01_anemometro").innerHTML = myObj.anemometro;
              document.getElementById("ESP32_01_veleta").innerHTML = myObj.veleta;
              document.getElementById("ESP32_01_pluviometro").innerHTML = myObj.pluviometro;
              document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
            }
          }
        };
        // Configura la solicitud HTTP (POST) al archivo "getdata.php" de manera asíncrona
        xmlhttp.open("POST","getdata.php",true);
       // Configura el tipo de contenido de la solicitud
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       // Envía la solicitud con el parámetro "id"
        xmlhttp.send("id="+id);
			}
    </script>

    <script> 
    // segundo script
    //-script para actualizar valores del esp32
    //-PONE LOS VALORES EN NULL 
    document.getElementById("ESP32_02_Temp").innerHTML = "NN"; 
    document.getElementById("ESP32_02_Humd").innerHTML = "NN";
    document.getElementById("ESP32_02_Status_Read_DHT11").innerHTML = "NN";
    document.getElementById("ESP32_02_anemometro").innerHTML ="NN";
    document.getElementById("ESP32_02_veleta").innerHTML="NN";
    document.getElementById("ESP32_02_pluviometro").innerHTML="NN";

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
      xmlhttpp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Respuesta del servidor:", this.responseText);
          var myObjDOS = JSON.parse(this.responseText);
          if (myObjDOS.id == "esp32_02") {
            document.getElementById("ESP32_02_Temp").innerHTML = myObjDOS.temperature;
            document.getElementById("ESP32_02_Humd").innerHTML = myObjDOS.humidity;
            document.getElementById("ESP32_02_Status_Read_DHT11").innerHTML = myObjDOS.status_read_sensor_dht11;
            document.getElementById("ESP32_02_anemometro").innerHTML = myObjDOS.anemometro;
            document.getElementById("ESP32_02_pluviometro").innerHTML =myObjDOS.pluviometro;
            document.getElementById("ESP32_02_veleta").innerHTML =myObjDOS.veleta;
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
    document.getElementById("ESP32_03_anemometro").innerHTML ="NN";
    document.getElementById("ESP32_03_veleta").innerHTML="NN";
    document.getElementById("ESP32_03_pluviometro").innerHTML="NN";

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
      xmlhttppp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Respuesta del servidor:", this.responseText);
          var myObjTRES = JSON.parse(this.responseText);
          if (myObjTRES.id == "esp32_03") {
            document.getElementById("ESP32_03_Temp").innerHTML = myObjTRES.temperature;
            document.getElementById("ESP32_03_Humd").innerHTML = myObjTRES.humidity;
            document.getElementById("ESP32_03_Status_Read_DHT11").innerHTML = myObjTRES.status_read_sensor_dht11;
            //se agrego esta linea de abajo
            document.getElementById("ESP32_03_anemometro").innerHTML = myObjTRES.anemometro;
            document.getElementById("ESP32_03_veleta").innerHTML =myObjTRES.veleta;
            document.getElementById("ESP32_03_pluviometro").innerHTML =myObjTRES.pluviometro;

          }
        }
      };
      xmlhttppp.open("POST", "getdataTRES.php", true);
      xmlhttppp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttppp.send("id=" + id);
    }

    <?php
        include( creadorDeTarjetas.php );
    
    ?>
    </script> 
  </body>
</html>

