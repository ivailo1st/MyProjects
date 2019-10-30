import time         # Library for delays.
import paho.mqtt.client as mqtt         # Library for MQTT protocols.
import os           # Library for using the camera bash script and also the google cloud vision api function.
import sys          # Library for the camera that provides additional variables.
import subprocess    # Library for the camera that spawns new processes, connects to various pipes and obtains return codes.
import io               # Library for the google vision api function that provides Python interfaces to stream handling.
import pyodbc           # Library for the SQL Database function that is a module for ODBC (Open Database Connectivity).
import datetime         # Library for the SQL Database function that is used for manipulating dates and times.

from google.cloud import vision  # Library for the Google vision API function that is used for sending images to the API
from google.cloud.vision import types   # Library for the Google vision API function that is used for loaidng images into memory

# The SQL Database function
def Database():
    # The Connection credentials
    dsn = 'my_mysql_server_data_source' # name of the server that is used in the odbc.ini file inside of the Raspberry
    user = 'Ivost@project-server-ivo' # name of the User
    password = 'Georgiev1' # password
    database = 'Car_Wash' # name of the Database

    con_string = 'DSN=%s;UID=%s;PWD=%s;DATABASE=%s;' % (dsn, user, password, database) # The actual connection commands
    conn = pyodbc.connect(con_string)
    f = open('place.txt', 'r') # Opening a file to read the letters that were sent back from the API
    value = f.readline() # Assigning it to a variable
    f.close() # Closing file
    value = value.replace(" ","") # Removing any empty spaces between characters
    value = value.replace("\n","") # Removing the newline command at the end of the line
    current = datetime.datetime.now() # Getting the current date for later usage in the Database
    cursor = conn.cursor() # function used for executing PostgreSQL commands
    numbers = cursor.execute('select car_number from car_plates') # Getting specific data from the Azure Database
    row = cursor.fetchall() # Getting all of the rows for car_number of the table
    global question # creating a global variable that is used in another function and inside this one too
    print(row) # Showing the user what is inside of the database

    # Checking if the earlier assigned value variable is inside the database and this is done by using the any() func
    # it returns True if any element of an iterable is True
    if any(value in code for code in row):
        print("It is in") # printing the user that the scanned plate is inside the database
        question= "y" # assigning the global variable to a string "y"
    else:
        print("It is not in") # printing the user that the scanned plate is not inside the database
        answer = input("Want to add it in the database?(y/n): ") # asking the user whether he wants to add it or not
        if answer == "y":
            # Inserting the letters inside the table that is in the SQL Database with a date
            addition = cursor.execute('insert into car_plates(tdate,car_number) values (?,?)', (current, value))
            conn.commit()
            print("done") # printing that everything is done
            question  = "y/n" # assigning the global variable to a string "y/n"
        else:
            print('Okay, Have a nice day!') # printing that the user has selected no
            question = "n" # assigning the global variable to the string "n"

#Google vision API function
def detect_text(path):

    client = vision.ImageAnnotatorClient() # Instantiating a client

    with io.open(path, 'rb') as image_file: # Reading the image
        content = image_file.read()

    image = vision.types.Image(content=content) # loaidng image into memory

    # performing text detection on the image
    response = client.text_detection(image=image)
    texts = response.text_annotations
    print('Texts:') # printing to the user the string "Texts:"
    f=open("place.txt",'w+') # opening a file to clean the text inside from previous uses
    f.close() # closing the file
    count=0 # adding a counter
    for text in texts: # creating a for loop to get all the text we receive from the API
    # Adding an if condition that checks how many times the for loop has ran and if it is more than once it breaks the loop
        if count == 0:
              print('\n','{}'.format(text.description)) # Printing the text we received from the API
              g=open('place.txt','a')   # Opening a file in append mode to insert said text
              g.write("{}".format(text.description)) # inserting the text
              g.close() # closing the file
              count+=1 # adding to the counter
        else:
              break

#Camera function
def camera():
	script_dir= os.path.dirname(__file__) # reading the absolute path
	os.system('./webcam.sh') # executing the bash script for the fswebcam
	rel_path="image.jpg" # creating a real path
	abs_file_path = os.path.join(script_dir,rel_path) # combining the two to make an absolute path
	time.sleep(2) # adding a delay

# MQTT Function used for telling the user if the program has successfully connected to the MQTT
def on_connect(client, userdata, flags, rc):
	print("Connected with Code :" + str(rc)) # printing the user the code that the program has connected with
	client.subscribe("myMQTT") # Subscribing to the "myMQTT" topic

# MQTT Function used for a callback function that runs each time a message is sent over the MQTT
def on_message(client, userdata, msg):
	global question # the global variable from the SQL Database function
	if str(msg.payload) == "b'Shoot'": # Checking if the message is Shoot
		print (str(msg.payload)) # Showing the message that it was indeed shoot to the user
		camera() # Running the camera function to get the picture and save it on a specific path
		time.sleep(3) # A delay of 3 seconds
		print("Please Wait") # Printing the user to wait for the API detect the text on the image
        # calling the Google vision API function that stores the text it read into a local file
		detect_text("/var/www/html/pics/image.jpg")
		Database() # Calling the SQL Database function to check wheter the scanned letters are inside the Database
        # Checking whether the user scanned plate is already in the database, wasn't but the user chose to add it or he
        # chose not to add it
		if question =="y":
			client.publish("myMQTT","The car plate Is already in the database") # Publishing that the scanned letters are in
		elif question == "y/n":
            # Publishing that the scanned letters weren't in but now are in
			client.publish("myMQTT","The car plate wasnt in but the user chose to add it in the database")
		elif question == "n":
            # Publishing that the scanned letters aren't in
			client.publish("myMQTT","The car plate isn't in the database")
		time.sleep(2) # A delay of two seconds
	else:
		print("Nothing for now") # Printing the user that there isn't anything happening now

client = mqtt.Client() # assigning a variable to the mqtt.CLient() function
client.on_connect = on_connect # Creating a callback for the function on_connect that is ran only once in the beginning
client.on_message = on_message # Creating a callback for the function on_message

client.connect("3.121.31.186", 1883, 60)  # connecting to the MQTT via port 1883 and timeout of 60 seconds

client.loop_forever() # looping the whole program


