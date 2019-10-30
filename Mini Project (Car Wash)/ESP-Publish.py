import machine # Library for controlling pins on the micro-controller
from time import sleep # Library for delays
import network # Library for connecting to a local network
from umqtt.simple import MQTTClient # Library for the MQTT

sta_if= network.WLAN(network.STA_IF) # assigning a variable to the function WLAN
sta_if.active(True) # Assigning the function WLAN to true
sta_if.connect('ITEK_e18a_2.4G', 'raspberry') # Connecting to the ITEK 2.4G network
sta_if.ifconfig() # Chechking the IP of the micro-controller

SERVER = "3.121.31.186" # The Server for the MQTT
CLIENT_ID = "group6" # The client id of the micro-controller
TOPIC = b"myMQTT" # The topic that the micro-controller will subscribe to

c = MQTTClient(CLIENT_ID,SERVER) # Assigning a variable to the MQTTClient function with the previous variables
def sub_cb(topic, msg): # A Callback function that is ran each time a new message is sent to the MQTT
    # An If condition that checks whether the letters from the API are in the Database or weren't but now are in the
    # Database
    if str(msg)=="b'The car plate Is already in the database'" or str(msg) == "b'The car plate wasnt in but the user chose to add it in the database'":
         pin2.on() # Turning the LED on
         sleep(2) # A Delay of 2 seconds
         pin2.off() # Turning the LED off

pin2 = machine.Pin(13, machine.Pin.OUT) # The LED set for the 13th pin as an output
pin1 = machine.Pin(12, machine.Pin.IN) # The button set for the 12th pin as an input
c.set_callback(sub_cb) # Setting a call back function sub_cb
c.connect() # Connecting to the MQTT
c.subscribe(TOPIC) # Subscribing to the 'myMQTT' topic

while True: # An Infinite loop that checks if the button is pressed and messages sent to the MQTT
    if pin1.value() == 1: # If the button is pressed it will publish to the MQTT the message Shoot
	pin2.on() # Turning the LED on
        c.publish(TOPIC, b'Shoot') # Publishing the message 'Shoot"
	pin2.off() # Turning the LED off
    c.check_msg() # MQTT function used for checking message sent to the MQTT
    sleep(1) # Delay of 1 second
