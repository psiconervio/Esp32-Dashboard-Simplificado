let clima = {
    apikey:"2c290850870ebbba2a0d95586f2aa709",
    fetchClima:function(clima){
        fetch(
            "https://api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&appid={API key}"
        )
    }
} 

//https://home.openweathermap.org/api_keys