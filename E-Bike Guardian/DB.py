
# Imported standard Flask libraries and a few special like SQLAlchemy that is for databases
# and flask_login which serves as the user management side of the website that communicates
# with the the database

from flask import *
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy import text, update
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import relationship
import flask_login
import simplejson as json
from functools import wraps
from flask_login import LoginManager, UserMixin, login_required, login_user, logout_user , current_user
from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, SubmitField


# This is the connection to the database its simple to understand
# its the ip user and password plus secret _key for security reasons
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://postgres:Georgiev@35.233.82.53/postgres'
db = SQLAlchemy(app)
app.secret_key = "ux&c[-{X'6Cc%Wh"

# Here I inistialize the user manager so that I can work with it
login_manager = LoginManager()
login_manager.init_app(app)

# This part is where I create a class that corresponds to the table I have in my
# database so that python can easily access the things I need from the DB

# This is the bike table where the coordinates and names of the bikes are stored
class Bike(db.Model):
    __tablename__ = "data"
    name = db.Column(db.Text)
    id = db.Column(db.Numeric,primary_key=True)
    time = db.Column(db.TIMESTAMP)
    latitude = db.Column(db.Numeric(10,5))
    longitude = db.Column(db.Numeric(10,5))

    def __init__(self,name, id, time, latitude,longitude):
        self.name = name
        self.id = id
        self.time = time
        self.latitude= latitude
        self.longitude= longitude


# This is the users tables. It contains the users username and password
class Users(db.Model):
    __tablename__ = "users"
    username = db.Column(db.Text, primary_key=True)
    password = db.Column(db.Text)
    role = db.Column(db.Text)

    def __init__(self,username, password, role):
        self.username = username
        self.password = password
        self.role=role

# This is the rent bike table. It contains which bike is rented and which is not and also
# which user rented said bike
class Rent(db.Model):
    __tablename__="rent"
    id = db.Column(db.Numeric, primary_key=True)
    name = db.Column(db.Text)
    rented = db.Column(db.Text)

    def __init__(self,id,name,rented):
        self.id = id
        self.name = name
        self.rented = rented

class User(flask_login.UserMixin):
    pass

# Here I setup the verification proccess of the system so that I can find out what
# kind of user I am dealing with be it a guest, a normal one or an admin

def get_current_user_role():
    Roles = db.session.query(Users).from_statement(text("""SELECT * FROM users where username = '""" + str(flask_login.current_user.id) + """';""")).all()
    for role in Roles:
        if role.role == "user":
            return str(role.role)
        elif role.role == "admin":
            return str(role.role)
        else:
            return "Error"

def error_response():
    return "Error"

# Here I start to restrict access to different users according to their privilages
def requires_roles(*roles):
    def wrapper(f):
        @wraps(f)
        def wrapped(*args, **kwargs):
            if get_current_user_role() not in roles:
                return error_response()
            return f(*args, **kwargs)
        return wrapped
    return wrapper

# Here I setup the user login system so that it corresponds accordingly to the Users
# pass and username
@login_manager.user_loader
def user_loader(username):
    usernames = db.session.query(Users.username).filter_by(username=username).scalar() is not None
    if usernames == False:
        return

    user = User()
    user.id = username
    return user

# Here is an error handler if the user doesnt write his/her password or username correctly
@login_manager.unauthorized_handler
def unauthorized_handler():
    flash('You need to login first.')
    return redirect(url_for('login'))

# Here I start creating the different routes for the system starting from the default one.
@app.route('/')
def hello():

    return "Hello World!"
# This is the login page
@app.route('/login')
def login():
    return render_template('login.html')

# This is the page you go to if you fail to login
@app.route('/incorrect_login')
def incorrect_login():
    return render_template('loginIncorrect.html')

# This is the register page
@app.route('/register')
def register():
    return render_template('register.html')

# This is the admin panel where admins have full control over the user system and bike renting system
@app.route('/adminPanel')
@flask_login.login_required
@requires_roles('admin')
def adminPanel():
    return render_template('admin_menu.html')

# This is the bike renting page
@app.route('/rent')
@flask_login.login_required
@requires_roles('admin','user')
def rent():
    flash('Hi ' + flask_login.current_user.id)
    return render_template('rent.html')

# This is the page where you go when you want to return a bike
@app.route('/unrent')
@flask_login.login_required
def unrent():
    return render_template('unrent.html')

# This is the page that shows where the bikes are on a map using the coordinates
# the bikes have currently
@app.route('/search')
@flask_login.login_required
def search():
        return render_template('mapSearch.html')

# This is the home page of the website
@app.route('/home')
@flask_login.login_required
def home():
    return render_template('home.html')

# This is where bike data is shown as whether they are rented and by whom they are used by.
@app.route('/showdata')
def showdata():
    myIotdata=Rent.query.all()
    return render_template('showdata.html', myIotdata=myIotdata)

# Here I make the functionality of the admin panel so that only admins can access it
# and also have the ability to change other users privilages
@app.route('/admin_menu', methods=['POST'])
@flask_login.login_required
@requires_roles('admin')
def admin_menu():
    username= request.form['username']
    roles = request.form['roles']
    result = db.session.query(Users).from_statement(text("""SELECT * FROM users;""")).all()
    if roles =="user":
        for rez in result:
            if rez.username == str(username):
                if rez.role == 'user':
                    return "User already has the same role."
                else:
                    rez.role = 'user'
                    db.session.commit()
                    flash("Successfully changed role for user")
                    return render_template("map.html")

        return "No such user"

    elif roles == "admin":
        for rez in result:
            if rez.username == str(username):
                if rez.role == 'admin':
                    return "User already has the same role."
                else:
                    rez.role = 'admin'
                    db.session.commit()
                    flash("Successfully changed role for user")
                    return render_template("map.html")

        return "No such user"

# Here I setup the rent function of the rent page. It's just accessing the table and
# changing the status of the bike to rented if it is already rented it returns an error
@app.route('/rent_a_bike', methods=['POST'])
@flask_login.login_required
def rent_a_bike():
    rented = request.form['bikes']
    result = db.session.query(Rent).from_statement(text("""SELECT * FROM rent where name = '""" + str(rented).capitalize() + """';""")).all()
    for rez in result:
        if rez.rented =='No':
            rez.rented= "Yes"
            db.session.commit()
            global user
            user = flask_login.current_user.id
            result = "The Bike now is rented"
        else:
            result = "The Bike is rented by " + user
    return render_template('showRented.html', Rented = result)

# The same as the previous functionality only this one makes them unrented
@app.route('/unrent_a_bike', methods=['POST'])
@flask_login.login_required
def unrent_a_bike():
    rented = request.form['bikes']
    result = db.session.query(Rent).from_statement(text("""SELECT * FROM rent where name = '""" + str(rented).capitalize() + """';""")).all()
    for rez in result:
        if rez.rented =='Yes':
            rez.rented= "No"
            db.session.commit()
            result = "The Bike now is returned"
        else:
            result = "The Bike is not rented"
    return render_template('showRented.html', Rented = result)

# Here is the functionality used for searching for a specific bike. It gets the name of the bikes
# then searches the bike in the Database and returns all it can find about it
@app.route('/search_bike',  methods=['POST'])
@flask_login.login_required
def search_bike():
    bike_name = request.form['bikename']
    filter= Bike.query.filter(Bike.name == bike_name)
    return render_template('map.html', myIotdata=filter)

# This functionality gets the last two coordinates of a specific bike.
@app.route('/last_pos', methods=['POST'])
@flask_login.login_required
def last_pos():
    result = db.session.query(Bike).from_statement(text('''SELECT * FROM data  WHERE id IN (SELECT MAX(id) FROM data GROUP BY name);''')).all()
    return render_template('map.html', myIotdata=result)

# This functionality handles the login. It checks with the database if the user exist
# and has the proper password and username then redirect to the search page.
@app.route('/login-post', methods=['GET', 'POST'])
def loginPost():
    users = request.form['username']
    username = db.session.query(Users.username,Users.password).filter_by(username=request.form['username'],password=request.form['password']).scalar() is not None
    password = db.session.query(Users.password, Users.username).filter_by(password=request.form['password'],username=request.form['username']).scalar() is not None
    if username == True and password == True:
        user = User()
        user.id = users
        flask_login.login_user(user)
        flash('Logged in.')
        return redirect(url_for('search'))

    return 'Bad login'

# This is a simple log out function
@app.route('/logout')
@flask_login.login_required
def logout():
    flask_login.logout_user()
    return 'Logged out'

# This restricts different pages so that only admins and/or users can access them
@app.route('/protected')
@flask_login.login_required
def protected():
    return 'Logged in as: ' + flask_login.current_user.id

# This handles the registration functionality. It simply increments to the already established table
@app.route('/register',  methods=['POST'])
def Register():
    userlist = db.session.query(Users.username).filter_by(username=request.form['username']).scalar() is not None
    if  userlist == False:
        userdata = Users(request.form['username'], request.form['password'])
        db.session.add(userdata)
        db.session.commit()
        return redirect(url_for('saveddata'))
    else:
        return "<h1 style='color: red'>Username is taken</h1>"

# This shows all the bikes on a map.
@app.route('/map')
@flask_login.login_required
def map():
    myIotdata = Bike.query.all()
    return render_template('map.html', myIotdata=myIotdata)

# This protects the file from being accessed from outside files etc.
if __name__ == '__main__':

    app.run(debug=True)
