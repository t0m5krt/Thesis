<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Live Location Test</title>

    <!-- leaflet css  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        #map {
            flex: 1;
            width: 100%;
        }

        #status {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* The switch - the box around the slider */
        .switch {
            font-size: 17px;
            position: relative;
            display: inline-block;
            width: 62px;
            height: 35px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 1;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0px;
            background: #fff;
            transition: .4s;
            border-radius: 30px;
            border: 1px solid #ccc;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 1.9em;
            width: 1.9em;
            border-radius: 16px;
            left: 1.2px;
            top: 0;
            bottom: 0;
            background-color: white;
            box-shadow: 0 2px 5px #999999;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #5fdd54;
            border: 1px solid transparent;
        }

        input:checked+.slider:before {
            transform: translateX(1.5em);
        }
    </style>
</head>

<body>
    <div id="map"></div>


    <p>Instruction: Toggle the switch to start sharing</p>

    <!-- Switch for start/stop -->
    <label class="switch">
        <input type="checkbox" id="startStopSwitch">
        <span class="slider"></span>
    </label>

    <!-- Status display -->
    <h1 id="status">Status: </h1>

    <!-- leaflet js  -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Map initialization
        var map = L.map("map").setView([14.5995, 120.9842], 6);
        var intervalId;

        // Event listener for switch change
        document.getElementById("startStopSwitch").addEventListener("change", function() {
            if (this.checked) {
                // Start continuous updates
                intervalId = setInterval(() => {
                    navigator.geolocation.getCurrentPosition(getPosition);
                }, 3000);
                console.log("Continuous updates started.");
                document.getElementById("status").innerText = "Status: Sharing";
            } else {
                // Stop continuous updates
                clearInterval(intervalId);
                console.log("Continuous updates stopped.");
                document.getElementById("status").innerText = "Status: Stopped";
            }
        });

        //osm layer
        var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        });
        osm.addTo(map);

        var serviceRequestId = <?php echo json_encode($_GET['SERVICE_REQUEST_ID']); ?>;

        function updateLocation(latitude, longitude) {
            // Use AJAX/fetch to send the updated location to the server
            fetch("updateLocation.php?SERVICE_REQUEST_ID=" + serviceRequestId, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        latitude: latitude,
                        longitude: longitude,
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    // Handle the response from the server if needed
                    console.log(data);
                })
                .catch((error) => console.error("Error updating location:", error));
        }

        var marker, circle;

        function getPosition(position) {
            var lat = position.coords.latitude;
            document.cookie = "latitude=" + lat;
            var long = position.coords.longitude;
            document.cookie = "longitude=" + long;
            var accuracy = position.coords.accuracy;

            // Update location on the server
            updateLocation(lat, long);

            if (marker) {
                map.removeLayer(marker);
            }

            if (circle) {
                map.removeLayer(circle);
            }

            marker = L.marker([lat, long]);
            circle = L.circle([lat, long], {
                radius: accuracy,
            });

            var featureGroup = L.featureGroup([marker, circle]).addTo(map);

            map.fitBounds(featureGroup.getBounds());

            console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);
        }
    </script>

</body>

</html>