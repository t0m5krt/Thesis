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

        #stopButton {
            width: 10%;
            height: 50px;
            background-color: #f44336;
            color: white;
            font-size: 20px;
            border: none;
            outline: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="map"></div>
</body>

<!-- Stop button -->
<button id="stopButton">Stop Viewing</button>

</html>

<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    // Map initialization
    var map = L.map("map").setView([14.5995, 120.9842], 6);
    var intervalId;

    //osm layer
    var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    });
    osm.addTo(map);

    if (!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!");
    } else {
        intervalId = setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition);
        }, 2000);
    }

    // Event listener for the "Stop Viewing" button
    document.getElementById("stopButton").addEventListener("click", function() {
        // Clear the interval to stop continuous updates
        clearInterval(intervalId);
        console.log("Continuous updates stopped.");
    });

    var marker, circle;

    function getPosition(position) {
        // console.log(position)
        var lat = position.coords.latitude;
        document.cookie = "latitude=" + lat;
        var long = position.coords.longitude;
        document.cookie = "longitude=" + long;
        var accuracy = position.coords.accuracy;

        if (marker) {
            map.removeLayer(marker);
        }

        if (circle) {
            map.removeLayer(circle);
        }

        marker = L.marker([lat, long]);
        circle = L.circle([lat, long], {
            radius: accuracy
        });

        var featureGroup = L.featureGroup([marker, circle]).addTo(map);

        map.fitBounds(featureGroup.getBounds());

        console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);
    }
</script>

<?php

include '../includes/connection.php';
$longtitude = $_COOKIE['longitude'];
$latitude = $_COOKIE['latitude'];
$id = $_GET['SERVICE_REQUEST_ID'];
// UPDATE live_location_tb SET live_location_tb.longlitude='14.6507',live_location_tb.latitude='121.1149' WHERE live_location_tb.`SERVICE_REQUEST_ID` = 58
$sql = "UPDATE live_location_tb 
        SET live_location_tb.longlitude='$longtitude',live_location_tb.latitude='$latitude' 
        WHERE live_location_tb.`SERVICE_REQUEST_ID` = '$id'";
$result = mysqli_query($conn, $sql);

if ($conn->query($sql) === TRUE) {
    echo "<h1>Record Updated Successfully</h1>";
} else {
    echo "Error updating record: " . $conn->error;
}



?>