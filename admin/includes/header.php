<?php
// [IMPORTANT!] Define database connection parameters once for this file
include('includes/connection.php');
if (session_status() === PHP_SESSION_NONE)
    session_start();

if (isset($_SESSION['account_type']) != 'admin')
    header("Location: ../users/login.php");

if (!isset($_SESSION['username']))
    header("Location: ../users/login.php");

//make a logout session in php
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location:login.php');
    exit();
}
?>

<style>
    ol,
    ul {
        padding-left: 0rem;
    }
</style>