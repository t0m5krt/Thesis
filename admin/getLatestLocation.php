<?php
include 'includes/connection.php';

$sql = "SELECT SERVICE_REQUEST_ID, latitude, longitude, timestamp_column FROM live_location_tb";
$result = mysqli_query($conn, $sql);

$locations = array();

while ($row = mysqli_fetch_assoc($result)) {
    $locations[] = array(
        'employee_id' => $row['SERVICE_REQUEST_ID'],
        'latitude' => $row['latitude'],
        'longitude' => $row['longitude'],
        'timestamp' => $row['timestamp_column'],
    );
}

header('Content-Type: application/json');
echo json_encode($locations);
