// URL de la API
var apiUrl = 'https://api.openweathermap.org/data/2.5/weather?lat=-28.46957&lon=-65.78524&appid=2c290850870ebbba2a0d95586f2aa709';

// Realizar la solicitud a la API
fetch(apiUrl)
    .then(response => response.json())
    .then(data => {
        // Llenar los elementos HTML con la información de la API
   
        document.getElementById('presion').textContent = data.main.pressure;

    })
    .catch(error => {
        console.error('Error al llamar a la API:', error);
    });
