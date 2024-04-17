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
      /* ----------------------------------- */
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
          <th>ID</th>
          <th>PLACA</th>
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
          //------------------------------------------------------------ The process for displaying a record table containing the DHT11 sensor data and the state of the LEDs.
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
            echo '<td class="bdr">'. $row['id'] . '</td>';
            echo '<td class="bdr">'. $row['board'] . '</td>';
            echo '<td class="bdr">'. $row['temperature'] . '</td>';
            echo '<td class="bdr">'. $row['humidity'] . '</td>';
            echo '<td class="bdr">'. $row['veleta'] . '</td>';
            echo '<td class="bdr">'. $row['anemometro'] . '</td>';
            echo '<td class="bdr">'. $row['pluviometro'] . '</td>';            
            echo '<td class="bdr">'. $row['time'] . '</td>';
            echo '<td>'. $dateFormat . '</td>';
            echo '</tr>';
            $data[] = ['date' => $dateFormat,'tiempo' =>$row['time'], 'temperature' => $row['temperature'], 'humidity' => $row['humidity']];
          }
          
          
        //  print_r($data);

          Database::disconnect();
          //------------------------------------------------------------

        ?>
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
            var row = listing_table.rows[i];
            console.log(row)
            var children = row.children;
            var fecha = row.children[9];
            var temp = row.children[3];
            var hum = row.children[4];
            var hora = row.children[8];
            var valortemp =temp.innerText;
            var valorfecha = fecha.innerText;
            var valorhum = hum.innerText;
            var valorhora = hora.innerText;
            //push para cambiar el sentido de la grafica
            arrayfecha.unshift(valorfecha); 
            arraytemp.unshift(valortemp); 
            arrayhum.unshift(valorhum); 
            arrayhora.unshift(valorhora); 
           // console.log(valortemp);
           // console.log(valor);
           myChart.update()
          } else {
            continue;
          }
        }
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
   
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: arrayfecha,
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