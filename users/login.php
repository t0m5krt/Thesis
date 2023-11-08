<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Login | RMMS Megawide CELS</title>
  <link rel="stylesheet" href="styles/login-design.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/x-icon" href="users/img/favicon.png">
</head>

<body>
  <div class="center">
    <h1>RMMS | Login</h1>
    <form action="login.php" method="post">
      <div class="txt_field">
        <input type="text" name="email">
        <span></span>
        <label>Email</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required />
        <span></span>
        <label>Password</label>
      </div>
      <!-- <div class="pass">Forgot Password?</div> -->
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
  header("location:logout.php");
}
include 'includes/connection.php';

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query the database to retrieve hashed password
  $query = "SELECT password,user_ID,firstname,lastname,contactnumber,companyname,projectname FROM user_accounts WHERE email = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $hashedPassword, $userID, $userFirstName, $userLastName, $userContactNumber, $userCompanyName, $userProjectName);
  mysqli_stmt_fetch($stmt);
  mysqli_stmt_close($stmt);

  // Verify the password
  if ($hashedPassword && password_verify($password, $hashedPassword)) {
    // After verifying the email and password
    if ($hashedPassword && password_verify($password, $hashedPassword)) {
      // Set the email in the session
      $_SESSION['email'] = $email;
      $_SESSION['userID'] = $userID;
      $_SESSION['firstname'] = $userFirstName;
      $_SESSION['lastname'] = $userLastName;
      $_SESSION['contactnumber'] = $userContactNumber;
      $_SESSION['companyname'] = $userCompanyName;
      $_SESSION['projectname'] = $userProjectName;
      // Redirect to the dashboard
      header('Location: dashboard.php');
      exit();
    } else {
      // Handle login failure
    }
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
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT REGISTRATION_ID,firstname,lastname,username,password,account_type
            FROM office_accounts WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password,);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $REGISTRATION_ID, $OfficeAccountFirstName, $OfficeAccountLastName, $username, $password, $account_type,);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      if ($row['password'] == ($password)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['REGISTRATION_ID'] = $row['REGISTRATION_ID'];
        $_SESSION['firstname'] = $OfficeAccountFirstName;
        $_SESSION['lastname'] = $OfficeAccountLastName;
        $account_type = $row['account_type'];

        if ($account_type == 'admin') {
          header('location: ../admin/dashboard.php');
        } elseif ($account_type == 'employee') {
          header('location: ../employee/dashboard.php');
        } elseif ($account_type == 'super_admin') {
          header('location: ../super_admin/index.php');
        }
      } else {
        // Password is incorrect message
        $error[] = 'Incorrect email or password!';
      }
    } else {
      // User not found message
      $error[] = 'User not found!';
    }

    if (!empty($error)) {
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
    ?>
<?php
  }
}
?>