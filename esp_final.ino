#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>


const char* ssid = "Kuging";           // Change to your WiFi network's SSID
const char* password = "indikogani";   // Change to your WiFi network's password
//const char* host = "localhost:3307";     // Change to your server's IP or domain
const char* host = "192.168.236.230";   // Change to your server's IP or domain
const char* phpScript = "/capp vp";
const char* sms = "/capp/sms.php"; 
const char* endpoint = "/capp/check_value.php";// Path to your PHP script

String sensorData1;
String sensorData2;

unsigned long lastRequestTime = 0;
unsigned long requestInterval = 60000; // Interval of 30 seconds between requests



void setup() {
  Serial.begin(115200);
  delay(10);

  // Connect to your WiFi network
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

void loop() {
  // Serial.println("WL_CONNECTED");
 // Serial.println(WL_CONNECTED);
  if (WiFi.status() == WL_CONNECTED) {
   
    HTTPClient http;
  unsigned long currentTime = millis();
  int level = sensorData1.toInt();
  int val_notif = 80;
    while (Serial.available() > 0) {
      String dataReceived = Serial.readStringUntil('\n');

      int commaIndex = dataReceived.indexOf(',');
      if (commaIndex != -1) {
      sensorData1 = dataReceived.substring(0, commaIndex);
      sensorData2 = dataReceived.substring(commaIndex + 1);
      
      Serial.println("Sensor 1 Data: " + sensorData1);
      Serial.println("Sensor 2 Data: " + sensorData2);


    if (level >= 0) { // Your threshold condition
          WiFiClient client;
          HTTPClient http;
          
          String url = "http://" + String(host) + endpoint + "?value=" + level;

          if (http.begin(client, url)) {
            int httpCode = http.GET();

            if (httpCode > 0) {
              String payload = http.getString();
              Serial.println("Server Response: " + payload);
            } else {
              Serial.println("Error on HTTP request: " + http.errorToString(httpCode));
            }

            http.end();
          } else {
            Serial.println("Failed to connect to server");
          }
        } else {
          Serial.println("Notification value not reached");
        }

   // Adjust the delay as needed


    if (level > 10000 && (currentTime - lastRequestTime >= requestInterval)) {
    String url = "http://" + String(host) + sms + "?data=" + String(level);
    WiFiClient client; // Create a WiFiClient object

    if (http.begin(client, url)) {
      int httpCode = http.GET();

      if (httpCode > 0) {
        String payload = http.getString();
        Serial.println("Server Response: " + payload);
      } else {
        Serial.println("Error on HTTP request: " + http.errorToString(httpCode));
      }

      http.end();
      lastRequestTime = currentTime; // Update the last request time
    } else {
      Serial.println("Failed to connect to the server");
    }
  }else{
    Serial.println("Wait for next message");
  }
    }
  
    
      String url = "http://" + String(host) + phpScript + "?data=" + sensorData1 + "&data2=" + sensorData2;
      // String urll = "http://" + String(host) + phpScript2 + "?data2=" + sensorData2;
            // Serial.println( String(dataReceived) + "cm");
      WiFiClient client; // Create a WiFiClient object
      if (http.begin(client, url)) {
        int httpCode = http.GET();

        if (httpCode > 0) {
          String payload = http.getString();
          Serial.println("Server Response: " + payload);
        } else {
          Serial.println("Error on HTTP request: " + http.errorToString(httpCode));
        }

        http.end();
      } else {
        Serial.println("Failed to connect to the server");
      } 
    }


  }
}
