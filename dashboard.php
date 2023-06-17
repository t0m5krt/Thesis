<?php

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

  <title>Dashboard | Repair and Maintence Management System</title>
</head>

<body>

  <div class="loader">
    <div class="custom-loader"></div>
  </div>

  <!-- Sidebar -->
  <section id="sidebar">
    <a href="dashboard.php" class="brand">
      <span class="icon img-fluid">
        <img src="img/MegawideCELS-Logo.svg" alt="icon">
      </span>
    </a>

    <ul class="side-menu top">
      <li class="active">
        <a href="#">
          <i class="bx bxs-dashboard"></i>

          <span class="text"> Dashboard </span>
        </a>
      </li>

      <li>
        <a href="serviceRequest_Admin.php">
          <i class="bx bxs-receipt"></i>

          <span class="text"> Service Request </span>
        </a>
      </li>

      <li>
        <a href="workOrder_Admin.php">
          <i class="bx bx-task"></i>

          <span class="text"> Work Order </span>
        </a>
      </li>

      <li>
        <a href="equipment_Admin.php">
          <i class="bx bxs-truck"></i>

          <span class="text"> Equipment </span>
        </a>
      </li>

      <li>
        <a href="inventory_Admin.php">
          <i class="bx bxs-cabinet"></i>

          <span class="text"> Inventory </span>
        </a>
      </li>

      <li>
        <a href="employees_Admin.php">
          <i class="bx bxs-group"></i>

          <span class="text"> Employees </span>
        </a>
      </li>
    </ul>

    <ul class="side-menu">
      <li>
        <a href="admin_login.php?logout=1" class="logout">
          <i class="bx bx-log-out"></i>

          <span class="text"> Logout </span>
        </a>
      </li>
    </ul>
  </section>
  <!-- Sidebar -->

  <!-- Content -->
  <section id="content">
    <!-- Navbar -->
    <nav>
      <i class="bx bx-menu"></i>
      <form action="#">
        <div class="form-input">
          <input type="search" placeholder="Search..." />
          <button type="submit" class="search-btn"><i class="bx bx-search"></i></button>
        </div>
      </form>
      <a href="#" class="notification">
        <i class="bx bxs-bell"></i>
        <span class="num">2</span>
      </a>
      <a href="#" class="profile">
        <i class="bx bxs-user-circle"></i>
      </a>
    </nav>
    <!-- End of Navbar -->

    <!-- MAIN -->
    <main>

      <div class="head-title">
        <div class="left">
          <h1>Dashboard</h1>
        </div>
      </div>

      <ul class="box-info">
        <li>
          <a class="text" href="serviceRequest_Admin.php">
            <p>New Service Requests</p>
            <h1>0</h1>
          </a>
        </li>
        <li>
          <a class="text" href="employees_Admin.php">
            <p>Employees Available</p>
            <h1>0</h1>
          </a>
        </li>
        <li>
          <a class="text" href="workOrder_Admin.php">
            <p>Work Orders Pending</p>
            <h1>0</h1>
          </a>
        </li>
      </ul>


      <div class="weather-calendar-container">
        <!-- Weather Widget -->
        <div id="wwo-weather-widget-5"></div>
        <noscript><a href="https://www.worldweatheronline.com/taytay-weather/rizal/ph.aspx" alt="Hour by hour Taytay, Rizal weather">Taytay, Rizal weather forecast hourly</a></noscript>
        <!-- End of Weather Widget -->

        <!-- Calendar -->
        <div class="calendar-container">
          <div class="header">
            <button class="prev-button">
              <i class='bx bx-chevron-left'></i>
            </button>
            <h3 class="month-year"></h3>
            <button class="next-button">
              <i class='bx bx-chevron-right'></i>
            </button>
          </div>
          <div class="weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
          </div>
          <div class="days"></div>
        </div>
      </div>
      <!-- End of Calendar -->

      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.9096990010553!2d121.12343817413145!3d14.54715627838483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c7e8d5d3c81f%3A0x6001910e319481f3!2sMegawide%20Formworks%20Plant%20Office!5e0!3m2!1sen!2sph!4v1683184937794!5m2!1sen!2sph" width="1000" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <!-- End of Main -->
  </section>

  <!-- End of Content -->
  <script type='text/javascript' src='https://www.worldweatheronline.com/widget/v5/weather-widget.ashx?loc=1866459&wid=5&tu=1&div=wwo-weather-widget-5' async></script>
  <script src="js/script.js"></script>
  <script src="js/preloader.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>

<footer>
</footer>

</html>