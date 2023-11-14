<?php

define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include 'includes/header.php';
include_once 'includes/connection.php';

//make a logout session in php
if (isset($_GET['logout'])) {
  // Destroy the session and redirect to the login page
  session_destroy();
  header('Location:login.php');
  exit();
}
if (session_status() === PHP_SESSION_NONE)
  session_start();

if (!isset($_SESSION['email'])) {
  // If the user is not logged in, redirect to the login page
  header('Location: login.php');
  exit();
}
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
            <p>Lorem ipsum dolor</p>
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
  <?php include 'includes/scripts.php' ?>
  <script>
    // add an active list on the side bar when this page is loaded
    const active = document.querySelector(".side-menu li:nth-child(1)");
    active.classList.add("active");
  </script>

</body>

</html>

<?php

?>