<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Realtime location tracker</title>

    <!-- leaflet css  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <!-- leaflet js  -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map("map").setView([14.5995, 120.9842], 6);

        var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        osm.addTo(map);

        // Fetch the latest location data from the server
        function fetchLatestLocation() {
            var serviceRequestId = <?php echo $_GET['SERVICE_REQUEST_ID']; ?>;

            // Use AJAX/fetch to get the latest location from the server
            fetch('getLatestLocation.php?SERVICE_REQUEST_ID=' + serviceRequestId)
                .then(response => response.json())
                .then(data => {
                    updateMap(data.latitude, data.longitude);
                })
                .catch(error => console.error('Error fetching latest location:', error));
        }

        // Initial fetch when the page loads
        fetchLatestLocation();

        // Periodically update the location (every 2 seconds in this example)
        setInterval(fetchLatestLocation, 2000);

        var marker, circle;

        function updateMap(latitude, longitude) {
            if (marker) {
                map.removeLayer(marker);
            }

            if (circle) {
                map.removeLayer(circle);
            }

            marker = L.marker([latitude, longitude]);
            circle = L.circle([latitude, longitude], {
                radius: 10 // You can adjust the radius as needed
            });

            var featureGroup = L.featureGroup([marker, circle]).addTo(map);

            map.fitBounds(featureGroup.getBounds());
        }
    </script>
</body>

</html>