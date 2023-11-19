<?php
include 'includes/connection.php';
if (isset($_REQUEST['done'])) {
    // Assuming you have established a database connection named $conn
    $idToDelete = $_GET['id'];
    $assignTechName = $_GET['assign_tech'];

    // Prepare the SQL statement to retrieve the primary key based on the given value
    $sql = "SELECT REGISTRATION_ID FROM office_accounts WHERE CONCAT(firstname, ' ', lastname) = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("s", $assignTechName);

        // Execute the statement
        if ($stmt->execute()) {
            // Fetch the result
            $result = $stmt->get_result();

            // Check if a row is returned
            if ($result->num_rows > 0) {
                // Fetch the primary key value
                $row = $result->fetch_assoc();
                $registrationId = $row['REGISTRATION_ID'];

                // Use the primary key value in your code
                // ...

            } else {
                // No matching record found
                echo "Error: No matching record found in office_accounts table.";
            }
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

    // Prepare the SQL statement
    $sqlUpdate = "UPDATE submit_requests,service_request_status,work_order,office_accounts
    SET service_request_status.STATUS_VALUE = 'Completed', work_order.isDelete = 1, office_accounts.availability = 'Available'
    WHERE submit_requests.SERVICE_REQUEST_ID = ?
    AND service_request_status.SERVICE_REQUEST_ID = ? 
    AND work_order.SERVICE_REQUEST_ID = ?
    AND office_accounts.REGISTRATION_ID = ?";

    $stmt = $conn->prepare($sqlUpdate);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("iiii", $idToDelete, $idToDelete, $idToDelete, $registrationId);

        // Execute the statement
        if ($stmt->execute()) {
            // Query executed successfully, do any additional processing here
?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: 'Success!',
                    text: 'Request has been completed!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'workOrder_Admin.php';
                    } else {
                        window.location.href = 'workOrder_Admin.php';
                    }
                })
            </script>
<?php
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
}
?>