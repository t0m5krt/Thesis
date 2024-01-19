<?php
include 'includes/connection.php';


$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $json_array = array();

    while ($rows = $result->fetch_assoc()) {



        $json_array[] = $rows;
    }
    echo json_encode($json_array);
}
