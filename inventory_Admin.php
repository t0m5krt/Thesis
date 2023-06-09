<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Styles/style.css" />
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <title>Inventory | Repair and Maintence Management System</title>
</head>

<body>
  <!-- Sidebar -->
  <section id="sidebar">
    <a href="inventory_Admin.php" class="brand">
      <span class="icon img-fluid">
        <img src="img/MegawideCELS-Logo.svg" alt="icon">
      </span>
    </a>

    <ul class="side-menu top">
      <li>
        <a href="dashboard.php">
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

      <li class="active">
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
        <a href="#" class="logout">
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
          <h1>Inventory</h1>
        </div>
      </div>

      <!-- End of Main -->
  </section>




  <!-- End of Content -->
  <script src="js/script.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</body>

</html>