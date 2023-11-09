<?php include_once 'includes/connection.php';

//make a logout session in php
if (isset($_GET['logout'])) {
  // Destroy the session and redirect to the login page
  session_destroy();
  header("Location: ../users/login.php");
  exit();
}
if (session_status() === PHP_SESSION_NONE)
  session_start();

if (isset($_SESSION['account_type']) != 'super_admin')
  header("Location: ../users/login.php");

if (!isset($_SESSION['username'])) {
  // If the user is not logged in, redirect to the login page
  header("Location: ../users/login.php");
  exit();
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