//codigo optimizado
async function cargaruv() {
    const myHeaders = new Headers();
    myHeaders.append("x-access-token", "openuv-165a9rlqaveqy0-io");
    myHeaders.append("Content-Type", "application/json");
  
    const requestOptions = {
      method: 'GET',
      headers: myHeaders,
      redirect: 'follow'
    };
  
    try {
      const response = await fetch("https://api.openuv.io/api/v1/uv?lat=-28.51&lng=-65.82&alt=100&dt=", requestOptions);
      const data = await response.json();
  
      // Acceder a los datos
      let uv = data.result.uv;
      document.getElementById('uv').innerText = uv;
  
      let color;
      if (uv <= 2) {
        color = "#4fb400";
      } else if (uv <= 5) {
        color = "#f8b600";
      } else if (uv <= 7) {
        color = "#f85900";
      } else if (uv <= 10) {
        color = "#d81f1d";
      } else if (uv >= 11) {
        color = "#998cff";
      }
      indiceuv.style.setProperty("--coloraso", color);
    } catch (error) {
      console.error('Error al obtener los datos:', error);
    }
  }
  
//   cargaruv();
  
  //setInterval(cargaruv, 1200000);
  
// function cargaruv() {
//   var myHeaders = new Headers();
// myHeaders.append("x-access-token", "openuv-165a9rlqaveqy0-io");
// myHeaders.append("Content-Type", "application/json");

// var requestOptions = {
//   method: 'GET',
//   headers: myHeaders,
//   redirect: 'follow'
// }
//   fetch("https://api.openuv.io/api/v1/uv?lat=-28.51&lng=-65.82&alt=100&dt=", requestOptions)
//     .then(response => response.json())
//     .then(data => {
//       // Acceder a los datos
//       let uv = data.result.uv;
//       document.getElementById('uv').innerText = uv;

//       if (uv <= 2) {
//         color = "#4fb400";
//         indiceuv.style.setProperty("--coloraso", color);
//       }
//       else if (uv <= 5) {
//         color = "#f8b600";
//         indiceuv.style.setProperty("--coloraso", color);
//       }
//       else if (uv <= 7) {
//         color = "#f85900";
//         indiceuv.style.setProperty("--coloraso", color);
//       }
//       else if (uv <= 10) {
//         color = "#d81f1d";
//         indiceuv.style.setProperty("--coloraso", color);
//       }
//       else if (uv >= 11) {
//         color = "#998cff";
//         indiceuv.style.setProperty("--coloraso", color);
//       }
//     })
//     .catch(error => {
//       console.error('Error al obtener los datos:', error);
//     });
// }
// cargaruv();

// function timeruv() {
//   cargaruv();
// }

// setInterval(timeruv, 1200000);
