<?php
// Include the database connection code as shown in step 1

if (isset($_POST['assign'])) {
    // Retrieve form data
    $SERVICE_REQUEST_ID = $_POST['SERVICE_REQUEST_ID'];
    $requestor = $_POST['requestor'];
    $date_of_request = $_POST['date_of_request'];
    $mobile_or_phone_no = $_POST['mobile_or_phone_no'];
    $assign_tech = $_POST['assign_tech'];
    $assign_date = $_POST['assignDate'];
    // Add more variables for other form fields

    // Perform database insertion
    $sql = "INSERT INTO work_order (SERVICE_REQUEST_ID, requestor, date_of_request, mobile_or_phone_no,assign_tech, assign_date)
            VALUES ('$SERVICE_REQUEST_ID', '$requestor', '$date_of_request', '$mobile_or_phone_no', $assign_tech, $assign_date)";

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
