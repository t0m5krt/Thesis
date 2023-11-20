<?php
include 'includes/connection.php';

$serviceRequestId = $_GET['SERVICE_REQUEST_ID'];

$sql = "SELECT latitude, longitude FROM live_location_tb WHERE SERVICE_REQUEST_ID = $serviceRequestId ORDER BY timestamp_column DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $locationData = array(
        'latitude' => $row['latitude'],
        'longitude' => $row['longitude']
    );
    echo json_encode($locationData);
} else {
    echo json_encode(array('error' => 'Location data not found.'));
}
