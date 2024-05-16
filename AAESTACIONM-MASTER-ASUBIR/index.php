<!DOCTYPE html>
<html lang="es">

<head>
  <!-- <link rel="stylesheet" href="resources/background.css"> -->
  <!-- <script src="resources/jquery.js"></script> -->
  <script>
window.onload = function () {
  $('#onload').fadeOut();
      $('body').removeClass('hidden');
      document.querySelector('.svg-class').style.visibility = 'visible';
//  document.getElementById('onload').style.display = 'none';
//  document.body.classList.remove('hidden');
//  document.querySelector('.svg-class').style.visibility = 'visible';
  //cargaruv();
  //cargarDatos();
  //Get_Data("esp32_01");
//setInterval(cargarDatos, 60000);
//setInterval(cargaruv, 1200000);
//setInterval(myTimer, 12000);
}
  </script>
  <!--script api uv-->
  <title>Laboratorio de Innovacion Social</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="resources/style-hover-moreinfo.css"> -->
  <!-- <script src="resources/fontasome.js" ></script> -->
  <link rel="stylesheet" href="resources/stylenew.css">
</head>
<!--loader-->

<body class="hidden">
  <!-- <div class="centrado" id='onload' style="z-index: 2;">
    <div class="lds-ring">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div> -->



  <div class="topnav">
    <img src="resources/img/logolabblack-modified.png" style="heigth:70px; width: 60px;">
    <h3>Laboratorio de Innovacion - Estacion Metereologica </h3>
  </div>
  <!-- MONITOREO Y CONTROL DE PANTALLAS (content es el contenedor main, cards son cada uno de los bloques) -->
  <div class="content">
    <div class="cards">
      <div class="card video-background">
        <div class="card header">
          <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
        </div>

        <video id="miVideo"></video>
        <div class="body-tarjet">
          <h2>San Fernando Del Valle de Catamarca</h2>
          <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
            
            <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
            <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
        </div>
        <!-- <div class="detalless">
          <h2>Datos Generales<span id="ESP32_01_Status_Read_DHT11"></span></h2>
        </div>
        <div class="detalles">
          <h2>Datos Estacion Nodo<span id="ESP32_01_Status_Read_DHT11"></span></h2>
        </div> -->
        <div class="contenedorTodosItems">
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->
          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
              <p class="humidityColor"> Humedad</p>
            </div>

            <div class="contenedorItem">
              <i class="fa-solid fa-gauge-simple-high" aria-hidden="true"></i> <span class="temperatureColor"><span
                  id="ESP32_01_Anemometro"></span>km/h </span>
              <p class="anemometro_title"> Velocidad Viento
              </p>
            </div>
            <div class="contenedorItem">
              <i class="fa-regular fa-compass" aria-hidden="true"></i> <span class="reading"><span
                  id="ESP32_01_Veleta">asd</span></span>
              <p class="veleta_title"> Direccion Viento</p>
            </div>

            <div class="contenedorItem">
              <span class="reading"><i class="fa-solid fa-cloud-rain"></i> <span id="ESP32_01_Pluviometro"></span>
                ml</span>
              <p class="pluviometro_title"> Caudal de Lluvia</p>
            </div>
          </div>

        </div>
        <div class='contenedorTodosItem'>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <span id=indiceuv> <span class="reading"><i class="fa-regular fa-sun"></i> <span id="uv"></span></span>
              </span>
              <p class="pluviometro_title"></i> Indice UV </p>
            </div>

            <div class="contenedorItem">
              <i class="fa-solid fa-cloud-rain"></i>
              <span class="reading"><span id="nubosidad"></span></span>
              <p class="pluviometro_title"> Nubosidad</p>
            </div>
            <div class="contenedorItem">
              <span class="reading"><i class="fa-solid fa-arrow-down-short-wide" aria-hidden="true"></i> <span
                  id="presion"></span> hPA</span>
              <p class="pluviometro_title"></i> Presion Atmosferica </p>
            </div>

            <div class="contenedorItem">
              <p><i class="fa-solid fa-eye"></i> <span class="" id="visibilidad"></span> Km</p>
              <p>Visibilidad</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->

  <!-- <svg class="svg-class" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    x="0px" y="0px" width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">

    <defs>
      <linearGradient id="bg">
        <stop offset="0%" style="stop-color:rgba(130, 158, 249, 0.06)"></stop>
        <stop offset="50%" style="stop-color:rgba(76, 190, 255, 0.6)"></stop>
        <stop offset="100%" style="stop-color:rgba(115, 209, 72, 0.2)"></stop>
      </linearGradient>
      <path id="wave" fill="url(#bg)" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
  s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
    </defs>
    <g>
      <use xlink:href='#wave' opacity=".3">
        <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="10s" calcMode="spline"
          values="270 230; -334 180; 270 230" keyTimes="0; .5; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
      </use>
      <use xlink:href='#wave' opacity=".6">
        <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="8s" calcMode="spline"
          values="-270 230;243 220;-270 230" keyTimes="0; .6; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
      </use>
      <use xlink:href='#wave' opacty=".9">
        <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="6s" calcMode="spline"
          values="0 230;-140 200;0 230" keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
      </use>
    </g>
  </svg> -->
  </div>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <script src="resources/apiclimaa.js"></script>
  <script src="resources/getdata.js"></script>
  <script src="resources/cargaruv.js"></script>
</body>
<footer>
  <div class="content">
    <div class="cards">
      <div class="card header"
        style="border-radius: 15px;display: flex; justify-content: space-around; align-items: center; justify-content: center;">
        <img id="catacapi" src="resources/img/muniwhite.png"></img>
        <div class="texto-footer">
          <h3>ÚLTIMA VEZ RECIBIDO DATOS DE ESP32 [ <span id="ESP32_01_LTRD"></span> ]</h3>
          <button onclick="window.open('recordtable.php', '_blank');">Abrir tabla de registros</button>
        </div>
        <img id="whitenodo" src="resources/img/whitenodo.png"> </img>
      </div>
    </div>
  </div>
</footer>

</html>