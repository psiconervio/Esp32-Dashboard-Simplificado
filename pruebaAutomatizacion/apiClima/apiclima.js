const asd = 'https://breezometerzakutynskyv1.p.rapidapi.com/getAirQuality';
const dsa = {
	method: 'POST',
	headers: {
		'content-type': 'application/x-www-form-urlencoded',
		'X-RapidAPI-Key': 'c1a8e7d8dcmsh4718376f0f1906fp1075c4jsn7361b18a5cba',
		'X-RapidAPI-Host': 'BreezometerzakutynskyV1.p.rapidapi.com'
	},
	body: new URLSearchParams({
		fields: '-28.4696 -65.7852'
	})
};

try {
	const response = await fetch(asd, dsa);
	const result = await response.text();
	console.log(result);
} catch (error) {
	console.error(error);
}
let clima = {
    apikey:"2c290850870ebbba2a0d95586f2aa709",
    fetchClima:function(clima){
        fetch(
            "https://api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&appid={API key}"
        )
    }
} 

//https://home.openweathermap.org/api_keys