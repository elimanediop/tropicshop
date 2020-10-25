var inputLocation;
function autocomp(input) {
    inputLocation = input;
    var inputLat = inputLocation.parentNode.querySelectorAll("[data-lat]")[0];
    var inputLon = inputLocation.parentNode.querySelectorAll("[data-lon]")[0];
    // var codepostal = document.querySelector("#new_address_codepostal");
    // var city = document.querySelector("#new_address_codepostal");
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(48.8566667, 2.3509871));

    var options = {
        bounds: defaultBounds,
        types: []
    };

    var autocomplete = new google.maps.places.Autocomplete(inputLocation, options);
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }else{
            var complete_address = document.querySelector("[data-complete-address]");
            var address = autocomplete.getPlace().formatted_address;
            complete_address.setAttribute("value", address);
            inputLat.setAttribute("value", autocomplete.getPlace().geometry.location.lat());
            inputLon.setAttribute("value", autocomplete.getPlace().geometry.location.lng());
        }
    });
}

window.onload = (event) => {
    var geocoder = new google.maps.Geocoder();
    var inputLocation = document.querySelector("[data-location]");
    var inputLat = inputLocation.parentNode.querySelectorAll("[data-lat]")[0];
    var inputLon = inputLocation.parentNode.querySelectorAll("[data-lon]")[0]

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {
        var latlng = { lat: parseFloat(position.coords.latitude), lng: parseFloat(position.coords.longitude) };
        geocoder.geocode({ location: latlng }, function(results, status) {
            if (status === "OK") {
                if (results[0]) {
                    var address = results[0].formatted_address;
                    inputLocation.setAttribute("value", address);
                    inputLat.setAttribute("value", latlng.lat);
                    inputLon.setAttribute("value", latlng.lng);
                } else {
                    window.alert("No results found");
                }
            } else {
                window.alert("Geocoder failed due to: " + status);
            }
        });
    }
}
