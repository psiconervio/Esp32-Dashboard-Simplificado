// recordtable.php
<!DOCTYPE HTML>
<html>
  <head>
    <title>Datos Estacion Metereologica del Nodo Tecnologico</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      html {font-family: Arial; display: inline-block; text-align: center;}
      p {font-size: 1.2rem;}
      h4 {font-size: 0.8rem;}
      body {margin: 0;}
      /* ----------------------------------- TOPNAV STYLE color anterior verde agua#0c6980 */
      .topnav {overflow: hidden; background-color: #25488d; color: white; font-size: 1.2rem;}
      /* ----------------------------------- */
      
      /* ----------------------------------- TABLE STYLE */
      .styled-table {
        border-collapse: collapse;
        margin-left: auto; 
        margin-right: auto;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        border-radius: 0.5em;
        overflow: hidden;
        width: 90%;
      }

      .styled-table thead tr {
        background-color: #25488d;
        color: #ffffff;
        text-align: left;
      }

      .styled-table th {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table td {
        padding: 12px 15px;
        text-align: left;
      }

      .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
      }

      .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
      }

      .bdr {
        border-right: 1px solid #e3e3e3;
        border-left: 1px solid #e3e3e3;
      }
      
      td:hover {background-color: rgba(12, 105, 128, 0.21);}
      tr:hover {background-color: rgba(12, 105, 128, 0.15);}
      .styled-table tbody tr:nth-of-type(even):hover {background-color: rgba(12, 105, 128, 0.15);}
      /* ----------------------------------- */
      
      /* ----------------------------------- BUTTON STYLE */
      .btn-group .button {
        background-color: #0c6980; /* Green */
        border: 1px solid #e3e3e3;
        color: white;
        padding: 5px 8px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        cursor: pointer;
        float: center;
      }

      .btn-group .button:not(:last-child) {
        border-right: none; /* Prevent double borders */
      }

      .btn-group .button:hover {
        background-color: #094c5d;
      }

      .btn-group .button:active {
        background-color: #0c6980;
        transform: translateY(1px);
      }

      .btn-group .button:disabled,
      .button.disabled{
        color:#fff;
        background-color: #a0a0a0; 
        cursor: not-allowed;
        pointer-events:none;
      }
    </style>
  </head>
  
  <body>
    <div class="topnav">
      <h3>LABORATORIO DE INNOVACION</h3>
    </div>
    
    <br>
    
    <h3 style="color: #0c6980;">DATOS ESTACION METEREOLOGICA</h3>
    
    <table class="styled-table" id= "table_id">
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
          $num = 0;
          $arrayfechaexactatotal =[];
          $arraydateFormat= [];
          //The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
          $pdo = Database::connect();
          // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
          // This table is used to store and record DHT11 sensor data updated by ESP32. 
          // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
          // To store data, this table is operated with the "INSERT" command, so this table will contain many rows.
          $sql = 'SELECT * FROM esp32_01_tablerecord ORDER BY date DESC, time DESC';
          foreach ($pdo->query($sql) as $row) {
            $date = date_create($row['date']);
            $dateFormat = date_format($date,"d-m-Y");
            $num++;
            echo '<tr>';
            echo '<td>'. $num . '</td>';
            echo '<td class="bdr">'. $row['temperature'] . ' °C</td>';
            echo '<td class="bdr">'. $row['humidity'] . ' %</td>';
            echo '<td class="bdr">'. $row['veleta'] . '</td>';
            echo '<td class="bdr">'. $row['anemometro'] . ' km/h</td>';
            echo '<td class="bdr">'. $row['pluviometro'] . ' ml/h</td>';            
            echo '<td class="bdr">'. $row['time'] . '</td>';
            echo '<td>'. $dateFormat . '</td>';
            echo '</tr>';
            $data[] = ['date' => $dateFormat,'tiempo' =>$row['time'], 'temperature' => $row['temperature'], 'humidity' => $row['humidity']];
         //   print_r($dateFormat);
            array_push($arraydateFormat, $dateFormat);
           // array_push($arraydateFormat, $dateFormat);
        }
     //     $fechaexactacambia = $dateformat;

          Database::disconnect();
   //-logica para traer los ultimos dias grabados en la base de datos, hacer logica para traer los valores
   //impplementar la carga de los ultimos 7 dias. probar con base de datos actualizada
          $fechaexactacambia = null; 
          $longfechaexacta = sizeof($arrayfechaexactatotal);
          $diass= 7;
          foreach ($arraydateFormat as $fechaexacta) {
            if ($fechaexacta != $fechaexactacambia && $longfechaexacta <$diass){

              array_push($arrayfechaexactatotal, $fechaexacta);
              $fechaexactacambia = $fechaexacta;
              $longfechaexacta++;
   //     $arrayfechaexactatotal[] = $fechaexacta;
          }
           }
            print_r($arrayfechaexactatotal);
            print_r($longfechaexacta);
  //logica para funcion de sacar maximo y minimo de tiempo para el dashboard// sacar promedio de datos obtenidos de la base de datos, con una variacion de 5 grados

?>
      </tbody>
    </table>
    <!--proceso para sacar los ultimos 7 dias --->
    <?php
     $contador=0;
         // contador para que itere los idas
          // The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
          $pdo = Database::connect();
          // replace_with_your_table_name, on this project I use the table name 'esp32_table_dht11_leds_record'.
          // This table is used to store and record DHT11 sensor data updated by ESP32. 
          // This table is also used to store and record the state of the LEDs, the state of the LEDs is controlled from the "home.php" page. 
          // To store data, this table is operated with the "INSERT" command, so this table will contain many rows.
          //traer dias de tabla
 //       $sql = 'SELECT * FROM esp32_01_tablerecord WHERE `date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY `date` DESC;';    
          $sql = 'SELECT * FROM `esp32_01_tablerecord` ORDER BY `esp32_01_tablerecord`.`date` DESC;';    
          $result = $pdo->query($sql);

          // Crear un array vacío para almacenar los resultados
          $fechachart = array();
          $fecha = array();
          // Iterar sobre los resultados de la consulta
          foreach ($result as $fila) {
              // Crear un objeto DateTime a partir del tiempo en la fila actual
              $fecha = date_create($fila['time']);
          
              // Formatear la fecha al formato deseado
              $formatofecha = date_format($fecha,"d-m-y");
          
              // Añadir la fecha formateada y el tiempo al array
              $fechachart[] = ['tiempo' => $formatofecha, 'fila' => $fila['time']];
          }

          Database::disconnect();
          if (empty($fechachart)) {
            echo 'No hay resultados para la consulta.';
        } else {
            echo '<pre>';
          //  print_r($fechachart);
            echo '</pre>';
        }
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
          //------------------------------------------------------------

        ?>
    
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
      let fechas = [];
      for(let i = 0; i < 7; i++){
          let fecha = new Date();
          fecha.setDate(fecha.getDate() - i);
          fechas.push(fecha.toISOString().split('T')[0]);
      }
      console.log(fechas);
        var arraypluvi= [];
        var arrayfecha = [];
        var arraytemp = []; 
        var arrayhum =[];
        var arrayhora=[];
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

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
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
            var pluvi= row.children[5];
            var valorpluvi = pluvi.innerText;
            var valortemp =temp.innerText;
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

          }
        }
        if (arraypluvi >= 100) {
          console.log("bateria baja")
          
        }
        console.log(arraypluvi)
        console.log(arrayfecha);
        console.log(arraytemp);
        console.log(arrayhum);
        console.log(arrayhora);

        page_span.innerHTML = page + "/" + numPages() + " (Total numero de filas = " + (l-1) + ") | Numero de filas : ";
        
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
      window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
      };
      //------------------------------------------------------------
    </script>
            <h1>GRAFICO DE TIEMPO</h1>

    <div id=graficocanvas style="height:80vh; width:100vw; margin: 0; display: flex; justify-content: center; align-items: center;">
        <canvas id="myChart" ></canvas>
        </div>
    <script>
   var arrayfechaexactatotal = <?php echo json_encode($arrayfechaexactatotal); ?>;

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

</script>
  </body>
  <footer>
    
  </footer>
</html>