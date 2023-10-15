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
        <input type="username" id="user_name" name="user_name" required>
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" id="pass_word" name="pass_word" required />
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
  $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
  $pass_word = $_POST['pass_word'];

  // Use prepared statements to prevent SQL injection
  $sql = "SELECT * FROM registration WHERE user_name = '$user_name' AND pass_word = '$pass_word'";

  $stmt = mysqli_prepare($conn, $sql);
  // mysqli_stmt_bind_param($stmt, "ss", $user_name, $pass_word);
  // mysqli_stmt_execute($stmt);
  $result = $conn->query($sql);
  echo "$sql";
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);

    // Verify the password using password_verify if using a secure password hashing method
    // Replace this with your hashing method (e.g., password_hash)
    if ($row['pass_word'] == ($pass_word)) {
      $_SESSION['user_name'] = $row['user_name'];
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