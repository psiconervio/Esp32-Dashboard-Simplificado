#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>
#include "DHT.h"
//======================================== DHT sensor settings (DHT11).
#define DHTPIN 15 //--> Defines the Digital Pin connected to the DHT11 sensor.
#define DHTTYPE DHT11 //--> Defines the type of DHT sensor used. Here used is the DHT11 sensor.
DHT dht11_sensor(DHTPIN, DHTTYPE); //--> Initialize DHT sensor.

const char* ssid = "PB02";
const char* password = "12345678";
//========== Variables for HTTP POST request data POSDATA ALMACENA LAS VARIABLES PARA EL ENVIO DE DATOS
String postData = ""; //--> Variables sent for HTTP POST request data/Variables enviadas para datos de solicitud HTTP POST
String payload = "";  //--> Variable for receiving response from HTTP POST./Variable para recibir respuesta de HTTP POST
//======== Variables for DHT11 sensor data.
float send_Temp;
int send_Humd;
String send_Status_Read_DHT11 = "";
int promedio ;
//variables veleta
float a= 0, b=0, c=0, d=0, a0=0, b0=0, c0=0, d0=0;
String puntoCardinal="";
//termina

void lecturaAnemometro (){ 
  int promedio=0;
  for (int i=0; i<1000; i++)
  {
    int lectura = analogRead(2);
    promedio=promedio+lectura;
    delay(1);
  }
  promedio=promedio/1000;
  Serial.println(promedio); 
}
// Subrutina para leer y obtener datos del sensor DHT11// Subroutine to read and get data from the DHT11 sensor.
void get_DHT11_sensor_data() {
  Serial.println();
  Serial.println("-------------get_DHT11_sensor_data()");
  
  // ¡Leer la temperatura o la humedad tarda unos 250 milisegundos!/Reading temperature or humidity takes about 250 milliseconds!
  // Las lecturas del sensor también pueden tener hasta 2 segundos de antigüedad (es un sensor muy lento)/Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
  
  // Read temperature as Celsius (the default)
  send_Temp = dht11_sensor.readTemperature();
  // Read Humidity
  send_Humd = dht11_sensor.readHumidity();
    
  // Read temperature as Fahrenheit (isFahrenheit = true)
  // float ft = dht11_sensor.readTemperature(true);

  // Check if any reads failed.
  if (isnan(send_Temp) || isnan(send_Humd)) {
    Serial.println("Failed to read from DHT sensor!");
    send_Temp = 0.00;
    send_Humd = 0;
    send_Status_Read_DHT11 = "FAILED";
  } else {
    send_Status_Read_DHT11 = "SUCCEED";
  }
  //IMPRIME LOS DATOS RECOLECTADOS EN LA TERMINAL
  Serial.printf("Temperature : %.2f °C\n", send_Temp);
  Serial.printf("Humidity : %d %%\n", send_Humd);
  Serial.printf("Status Read DHT11 Sensor : %s\n", send_Status_Read_DHT11);
  Serial.println("-------------");
}
//________________________________________________________________________________ VOID SETUP()
void setup() {
// codigo veleta
  Serial.begin(9600);
  delay(500);
  a0 = analogRead(0);
  b0 = analogRead(1);
  c0 = analogRead(2);
  d0 = analogRead(3);
  delay(1500);

// put your setup code here, to run once:
  
  Serial.begin(115200); //--> Initialize serial communications with the PC.

  delay(2000);

  // Make WiFi on ESP32 in "STA/Station" mode and start connecting to WiFi Router/Hotspot.
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  
  Serial.println();
  Serial.println("-------------");
  Serial.print("Connecting");

  //The process of connecting the WiFi on the ESP32 to the WiFi Router/Hotspot.
  // The process timeout of connecting ESP32 with WiFi Hotspot / WiFi Router is 20 seconds.
  // If within 20 seconds the ESP32 has not been successfully connected to WiFi, the ESP32 will restart.
  // I made this condition because on my ESP32, there are times when it seems like it can't connect to WiFi, so it needs to be restarted to be able to connect to WiFi.

  int connecting_process_timed_out = 20; //--> 20 = 20 seconds.
  connecting_process_timed_out = connecting_process_timed_out * 2;
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");

    // Countdown "connecting_process_timed_out".
    if(connecting_process_timed_out > 0) connecting_process_timed_out--;
    if(connecting_process_timed_out == 0) {
      delay(1000);
      ESP.restart();
    }
  }
  
  
  //---------------------------------------- If successfully connected to the wifi router, the IP Address that will be visited is displayed in the serial monitor
  Serial.println();
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  //Serial.print("IP address: ");
  //Serial.println(WiFi.localIP());
  Serial.println("-------------"); 

  // Setting up the DHT sensor (DHT11).
  dht11_sensor.begin();

  delay(2000);
}
//________________________________________________________________________________ 

//________________________________________________________________________________ VOID LOOP()
void loop() {
  //CODIGO VELETA
   {
  a = analogRead(0);
  b = analogRead(1);
  c = analogRead(2);
  d = analogRead(3);
  
  if (((a-a0)/a0) > 0.07) {
    puntoCardinal="NORTE";
    Serial.println(puntoCardinal);
    Serial.println("=============");
  }
  else if ((b-b0)/b0 > 0.07) {
    puntoCardinal="ESTE";
    Serial.println(puntoCardinal);
    Serial.println("=============");
  }
  else if ((c-c0)/c0 > 0.07) {
    puntoCardinal="SUR";
    Serial.println(puntoCardinal);
    Serial.println("=============");
  }
  else if ((d-d0)/d0 > 0.07) {
    puntoCardinal="OESTE";
    Serial.println(puntoCardinal);
    Serial.println("=============");
  }
  else if ((a-a0)/a0 < -0.025 && (b-b0)/b0 <-0.025) {
    puntoCardinal="NORESTE";
    Serial.println(puntoCardinal);
    Serial.println("=============");
  }
  else if ((c-c0)/c0 < -0.025 && (b-b0)/b0 <-0.025) {
    puntoCardinal="SURESTE";
    Serial.println(puntoCardinal);
    Serial.println("=============");
  }
  else if ((c-c0)/c0 < -0.025 && (d-d0)/d0 <-0.025) {
    puntoCardinal="SUROESTE";
    Serial.println(puntoCardinal);;
    Serial.println("=============");
  }
  else if ((a-a0)/a0 < -0.025 && (d-d0)/d0 <-0.025) {
    puntoCardinal="NOROESTE";
    Serial.println(puntoCardinal);
    Serial.println("=============");
  }
  else {
    Serial.println(puntoCardinal);
    Serial.println("XXXXXXXXXXXXXXXXXXXXXXXXXXX");
  }
  delay(500);
}
  //TERMINA
  // put your main code here, to run repeatedly

  //---------------------------------------- Check WiFi connection status.
  if(WiFi.status()== WL_CONNECTED) {
    HTTPClient http;  //--> Declare object of class HTTPClient.
    int httpCode;     //--> Variables for HTTP return code.
    lecturaAnemometro();

    //conectado con getdata.php/no cambiar nombre // Process to get LEDs data from database to control LEDs.
    postData = "id=esp32_03";
    
    payload = "";
  
    digitalWrite(ON_Board_LED, HIGH);
    Serial.println();
    Serial.println("---------------getdata.php");
    // In this project I use local server or localhost with XAMPP application.
    // So make sure all PHP files are "placed" or "saved" or "run" in the "htdocs" folder.
    // I suggest that you create a new folder for this project in the "htdocs" folder.
    // The "htdocs" folder is in the "xampp" installation folder.
    // The order of the folders I recommend:
    // xampp\htdocs\your_project_folder_name\phpfile.php
    //
    // ESP32 accesses the data bases at this line of code: 
    // http.begin("http://REPLACE_WITH_YOUR_COMPUTER_IP_ADDRESS/REPLACE_WITH_PROJECT_FOLDER_NAME_IN_htdocs_FOLDER/getdata.php");
    // REPLACE_WITH_YOUR_COMPUTER_IP_ADDRESS = there are many ways to see the IP address, you can google it. 
    //                                         But make sure that the IP address used is "IPv4 address".
    // Example : http.begin("http://192.168.101.95/ESP32_MySQL_Database/Test/getdata.php");
    http.begin("https://esp32dashboard.000webhostapp.com/getdataTRES.php");  //--> Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");        //--> Specify content-type header
   //ENVIA postData por el metodo Post
    httpCode = http.POST(postData); //--> Send the request
    payload = http.getString();     //--> Get the response payload
  
    Serial.print("httpCode : ");
    Serial.println(httpCode); //--> Print HTTP return code
    Serial.print("payload  : ");
    Serial.println(payload);  //--> Print request response payload
    
    http.end();  //--> Close connection
    Serial.println("---------------");


    // Calls the get_DHT11_sensor_data() subroutine.
    get_DHT11_sensor_data();
   // se cambio el id a id1 y el esp32_01 a esp32_02
    //se procesan los datos para el envio en base de datos /The process of sending the DHT11 sensor data to the database.
    postData = "id=esp32_03";
    postData += "&temperature=" + String(send_Temp);
    postData += "&humidity=" + String(send_Humd);
    postData += "&status_read_sensor_dht11=" + send_Status_Read_DHT11;
    postData += "&anemometro=" + String(promedio);  
    
    payload = "";
  
    Serial.println();
    Serial.println("-updateDHT11data.php");
    // Example : http.begin("192.168.101.95/ESP32_MySQL_Database/Test/updateDHT11data_and_recordtableTRES.php");
    //ACA SE ESPECIFICA EL ENVIO DE DATOS A UPDATEDHT11DATA
    http.begin("https://192.168.101.95/APPS/ESP32dashboard/Subido-esp32-dashboard/App-web-public/updateDHT11data_and_recordtableTRES.php");
   // http.begin("https://esp32dashboard.000webhostapp.com/updateDHT11data_and_recordtableTRES.php");  //--> Specify request destination
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  //--> Specify content-type header
    // SE ENVIAN LOS DATOS ACTUALIZADOS Al updateDHT11DATA
    httpCode = http.POST(postData); //--> Send the request
    payload = http.getString();  //--> Get the response payload
  
    Serial.print("httpCode : ");
    Serial.println(httpCode); //--> Print HTTP return code
    Serial.print("payload  : ");
    Serial.println(payload);  //--> Print request response payload
    
    http.end();  //Close connection
    Serial.println("---------------");
    //........................................ 
    
    delay(5000);
  }
}