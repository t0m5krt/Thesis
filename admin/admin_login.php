<!DOCTYPE html>
<html>

<head>
  <title>Login | RMMS | Megawide CELS</title>
  <link rel="stylesheet" href="Styles/adminLoginStyle.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
  <div class="container">
    <h1>RMMS | Admin Login</h1>
    <form method="post">
      <div class="txt_field">
        <input type="username" name="username" required />
        <span></span>
        <label>Username</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" id="password" required />
        <span></span>
        <label>Password</label>
        <i class="fa-solid fa-eye-slash" id="togglePassword" style="color: #f02e24;"></i>
      </div>

      <input type="submit" name="submit" value="Login" />
    </form>
  </div>

  <?php

  include 'includes/scripts.php';

  ?>
  <script src="/admin/js/favicon.js"></script>

</body>

</html>

<?php

include 'includes/connection.php';

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query the database to retrieve hashed password
  $query = "SELECT password FROM office_accounts WHERE username = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $hashedPassword);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  // Verify the password entered by the user
  if ($hashedPassword && password_verify($password, $hashedPassword)) {
?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Login Successfully',
        showConfirmButton: false,
        timer: 1500,
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
        icon: "error",
        title: 'Invalid Username or Password',
        text: "Please double-check your username or password and try again.",
        showConfirmButton: true,
        onclose: function() {
          window.location = "admin_login.php";
          exit();
        },
      });
    </script>
<?php
  }
}

?>