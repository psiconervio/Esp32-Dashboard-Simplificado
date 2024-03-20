#include <Arduino.h>
#include <WiFi.h>
#include <FirebaseESP32.h>

#define WIFI_SSID "PB02"
#define WIFI_PASSWORD "12345678"

// For the following credentials, see examples/Authentications/SignInAsUser/EmailPassword/EmailPassword.ino

/* 2. Define the API Key */
#define API_KEY "AIzaSyDxdWTYY2U2e0uGjJmq-fyy8PrR2Zp5pMM"

/* 3. Define the RTDB URL */
#define DATABASE_URL "esp32enviodatos-default-rtdb.firebaseio.com" //<databaseName>.firebaseio.com or <databaseName>.<region>.firebasedatabase.app

/* 4. Define the user Email and password that alreadey registerd or added in your project */
#define USER_EMAIL "asd@asdasd.com"
#define USER_PASSWORD "asd.com"

void setup(){
    wifi.begin(WIFI_SSID, WIFI_PASSWORD);
    Serial.println("conectando");
    while(WiFi.status != WL_CONNECTED){
        Serial.println(".");
        delay(500);
}
Serial.println();
Serial.println("conectado;");
Serial.println(WiFi.localIP);


https://www.youtube.com/watch?v=fHnSlUKpS6A este tuto