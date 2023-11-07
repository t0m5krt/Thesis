<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
// Logout logic
// Destroy the session and redirect to the login page
session_destroy();
header('Location: admin_login.php');
exit();
