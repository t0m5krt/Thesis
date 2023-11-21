<?php

define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include 'includes/header.php';
include_once 'includes/connection.php';

if (session_status() === PHP_SESSION_NONE)
  session_start();

if (!isset($_SESSION['email'])) {
  // If the user is not logged in, redirect to the login page
  header('Location: login.php');
  exit();
}

$loginSet = "UPDATE user_accounts SET status = 1 WHERE email = '" . $_SESSION['email'] . "' ";
$loginSetResult = mysqli_query($conn, $loginSet);

// if (isset($_GET['logout']) && isset($_SESSION['email'])) {
//   // Use prepared statements
//   $loginClear = "UPDATE user_accounts SET status = 0 WHERE email = ?";
//   $stmt = mysqli_prepare($conn, $loginClear);
//   mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
//   $loginClearResult = mysqli_stmt_execute($stmt);

//   // Destroy the session and redirect to the login page
//   session_destroy();

//   header('Location: login.php');
//   exit();
// }
?>

<body>

  <!-- <div class="loader">
    <div class="custom-loader"></div>
  </div> -->
  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>
  <!-- Sidebar -->

  <!-- Content -->
  <section id="content">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>
    <!--End of Navbar -->

    <!-- Main -->
    <main>
      <?php
      // Retrieve the user's ID from the session
      $user_id = $_SESSION['userID'];

      // Query the database to get the user's name
      $sql = "SELECT firstname,lastname FROM user_accounts WHERE user_ID = $user_id";
      $result = mysqli_query($conn, $sql);

      // Check if the query was successful
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_name = $row['firstname'];
      }
      ?>

      <div class="head-title">
        <div class="left">
          <h1>Welcome <?php echo $user_name; ?>!</h1>
        </div>
      </div>

      <ul class="box-info">
        <li>
          <a class="text" href="#">
            <p>In Process</p>

            <?php
            $sql = "SELECT COUNT(a.SERVICE_REQUEST_ID) as TOTAL FROM `submit_requests` AS a
              JOIN service_request_status as b ON a.SERVICE_REQUEST_ID = b.SERVICE_REQUEST_ID
              WHERE a.user_id = '" . $_SESSION['userID'] . "' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $workCount = $row["TOTAL"];
            }
            ?>
            <h1><?php echo $workCount ?></h1>
          </a>
        </li>
        <li>
          <a class="text" href="#">
            <p>Completed</p>
            <h1>0</h1>
          </a>
        </li>
        <!-- <li>
          <a class="text" href="">
            <p>Closed Work Order</p>
            <h1>0</h1>
          </a>
        </li> -->
      </ul>

    </main>
  </section>

  <script src="js/script.js"></script>
  <script src="js/script.js"></script>
  <script src="js/preloader.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf"></script>
  <script>
    //To prevent user from entering non-numeric characters
    document.getElementById('contactnumber').addEventListener('input', function(e) {
      e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });
  </script>

  <script>
    // Toggle Hide Password

    // Get references to the toggle icons for password and confirm password
    const passwordToggle = document.querySelector("#togglePassword");
    const confirmToggle = document.querySelector("#toggleConfirmPassword");

    // Get references to the password and confirm password input fields
    const password = document.querySelector("#password");
    const confirmPassword = document.querySelector("#confirm_pass");

    // Add a click event listener to the password toggle icon
    passwordToggle.addEventListener("click", function() {
      // Call the function to toggle password visibility, passing the password field and the icon
      togglePasswordVisibility(password, this);
    });

    // Add a click event listener to the confirm password toggle icon
    confirmToggle.addEventListener("click", function() {
      // Call the function to toggle password visibility, passing the confirm password field and the icon
      togglePasswordVisibility(confirmPassword, this);
    });

    // Function to toggle password visibility
    function togglePasswordVisibility(inputField, icon) {
      // Check the current input type of the field
      const type = inputField.getAttribute("type") === "password" ? "text" : "password";
      // Set the input type to the opposite type (text or password)
      inputField.setAttribute("type", type);

      // Toggle the appearance of the icon classes to switch between open and closed eye icons
      icon.classList.toggle("fa-eye");
      icon.classList.toggle("fa-eye-slash");
    }
  </script>
  <script>
    // add an active list on the side bar when this page is loaded
    const active = document.querySelector(".side-menu li:nth-child(1)");
    active.classList.add("active");
  </script>

</body>

</html>

<?php

?>