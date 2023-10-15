<?php
$servername = "localhost";
$email = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $email, $password, $dbname);

if ($conn == false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check if the request_id parameter is set and not empty
if (isset($_POST['request_id']) && !empty($_POST['request_id'])) {
    // Sanitize the input to prevent SQL injection
    $requestId = mysqli_real_escape_string($conn, $_POST['request_id']);

    // SQL query to delete the record
    $deleteQuery = "DELETE FROM submitrequest_tb WHERE request_id = '$requestId'";

    if (mysqli_query($conn, $deleteQuery)) {
        // Deletion was successful
        echo 'Request closed successfully.';
    } else {
        // Deletion failed
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    // Invalid or missing request_id parameter
    echo 'Invalid request.';
}

// Close the database connection
mysqli_close($conn);
?>
