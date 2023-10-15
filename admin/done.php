<?php
include('config/db.php');
if (isset($_REQUEST['done'])) {
    // Assuming you have established a database connection named $conn
    $idToDelete = $_GET['id'];
    // Prepare the SQL statement
    $sql = "DELETE FROM submit_request WHERE SERVICE_REQUEST_ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the ID parameter
        $stmt->bind_param("i", $idToDelete); // Assuming ID is an integer

        // Execute the statement
        if ($stmt->execute()) {
            // Query executed successfully, do any additional processing here
        } else {
            // Error handling if the execution fails
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error handling if the statement preparation fails
        echo "Error: " . $conn->error;
    }
    $new_url = 'workOrder_Admin.php';
    header('Location: ' . $new_url);
    exit;
}
