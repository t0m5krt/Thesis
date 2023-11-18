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

    <?php
    include 'includes/connection.php';
    $RID = $_GET['SERVICE_REQUEST_ID'];
    $sql = "SELECT live_location_tb.latitude, live_location_tb.longlitude FROM live_location_tb WHERE SERVICE_REQUEST_ID = $RID";

    $conn->query($sql);
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            $latitude = $row['latitude'];
            $longtitude = $row['longlitude'];
        }
    } else {
        echo "0 results";
    }
    ?>
</body>

</html>

<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    // Map initialization
    var map = L.map("map").setView([14.5995, 120.9842], 6);

    //osm layer
    var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    });
    osm.addTo(map);

    if (!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!");
    } else {
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition);
        }, 2500);
    }

    var marker, circle;

    function getPosition(position) {
        // console.log(position)
        var phpLat = <?php echo $latitude ?>;
        var phpLong = <?php echo $longtitude ?>;

        var lat = phpLat;
        var long = phpLong;
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