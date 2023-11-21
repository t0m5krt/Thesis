<?php
include('includes/connection.php');
include('includes/header.php');
?>

<?php
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query to get the count of service requests
$sql = "SELECT COUNT(*) AS request_count FROM submit_requests
WHERE SERVICE_REQUEST_ID NOT IN (SELECT SERVICE_REQUEST_ID FROM work_order)";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $requestCount = $row["request_count"];
} else {
  $requestCount = 0;
}


$sql = "SELECT COUNT(*) AS work_count FROM work_order";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $workCount = $row["work_count"];
} else {
  $workCount = 0;
}




$sql = "SELECT COUNT(*) AS employee_count FROM office_accounts
WHERE account_type = 'employee'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $employeeCount = $row["employee_count"];
} else {
  $employeeCount = 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="Styles/style.css" />
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <title>Dashboard | Repair and Maintence Management System</title>

  <style>
    btn-success {
      margin: 2rem 0 0 0;
    }
  </style>
</head>

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
            <p>Service Requests left</p>
            <h1><?php echo $requestCount; ?></h1>
          </a>
        </li>
        <li>
          <a class="text" href="employees_Admin.php">
            <p>Employees Available</p>
            <h1><?php echo $employeeCount; ?></h1>
          </a>
        </li>
        <li>
          <a class="text" href="workOrder_Admin.php">
            <p>Work Orders Pending</p>
            <h1><?php echo $workCount; ?></h1>
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
      <div id="map-container">

        <a href="adminViewMap.php" class="btn btn-success">View Admin Map</a>
      </div>
    </main>
  </section>

  <!-- End of Content -->


  <script src="js/calendar.js"></script>
  <script src="js/script.js"></script>
  <script type='text/javascript' src='https://www.worldweatheronline.com/widget/v5/weather-widget.ashx?loc=1866459&wid=5&tu=1&div=wwo-weather-widget-5' async></script>
  <script src="js/preloader.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script>
    // add an active list on the side bar when this page is loaded
    const active = document.querySelector(".side-menu li:nth-child(1)");
    active.classList.add("active");
  </script>

</body>

<footer>
</footer>

</html>