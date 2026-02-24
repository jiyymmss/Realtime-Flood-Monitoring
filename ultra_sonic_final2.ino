#define TRIG_PIN 9
#define ECHO_PIN 10


// const int sensorInterrupt = 0;  // 0 means that the sensor is connected to digital pin 2
// volatile unsigned int pulseCount = 0;
// unsigned int flowRate;
// unsigned int flowMilliLitres;
// unsigned long totalMilliLitres;

void setup() {
  Serial.begin(115200);
  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);

  // pinMode(sensorInterrupt, INPUT);
  // digitalWrite(sensorInterrupt, HIGH);

  // attachInterrupt(0, pulseCounter, FALLING);
}

void loop() {
  // delay(1000);
  // detachInterrupt(0);  // Disable the interrupt while calculating flow rate and volume
  // flowRate = pulseCount / 7.5;  // Pulse frequency to flow rate in L/min
  // flowMilliLitres = (flowRate / 60) * 1000;  // Flow rate in L/sec to L
  // totalMilliLitres += flowMilliLitres;
  // pulseCount = 0;
  // attachInterrupt(0, pulseCounter, FALLING);

 
  



  long duration, distance, sam;

  // Trigger ultrasonic sensor
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);

  // Read echo pulse
  duration = pulseIn(ECHO_PIN, HIGH);

  // Calculate distance in centimeters
 
  //distance = (duration/2) / 29.09;
  //distance = (duration * 0.034 / 2);
  distance = duration * 0.0343 / 2;
  distance = 200 - distance;

  sam = 0;

  if(distance >= 0){
    Serial.print(distance);
    Serial.print(",");
    
  }else{
    Serial.print(sam); 
    Serial.print(","); 
    }

  // if(flowRate >= 0){
  //   Serial.print(flowRate);
  //   Serial.print(",");
    
  // }else{
  //   Serial.print(sam); 
  //   Serial.print(","); 
  //   }




  // Send distance data to ESP8266
  
  // Serial.print(distance);
  // Serial.print(",");
  // Serial.print(flowRate);
  // Serial.print(flowRate);

  delay(4000); // Wait for a moment before sending the next reading
}

// void pulseCounter() {
//   pulseCount++;
// }







