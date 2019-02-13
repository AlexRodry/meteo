#include <HCSR04.h> //by Martin Sosic
#include <OneWire.h>  //by Jim Studt and others..
#include <DallasTemperature.h> //by Miles Burton and others...

#define TRIG_PIN 8
#define ECHO_PIN 7
#define TEMP_PIN 10

OneWire  ds(TEMP_PIN);
DallasTemperature sensors(&ds);
UltraSonicDistanceSensor distanceSensor(TRIG_PIN, ECHO_PIN);
int pinLed = 13;

void setup(){
    Serial.begin(9600);
    sensors.begin();
    digitalWrite(pinLed, LOW);
}

void loop() {
    char c;
    int distance;
    float temp;
    String cad;
    distance = Fdistance();
    temp = Ftemp ();
    readserial();
    cad = "#1:" + String(distance) + "#2:" + String(temp) + "@";
    Serial.println(cad);
 
    delay(2900);
}

double Fdistance(){
  int d = distanceSensor.measureDistanceCm() ;
  return d;
}

float Ftemp(){
  float f = -127;
  sensors.requestTemperatures();  
  delay (100);
  f = sensors.getTempCByIndex(0);

  return f;  
}

char readserial(){
  if (Serial.available()) { //Si estรก disponible
      char c_ = Serial.read(); //Guardamos la lectura en una variable char
      if (c_ == 'H') { //Si es una 'H', enciendo el LED
         digitalWrite(pinLed, HIGH);
      } else if (c_ == 'L') { //Si es una 'L', apago el LED
         digitalWrite(pinLed, LOW);
      }
   }
}   
