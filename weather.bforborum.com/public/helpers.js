const createVenueHTML = (name, location, iconSource) => {
  return `<h2>${name}</h2>
  <img class="venueimage" src="${iconSource}"/>
  <h3>Address:</h3>
  <p>${location.address}</p>
  <p>${location.city}, ${location.state}</p>
  <p>${location.country}</p>`;
}

const createWeatherHTML = (currentDay) => {
  let degreesUnit = "&#0176 F";
  degreesUnit = " K";
  return `<h2> High: ${currentDay.main.temp_max}${degreesUnit}</h2>
    <h2> Low: ${currentDay.main.temp_min}${degreesUnit}</h2>
		<h2> Avg: ${currentDay.main.temp}${degreesUnit}</h2>
    <img src="http://openweathermap.org/img/wn/${currentDay.weather[0].icon}@2x.png" class="weathericon" />
    <h2>Today</h2>`;
}