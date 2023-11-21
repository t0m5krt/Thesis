<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Employee Locations</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <style>
        #map {
            width: 100%;
            height: 100vh;
        }

        #backButton {
            position: absolute;
            top: 10px;
            left: 50px;
            z-index: 999;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <button id="backButton" class="btn btn-success">Go Back to Dashboard</button>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([14.6037, 121.3084], 10);
        mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 18,
            }).addTo(map);

        function fetchEmployeeLocations() {
            fetch('getLatestLocation.php')
                .then(response => response.json())
                .then(data => {
                    updateMap(data);
                })
                .catch(error => console.error('Error fetching locations:', error));
        }

        function updateMap(locations) {
            // Clear existing markers
            map.eachLayer(layer => {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Add markers for each location
            locations.forEach(location => {
                L.marker([location.latitude, location.longitude], {
                        title: `SRN: ${location.employee_id}`
                    })
                    .bindPopup(`SRN: ${location.employee_id}<br>Timestamp: ${location.timestamp}`)
                    .addTo(map);
            });
        }

        // Initial fetch when the page loads
        fetchEmployeeLocations();

        // Periodically update the location (every 5 seconds in this example)
        setInterval(fetchEmployeeLocations, 5000);

        document.getElementById('backButton').addEventListener('click', () => {
            window.location.href = 'dashboard.php';
        });
    </script>


</body>

</html>