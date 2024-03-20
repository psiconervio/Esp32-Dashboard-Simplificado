
function cargarfirebase() {
  // Especifica la ruta específica de los datos que deseas recuperar de la base de datos
  let firebaseURL = "https://esp32enviodatos-default-rtdb.firebaseio.com/test.json";

  fetch(firebaseURL)
  .then(response => {
      // Verifica si la respuesta es exitosa
      if (!response.ok) {
          throw new Error('No se pudo obtener los datos');
      }
      return response.json();
  })
  .then(data => {
      // Acceder a los datos
      let firebase = data;
      const fire =data.test;
      console.log(fire);
      document.
      console.log(firebase);
  })
  .catch(error => {
      console.error('Error al obtener los datos:', error);
  });
}

cargarfirebase();
