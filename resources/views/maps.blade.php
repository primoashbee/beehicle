<!DOCTYPE html>
<html>
  <head>
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        width: 600px;
       }
    </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </head>
  <body>
    <!--The div elements for the map and message -->
    <div id="map"></div>
    <div id="msg"></div>
    <script>
// Initialize and add the map
var map;
function initMap() {

  // axios.post('https://beehicle.xyz/api/user/login', {
  //   email: 'ashbee.morgado@icloud.com',
  //   password: 'password'
  // })
  //   .then(res=>{
  //     console.log(res.data);
  //   })
  // The map, centered on Central Park
  const center = {lat: 40.774102, lng: -73.971734};
  const options = {zoom: 15, scaleControl: true, center: center};
  map = new google.maps.Map(
      document.getElementById('map'), options);
  // Locations of landmarks
  const dakota = {lat: 40.7767644, lng: -73.9761399};
  const frick = {lat: 40.771209, lng: -73.9673991};
  // The markers for The Dakota and The Frick Collection
  var mk1 = new google.maps.Marker({position: dakota, map: map});
  var mk2 = new google.maps.Marker({position: frick, map: map});

  let directionsService = new google.maps.DirectionsService();
  let directionsRenderer = new google.maps.DirectionsRenderer();
  directionsRenderer.setMap(map); // Existing map object displays directions
  // Create route from existing points used for markers
  const route = {
      origin: dakota,
      destination: frick,
      travelMode: 'DRIVING'
  }


  console.log(route);
  directionsService.route(route,
    function(response, status) { // anonymous function to capture directions
      if (status !== 'OK') {
        window.alert('Directions request failed due to ' + status);
        return;
      } else {
        directionsRenderer.setDirections(response); // Add route to the map
        var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
        if (!directionsData) {
          window.alert('Directions request failed');
          return;
        }
        else {
          document.getElementById('msg').innerHTML += " Driving distance is " + directionsData.distance.text + " (" + directionsData.duration.text + ").";
        }
      }
    });
}
    </script>
    <!--Load the API from the specified URL -- remember to replace YOUR_API_KEY-->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{config('services.google.api_key')}}&callback=initMap">
    </script>

    
  </body>
</html>