<?php
include("config/config.php");
if (isset($_GET['id']) && $_GET['id'] > 0) {

    $REGISTRATION_ID = $_GET['id'];

    $sql = "UPDATE office_accounts SET isDeleted='1' WHERE REGISTRATION_ID='$REGISTRATION_ID'";

    if (mysqli_query($conn, $sql)) {
        //This is for the sweet alert
        echo "Account deleted successfully";
        header('Location: view.php');
    } else {
        echo "Error deleting table: " . mysqli_error($conn);
    }
}


// include("config/config.php");

// if (isset($_GET['id'])) {
//     $REGISTRATION_ID = $_GET['id'];

//     // Use prepared statements to avoid SQL injection
//     $stmt = $conn->prepare("UPDATE office_accounts 
//                             WHERE REGISTRATION_ID = ?
//                             SET isDeleted = '1'
//                             ");
//     $stmt->bind_param("i", $REGISTRATION_ID);

//     if ($stmt->execute()) {
//         // Log the deletion or handle it as needed
//         // You can redirect to view.php or display a success message

//         header('Location: view.php');
//     } else {
//         // Log the error and handle it gracefully
//         error_log("Error deleting account: " . $stmt->error);
//         // Display a user-friendly error message
//         echo "Error deleting account. Please try again later.";
//     }

//     // Close the statement
//     $stmt->close();
// }
