#!/usr/bin/env python
import serial
import mysql.connector
arduino = serial.Serial('/dev/ttyACM0', 9600)
#  #1:68#2:21.50@
def cad_proc(cad):
    print ("\n\nInicio------------------------------------------------>" + cad)
    i = cad.find("@")
    while (i > 0):
        #Elimino prime #
        j = cad.find("#")
        cad = cad [j+1:]
        aux = cad

        #Cad avanza 1 bloque y aux se queda con el bloque anterior
        j = cad.find("#")
        if (j < 0):
            j = cad.find("@") #Si entro en este condicional he llegado a ultimo bloque
        aux = aux[:j]
        cad = cad[j:]

        #Divido aux en ID y valor
        x = aux.find(":")
        sensor = aux[:x]
        value = aux[x+1:]

        #info print
        print("sensor:" + sensor)	#sensor
        print("value:" + value)     #value
        send_mysql(sensor,value)
        i = cad.find("@")

def send_mysql(sensor_,value_):
    cnx = mysql.connector.connect(user='root', password='1234',
                              host='localhost',
                              database='IOT')
    cursor = cnx.cursor()
    query = "Insert into datas (id_sensor,data) VALUES (" + sensor_  + "," + value_ + ");"
    print(query)
    cursor.execute(query)
    cnx.commit()
    cursor.close()
    cnx.close()


while True:
    line = arduino.readline()
    cad_proc(line)
arduino.close() #Finalizamos la comunicacionarduino = serial.Serial('/dev/ttyACM0', 9600)
