function autocomp(input) {
    var inputLocation = input;
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
        }
    });
}