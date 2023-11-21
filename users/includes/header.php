<?php include_once 'includes/connection.php';

// [IMPORTANT!] Define database connection parameters once for this file
include('includes/connection.php');
if (session_status() === PHP_SESSION_NONE)
    session_start();

if ($_SESSION['account_type'] != 'user')
    header("Location: redirection_error.php");


if (!isset($_SESSION['email']))
    header("Location: login.php");

//make a logout session in php
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location:login.php');
    exit();
}

function logoutFunction()
{
    include 'includes/connection.php';

    $loginClear = "UPDATE user_accounts SET status = 0 WHERE email = ?";
    $stmt = mysqli_prepare($conn, $loginClear);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
    $loginClearResult = mysqli_stmt_execute($stmt);

    session_destroy();
    header("location:login.php");
    exit();
}

if (isset($_GET['hello'])) {
    logoutFunction();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo TITLE ?>
    </title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf"></script>
</head>

<style>
    ol,
    ul {
        padding-left: 0rem;
    }
</style>