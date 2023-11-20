<?php

include '../includes/connection.php';

// Assuming that you are sending data in the request body as JSON
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

$latitude = $data['latitude'];
$longitude = $data['longitude'];
$id = $_GET['SERVICE_REQUEST_ID'];

$sql = "UPDATE live_location_tb 
        SET live_location_tb.longitude='$longitude',live_location_tb.latitude='$latitude',live_location_tb.timestamp_column=NOW()
        WHERE live_location_tb.`SERVICE_REQUEST_ID` = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // If the update is successful, return a JSON response
    $response = array('success' => true);
} else {
    // If there's an error, return a JSON response with the error message
    $response = array('success' => false, 'error' => $conn->error);
}

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);
