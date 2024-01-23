// URL de la API
var apiUrl = 'https://api.openweathermap.org/data/2.5/weather?lat=-28.46957&lon=-65.78524&appid=2c290850870ebbba2a0d95586f2aa709';

console.log("holaaaa")
// Realizar la solicitud a la API
fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        // Llenar los elementos HTML con la información de la API
        console.log(data.main.pressure)
        let descripcionCielo = data.weather[0].description;
        document.getElementById('presion').textContent = data.main.pressure;
        document.getElementById('descripcionCielo').textContent = descripcionCielo;
        console.log(data.weather[0].main);

        switch (descripcionCielo){
            case 'overcast clouds': // Corregido aquí
                console.log("nubes superpuestas");
                break;
            case 'clear sky':
                console.log("cielo limpio");
                document.getElementById('miVideo').src = 'videos/blue_sky.mp4';
                document.getElementById('miVideo').autoplay = true;
                document.getElementById('miVideo').muted = true;
                document.getElementById('miVideo').loop = true;
                document.getElementById('descripcionCielo').textContent = "Cielo Limpio";
                break;
            case 'broken clouds':
                console.log("nubes rotas");
                break;
            case 'thunderstorm with rain':
                console.log("tormenta con lluvia");
                break;
            case 'light rain':
                console.log("lluvia ligera");
                break;
            case 'few clouds':
                console.log("pocas nubes");
                break;
            case 'scattered clouds':
                console.log("nubes dispersas");
                break;
            case 'light intensity shower rain':
                console.log("lluvia de intensidad de luz");
                break;
        }
        

    })
    .catch(error => {
        console.error('Error al llamar a la API:', error);
    });
//script para cambiar animacion de clima

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