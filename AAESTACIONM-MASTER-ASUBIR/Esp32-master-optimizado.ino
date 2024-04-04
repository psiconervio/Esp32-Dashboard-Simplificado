#include <WiFi.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>
#include "DHT.h"

// Definiciones para el sensor DHT11
#define DHTPIN 15    // Pin digital conectado al sensor DHT11
#define DHTTYPE DHT11    // Tipo de sensor DHT utilizado (DHT11 en este caso)
DHT dht11_sensor(DHTPIN, DHTTYPE);    // Inicialización del sensor DHT

// Credenciales de red WiFi
//const char* ssid = "P102";
//const char* password = "12345678";
const char* ssid ="TP-LINK_8E0D5E"
const char* password = "delc@mpo4268"

// Variables para datos de solicitud HTTP POST
String postData = "";
String payload = "";

// Variables para datos del sensor DHT11
float send_Temp;
int send_Humd;
String send_Status_Read_DHT11 = "";

// Variables para el anemómetro
int promedio;

// Variables para la dirección del viento
float a=0, b=0, c=0, d=0, a0=0, b0=0, c0=0, d0=0;
String puntoCardinal="";

// Función para leer y obtener datos del anemómetro
void lecturaAnemometro () { 
  int promedio = 0;
  for (int i = 0; i < 1000; i++) {
    int lectura = analogRead(2);
    promedio = promedio + lectura;
    delay(1);
  }
  promedio = promedio / 1000;
  Serial.println(promedio); 
}

// Subrutina para leer y obtener datos del sensor DHT11
void get_DHT11_sensor_data() {
  Serial.println();
  Serial.println("-get_DHT11_sensor_data()");
  
  send_Temp = dht11_sensor.readTemperature();    // Leer temperatura
  send_Humd = dht11_sensor.readHumidity();    // Leer humedad
  
  if (isnan(send_Temp) || isnan(send_Humd)) {    // Verificar si la lectura del sensor falló
    Serial.println("Failed to read from DHT sensor!");
    send_Temp = 0.00;
    send_Humd = 0;
    send_Status_Read_DHT11 = "FAILED";
  } else {
    send_Status_Read_DHT11 = "SUCCEED";
  }
  
  Serial.printf("Temperature : %.2f °C\n", send_Temp);    // Imprimir temperatura
  Serial.printf("Humidity : %d %%\n", send_Humd);    // Imprimir humedad
  Serial.printf("Status Read DHT11 Sensor : %s\n", send_Status_Read_DHT11);
  Serial.println("-------------");
}

void setup() {
  Serial.begin(115200);    // Inicializar comunicación serial
  
  delay(2000);
  
  // Conexión a red WiFi
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  
  Serial.println();
  Serial.println("-------------");
  Serial.print("Connecting");

  // Esperar a que se conecte a la red WiFi
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  
  Serial.println();
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.println("-------------"); 

  // Inicializar sensor DHT11
  dht11_sensor.begin();

  delay(2000);
}

void loop() {
  // Leer datos del anemómetro
  lecturaAnemometro();
  
  // Realizar solicitud HTTP POST para obtener datos del servidor a
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    int httpCode;
    
    postData = "id=esp32_01";
    payload = "";
    Serial.println();
    Serial.println("---------------getdata.php");
   // http.begin("http://192.168.101.86/APPS/nuevos/V4.3office/Esp32-Dashboard-Simplificado/AAESTACIONM-MASTER-ASUBIR/conexion/getdata.php");
    http.begin("http://192.168.0.102/APPS/NUEVO/v4.5home/Esp32-Dashboard-Simplificado/AAESTACIONM-MASTER-ASUBIR/conexion/getdata.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    httpCode = http.POST(postData);
    payload = http.getString();
  
    Serial.print("httpCode : ");
    Serial.println(httpCode);
    Serial.print("payload  : ");
    Serial.println(payload);
    
    http.end();
    Serial.println("---------------");


    // Leer datos del sensor DHT11
    get_DHT11_sensor_data();
    
    // preparar datos para enviar al servidor tableupdate
    postData = "id=esp32_01";
    postData += "&temperature=" + String(send_Temp);
    postData += "&humidity=" + String(send_Humd);
    postData += "&status_read_sensor_dht11=" + send_Status_Read_DHT11;
    postData += "&veleta=" + String(promedio);  
    postData += "&anemometro=" + String(promedio);  
    postData += "&pluviometro=" + String(promedio);  

    payload = "";
  
    Serial.println();
    Serial.println("tableUpdate.php");
   // http.begin("http://192.168.101.86/APPS/nuevos/V4.3office/Esp32-Dashboard-Simplificado/AAESTACIONM-MASTER-ASUBIR/conexion/tableUpdate.php");
    http.begin("http://192.168.0.102/APPS/NUEVO/v4.5home/Esp32-Dashboard-Simplificado/AAESTACIONM-MASTER-ASUBIR/conexion/tableUpdate.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    httpCode = http.POST(postData);
    payload = http.getString();
  
    Serial.print("httpCode : ");
    Serial.println(httpCode);
    Serial.print("payload  : ");
    Serial.println(payload);
    
    http.end();
    Serial.println("---------------");
    
    delay(5000);
  }
}