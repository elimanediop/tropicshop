var placeSearch, topMap;

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  topMap = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */(document.getElementById('topMap')),
    {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  topMap.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = topMap.getPlace();
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      topMap.setBounds(circle.getBounds());
    });
  }
}