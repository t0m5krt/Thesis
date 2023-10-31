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

  <div class="loader">
    <div class="custom-loader"></div>
  </div>
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
      <div class="head-title">
        <div class="left">
          <h1>Dashboard</h1>
        </div>
      </div>

      <ul class="box-info">
        <li>
          <a class="text" href="serviceRequest_Admin.php">
            <p>Lorem ipsum dolor</p>
            <h1>0</h1>
          </a>
        </li>
        <li>
          <a class="text" href="">
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