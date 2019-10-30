import time
import RPi.GPIO as GPIO
GPIO.setmode(GPIO.BOARD)
GPIO.setup(11, GPIO.OUT)
GPIO.setup(12, GPIO.OUT)

a = GPIO.PWM(11, 50)  # channel=11 frequency=50Hz
b = GPIO.PWM(12, 50)

a.start(0)
b.start(0)

f=open("/var/www/html/carctrl.txt", "r")
while True:
	time.sleep(0.6)
	contents = f.read()
	if (contents == 'B1F\n'):
		a.ChangeDutyCycle(50)
		print('Button 1 Forwards')
	elif (contents == 'B2F\n'):
		b.ChangeDutyCycle(50)
		print('Button 2 Fowards')
	elif (contents == 'F\n'):
		a.ChangeDutyCycle(50)
		b.ChangeDutyCycle(50)
		print('Forwards')
	elif (contents == 'B1FF\n'):
		a.ChangeDutyCycle(100)
		print('Button 1 Fast Fowards')
	elif (contents == 'B2FF\n'):
		b.ChangeDutyCycle(100)
		print('Button 2 Fast Fowards')
	elif (contents == 'FF\n'):
		a.ChangeDutyCycle(100)
		b.ChangeDutyCycle(100)
		print('Fast Forwards')
	elif (contents == 'B1S\n'):
		a.ChangeDutyCycle(0)
		print('Button 1 Stop')
	elif (contents == 'B2S\n'):
		b.ChangeDutyCycle(0)
		print('Button 2 Stop')
	elif (contents == 'S\n'):
		a.ChangeDutyCycle(0)
		b.ChangeDutyCycle(0)
		print('Stop')
	print(contents)
	f.seek(0,0)
GPIO.cleanup()
