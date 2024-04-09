#include <WiFi.h>
#include <Arduino.h>
#include <HTTPClient.h>
#include <Arduino_JSON.h>
#include "DHT.h"

// Credenciales de red WiFi 
const char* ssid = "PB02";
const char* password = "12345678";
//const char* ssid ="TP-LINK_8E0D5E"
//const char* password = "delc@mpo4268"

// Definiciones para el sensor DHT11
#define DHTPIN 23    // Pin digital conectado al sensor DHT11
#define DHTTYPE DHT11    // Tipo de sensor DHT utilizado (DHT11 en este caso)
DHT dht11_sensor(DHTPIN, DHTTYPE);    // Inicialización del sensor DHT

// Variables para datos de solicitud HTTP POST
String postData = "";
String payload = "";

String puntoCardinal = ""; //Variable de Dirección del Viento

// Variables para datos del sensor DHT11

float acumuladorAnemometro = 0, velocidadViento = 0; //acumulador de lecturas y promedio del anemómetro.
int contadorAnemometro=0;

int lecturaPluv = 0, contadorCiclosPluv = 0, contadorEstadoPluviometroA = 0, contadorEstadoPluviometroB = 0; //variables auxiliares del Pluviometro.
float acumuladorMmCaidos = 0; //acumulador de mm caidos detectados por el pluviometro.

// Lectura del pluviómetro
float pluviometro() {
  lecturaPluv = analogRead(36);
  float factorMM = 3.4;
  if (lecturaPluv < 2060) {
    contadorEstadoPluviometroB = 0;
    if (contadorEstadoPluviometroA == 0) {
      contadorCiclosPluv++;
      acumuladorMmCaidos = (contadorCiclosPluv - 1) * factorMM;
    }
    contadorEstadoPluviometroA++;
  } else {
    contadorEstadoPluviometroA = 0;
    if (contadorEstadoPluviometroB == 0) {
      contadorCiclosPluv++;
      acumuladorMmCaidos = (contadorCiclosPluv - 1) * factorMM;
    }
    contadorEstadoPluviometroB++;
  }
  return acumuladorMmCaidos;
}

// Función para leer y obtener datos del anemómetro
float anemometro() {
  float lecturaViento = analogRead(39);
  float divisor = 1;
  int muestras = 20;

  for (int i=0; i < muestras; i++) {
    acumuladorAnemometro = acumuladorAnemometro + lecturaViento;
    delay(1);
  }

  velocidadViento = (acumuladorAnemometro / muestras) / divisor;
  if (velocidadViento < 1) {
    velocidadViento=0.0;
  }
  acumuladorAnemometro = 0;
  return velocidadViento;
}

// Lectura de la veleta
String veleta() {
  float a = 0, b = 0, c = 0, d = 0, a0 = 1937, b0 = 1953, c0 = 1919, d0 = 1955;

  a = analogRead(32);
  b = analogRead(35);
  c = analogRead(34);
  d = analogRead(33);

  if (a < 1000 || b < 1000 || c < 1000 || d < 1000) {
    puntoCardinal = "Error";
  } else if (((a - a0) / a0) > 0.07) {
    puntoCardinal = "NORTE";
  } else if ((b - b0) / b0 > 0.07) {
    puntoCardinal = "ESTE";
  } else if ((c - c0) / c0 > 0.07) {
    puntoCardinal = "SUR";
  } else if ((d - d0) / d0 > 0.07) {
    puntoCardinal = "OESTE";
  } else if ((a - a0) / a0 < -0.025 && (b - b0) / b0 < -0.025) {
    puntoCardinal = "NORESTE";
  } else if ((c - c0) / c0 < -0.025 && (b - b0) / b0 < -0.025) {
    puntoCardinal = "SURESTE";
  } else if ((c - c0) / c0 < -0.025 && (d - d0) / d0 < -0.025) {
    puntoCardinal = "SUROESTE";
  } else if ((a - a0) / a0 < -0.025 && (d - d0) / d0 < -0.025) {
    puntoCardinal = "NOROESTE";
  } else if (a < 1000 || b < 1000 || c < 1000 || d < 1000) {
    puntoCardinal = "Error";
  }
  return puntoCardinal;
}


void setup() {
  Serial.begin(115200);    // Inicializar comunicación serial
  dht11_sensor.begin();
  delay(2000);
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.println();
  Serial.println("-------------");
  Serial.print("Connecting");
  int connecting_process_timed_out = 20; //--> 20 = 20 seconds.
  connecting_process_timed_out = connecting_process_timed_out * 2;
  // Esperar a que se conecte a la red WiFi
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
        if(connecting_process_timed_out > 0) connecting_process_timed_out--;
    if(connecting_process_timed_out == 0) {
      delay(1000);
      ESP.restart();
    }
  }
  
  Serial.println();
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.println("-------------"); 

  // Inicializar sensor DHT11

  delay(2000);
}

void loop() {

  for (int i=0; i<200; i++){
    pluviometro();
    anemometro();
    delay(10);
  }
  // Realizar solicitud HTTP POST para obtener datos del servidor a
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    int httpCode;
    


  float humedad = dht11_sensor.readHumidity();
  float temperatura = dht11_sensor.readTemperature();
  
  Serial.print("Temperatura: ");
  Serial.print(temperatura);
  Serial.println("°C");

  Serial.print("Humedad: ");
  Serial.print(humedad);
  Serial.println("%");

  Serial.print("Velocidad del viento: ");
  Serial.println(anemometro());

  Serial.print("Dirección del viento: ");
  Serial.println(veleta());
  Serial.println(veleta());

  Serial.print("mm de lluvia caída: ");
  Serial.println(pluviometro());

    postData = "id=esp32_01";
    payload = "";

    // preparar datos para enviar al servidor tableupdate
    postData = "id=esp32_01";
    postData += "&temperature=" + String(temperatura);
    postData += "&humidity=" + String(humedad);
    postData += "&veleta=" + String("veleta());  
    postData += "&anemometro=" + String("anemometro()");  
    postData += "&pluviometro=" + String("pluviometro()");  

    payload = "";
  
    Serial.println();
    Serial.println("tableUpdate.php");
   // http.begin("http://192.168.101.86/APPS/nuevos/V4.3office/Esp32-Dashboard-Simplificado/AAESTACIONM-MASTER-ASUBIR/conexion/tableUpdate.php");
    http.begin("http://192.168.101.109/APPS/nuevos/v4.5office/Esp32-Dashboard-Simplificado/AAESTACIONM-MASTER-ASUBIR/conexion/tableUpdate.php");
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