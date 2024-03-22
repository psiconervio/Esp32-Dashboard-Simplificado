#include <Arduino.h>
#include <WiFi.h>
#include <Firebase_ESP_Client.h>
#include "DHT.h"
#include <time.h>

//Provide the token generation process info.
#include "addons/TokenHelper.h"
//Provide the RTDB payload printing info and other helper functions.
#include "addons/RTDBHelper.h"

#define DHTPIN 15 //--> Defines the Digital Pin connected to the DHT11 sensor.
#define DHTTYPE DHT11 //--> Defines the type of DHT sensor used. Here used is the DHT11 sensor.
DHT dht11_sensor(DHTPIN, DHTTYPE);

// Insert your network credentials
#define WIFI_SSID "PB02"
#define WIFI_PASSWORD "12345678"

// Insert Firebase project API Key
#define API_KEY "AIzaSyBb-yNKIY1jLQkjWC7-4Ew6EaCaTfErWag"

// Insert RTDB URLefine the RTDB URL */
#define DATABASE_URL "https://esp32estacionultima-default-rtdb.firebaseio.com/" 

//variables estacion
float send_Temp;
int send_Humd;
char horaargentina[9]; // Declare the variable to store the time

//Define Firebase Data object
FirebaseData fbdo;

FirebaseAuth auth;
FirebaseConfig config;

unsigned long sendDataPrevMillis = 0;
int count = 0;
bool signupOK = false;

void setup(){
  
  Serial.begin(115200);
  WiFi.begin(WIFI_SSID, WIFI_PASSWORD);
  Serial.print("Connecting to Wi-Fi");
  while (WiFi.status() != WL_CONNECTED){
    Serial.print(".");
    delay(300);
  }
  Serial.println();
  Serial.print("Connected with IP: ");
  Serial.println(WiFi.localIP());
  Serial.println();

  /* Assign the api key (required) */
  config.api_key = API_KEY;

  /* Assign the RTDB URL (required) */
  config.database_url = DATABASE_URL;

  /* Sign up */
  if (Firebase.signUp(&config, &auth, "", "")){
    Serial.println("ok");
    signupOK = true;
  }
  else{
    Serial.printf("%s\n", config.signer.signupError.message.c_str());
  }

  /* Assign the callback function for the long running token generation task */
  config.token_status_callback = tokenStatusCallback; //see addons/TokenHelper.h
  
  Firebase.begin(&config, &auth);
  Firebase.reconnectWiFi(true);

  // Set timezone to Argentina Time
  configTime(-3 * 3600, 0, "pool.ntp.org", "time.nist.gov");
}

void loop(){
    // Read temperature as Celsius (the default)
  send_Temp = dht11_sensor.readTemperature();
  // Read Humidity
  send_Humd = dht11_sensor.readHumidity();

  // Get the current time
  time_t now = time(nullptr);
  // Convert to local time format
  struct tm* localTime = localtime(&now);
  // Store the hour in horaargentina
  sprintf(horaargentina, "%02d:%02d:%02d", localTime->tm_hour, localTime->tm_min, localTime->tm_sec);

  if (Firebase.ready() && signupOK && (millis() - sendDataPrevMillis > 15000 || sendDataPrevMillis == 0)){
    sendDataPrevMillis = millis();
    // Write an Int number on the database path test/int
    if (Firebase.RTDB.setFloat(&fbdo, "test/temperatura", send_Temp)){
      Serial.println("PASSED");
      Serial.println("PATH: " + fbdo.dataPath());
      Serial.println("TYPE: " + fbdo.dataType());
      Serial.println(send_Temp);

    }
    else {
      Serial.println("FAILED");
      Serial.println("REASON: " + fbdo.errorReason());
    }
    count++;
    
    // Write an Float number on the database path test/float
    if (Firebase.RTDB.setInt(&fbdo, "test/humedad", send_Humd)){
      Serial.println("PASSED");
      Serial.println("PATH: " + fbdo.dataPath());
      Serial.println("TYPE: " + fbdo.dataType());
      Serial.println(send_Humd);
    }
    else {
      Serial.println("FAILED");
      Serial.println("REASON: " + fbdo.errorReason());
    }
    //nuevas implementaciones
        if (Firebase.RTDB.setString(&fbdo, "test/hora", horaargentina)){
      Serial.println("PASSED");
      Serial.println("PATH: " + fbdo.dataPath());
      Serial.println("TYPE: " + fbdo.dataType());
      Serial.println(horaargentina);

    }
    else {
      Serial.println("FAILED");
      Serial.println("REASON: " + fbdo.errorReason());
    }
  }
}

