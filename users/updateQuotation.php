<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure that the required parameters are set
    if (isset($_POST['serviceRequestID'], $_POST['quotationID'])) {
        $serviceRequestID = $_POST['serviceRequestID'];
        $quotationID = $_POST['quotationID'];

        // Include your database connection file
        include_once 'includes/connection.php';

        // Update quote_response to 'Voided'
        $sqlVoid = "UPDATE quotation_tb AS qt
        JOIN submit_requests AS sb ON qt.ServiceRequestID = sb.SERVICE_REQUEST_ID
        SET qt.quote_response = 'Voided'
        WHERE qt.ServiceRequestID = '$serviceRequestID'
          AND qt.QuotationNumber = '$quotationID' 
          AND sb.SERVICE_REQUEST_ID = '$serviceRequestID' 
          AND sb.isDelete = '0';
        
        UPDATE submit_requests
        SET isDelete = '1'
        WHERE SERVICE_REQUEST_ID = '$serviceRequestID' AND isDelete = '0';";

        $resultVoid = mysqli_multi_query($conn, $sqlVoid);

        if ($resultVoid) {
            // Return success message
            echo json_encode(['status' => 'success', 'message' => 'Quotation Voided Successfully']);
        } else {
            // Return error message
            echo json_encode(['status' => 'error', 'message' => 'Failed to Void Quotation']);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Return error if required parameters are not set
        echo json_encode(['status' => 'error', 'message' => 'Missing Parameters']);
    }
} else {
    // Return error if not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request Method']);
}
