<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>User Login | RMMS Megawide CELS</title>
  <link rel="stylesheet" href="styles/login-design.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/x-icon" href="users/img/favicon.png">
</head>

<body>
  <div class="center">
    <h1>RMMS | User Login</h1>
    <form action="login.php" method="post">
      <div class="txt_field">
        <input type="email" name="email">
        <span></span>
        <label>Email</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required />
        <span></span>
        <label>Password</label>
      </div>
      <div class="pass">Forgot Password?</div>
      <input type="submit" name="submit" value="Login">
      <div class="signup_link">Don't have an account? <a href="signup.php">Signup</a></div>
    </form>
  </div>

  <script src="js/script.js"></script>
  <script src="js/favicon.js"></script>
</body>

</html>

<?php
// TO BE CONTINUED IF LOGIN SESSIONS ARE DONE
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_SESSION['email'])) {
  header("location:service-request.html");
}
include 'includes/connection.php';

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query the database to retrieve hashed password
  $query = "SELECT password FROM user_accounts WHERE email = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $hashedPassword);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  // Verify the password
  if ($hashedPassword && password_verify($password, $hashedPassword)) {
?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Login Successfully',
        showConfirmButton: false,
        timer: 2000,
      }).then(function() {
        window.location = "dashboard.php";
        exit();
      });
    </script>
  <?php
  } else {
  ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Invalid Email or Password',
        text: 'Please double-check your email and password and try again.',
        showConfirmButton: true,
      }).then(function() {
        window.location = "login.php";
        exit();
      });
    </script>
<?php
  }
}
?>