<!DOCTYPE HTML>
<html>

<head>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script>
    window.onload = function () {
      $('#onload').fadeOut();
      $('body').removeClass('hidden');
    }
  </script>
  <!--script api uv-->
  <script>
    var myHeaders = new Headers();
    myHeaders.append("x-access-token", "openuv-165a9rlqaveqy0-io");
    myHeaders.append("Content-Type", "application/json");

    var requestOptions = {
      method: 'GET',
      headers: myHeaders,
      redirect: 'follow'
    };
function cargaruv{
      fetch("https://api.openuv.io/api/v1/uv?lat=-28.51&lng=-65.82&alt=100&dt=", requestOptions)
      .then(response => response.json())
      .then(data => {
        // Acceder a los datos
        const uv = data.result.uv;
         if (uv<=2){
          color = "#4fb400";
          elemento.style.setProperty("--coloraso", color);
         }
         else if(uv<=5){
          color = "#f8b600";
          elemento.style.setProperty("--coloraso", color);
         }
         else if (uv<=7){
          color = "#f85900";
          elemento.style.setProperty("--coloraso", color);
         }
         else if (uv<=10){
          color = "#d81f1d";
          elemento.style.setProperty("--coloraso", color);
         }
         else if (uv>=11){
          color = "#998cff";
          elemento.style.setProperty("--coloraso", color);
         }
        document.getElementById('uv').innerText = uv;
      })
      .catch(error => {
        console.error('Error al obtener los datos:', error);
      });
    }
    cargaruv();

    function timer() {
      cargaruv();
    }

    setInterval(timer, 60000);
  </script>
   <script src="pruebaAutomatizacion\apiclimaa.js"></script>
  <title>Laboratorio de Innovacion Social</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="funciones/accesibility-hover-moreinfo.js"></script>
  <link rel="stylesheet" href="funciones/style-hover-moreinfo.css">
  <script src="https://kit.fontawesome.com/da4a5b6f37.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="icon" href="data:,">
  <link rel="stylesheet" href="styleINDEXNUEVODISEÑO.css">

</head>
<!--loader-->

<body class="hidden">
  <div class="centrado" id='onload'>
    <div class="lds-ring">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <div class="topnav">
    <img src="banernodo1.png" width="100%" height="20%" alt="">
    <h3>Laboratorio de Innovacion Social - Estacion Metereologica </h3>
  </div>
  <br>

  <!-- MONITOREO Y CONTROL DE PANTALLAS (content es el contenedor main, cards son cada uno de los bloques) -->
  <div class="content">
    <div class="cards">
      <div class="card video-background">
        <div class="card header">
          <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
        </div>
        <div class="transparencia"></div>

        <video id="miVideo"></video>
        <div class="body-tarjet">
          <h2>San Fernando Del Valle de Catamarca</h2>
          <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
            <br>
            <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
            <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>

        </div>
        <div id="piechart" style="width: 100px; height: 100x;"></div>

        <div class="detalles">
          <h2>Detalles</h2>
          <p>Indice uv</p>
          <div class="barraprogreso"></div>
          <div class="contenedorItem">
            <span class="reading"><i class="fa-solid fa-arrow-down-short-wide" aria-hidden="true"></i> <span
                id="uv"></span> uv</span>
            <p class="pluviometro_title"></i> Indice UV<br> </p>
          </div>
        </div>

        <br>
        <div class='contenedorTodosItem'>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
              <p class="humidityColor"> Humedad<br></p>
            </div>
            <div class='contenedorItem'>
              <i class="fa-solid fa-gauge-simple-high"></i> <span class="temperatureColor"><span
                  id="ESP32_01_anemometro"></span>km/h </span>
              <p class="anemometro_title"> Velocidad Viento<br>
              </p>
            </div>
            <div class="contenedorItem">
              <i class="fa-regular fa-compass"></i> <span class="reading"><span id="ESP32_01_veleta"></span>°</span>
              <p class="veleta_title"> Direccion Viento<br><span class="reading"><span
                    id="ESP32_01_veleta"></span></span></p>
            </div>
            <div class="contenedorItem">
              <i class="fa-solid fa-cloud-rain"></i>
              <span class="reading"><span id="nubosidad"></span></span>
              <p class="pluviometro_title"> Nubosidad<br></p>
            </div>
            <div class="contenedorItem">
              <span class="reading"><i class="fa-solid fa-arrow-down-short-wide" aria-hidden="true"></i> <span
                  id="presion"></span> hPA</span>
              <p class="pluviometro_title"></i> Presion Atmosferica<br> </p>
            </div>

            <div class="contenedorItem">
              <p><i class="fa-solid fa-eye"></i> <span class="" id="visibilidad"></span> Km</p>
              <p>Visibilidad</p>
            </div>
            <div class="contenedorItem">
              <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> Caudal de Lluvia<br>
                <span class="reading"><span id="ESP32_01_pluviometro"></span> ml</span>
              </p>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="cards">

      <!-- ==Primer card MONITOREO_ESP32_01== izquierda -->
      <div class="card video-background">
        <div class="card header">
          <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
        </div>
        <div class="transparencia"></div>

        <video id="miVideo1" src="videos/lluvia.mp4" autoplay loop muted></video>
        <div class="body-tarjet">
          <h2>San Fernando Del Valle de Catamarca</h2>
          <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
            <br>
            <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
            <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
        </div>
        <div class="detalles">
          <p>Detalles
        </div>
        <br>
        <div class='contenedorTodosItem'>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
              <p class="humidityColor"> Humedad<br></p>
            </div>
            <div class='contenedorItem'>
              <i class="fa-solid fa-gauge-simple-high"></i> <span class="temperatureColor"><span
                  id="ESP32_01_anemometro"></span>km/h </span>
              <p class="anemometro_title"> Velocidad Viento<br>
              </p>
            </div>
            <div class="contenedorItem">
              <i class="fa-regular fa-compass"></i> <span class="reading"><span id="ESP32_01_veleta"></span>°</span>
              <p class="veleta_title"> Direccion Viento<br><span class="reading"><span
                    id="ESP32_01_veleta"></span></span></p>
            </div>
            <div class="contenedorItem">
              <i class="fa-solid fa-cloud-rain"></i>
              <span class="reading"><span id="nubosidad"></span></span>
              <p class="pluviometro_title"> Nubosidad<br></p>
            </div>
            <div class="contenedorItem">
              <span class="reading"><i class="fa-solid fa-arrow-down-short-wide" aria-hidden="true"></i> <span
                  id="presion"></span> hPA</span>
              <p class="pluviometro_title"></i> Presion Atmosferica<br> </p>
            </div>

            <div class="contenedorItem">
              <p><i class="fa-solid fa-eye"></i> <span class="" id="visibilidad"></span> Km</p>
              <p>Visibilidad</p>
            </div>
            <div class="contenedorItem">
              <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> Caudal de Lluvia<br>
                <span class="reading"><span id="ESP32_01_pluviometro"></span> ml</span>
              </p>
            </div>
          </div>
        </div>

      </div>
      <div class="card video-background">
        <div class="card header">
          <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
        </div>
        <div class="transparencia"></div>

        <video id="miVideo2" src="videos/storm.mp4" autoplay loop muted></video>
        <div class="body-tarjet">
          <h2>San Fernando Del Valle de Catamarca</h2>
          <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
            <br>
            <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
            <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
        </div>
        <div class="detalles">
          <p>Detalles
        </div>
        <br>
        <div class='contenedorTodosItem'>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
              <p class="humidityColor"> Humedad<br></p>
            </div>
            <div class='contenedorItem'>
              <i class="fa-solid fa-gauge-simple-high"></i> <span class="temperatureColor"><span
                  id="ESP32_01_anemometro"></span>km/h </span>
              <p class="anemometro_title"> Velocidad Viento<br>
              </p>
            </div>
            <div class="contenedorItem">
              <i class="fa-regular fa-compass"></i> <span class="reading"><span id="ESP32_01_veleta"></span>°</span>
              <p class="veleta_title"> Direccion Viento<br><span class="reading"><span
                    id="ESP32_01_veleta"></span></span></p>
            </div>
            <div class="contenedorItem">
              <i class="fa-solid fa-cloud-rain"></i>
              <span class="reading"><span id="nubosidad"></span></span>
              <p class="pluviometro_title"> Nubosidad<br></p>
            </div>
            <div class="contenedorItem">
              <span class="reading"><i class="fa-solid fa-arrow-down-short-wide" aria-hidden="true"></i> <span
                  id="presion"></span> hPA</span>
              <p class="pluviometro_title"></i> Presion Atmosferica<br> </p>
            </div>

            <div class="contenedorItem">
              <p><i class="fa-solid fa-eye"></i> <span class="" id="visibilidad"></span> Km</p>
              <p>Visibilidad</p>
            </div>
            <div class="contenedorItem">
              <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> Caudal de Lluvia<br>
                <span class="reading"><span id="ESP32_01_pluviometro"></span> ml</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="content">
      <div class="cards">

        <!-- ==Primer card MONITOREO_ESP32_01== izquierda -->
        <div class="card video-background">
          <div class="card header">
            <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
          </div>
          <div class="transparencia"></div>

          <video id="miVideo3" src="videos/pocasnubess.mp4" autoplay loop muted></video>
          <div class="body-tarjet">
            <h2>San Fernando Del Valle de Catamarca</h2>
            <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
              <br>
              <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
              <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
          </div>
          <div class="detalles">
            <p>Detalles
          </div>
          <br>
          <div class='contenedorTodosItem'>
            <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

            <div class="contenedorInterior">
              <div class="contenedorItem">
                <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
                <p class="humidityColor"> Humedad<br></p>
              </div>
              <div class='contenedorItem'>
                <i class="fa-solid fa-gauge-simple-high"></i> <span class="temperatureColor"><span
                    id="ESP32_01_anemometro"></span>km/h </span>
                <p class="anemometro_title"> Velocidad Viento<br>
                </p>
              </div>
              <div class="contenedorItem">
                <i class="fa-regular fa-compass"></i> <span class="reading"><span id="ESP32_01_veleta"></span>°</span>
                <p class="veleta_title"> Direccion Viento<br><span class="reading"><span
                      id="ESP32_01_veleta"></span></span></p>
              </div>
              <div class="contenedorItem">
                <i class="fa-solid fa-cloud-rain"></i>
                <span class="reading"><span id="nubosidad"></span></span>
                <p class="pluviometro_title"> Nubosidad<br></p>
              </div>
              <div class="contenedorItem">
                <span class="reading"><i class="fa-solid fa-arrow-down-short-wide" aria-hidden="true"></i> <span
                    id="presion"></span> hPA</span>
                <p class="pluviometro_title"></i> Presion Atmosferica<br> </p>
              </div>

              <div class="contenedorItem">
                <p><i class="fa-solid fa-eye"></i> <span class="" id="visibilidad"></span> Km</p>
                <p>Visibilidad</p>
              </div>
              <div class="contenedorItem">
                <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> Caudal de Lluvia<br>
                  <span class="reading"><span id="ESP32_01_pluviometro"></span> ml</span>
                </p>
              </div>
            </div>
          </div>

        </div>
        <div class="card video-background">
          <div class="card header">
            <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
          </div>
          <div class="transparencia"></div>

          <video id="miVideo4" src="videos/rainn.mp4" autoplay loop muted></video>
          <div class="body-tarjet">
            <h2>San Fernando Del Valle de Catamarca</h2>
            <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
              <br>
              <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
              <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
          </div>
          <div class="detalles">
            <p>Detalles
          </div>
          <br>
          <div class='contenedorTodosItem'>
            <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

            <div class="contenedorInterior">
              <div class="contenedorItem">
                <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
                <p class="humidityColor"> Humedad<br></p>
              </div>
              <div class='contenedorItem'>
                <i class="fa-solid fa-gauge-simple-high"></i> <span class="temperatureColor"><span
                    id="ESP32_01_anemometro"></span>km/h </span>
                <p class="anemometro_title"> Velocidad Viento<br>
                </p>
              </div>
              <div class="contenedorItem">
                <i class="fa-regular fa-compass"></i> <span class="reading"><span id="ESP32_01_veleta"></span>°</span>
                <p class="veleta_title"> Direccion Viento<br><span class="reading"><span
                      id="ESP32_01_veleta"></span></span></p>
              </div>
              <div class="contenedorItem">
                <i class="fa-solid fa-cloud-rain"></i>
                <span class="reading"><span id="nubosidad"></span></span>
                <p class="pluviometro_title"> Nubosidad<br></p>
              </div>
              <div class="contenedorItem">
                <span class="reading"><i class="fa-solid fa-arrow-down-short-wide" aria-hidden="true"></i> <span
                    id="presion"></span> hPA</span>
                <p class="pluviometro_title"></i> Presion Atmosferica<br> </p>
              </div>

              <div class="contenedorItem">
                <p><i class="fa-solid fa-eye"></i> <span class="" id="visibilidad"></span> Km</p>
                <p>Visibilidad</p>
              </div>
              <div class="contenedorItem">
                <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain"></i> Caudal de Lluvia<br>
                  <span class="reading"><span id="ESP32_01_pluviometro"></span> ml</span>
                </p>
              </div>
            </div>
          </div>
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
</body>

</html>