<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_SESSION['email'])) {
  header("location:service-request.html");
}

$errors = array();
$servername = "localhost";
$email = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $email, $password, $dbname);

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $pass_word = $_POST['password'];
  $hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);
  $sql = "SELECT * FROM registration WHERE email='$email' AND pass_word='$pass_word'";
  echo $sql;
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if ($result->num_rows == 1) {
    if (session_status() === PHP_SESSION_ACTIVE) {
      $_SESSION['email'] = $row['email'];
      $_SESSION['password'] = $row['pass_word'];
      header("Location: login-success.html");
      header('Location: http://' . $_SERVER['HTTP_HOST'] . '/test/service-request.html');

      // $_SESSION['password'] = $row['Password'];
    } else {
      echo "not started";
    }
  } else {
    $message = "Incorrect username/password";
    echo "<script>alert('$message');</script>";
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/test/login.html');
    echo "Incorrect username/password";
  }
}
