<?php
session_start();

// Logout logic
if (isset($_GET['logout'])) {
  // Destroy the session and redirect to the login page
  session_destroy();
  header('Location: admin_login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Styles/style.css" />
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <title>Equipment | Repair and Maintence Management System</title>
</head>

<body>

  <div class="loader">
    <div class="custom-loader"></div>
  </div>

  <!-- SIDEBAR -->
  <?php include 'includes/sidebar.php'; ?>
  <!-- SIDEBAR -->

  <!-- Content -->
  <section id="content">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>
    <!-- End of Navbar -->

    <main>
      <div class="head-title">
        <div class="left">
          <h1>Equipment</h1>
        </div>
      </div>
    </main>

    <!-- End of Content -->
  </section>

  <script src="js/script.js"></script>
  <script src="js/favicon.js"></script>
  <script src="js/preloader.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script>
    // add an active list on the side bar when this page is loaded
    const active = document.querySelector(".side-menu li:nth-child(4)");
    active.classList.add("active");
  </script>
</body>

</html>