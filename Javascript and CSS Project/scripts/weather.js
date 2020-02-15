// Constants for the objects inside the weather section
const iconObject = document.querySelector(".WeatherIcon");
const tempObject = document.querySelector(".TemperatureValue");
const descObject = document.querySelector(".TemperatureDesc");
const locationObject = document.querySelector(".Location p");
const notificationObject = document.querySelector(".Notification");

// Application data
const weather = {};

weather.temperature={
    unit: "celsius"
}

// Constants and Variables for Application
const KELVIN = 273;

// Api Key for OpenWeatherMap that provides information about the weather
const key ="d4b46a2f291b881a2d34563836e6c40e";

// Gets Current GeoLocation
if("geolocation" in navigator){
  navigator.geolocation.getCurrentPosition(setPosition, showError);
}
else{
  notificationObject.style.display="block";
  notificationObject.innerHTML="<p>Browser doesn't Support Geolocation</p>";
}

// Setups the Latitude and longitude
function setPosition(position){
  let latitude = position.coords.latitude;
  let longitude = position.coords.longitude;

  getWeather(latitude, longitude);
}

// Function for Error messages
function showError(error){
  notificationObject.style.display="block";
  notificationObject.innerHTML=`<p> ${error.message} </p>`;
}

// Main Function that connects to weather api and gets said data about the weather
function getWeather(latitude,longitude){
  let api = `http://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${key}`;

  fetch(api)
    .then(function(response){
      let data = response.json();
      return data;
    })
    .then(function(data){
      weather.temperature.value=Math.floor(data.main.temp - KELVIN);
      weather.description = data.weather[0].description;
      weather.iconId = data.weather[0].icon;
      weather.city = data.name;
      weather.country = data.sys.country;
    })
    .then(function(){
      displayWeather();
    });
}

// Function that displays collected data
function displayWeather(){
    iconObject.innerHTML = `<img src="icons/${weather.iconId}.png"/>`;
    tempObject.innerHTML = `${weather.temperature.value}°<span>C</span>`;
    descObject.innerHTML = weather.description;
    locationObject.innerHTML = `${weather.city}, ${weather.country}`;

}

// Simple function that converts the temperature value from celsius to fahrenheit
function celsiusToFahrenheit(temperature){
    return (temperature * 9/5 ) + 32;
}

//Event listener that will change the temperature value from celsius to fahrenheit and vice versa
// on user click
tempObject.addEventListener("click", function(){
    if(weather.temperature.value == undefined) return;

    if(weather.temperature.unit == "celsius"){
      let fahrenheit = celsiusToFahrenheit(weather.temperature.value);
      fahrenheit = Math.floor(fahrenheit);

      tempObject.style.opacity=0;
      setTimeout(function(){
        tempObject.innerHTML = `${fahrenheit}°<span> F </span>`;
        weather.temperature.unit = "fahrenheit";
        tempObject.style.opacity=1;
      },500);
    }
    else{
      tempObject.style.opacity=0;
      setTimeout(function(){
        tempObject.innerHTML = `${weather.temperature.value}°<span>C</span>`;
        weather.temperature.unit ="celsius";
        tempObject.style.opacity=1;
      },500);
    }
});
