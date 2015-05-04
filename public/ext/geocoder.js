                /** Google Maps GeoCoder **/
                var geocoder;
                var map;
                function initialize() {
                  geocoder = new google.maps.Geocoder();
                  var latlng = new google.maps.LatLng(51.5286416, -0.1015987); //London 
                  var mapOptions = {
                    zoom: 4,
                    center: latlng
                  }
                  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                }
                
                function codeAddress() {
                  var address = document.getElementById('location').value;
                  geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                      map.setCenter(results[0].geometry.location);
                      var marker = new google.maps.Marker({
                          map: map,
                          position: results[0].geometry.location
                      });
                      
                      console.log(results[0].geometry.location);
                      
                      document.getElementById('latitude').value = results[0].geometry.location.A;
                      document.getElementById('longitude').value = results[0].geometry.location.F;
                      
                    } else {
                      alert('Geocode was not successful for the following reason: ' + status);
                    }
                  });
                }
                
                google.maps.event.addDomListener(window, 'load', initialize);