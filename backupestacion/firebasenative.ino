#include <WiFi.h>
#include <FirebaseESP32.h>
#include <DHT.h>
#include <IOXhop_FirebaseESP32.h>

#define DHTPIN 15
#define DHTTYPE DHT11
#define WIFI_SSID "PB02"
#define WIFI_PASSWORD "12345678"

#define FIREBASE_AUTH "esp32enviodatos-default-rtdb.firebaseio.com" //<databaseName>.firebaseio.com or <databaseName>.<region>.firebasedatabase.app
#define FIREBASE_HOST "AIzaSyDxdWTYY2U2e0uGjJmq-fyy8PrR2Zp5pMM"
/* 4. Define the user Email and password that alreadey registerd or added in your project */
#define USER_EMAIL "asd@asdasd.com"
#define USER_PASSWORD "asd.com"

void setup(){
    Serial.begin(115200);
    Serial.println("DHT TEST");
    dht.begin();

    //conexion a wifi
    wifi.begin(WIFI_SSID, WIFI_PASSWORD);
    Serial.println("conectando");
    while(WiFi.status != WL_CONNECTED){
        Serial.println(".");
        delay(500);
}
Serial.println();
Serial.println("conectado;");
Serial.println(WiFi.localIP);
Firebase.begin(FIREBASE_AUTH, FIREBASE_HOST);
}

int n = 0;
void loop(){
    //dht humedad y temperatura
    float h = dht.readHumidity();
    float t = dht.readTemperature();
    if(isnan(h)|| isnan(t)) {
        serial.println("falla en leer el dht");
        return;
    }
    Serial.println("humedad:");
    Serial.print(h);
    Serial.print("$/t");

    Serial.println("temperatura:");
    Serial.print(t);
    Serial.print("*C");
}
 //setear valor
 Firebase.setFloat("humedad", h);
 //handle error
 if(Firebase.failed()) {
    Serial.print("settings/number failed:");
    Serial.printInt(firebaseError());
    return;
 }
 if (Firebase.setFloat("temperatura;",t))
 {
    if(Firebase.failed()) {
        Serial.print("setting/number failed;");
        Serial.printInt(firebaseError());
        return;
    }
 }
 Serial.printInt("temperatura y humedad data");
 delay(1000);
 
https://www.youtube.com/watch?v=fHnSlUKpS6A este tuto