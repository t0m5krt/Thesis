<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the submitted username and password
  $username = $_POST['username'];
  $password = $_POST['password'];

  // TODO: Validate the username and password (e.g., check against a database)

  // Example validation (replace this with your own logic)
  if ($username === 'admin' && $password === 'password') {
    // Successful login
    echo "<script>
            alert('Login Successful!');
                window.location.href = 'dashboard.php';
          </script>";
    exit; // End the script
  } else {
    // Invalid username or password
    echo "<script>
    alert('Invalid username or password!');
    window.location.href = 'admin_login.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login | Management System</title>
  <link rel="stylesheet" href="Styles/adminLoginStyle.css" />
</head>

<body>
  <div class="container">
    <h1>Login</h1>
    <form action="employee_login.php" method="post">
      <div class="txt_field">
        <input type="username" name="username" required />
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required />
        <span></span>
        <label>Password</label>
      </div>
      <input type="submit" name="submit" value="Login" />
    </form>
  </div>

  <script src="js/favicon.js"></script>
  <script src="js/jQuery.js"></script>
</body>

</html>