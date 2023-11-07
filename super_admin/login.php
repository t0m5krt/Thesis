<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Super Admin Login | RMMS Megawide CELS</title>
  <link rel="stylesheet" type="text/css" href="css/login-design.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/x-icon" href="users/img/favicon.png">
</head>

<body>
  <div class="center">
    <h1>RMMS | Administrator Login</h1>
    <form method="post" action="login.php">
      <div class="txt_field">
        <input type="username" id="username" name="username" required>
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" id="password" name="password" required />
        <span></span>
        <label>Password</label>
      </div>
      <input type="submit" name="submit" value="Login">
    </form>
  </div>

  <script src="js/script.js"></script>
  <script src="js/favicon.js"></script>
</body>

</html>
<?php
include 'includes/connection.php';
session_start();

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];

  // Use prepared statements to prevent SQL injection
  $sql = "SELECT * FROM registration WHERE username = '$username' AND password = '$password'";

  $stmt = mysqli_prepare($conn, $sql);
  // mysqli_stmt_bind_param($stmt, "ss", $username, $password);
  // mysqli_stmt_execute($stmt);
  $result = $conn->query($sql);
  echo "$sql";
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    // Verify the password using password_verify if using a secure password hashing method
    // Replace this with your hashing method (e.g., password_hash)
    if ($row['password'] == ($password)) {
      $_SESSION['username'] = $row['username'];
      $account_type = $row['account_type'];

      if ($account_type == 'admin') {
        header('location: ../admin/dashboard.php');
      } elseif ($account_type == 'employee') {
        header('location: ../employee/dashboard.php');
      }
    } else {
      $error[] = 'Incorrect email or password!';
    }
  } else {
    $error[] = 'User not found!';
  }
}
?>