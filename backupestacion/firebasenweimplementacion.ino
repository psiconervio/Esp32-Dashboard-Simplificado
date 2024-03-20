#include <ArduinoJson.hpp>
#include <Arduino_JSON.h>

#include <IOXhop_FirebaseESP32.h>
#include <IOXhop_FirebaseStream.h>

#include <WiFi.h>
#include <DHT.h>

#define DHTPIN 15
#define DHTTYPE DHT11
#define WIFI_SSID "PB02"
#define WIFI_PASSWORD "12345678"

DHT dht(DHTPIN, DHTTYPE); // Declarar el objeto DHT con el pin y tipo correspondientes

/* 3. Define the RTDB URL */
#define FIREBASE_AUTH "https://esp32enviodatos-default-rtdb.firebaseio.com/" //<databaseName>.firebaseio.com or <databaseName>.<region>.firebasedatabase.app
#define FIREBASE_HOST "AIzaSyDxdWTYY2U2e0uGjJmq-fyy8PrR2Zp5pMM" // Cambiar FIREBASE_HOST a la URL correcta sin la clave API

void setup() {
    Serial.begin(115200);
    Serial.println("DHT TEST");
    dht.begin();

    //conexion a wifi
    WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
    Serial.println("conectando");
    while (WiFi.status() != WL_CONNECTED) { // Corregir WiFi.status() para llamar a la función
        Serial.print(".");
        delay(500);
    }
    Serial.println();
    Serial.println("conectado;");
    Serial.println(WiFi.localIP());
    Firebase.begin(FIREBASE_AUTH, FIREBASE_HOST);
}

void loop() {
    //dht humedad y temperatura
    float h = dht.readHumidity();
    float t = dht.readTemperature();
    if (isnan(h) || isnan(t)) {
        Serial.println("falla en leer el dht");
        return;
    }
    Serial.println("humedad:");
    Serial.print(h);
    Serial.println("%"); // Corregir el formato para imprimir el símbolo de porcentaje

    Serial.println("temperatura:");
    Serial.print(t);
    Serial.println("*C"); // Corregir el formato para imprimir el símbolo de grado Celsius

    // Setear valor
    Firebase.setFloat("humedad", h);
    // Handle error
    if (Firebase.failed()) {
        Serial.print("Setting number failed:");
        Serial.println(Firebase.error()); // Corregir la llamada a la función para obtener el error de Firebase
        return;
    }
    if (Firebase.setFloat("temperatura", t)
        if (Firebase.failed()) {
            Serial.print("Setting number failed:");
            Serial.println(Firebase.error()); // Corregir la llamada a la función para obtener el error de Firebase
            return;
        }
    
    Serial.println("Temperatura y humedad data guardada");
    delay(1000);
}