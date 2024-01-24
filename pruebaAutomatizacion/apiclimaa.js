var apiuvurl ='';
// URL de la API
var apiUrl = 'https://api.openweathermap.org/data/2.5/weather?lat=-28.46957&lon=-65.78524&appid=2c290850870ebbba2a0d95586f2aa709';

function cargarDatos(){
console.log("holaaaa")
// Realizar la solicitud a la API
fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        // Llenar los elementos HTML con la información de la API
        console.log(data.main.pressure)
        let descripcionCielo = data.weather[0].description;
        document.getElementById('presion').textContent = data.main.pressure;
        temperaturaExacta = data.main.temp - 273.15;
        sensaciontermica = data.main.feels_like -273.15;
        document.getElementById('ESP32_01_Humd').innerText = data.main.humidity;
        document.getElementById("ESP32_01_Temp").innerText = temperaturaExacta.toFixed(1);
        document.getElementById('iddescripcioncielo').textContent = descripcionCielo;
        document.getElementById('sensaciontermica').textContent = sensaciontermica.toFixed(1);
        document.getElementById('ESP32_01_anemometro').textContent = data.wind.speed;
        document.getElementById('ESP32_01_veleta').textContent = data.wind.deg;
        let rafagadeviento = data.wind.gust * 3.6;
        document.getElementById('rafagadeviento').textContent= data.wind.gust;
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
                console.log("cielo limpio");
                document.getElementById('miVideo').src = 'videos/blue_sky.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Cielo Limpio";
                break;
            case 'broken clouds':
                document.getElementById('miVideo').src = 'videos/nubesrotas.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Nubes rotas";
                console.log("nubes rotas");

                break;
            case 'thunderstorm with rain':
                console.log("tormenta con lluvia");
                document.getElementById('miVideo').src = 'videos/storm.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Tormenta con lluvia";
                break;
            case 'light rain':
                console.log("lluvia ligera");
                break;
            case 'few clouds':
                console.log("pocas nubes");
                document.getElementById('miVideo').src = 'videos/pocasnubess.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Pocas Nubes";
                break;
            case 'scattered clouds':
                console.log("nubes dispersas");
                document.getElementById('miVideo').src = 'videos/nubesdispersas1.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('iddescripcioncielo').textContent = "Nubes Dispersas";
                break;
            case 'light intensity shower rain':
                console.log("lluvia de intensidad de luz");
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