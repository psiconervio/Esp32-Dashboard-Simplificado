    //---------posible error, las etiquetas(span con id de las etiquedas) no estan creadas y puede salir el error de ---------------------------------------------------
// document.getElementById("ESP32_01_Temp").innerHTML = "NN";
// document.getElementById("ESP32_01_Humd").innerHTML = "NN";
// document.getElementById("ESP32_01_Veleta").innerHTML = "NN";
// document.getElementById("ESP32_01_Anemometro").innerHTML = "NN";
// document.getElementById("ESP32_01_Pluviometro").innerHTML = "NN";
//------------------------------------------------------------

// Get_Data("esp32_01");

//setInterval(myTimer, 12000);

//------------------------------------------------------------
async function myTimer() {
  await Get_Data("esp32_01");
}
//------------------------------------------------------------

//------------------------------------------------------------
async function Get_Data(id) {
  try {
    const response = await fetch("conexion/getdata.php", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `id=${id}`
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    } else {
      const myObj = await response.json();
      if (myObj.id == "esp32_01") {
        document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
        document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
        // document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
        document.getElementById("ESP32_01_Veleta").innerHTML = myObj.veleta;
        document.getElementById("ESP32_01_Anemometro").innerHTML = myObj.anemometro;
        document.getElementById("ESP32_01_Pluviometro").innerHTML = myObj.pluviometro;
      }
    }
  } catch (error) {
    console.error('There has been a problem with your fetch operation:', error);
  }
}
//------------------------------------------------------------

    
    
    //---------posible error, las etiquetas(span con id de las etiquedas) no estan creadas y puede salir el error de ---------------------------------------------------
     // document.getElementById("ESP32_01_Temp").innerHTML = "NN";
     // document.getElementById("ESP32_01_Humd").innerHTML = "NN";
     // document.getElementById("ESP32_01_Veleta").innerHTML = "NN";
     // document.getElementById("ESP32_01_Anemometro").innerHTML = "NN";
     // document.getElementById("ESP32_01_Pluviometro").innerHTML = "NN";
      //------------------------------------------------------------

      // Get_Data("esp32_01");

      // setInterval(myTimer, 5000);

      // //------------------------------------------------------------
      // function myTimer() {
      //   Get_Data("esp32_01");
      // }
      // //------------------------------------------------------------

      // //------------------------------------------------------------
      // function Get_Data(id) {
      //   if (window.XMLHttpRequest) {
      //     // code for IE7+, Firefox, Chrome, Opera, Safari
      //     xmlhttp = new XMLHttpRequest();
      //   } else {
      //     // code for IE6, IE5
      //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      //   }
      //   xmlhttp.onreadystatechange = function () {
      //     if (this.readyState == 4 && this.status == 200) {
      //       const myObj = JSON.parse(this.responseText);
      //       if (myObj.id == "esp32_01") {
      //         document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
      //         document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
      //         // document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
      //         document.getElementById("ESP32_01_Veleta").innerHTML = myObj.veleta;
      //         document.getElementById("ESP32_01_Anemometro").innerHTML = myObj.anemometro;
      //         document.getElementById("ESP32_01_Pluviometro").innerHTML = myObj.pluviometro;
      //         // 
      //       }
      //     }
      //   };
      //   xmlhttp.open("POST", "conexion/getdata.php", true);
      //   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //   xmlhttp.send("id=" + id);
      // }
      // //------------------------------------------------------------

