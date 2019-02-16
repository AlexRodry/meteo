#include <RBD_LightSensor.h>
#include <DHT.h>
#include <DHT_U.h>
#include <HCSR04.h> //by Martin Sosic
#include <OneWire.h>  //by Jim Studt and others..
#include <DallasTemperature.h> //by Miles Burton and others...

#define DHTTYPE DHT11
RBD::LightSensor light_sensor(A0);
const int DHTPin = 9; // Pin digital donde se conectará el DHT
const int TEMP_PIN = 10;
int pinLed = 13;

char    c;
float   temp1;
float   temp2;
float   hum;
float   luz;
String  cad;

DHT dht(DHTPin, DHTTYPE);
OneWire  ds(TEMP_PIN);
DallasTemperature sensors(&ds);

void setup(){
    Serial.begin(9600);
    sensors.begin();
    light_sensor.setFloor(10);
    light_sensor.setCeiling(1000);
    digitalWrite(pinLed, LOW);
    dht.begin();
}

void loop() {
    temp1         = Ftemp ();
    (temp2, hum)  = FTH ();
    luz           = FL ();
    readserial();
    cad = "#1:" + String(hum) + "#2:" + String(temp1) + "#3:" + String(luz) + "@";
    Serial.println(cad);
    delay(2900);
}

float FTH(){
  delay(250);
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  return t,h;
}

float FL(){
  delay(250);
  float l = light_sensor.getPercentValue();
  return l;
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
