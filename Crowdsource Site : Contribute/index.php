<?php
require_once 'app/config.php';
$json_string = 'https://go.jeffrey.gq/nearest_building.json';
$jsondata = file_get_contents($json_string);
$obj = json_decode($jsondata, true);

$query = "SELECT nameOfBuilding, Latitude, Longitude FROM Task WHERE 1";
$result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height:100vh;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        /* Set the width of the side navigation to 250px */
        function openNav() {
            document.getElementById("mySidenav").style.width = "135px";
        }

        /* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        //MAP MARKERS------------------------------------------------------------------------------------------------------

        //defining custom label

        var customLabel = {
            Loblaws: {
                label: 'L'
            },
        };

        //Map

        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(40.8734357, -73.8956846,17),
                zoom: 16.5,
                disableDefaultUI: true,
                scrollwheel: false,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false,
                draggable: true,
                disableDoubleClickZoom: true,

            });
            var infoWindow = new google.maps.InfoWindow;

            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                    new ActiveXObject('Microsoft.XMLHTTP') :
                    new XMLHttpRequest;

                request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }



//Pulling info from php file

            downloadUrl('php2xml.php', function(data) {
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) {
                    var id = markerElem.getAttribute('id');
                    var name = markerElem.getAttribute('name');
                    var address = markerElem.getAttribute('address');
                    var hasElevator = markerElem.getAttribute('hasElevator');
                    var hasRamp = markerElem.getAttribute('hasRamp');
                    var numofFloors = markerElem.getAttribute('numFloors');
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));



                    var elevator = document.createElement('elevator');
                    if(hasElevator == 'Y'){
                        elevator.textContent = 'This have an Elevator'
                    } else{
                        elevator.textContent = 'This doesnt have an Elevator'
                    }
                    infowincontent.appendChild(elevator);
                    infowincontent.appendChild(document.createElement('br'));

                    var ramp = document.createElement('ramp');
                    if(hasRamp == 'Y'){
                        ramp.textContent = 'This is Ramp Accessible'
                    } else{
                        ramp.textContent = 'This isnt Ramp Accessible'
                    }
                    infowincontent.appendChild(ramp);
                    infowincontent.appendChild(document.createElement('br'));
                    var floor = document.createElement('floors');
                    floor.textContent = "This building has " + numofFloors + " floors"
                    infowincontent.appendChild(floor);
                    infowincontent.appendChild(document.createElement('br'));
                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    var icon = customLabel[type] || {};
                    var marker = new google.maps.Marker({
                        map: map,
                        position: point,
                        label: icon.label
                    });
                    marker.addListener('click', function() {
                        infoWindow.setContent(infowincontent);
                        infoWindow.open(map, marker);
                    });
                });
            });

//Resize based on window size

            google.maps.event.addDomListener(window, "resize", function() {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
            });
        }

        /*request.open('GET', url, true);
        request.send(null);
    }*/

        function doNothing() {

        }



    </script>

</head>
<body>
<div id="map"></div>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7xAjMq9O83M2WKh__rJtoUgZapQifq4g&callback=initMap">
</script>
<script src="js/script.js"></script>
</body>
</html>
