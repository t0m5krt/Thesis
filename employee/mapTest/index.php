<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>SPACE-O :: Get Visitor Location using HTML5</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);


      } else {
        $("#location").html("Geolocation is not supported by this browser.");
      }
    });




    function showLocation(position) {
      var latitude = position.coords.latitude;
      document.cookie = "latitude=" + latitude;
      var longitude = position.coords.longitude;
      document.cookie = "longitude=" + longitude;
      $("#connection").html(latitude + " " + longitude);
      $.ajax({
        type: "POST",
        url: "getLocation.php",
        data: "&latitude=" + latitude + "&longitude=" + longitude,
        success: function(msg) {
          if (msg) {
            $("#location").html(msg);
          } else {
            $("#location").html("Not Available");
          }
        }
      });
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

  while (true) {
    sleep(10);
    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }


  ?>
  <style type="text/css">
    p {
      border: 2px dashed #009755;
      width: auto;
      padding: 10px;
      font-size: 18px;
      border-radius: 5px;
      color: #ff7361;
    }

    span.label {
      font-weight: bold;
      color: #000;
    }
  </style>
</head>

<body>
  <p>
    <span class="label">connection check:</span> <span id="connection"></span>
    <span class="label">Your Location:</span> <span id="location"></span>
  </p>
</body>

</html>