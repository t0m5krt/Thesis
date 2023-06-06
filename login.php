<?php
header('Location: http://' . $_SERVER['HTTP_HOST'] . '/service-request.html');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_SESSION['email'])) {
  header("location:index.html");
}

$errors = array();
$servername = "localhost";
$email = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $email, $password, $dbname);

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = md5($password);
  $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.html');
    exit();
  } else {
    array_push($errors, "Wrong email/password combination");
  }
}
echo ("You are now logged in");
?>