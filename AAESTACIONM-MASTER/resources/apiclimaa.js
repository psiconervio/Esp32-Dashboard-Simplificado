var apiuvurl ='';
// URL de la API
var apiUrl = 'https://api.openweathermap.org/data/2.5/weather?lat=-28.46957&lon=-65.78524&appid=2c290850870ebbba2a0d95586f2aa709';

function cargarDatos(){
// Realizar la solicitud a la API
fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        // Llenar los elementos HTML con la información de la API
        let descripcionCielo = data.weather[0].description;
        document.getElementById('presion').textContent = data.main.pressure;
        temperaturaExacta = data.main.temp - 273.15;
        sensaciontermica = data.main.feels_like -273.15;
        document.getElementById('ESP32_01_Humd').innerText = data.main.humidity;
        document.getElementById("ESP32_01_Temp").innerText = temperaturaExacta.toFixed(1);
        document.getElementById('iddescripcioncielo').textContent = descripcionCielo;
        document.getElementById('sensaciontermica').textContent = sensaciontermica.toFixed(1);
        velocidaddeviento = data.wind.speed * 1.609 ;
        document.getElementById('ESP32_01_anemometro').textContent = velocidaddeviento.toFixed(0);
        let rafagadeviento = data.wind.gust * 1.609 ;
        document.getElementById('ESP32_01_veleta').textContent = data.wind.deg ;
        document.getElementById('rafagadeviento').textContent= rafagadeviento.toFixed(0);
        document.getElementById("nubosidad").innerText = data.clouds.all;
        visibilidad = data.visibility / 1000;
        document.getElementById("visibilidad").innerText = visibilidad.toFixed(1);
//arreglar la conversion de datos para el front
        console.log(data.weather[0].main);

        switch (descripcionCielo){
            case 'overcast clouds': // Corregido aquí
                console.log("nubes superpuestas");
                document.getElementById('miVideo').src = 'videos/nublado.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Nubes superpuestas";
                break;
            case 'clear sky':
                console.log("cielo limpio");//cheked
                document.getElementById('miVideo').src = 'videos/blue_sky.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Cielo Limpio";
                break;
            case 'broken clouds':   //checked
                document.getElementById('miVideo').src = 'videos/brokenclouds.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Nubes rotas";
                console.log("nubes rotas");

                break;
            case 'thunderstorm with rain': //cheked
                console.log("tormenta con lluvia");
                document.getElementById('miVideo').src = 'videos/storm.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Tormenta con lluvia";
                break;
            case 'light rain':
                console.log("lluvia ligera"); //cheked
                document.getElementById('miVideo').src = 'videos/lluvialigera1.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "lluvia ligera";
                break;
            case 'few clouds':
                console.log("pocas nubes"); //cheked
                document.getElementById('miVideo').src = 'videos/pocasnubess.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Pocas Nubes";
                break;
            case 'scattered clouds':
                document.getElementById('miVideo').src = 'videos/nubesdispersas.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Nubes Dispersas";
                break;
            case 'light intensity shower rain':
                console.log("lluvia de intensidad de luz");
                document.getElementById('miVideo').src = 'videos/rainn.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Nubes Dispersas";
                break;
        }
        

    })
    .catch(error => {
        console.error('Error al llamar a la API:', error);
    });
}
cargarDatos();

function timer(){
    cargarDatos();
}

setInterval(timer, 60000);
//script para caambiar animacion de clima

/*tipos de cielo 
broken clouds
overlast clouds
clear sky
scattered clouds 
light rain
thunderstorm with rain
few cloudsrain
nuevas
light intensity shower rain
moderate rain*/

/*Estados
Clouds
Rain
Clear 
Thunderstorm*/