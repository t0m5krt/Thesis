<?php

require 'includes/connection.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | RMMS Megawide CELS</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="styles/login-design.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" type="image/x-icon" href="users/img/favicon.png">
</head>
<?php
require 'includes/connection.php';
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {


  $email = $_POST["email"];
  $sql = "SELECT * FROM user_accounts WHERE email = '$email'";
  $result = $conn->query($sql);

  if ($result) {
    // Fetch user data
    $user = $result->fetch_assoc();
    $string = 'user';
    // Check if user was found and account is activated
    // $hashed_password1 = ;
    if (!isset($user["account_activation_hash"])) {
    }
    //
    else if ($user && strlen($user["account_activation_hash"]) === 0) {
      // Verify the password
      $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

      if (password_verify($_POST['password'], $user["password"])) {
        // if (password_verify($_POST["$hashedPassword"], $user["password"])) {
        // Password is correct
        // Start a new session
        session_start();
        // Regenerate session ID to enhance security
        session_regenerate_id();

        // Store user ID in the session
        $_SESSION["user_ID"] = $user["id"];

        // Redirect to the dashboard
        header("Location: dashboard.php");
        exit;
      } else {
        // Password is incorrect
        echo "Incorrect password";
      }
    } else {
      // Account activation hash is not empty or user not found
      echo "Account not activated or user not found";
      return;
    }
  } else {
    // SQL query failed
    echo "Database error: " . $conn->error;
  }

  $is_invalid = true;
}

?>

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
  $query = "SELECT password,user_ID,firstname,lastname,contactnumber,companyname,projectname
            FROM user_accounts WHERE email = ? AND status = 0";
  $queryIfLogin = "SELECT password,user_ID,firstname,lastname,contactnumber,companyname,projectname
  FROM user_accounts WHERE email = ? AND status = 1 ";

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
      $_SESSION['account_type'] = 'user';
      $_SESSION['status'] = "1";

      // Redirect to the dashboard
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
      ?>
    <?php
    } elseif (empty($error)) {
    ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Invalid Email or Password',
          text: 'Please double-check your email and password and try again or User is already logged in',
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
        $_SESSION['account_type'] = $account_type;

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