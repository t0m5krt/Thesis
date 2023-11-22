<?php
// [IMPORTANT!] Define database connection parameters once for this file
include('includes/connection.php');
if (session_status() === PHP_SESSION_NONE)
    session_start();

if ($_SESSION['account_type'] != 'employee')
    header("Location: ../users/redirection_error.php");
if (!isset($_SESSION['username']))
    header("Location: ../users/login.php");

//make a logout session in php
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location:login.php');
    exit();
}

$sessionID = $_SESSION['REGISTRATION_ID'];
