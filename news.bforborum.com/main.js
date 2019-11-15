// Foursquare API Info
const clientId = 'P5ACJ1UWN5XRX2PW2U4D5OKD1ATENF2DFEUC0MD2VCEO2JH3';
const clientSecret = 'RFIZL1BPROGC4CWKTSWF0QJNTZGKTF4WVAN5YP10012JFZOT';
const url = 'https://api.foursquare.com/v2/venues/explore?near=';

// APIXU Info
const apiKey = 'd693e3058c654de7bfcac6199fb8f4e0';
const forecastUrl = `https://api.apixu.com/v1/forecast.json?key=`;

// Page Elements
const $input = $('#city');
const $submit = $('#button');
const $destination = $('#destination');
const $container = $('.container');
const $venueDivs = [$("#venue1"), $("#venue2"), $("#venue3"), $("#venue4")];
const $weatherDivs = [$("#weather1"), $("#weather2"), $("#weather3"), $("#weather4"), $('#weather5')];
const weekDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

// Add AJAX functions here:
const getVenues = async () => {
	const city = $input.val();
  const urlToFetch = url + city + '&limit=8&client_id=' + clientId + '&client_secret=' + clientSecret + '&v=20180825';
  try {
    const response = await fetch(urlToFetch);
    if(response.ok) {
      const jsonResponse = await response.json();
      const venues = jsonResponse.response.groups[0].items.map(item => item.venue);
      console.log(jsonResponse);
      return venues;
    }
  } catch(error) {
    console.log(error);
  }
}

const getForecast = async () => {
  const urlToFetch = forecastUrl + apiKey + "&q=" + $input.val() + "&days=6&hour=11";
	try {
    const response = await fetch(urlToFetch);
    if(response.ok) {
      const jsonResponse = await response.json();
      const days = jsonResponse.forecast.forecastday;
      console.log(jsonResponse);
      return days;
    }
  } catch (error) {
    console.log(error);
  }
}


// Render functions
const renderVenues = (venues) => {
  $venueDivs.forEach(($venue, index) => {
    // Add your code here:
    const venue = venues[index];
    let venueContent = '';
    const venueIcon = venue.categories[0].icon;
    const venueImgSrc = venueIcon.prefix + 'bg_64' + venueIcon.suffix;
    venueContent+= createVenueHTML(venue.name, venue.location, venueImgSrc);
    $venue.append(venueContent);
  });
  $destination.append(`<h2>${venues[0].location.city}</h2>`)

const executeSearch = () => {
  $venueDivs.forEach(venue => venue.empty());
  $weatherDivs.forEach(day => day.empty());
  $destination.empty();
  $container.css("visibility", "visible");
  getVenues().then(venues => {
    return renderVenues(venues);
  });
  return false;
}

$submit.click(executeSearch)
