#!/usr/bin/env python
import serial

arduino = serial.Serial('/dev/ttyACM0', 9600)
while True:
    line = arduino.readline()
    print(line)

arduino.close() #Finalizamos la comunicacionarduino = serial.Serial('/dev/ttyACM0', 9600)
