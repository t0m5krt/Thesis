<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
}

// Redirect the user to the login page
header('Location: login.php');
exit();
?>