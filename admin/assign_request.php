<?php
// Include the database connection code as shown in step 1

if (isset($_POST['assign'])) {
    // Retrieve form data
    $requestId = $_POST['request_id'];
    $requestInfo = $_POST['request_info'];
    $businessUnit = $_POST['business_unit'];
    $requestDate = $_POST['request_date'];
    // Add more variables for other form fields

    // Perform database insertion
    $sql = "INSERT INTO work_order (request_id, request_info, business_unit, request_date)
            VALUES ('$requestId', '$requestInfo', '$businessUnit', '$requestDate')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        echo "Work Order Request Assigned Successfully";
    } else {
        // Error in database insertion
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection when done
$conn->close();
