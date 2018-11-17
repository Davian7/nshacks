<!DOCTYPE html>
<html>
<head>
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;  /* The height is 400 pixels */
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
                zoom: 16,
                disableDefaultUI: true,
                scrollwheel: false,
                zoomControl: true,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: true,
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
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                        parseFloat(markerElem.getAttribute('lat')),
                        parseFloat(markerElem.getAttribute('lng')));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
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
<h3>My Google Maps Demo</h3>
<!--The div element for the map -->
<div id="map"></div>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7xAjMq9O83M2WKh__rJtoUgZapQifq4g&callback=initMap">
</script>
</body>
</html>
