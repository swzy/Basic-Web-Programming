$(document).ready(function() {
	setBackground();
	
	$('button').click(function() {
		getWeather();
	});

});

/*
	Each of these arrays holds the labeled information
	for the next 5 days. Temps stored in Fahrenheit (API stores as Kelvin), humidity in %,
	and windspeed in m/s.
*/
var highTemps = new Array();
var lowTemps = new Array();
var humidity = new Array();
var windSpeed = new Array();
var weather_desc = new Array();
var rain_level = new Array();
var icons = new Array();
/*
	CurrentTemp will only return the temperature of the
	time of the query
*/
var currentTemp;
var zipcode;
var cityname;
var realCity;
var realCountry;
var finalQueryParam;
var day, time, weatherPic;
//For morning, afternoon, night pictures
var timeOfDay = ['images/day.jpg', 'images/night.jpg'];
//To change theme of weather box based on temperature.
var weatherTheme = ['images/cold.jpg', 'images/hot.jpg'];
var daysOfWeek = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

//Logic for showing days of the week
function getCurrentDay(dayFrom) {
	var d = new Date();
	day = d.getDay();
	day = day + dayFrom;
	if (day > 6) {
		day = day - 7;
	}
	return day;
}

function setBackground() {
	$('#fiveDay').toggle();

	var d = new Date;
	var background = timeOfDay[0];
	time = d.getHours();
	if (time >= 12) {
		background = timeOfDay[1];
	}
	document.body.style.backgroundImage = 'url(' + background + ')';
}

function getWeather(callback) {
	$('#fiveDay').show();
	try {
		zipcode = document.getElementById('zipcode').value;
		cityname = document.getElementById('cityname').value;
	} catch (err) {
		//Have not described error behavior when text fields are empty. Default is Atlanta, GA zipcode.
	}
	if (zipcode != "") {
		finalQueryParam = "zip=" + zipcode;
	} else if (cityname != "") {
		finalQueryParam = "q=" + cityname;
	} else {
		//Default query if textfields are empty.
		finalQueryParam = "zip=30303";
	}
	var weather = 'http://api.openweathermap.org/data/2.5/forecast?APPID=d5bb82e1692a9d7508bc273206ad695a' + '&'
    + finalQueryParam;
    $.ajax({
    	contentType: "application/json; charset=utf-8",
      	dataType: "jsonp",
      	url: weather,
      	success: callback,
      	APPID: 'd5bb82e1692a9d7508bc273206ad695a'
    })
    //Describes behavior when API request succeeds
    .done(function(data) {
    	console.log('weather data received');
		var visual = document.getElementById('ajxContent');
		var j = 4;

		//Set current temperature as well as background.
		var currentTemp = Math.floor((data.list[0].main.temp - 273.15) * 9/5 + 32);
		if (currentTemp > 55) {
			weatherPic = weatherTheme[1];
		} else weatherPic = weatherTheme[0];

		//Bulk of JSON object parsing logic
		for (var i = 0; i < 5; i++) {
			//Convert temps from K to F. Takes the min/max temperature from a range of times.

			var hTemp1 = data.list[j - 1].main.temp_max;
			var hTemp2 = data.list[j].main.temp_max;
			var hTemp3 = data.list[j + 1].main.temp_max

			highTemps[i] = Math.floor((Math.max(hTemp1, hTemp2, hTemp3) - 273.15) * 9/5 + 32);

			var lTemp1 = data.list[j - 1].main.temp_min;
			var lTemp2 = data.list[j].main.temp_min;
			var lTemp3 = data.list[j + 1].main.temp_min;

			lowTemps[i]	= Math.floor((Math.min(lTemp1, lTemp2, lTemp3) - 273.15) * 9/5 + 32);

			humidity[i] = data.list[j].main.humidity;
			windSpeed[i] = data.list[j].wind.speed;
			weather_desc[i] = data.list[j].weather[0].description;
			icons[i] = data.list[j].weather[0].icon;
			if (data.list[j].weather[0].main === "Rain") {
				rain_level[i] = data.list[j].rain["3h"];
			} else {
				rain_level[i] = 0;
			}


			realCity = data.city.name;
			realCountry = data.city.country;
			/*
				This statement pulls the data from 3PM of the next 5 days
				because the JSON object that is retrieved is structured in
				a consistent manner (every 8 entries).
			*/

			j = j + 8;
		}

		document.body.style.backgroundImage = 'url(' + weatherPic + ')';
		//http://openweathermap.org/img/w/iconID.png
		document.getElementById('todayIcon').setAttribute('src', 'http://openweathermap.org/img/w/' + icons[0] + '.png');
		document.getElementById('tomorrowIcon').setAttribute('src', 'http://openweathermap.org/img/w/' + icons[1] + '.png');
		document.getElementById('twoDaysIcon').setAttribute('src', 'http://openweathermap.org/img/w/' + icons[2] + '.png');
		document.getElementById('threeDaysIcon').setAttribute('src', 'http://openweathermap.org/img/w/' + icons[3] + '.png');
		document.getElementById('fourDaysIcon').setAttribute('src', 'http://openweathermap.org/img/w/' + icons[4] + '.png');

		document.getElementById('inputinfo').innerHTML = realCity + ", " + realCountry;
		document.getElementById('todayTemp').innerHTML = "Current Temperature: <br>" + currentTemp;

		document.getElementById('todayTitle').innerHTML = daysOfWeek[getCurrentDay(0)];
		document.getElementById('tomorrowTitle').innerHTML = daysOfWeek[getCurrentDay(1)];
		document.getElementById('twoDaysTitle').innerHTML = daysOfWeek[getCurrentDay(2)];
		document.getElementById('threeDaysTitle').innerHTML = daysOfWeek[getCurrentDay(3)];
		document.getElementById('fourDaysTitle').innerHTML = daysOfWeek[getCurrentDay(4)];

		document.getElementById('todayRain').innerHTML = "Rain level: " + rain_level[0] + " mm";
		document.getElementById('tomorrowRain').innerHTML = "Rain level: " + rain_level[1] + " mm";
		document.getElementById('twoDaysRain').innerHTML = "Rain level: " + rain_level[2] + " mm";
		document.getElementById('threeDaysRain').innerHTML = "Rain level: " + rain_level[3] + " mm";
		document.getElementById('fourDaysRain').innerHTML = "Rain level: " + rain_level[4] + " mm";

		document.getElementById('todayLow').innerHTML = lowTemps[0];
		document.getElementById('tomorrowLow').innerHTML = lowTemps[1];
		document.getElementById('twoDaysLow').innerHTML = lowTemps[2];
		document.getElementById('threeDaysLow').innerHTML = lowTemps[3];
		document.getElementById('fourDaysLow').innerHTML = lowTemps[4];

		document.getElementById('todayHigh').innerHTML = highTemps[0];
		document.getElementById('tomorrowHigh').innerHTML = highTemps[1];
		document.getElementById('twoDaysHigh').innerHTML = highTemps[2];
		document.getElementById('threeDaysHigh').innerHTML = highTemps[3];
		document.getElementById('fourDaysHigh').innerHTML = highTemps[4];

		document.getElementById('todayWind').innerHTML = "Windspeed: " + windSpeed[0] + " m/s";
		document.getElementById('tomorrowWind').innerHTML = "Windspeed: " + windSpeed[1] + " m/s";
		document.getElementById('twoDaysWind').innerHTML = "Windspeed: " + windSpeed[2] + " m/s";
		document.getElementById('threeDaysWind').innerHTML = "Windspeed: " + windSpeed[3] + " m/s";
		document.getElementById('fourDaysWind').innerHTML = "Windspeed: " + windSpeed[4] + " m/s";

		document.getElementById('todayHumidity').innerHTML = "Humidity: " + humidity[0] + "%";
		document.getElementById('tomorrowHumidity').innerHTML = "Humidity: " + humidity[1] + "%";
		document.getElementById('twoDaysHumidity').innerHTML = "Humidity: " + humidity[2] + "%";
		document.getElementById('threeDaysHumidity').innerHTML = "Humidity: " + humidity[3] + "%";
		document.getElementById('fourDaysHumidity').innerHTML = "Humidity: " + humidity[4] + "%";

		document.getElementById('todayDesc').innerHTML = weather_desc[0];
		document.getElementById('tomorrowDesc').innerHTML = weather_desc[1];
		document.getElementById('twoDaysDesc').innerHTML = weather_desc[2];
		document.getElementById('threeDaysDesc').innerHTML = weather_desc[3];
		document.getElementById('fourDaysDesc').innerHTML = weather_desc[4];

//Test loop
		// visual.innerHTML = "";
		// for (var i in highTemps) {
				
		// 		visual.innerHTML += "<br>\n" + highTemps[i];
		// 		console.log(highTemps[i]);
		// 		console.log(realCity);
		// 		console.log(realCountry);
		// 	}

	//Describes behavior when API request fails.
    }).fail(function() {
    	alert("Error with API request.");
    });
}
