<!DOCTYPE html>
<html lang="es">

<head>
  <script src="resources/jquery.js"></script>
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
    }
    function cargaruv() {
      fetch("https://api.openuv.io/api/v1/uv?lat=-28.51&lng=-65.82&alt=100&dt=", requestOptions)
        .then(response => response.json())
        .then(data => {
          // Acceder a los datos
          let uv = data.result.uv;
          document.getElementById('uv').innerText = uv;

          if (uv <= 2) {
            color = "#4fb400";
            indiceuv.style.setProperty("--coloraso", color);
          }
          else if (uv <= 5) {
            color = "#f8b600";
            indiceuv.style.setProperty("--coloraso", color);
          }
          else if (uv <= 7) {
            color = "#f85900";
            indiceuv.style.setProperty("--coloraso", color);
          }
          else if (uv <= 10) {
            color = "#d81f1d";
            indiceuv.style.setProperty("--coloraso", color);
          }
          else if (uv >= 11) {
            color = "#998cff";
            indiceuv.style.setProperty("--coloraso", color);
          }
        })
        .catch(error => {
          console.error('Error al obtener los datos:', error);
        });
    }
    cargaruv();

    function timeruv() {
      cargaruv();
    }

    setInterval(timeruv, 1200000);
  </script>
  <script src="resources/apiclimaa.js"></script>
  <title>Laboratorio de Innovacion Social</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="resources/style-hover-moreinfo.css">
  <script src="resources/fontasome.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="resources/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="resources/styleINDEXNUEVODISEÑO.css">

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
        <div class="detalless">
          <h2>Datos Generales<span id="ESP32_01_Status_Read_DHT11"></span></h2>
        </div>

        <div class="detalles">
          <h2>Datos Estacion Nodo<span id="ESP32_01_Status_Read_DHT11"></span></h2>
        </div>

        <br>
        <div class="contenedorTodosItems">
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
              <p class="humidityColor"> Humedad<br></p>
            </div>

            <div class="contenedorItem">
              <i class="fa-solid fa-gauge-simple-high" aria-hidden="true"></i> <span class="temperatureColor"><span
                  id="ESP32_01_Anemometro"></span>km/h </span>
              <p class="anemometro_title"> Velocidad Viento<br>
              </p>
            </div>
            <div class="contenedorItem">
              <i class="fa-regular fa-compass" aria-hidden="true"></i> <span class="reading"><span
                  id="ESP32_01_Veleta">asd</span></span>
              <p class="veleta_title"> Direccion Viento<br></p>
            </div>

            <div class="contenedorItem">
              <span class="reading"><i class="fa-solid fa-cloud-rain"></i> <span id="ESP32_01_Pluviometro"></span> ml</span>
              <p class="pluviometro_title"> Caudal de Lluvia<br>

              </p>
            </div>
          </div>

        </div>
        <div class='contenedorTodosItem'>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <span id=indiceuv> <span class="reading"><i class="fa-regular fa-sun"></i> <span id="uv"></span></span>
              </span>
              <p class="pluviometro_title"></i> Indice UV<br> </p>
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


          </div>

        </div>
      </div>
    </div>
  </div>
<!--   <div class="content">
    <div class="cards">

      <!-- ==Primer card MONITOREO_ESP32_01== izquierda -->
      <div class="card video-background">
        <div class="card header">
          <h3 style="font-size: 1rem;">Estacion Metereologica Zona Norte</h3>
        </div>
        <div class="transparencia"></div>

        <video id="miVideo1" src="resources/videos/lluvia.mp4" autoplay loop muted></video>
        <div class="body-tarjet">
          <h2>San Fernando Del Valle de Catamarca</h2>
          <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
            <br>
            <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
            <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
        </div>
        <div class="detalless">
          <h2>Datos Generales<span id="ESP32_01_Status_Read_DHT11"></span></h2>
        </div>
        <div class="detalles">
          <h2>Datos Esp32</h2>
        </div>
        <br>
        <div class="contenedorTodosItems">
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint" aria-hidden="true"></i> <span class="reading"><span
                  id="ESP32_01_Humd">55</span>%</span>
              <p class="humidityColor"> Humedad<br></p>
            </div>

            <div class="contenedorItem">
              <i class="fa-solid fa-gauge-simple-high" aria-hidden="true"></i> <span class="temperatureColor"><span
                  id="ESP32_01_Anemometro">0</span>km/h </span>
              <p class="anemometro_title"> Velocidad Viento<br>
              </p>
            </div>
            <div class="contenedorItem">
              <i class="fa-regular fa-compass" aria-hidden="true"></i> <span class="reading"><span
                  id="ESP32_01_Veleta">NOROESTE</span></span>
              <p class="veleta_title"> Direccion Viento<br></p>
            </div>

            <div class="contenedorItem">
              <span class="reading"><span id="ESP32_01_Pluviometro">10</span> ml</span>
              <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain" aria-hidden="true"></i> Caudal de
                Lluvia<br>

              </p>
            </div>
          </div>

        </div>
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
              <i class="fa-regular fa-compass"></i> <span class="reading"><span id="ESP32_01_Veleta"></span>°</span>
              <p class="veleta_title"> Direccion Viento<br><span class="reading"></span></p>
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
          <h3 style="font-size: 1rem;">Estacion Metereologica Zona Sur</h3>
        </div>
        <div class="transparencia"></div>

        <video id="miVideo2" src="resources/videos/storm.mp4" autoplay loop muted></video>
        <div class="body-tarjet">
          <h2>San Fernando Del Valle de Catamarca</h2>
          <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
            <br>
            <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
            <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
        </div>
        <div class="detalless">
          <h2>Datos Generales<span id="ESP32_01_Status_Read_DHT11"></span></h2>
        </div>
        <div class="detalles">
          <h2>Datos Esp32</h2>
        </div>
        <br>
        <div class="contenedorTodosItems">
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint" aria-hidden="true"></i> <span class="reading"><span
                  id="ESP32_01_Humd">55</span>%</span>
              <p class="humidityColor"> Humedad<br></p>
            </div>

            <div class="contenedorItem">
              <i class="fa-solid fa-gauge-simple-high" aria-hidden="true"></i> <span class="temperatureColor"><span
                  id="ESP32_01_Anemometro">0</span>km/h </span>
              <p class="anemometro_title"> Velocidad Viento<br>
              </p>
            </div>
            <div class="contenedorItem">
              <i class="fa-regular fa-compass" aria-hidden="true"></i> <span class="reading"><span
                  id="ESP32_01_Veleta">NOROESTE</span></span>
              <p class="veleta_title"> Direccion Viento<br></p>
            </div>

            <div class="contenedorItem">
              <span class="reading"><span id="ESP32_01_Pluviometro">10</span> ml</span>
              <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain" aria-hidden="true"></i> Caudal de
                Lluvia<br>

              </p>
            </div>
          </div>

        </div>
        <div class='contenedorTodosItem'>
          <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

          <div class="contenedorInterior">
            <div class="contenedorItem">
              <i class="fas fa-tint"></i> <span class="reading"><span id="ESP32_01_Humd"></span>&percnt;</span>
              <p class="humidityColor"> Humedad<br></p>
            </div>
            <div class='contenedorItem'>
              <i class="fa-solid fa-gauge-simple-high"></i> <span class="temperatureColor"><span
                  id="ESP32_01_Anemometro"></span>km/h </span>
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
                <span class="reading"><span id="ESP32_01_Pluviometro"></span> ml</span>
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
            <h3 style="font-size: 1rem;">Estacion Metereologica Zona Este</h3>
          </div>
          <div class="transparencia"></div>

          <video id="miVideo3" src="resources/videos/pocasnubess.mp4" autoplay loop muted></video>
          <div class="body-tarjet">
            <h2>San Fernando Del Valle de Catamarca</h2>
            <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
              <br>
              <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
              <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
          </div>
          <div class="detalless">
            <h2>Datos Generales<span id="ESP32_01_Status_Read_DHT11"></span></h2>
          </div>
          <div class="detalles">
            <h2>Datos Esp32</h2>
          </div>
          <br>
          <div class="contenedorTodosItems">
            <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

            <div class="contenedorInterior">
              <div class="contenedorItem">
                <i class="fas fa-tint" aria-hidden="true"></i> <span class="reading"><span
                    id="ESP32_01_Humd">55</span>%</span>
                <p class="humidityColor"> Humedad<br></p>
              </div>

              <div class="contenedorItem">
                <i class="fa-solid fa-gauge-simple-high" aria-hidden="true"></i> <span class="temperatureColor"><span
                    id="ESP32_01_Anemometro">0</span>km/h </span>
                <p class="anemometro_title"> Velocidad Viento<br>
                </p>
              </div>
              <div class="contenedorItem">
                <i class="fa-regular fa-compass" aria-hidden="true"></i> <span class="reading"><span
                    id="ESP32_01_Veleta">NOROESTE</span></span>
                <p class="veleta_title"> Direccion Viento<br></p>
              </div>

              <div class="contenedorItem">
                <span class="reading"><span id="ESP32_01_Pluviometro">10</span> ml</span>
                <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain" aria-hidden="true"></i> Caudal de
                  Lluvia<br>

                </p>
              </div>
            </div>

          </div>
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
            <h3 style="font-size: 1rem;">Estacion Metereologica Zona oeste</h3>
          </div>
          <div class="transparencia"></div>

          <video id="miVideo4" src="resources/videos/rainn.mp4" autoplay loop muted></video>
          <div class="body-tarjet">
            <h2>San Fernando Del Valle de Catamarca</h2>
            <h1><span id="ESP32_01_Temp"></span> &deg;C</span></h2>
              <br>
              <p><span id='iddescripcioncielo'></span> | Sensacion Termica <span id='sensaciontermica'></span>°C</p>
              <p>Rafaga de viento <span id="rafagadeviento"></span> km/h </p>
          </div>
          <div class="detalless">
            <h2>Datos Generales<span id="ESP32_01_Status_Read_DHT11"></span></h2>
          </div>
          <div class="detalles">
            <h2>Datos Esp32</h2>
          </div>
          <br>
          <div class="contenedorTodosItems">
            <!-- Muestra los valores de humedad y temperatura recibidos de ESP32.. *** -->

            <div class="contenedorInterior">
              <div class="contenedorItem">
                <i class="fas fa-tint" aria-hidden="true"></i> <span class="reading"><span
                    id="ESP32_01_Humd">55</span>%</span>
                <p class="humidityColor"> Humedad<br></p>
              </div>

              <div class="contenedorItem">
                <i class="fa-solid fa-gauge-simple-high" aria-hidden="true"></i> <span class="temperatureColor"><span
                    id="ESP32_01_Anemometro">0</span>km/h </span>
                <p class="anemometro_title"> Velocidad Viento<br>
                </p>
              </div>
              <div class="contenedorItem">
                <i class="fa-regular fa-compass" aria-hidden="true"></i> <span class="reading"><span
                    id="ESP32_01_Veleta">NOROESTE</span></span>
                <p class="veleta_title"> Direccion Viento<br></p>
              </div>

              <div class="contenedorItem">
                <span class="reading"><span id="ESP32_01_Pluviometro">10</span> ml</span>
                <p class="pluviometro_title"><i class="fa-solid fa-cloud-rain" aria-hidden="true"></i> Caudal de
                  Lluvia<br>

                </p>
              </div>
            </div>

          </div>
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
                <p class="veleta_title"> Direccion Viento<br><span class="reading"></span></p>
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
    </div> -->

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
      //---------posible error, las etiquetas(span con id de las etiquedas) no estan creadas y puede salir el error de ---------------------------------------------------
      document.getElementById("ESP32_01_Temp").innerHTML = "NN";
      document.getElementById("ESP32_01_Humd").innerHTML = "NN";
      document.getElementById("ESP32_01_Veleta").innerHTML = "NN";
      document.getElementById("ESP32_01_Anemometro").innerHTML = "NN";
      document.getElementById("ESP32_01_Pluviometro").innerHTML = "NN";
      //------------------------------------------------------------

      Get_Data("esp32_01");

      setInterval(myTimer, 5000);

      //------------------------------------------------------------
      function myTimer() {
        Get_Data("esp32_01");
      }
      //------------------------------------------------------------

      //------------------------------------------------------------
      function Get_Data(id) {
        if (window.XMLHttpRequest) {
          // code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp = new XMLHttpRequest();
        } else {
          // code for IE6, IE5
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            if (myObj.id == "esp32_01") {
              document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
              document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
              // document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
              document.getElementById("ESP32_01_Veleta").innerHTML = myObj.veleta;
              document.getElementById("ESP32_01_Anemometro").innerHTML = myObj.anemometro;
              document.getElementById("ESP32_01_Pluviometro").innerHTML = myObj.pluviometro;
              // 
            }
          }
        };
        xmlhttp.open("POST", "conexion/getdata.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id);
      }
      //------------------------------------------------------------


    </script>
</body>

</html>