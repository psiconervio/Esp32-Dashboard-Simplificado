// recordtable.php
<!DOCTYPE HTML>
<html>
<head>
  <title>Datos Estacion Metereologica del Nodo Tecnologico</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="resources/stylerecord.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="topnav">
    <h3>LABORATORIO DE INNOVACION</h3>
  </div>
  <br>
  <h3 style="color: #0c6980;">DATOS ESTACION METEREOLOGICA</h3>
  <table class="styled-table" id="table_id">
    <thead>
      <tr>
        <th>NO</th>
        <th>TEMPERATURA (°C)</th>
        <th>HUMEDAD (%)</th>
        <th>DIRECCION DE VIENTO</th>
        <th>VELOCIDAD DE VIENTO</th>
        <th>CAUDAL DE LLUVIA</th>
        <th>TIEMPO</th>
        <th>FECHA (D-M-A)</th>
      </tr>
    </thead>
    <tbody id="tbody_table_record">
      <?php
      include 'conexion/database.php';
      //trabajar con php
      $num = 0;
      $arrayfechaexactatotal = [];
      $arraydateFormat = [];
      $arraytemperaturate = [];
      $arrayhumedad = [];
      //The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
      $pdo = Database::connect();
      // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
      // This table is used to store and record DHT11 sensor data updated by ESP32. 
      // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
      // To store data, this table is operated with the "INSERT" command, so this table will contain many rows.
      $sql = 'SELECT * FROM esp32_01_tablerecord ORDER BY date DESC, time DESC';
      $fechaanterior = null;
      
      foreach ($pdo->query($sql) as $row) {
        $date = date_create($row['date']);
        $dateFormat = date_format($date, "d-m-Y");
        $data[] = ['date' => $dateFormat, 'tiempo' => $row['time'], 'temperature' => $row['temperature'], 'humidity' => $row['humidity'], 'veleta' => $row['veleta'], 'anemometro' => $row['anemometro'], 'pluviometro' => $row['pluviometro']];
        $longitudarray= count($data); 
        
        $num++;
        echo '<tr>';
        echo '<td>' . $num . '</td>';
        echo '<td class="bdr">' . $row['temperature'] . ' °C</td>';
        echo '<td class="bdr">' . $row['humidity'] . ' %</td>';
        echo '<td class="bdr">' . $row['veleta'] . '</td>';
        echo '<td class="bdr">' . $row['anemometro'] . ' km/h</td>';
        echo '<td class="bdr">' . $row['pluviometro'] . ' ml/h</td>';
        echo '<td class="bdr">' . $row['time'] . '</td>';
        echo '<td>' . $dateFormat . '</td>';
        echo '</tr>';
        // $arraytemperaturate[] = ['temperaturaa'=>$row['temperature']];
        $arreglofecha[] = ['date' => $dateFormat];
        //para sacar temperatura de fechas exactas hay que iterrar en el array
        //para sacar humedad de fechas exactas hay que iterrar en el arrayintentar hacerlo en el array data
      

        // print_r($data);
        // array_push($arrayfechaexactatotal,);
        array_push($arraydateFormat, $dateFormat);
      }
      //   $fechaexactacambia = $dateformat;
      //pasar todos array php a javascript json para el manejo de la logica y asyncs y traer las tablas sea lo esperado
      Database::disconnect();
      //funcion para promediar maximo y minimo de la temperatura en un solo dia
      $varprimerafecha = null;
      $arrayfechasphp = [];
      
      for ($i = 0; $i < $longitudarray; $i++) { 
          if ($data[$i]['date'] !== $varprimerafecha) {
              // Si la fecha actual es diferente a la fecha anterior, inicializar los arrays
              $arrayfechasphp[$data[$i]['date']] = [
                  'max_temp' => null,
                  'min_temp' => null,
                  'max_humidity' => null,
                  'min_humidity' => null,
                  'max_veleta' => null,
                  'min_veleta' => null,
                  'max_anemometro' => null,
                  'min_anemometro' => null,
                  'max_pluviometro' => null,
                  'min_pluviometro' => null,
              ];
      
              // Inicializar arrays temporales para almacenar los valores del día actual
              $temperaturas_del_dia = [];
              $humedad_del_dia = [];
              $veleta_del_dia = [];
              $anemometro_del_dia = [];
              $pluviometro_del_dia = [];
      
              // Recorrer $data para encontrar los registros del día actual
              foreach ($data as $registro) {
                  if ($registro['date'] === $data[$i]['date']) {
                      $temperaturas_del_dia[] = $registro['temperature'];
                      $humedad_del_dia[] = $registro['humidity'];
                      $veleta_del_dia[] = $registro['veleta'];
                      $anemometro_del_dia[] = $registro['anemometro'];
                      $pluviometro_del_dia[] = $registro['pluviometro'];
                  }
              }
      
              // Obtener los valores máximos y mínimos para cada tipo de dato del día actual
              $arrayfechasphp[$data[$i]['date']]['max_temp'] = max($temperaturas_del_dia);
              $arrayfechasphp[$data[$i]['date']]['min_temp'] = min($temperaturas_del_dia);
      
              $arrayfechasphp[$data[$i]['date']]['max_humidity'] = max($humedad_del_dia);
              $arrayfechasphp[$data[$i]['date']]['min_humidity'] = min($humedad_del_dia);
      
              $arrayfechasphp[$data[$i]['date']]['max_veleta'] = max($veleta_del_dia);
              $arrayfechasphp[$data[$i]['date']]['min_veleta'] = min($veleta_del_dia);
      
              $arrayfechasphp[$data[$i]['date']]['max_anemometro'] = max($anemometro_del_dia);
              $arrayfechasphp[$data[$i]['date']]['min_anemometro'] = min($anemometro_del_dia);
      
              $arrayfechasphp[$data[$i]['date']]['max_pluviometro'] = max($pluviometro_del_dia);
      
              // Actualizar $varprimerafecha
              $varprimerafecha = $data[$i]['date'];
          }
      }
      
      // Imprimir el array de manera ordenada
      foreach ($arrayfechasphp as $fecha => $datos) {
          echo "Fecha: $fecha\n <br>";
          echo "Temperatura Máxima: " . $datos['max_temp'] . "°C\n <br>";
          echo "Temperatura Mínima: " . $datos['min_temp'] . "°C\n <br>";
          echo "Humedad Máxima: " . $datos['max_humidity'] . "%\n <br>";
          echo "Humedad Mínima: " . $datos['min_humidity'] . "%\n <br>";
          echo "Veleta Máxima: " . $datos['max_veleta'] . "\n <br>";
          echo "Veleta Mínima: " . $datos['min_veleta'] . "\n <br>";
          echo "Anemómetro Máximo: " . $datos['max_anemometro'] . " km/h\n <br>";
          echo "Anemómetro Mínimo: " . $datos['min_anemometro'] . " km/h\n <br>";
          echo "Pluviómetro Máximo: " . $datos['max_pluviometro'] . " ml\n <br>";
          echo "-------------------------\n <br>";
      }
      
      
      
      
      //-logica para traer los ultimos dias grabados en la base de datos, hacer logica para traer los valores
      //implementar la carga de los ultimos 7 dias. probar con base de datos actualizada
      // print_r($arraytemperaturate);
      // $fechaexactacambia = null;
      // $longfechaexacta = sizeof($arrayfechaexactatotal);
      // $diass = 7;
      // foreach ($arraydateFormat as $fechaexacta) {
      //   if ($fechaexacta != $fechaexactacambia && $longfechaexacta < $diass) {
//
      //     array_push($arrayfechaexactatotal, $fechaexacta);
      //     $fechaexactacambia = $fechaexacta;
      //     $longfechaexacta++;
      //     $arrayfechaexactatotal[] = $fechaexacta;
      //   }
      // }
      //            print_r($arrayfechaexactatotal);
      //            print_r($longfechaexacta);
      //logica para funcion de sacar maximo y minimo de tiempo para el dashboard// sacar promedio de datos obtenidos de la base de datos, con una variacion de 5 grados
      
      ?>
      <script>
        let fechas = [];
        let fechaanterior ;
        var data = <?php echo json_encode($data); ?>;
        console.log(data);
        function fechaa() {
          for (let i = 0; i <= 15; i++) {

            if (data[i].date !== fechaanterior) {
              fechas.push(data[i].date);
              fechaanterior = data[i].date;

            }
          }
          console.log(fechas);

          //  hacer una sola funcion para que se ejecute cuando se aprieta el boton
        }
        fechaa()
        //  let fechas = data;
        // let temperaturadata = data.temperature;

      //  var arreglofechas = <?php echo json_encode($arreglofecha); ?>;
      </script>
    </tbody>
  </table>
  <br>
  <div class="btn-group">
    <button class="button" id="btn_prev" onclick="prevPage()">Anterior</button>
    <button class="button" id="btn_next" onclick="nextPage()">Siguiente</button>
    <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;;">
      <p style="position:relative; font-size: 14px;"> Tabla : <span id="page"></span></p>
    </div>
    <select name="number_of_rows" id="number_of_rows">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </select>
    <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Aplicar</button>
  </div>
  <br>
  <script>
    //script para sacar fecha actual y de los ultimos 6 dias
    // let fechas = [];
    // for(let i = 0; i < 7; i++){
    //     let fecha = new Date();
    //     fecha.setDate(fecha.getDate() - i);
    //     fechas.push(fecha.toISOString().split('T')[0]);
    // }
    // console.log(fechas);
    var arraypluvi = [];
    var arrayfecha = [];
    var arraytemp = [];
    var arrayhum = [];
    var arrayhora = [];
    //------------------------------------------------------------
    var current_page = 1;
    var records_per_page = 10;
    var l = document.getElementById("table_id").rows.length
    //------------------------------------------------------------
    function apply_Number_of_Rows() {
      var x = document.getElementById("number_of_rows").value;
      records_per_page = x;
      changePage(current_page);
    }
    //------------------------------------------------------------
    function prevPage() {
      if (current_page > 1) {
        current_page--;
        changePage(current_page);
        fechaa()
        myChart.update()
      }
    }
    //------------------------------------------------------------
    function nextPage() {
      if (current_page < numPages()) {
        current_page++;
        changePage(current_page);
      }
    }
    //------------------------------------------------------------
    function changePage(page) {
      var btn_next = document.getElementById("btn_next");
      var btn_prev = document.getElementById("btn_prev");
      var listing_table = document.getElementById("table_id");
      var page_span = document.getElementById("page");
      // Validate page
      if (page < 1) page = 1;
      if (page > numPages()) page = numPages();

      [...listing_table.getElementsByTagName('tr')].forEach((tr) => {
        tr.style.display = 'none'; // reset all to not display
      });
      listing_table.rows[0].style.display = ""; // display the title row

      for (var i = (page - 1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
        if (listing_table.rows[i]) {
          listing_table.rows[i].style.display = ""
          //listing_table.rows contiene el valor de cada elemento a poner en la tabla , buscar variable que controla la cantidad
          //console.log(listing_table.rows[i].style.display);
          //extrae datos especificos de la tabla
          var row = listing_table.rows[i];
          console.log(row)
          var children = row.children;
          var fecha = row.children[7];
          var temp = row.children[1];
          var hum = row.children[3];
          var hora = row.children[6];
          var pluvi = row.children[5];
          var valorpluvi = pluvi.innerText;
          var valortemp = temp.innerText;
          var valorfecha = fecha.innerText;
          var valorhum = hum.innerText;
          var valorhora = hora.innerText;
          //push para cambiar el sentido de la grafica
          arraypluvi.unshift(valorpluvi);
          arrayfecha.unshift(valorfecha);
          arraytemp.unshift(valortemp);
          arrayhum.unshift(valorhum);
          arrayhora.unshift(valorhora);
          // console.log(valortemp);
          // console.log(valor);
          fechaa;
          if (myChart) {
            myChart.update();
          }
        }
      }
      const constlowbatery = 100;
      if (arraypluvi >= constlowbatery) {
        console.log("bateria baja")
        ///pasar todo a javascritp
      }
      console.log(arraypluvi);
      console.log(arrayfecha);
      console.log(arraytemp);
      console.log(arrayhum);
      console.log(arrayhora);

      page_span.innerHTML = page + "/" + numPages() + " (Total numero de filas = " + (l - 1) + ") | Numero de filas : ";

      if (page == 0 && numPages() == 0) {
        btn_prev.disabled = true;
        btn_next.disabled = true;
        return;
      }

      if (page == 1) {
        btn_prev.disabled = true;
      } else {
        btn_prev.disabled = false;
      }

      if (page == numPages()) {
        btn_next.disabled = true;
      } else {
        btn_next.disabled = false;
      }
    }
    //------------------------------------------------------------
    function numPages() {
      return Math.ceil((l - 1) / records_per_page);
    }
    //------------------------------------------------------------
    window.onload = function () {
      var x = document.getElementById("number_of_rows").value;
      records_per_page = x;
      changePage(current_page);
    };
    //------------------------------------------------------------
  </script>
  <h1>GRAFICO DE TIEMPO</h1>
  <div id="graficocanvas"
    style="height:80vh; width:100vw; margin: 0; display: flex; justify-content: center; align-items: center;">
    <canvas id="myChart"></canvas>
  </div>
  <script>
    var arrayfechaexactatotal = <?php echo json_encode($arrayfechaexactatotal); ?>;
    var arraytemperaturatotal = <?php echo json_encode($arraytemperaturate); ?>;
    console.log(arraytemperaturatotal);
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: arrayfechaexactatotal,
        datasets: [{
          label: 'Temperatura',
          data: arraytemp,
          borderColor: 'rgba(255, 99, 132, 1)',
          fill: false
        }, {
          label: 'Humedad',
          data: arrayhum,
          borderColor: 'rgba(75, 192, 192, 1)',
          fill: false
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
    if (myChart) {
      myChart.update();
    }
    console.log(arrayfechaexactatotal);
  </script>
</body>
<footer>
</footer>
</html>