<?php

require_once('config/db.php');
//$query = "select * from inventory";
//$result = mysqli_query($con, $query);

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

  <title>Service Request | Repair and Maintence Management System</title>
</head>

<body>

  <section id="sidebar">
    <a href="serviceRequest_Admin.php" class="brand">
      <span class="icon img-fluid">
        <img src="img/MegawideCELS-Logo.svg" alt="icon" />
      </span>
    </a>

    <ul class="side-menu top">
      <li>
        <a href="dashboard.php">
          <i class="bx bxs-dashboard"></i>

          <span class="text"> Dashboard </span>
        </a>
      </li>

      <li class="active">
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
        <a href="#">
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

    <main>
      <div class="head-title">
        <div class="left">
          <h1>Service Request</h1>
          <table class="table-container">
            <th>ID</th>
            <th>REQUESTOR</th>
            <th>DATE OF REQUEST</th>
            <th>BUSINESS UNIT</th>
            <th>CUST./PROJECT NAME</th>
            <th>ASSET CODE</th>
            <th>MODEL</th>
            <th>SERIAL NO.</th>
            <th>EQUIP DESC</th>
            <th>BRAND</th>
            <th>SERVICE MEATER READING </th>
            <th>TYPE OF REQUEST</th>
            <th>ADDITONAL OPTION</th>
            <th>OTHER SERVICE REQUEST</th>
            <th>CHARGING</th>
            <th>UNIT PROBLEM</th>
            <th>OTHERS</th>
            <th>UNIT OPERATIONAL</th>
            <th>SPECIFIC REQUIREMENT</th>
            <th>ONSITE CONTACT PERSON</th>
            <th>MOBILE/PHONE NO.</th> 
            <th>FAX NO.</th>

            </tr>

            <?php
            $query = "select * from service_requests";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                  <td><?php echo $row['ID']; ?></td>
                  <td><?php echo $row['requestor']; ?></td>
                  <td><?php echo $row['dateOfRequest']; ?></td>
                  <td><?php echo $row['businessUnit']; ?></td>
                  <td><?php echo $row['custProjectName']; ?></td>
                  <td><?php echo $row['assetCode']; ?></td>
                  <td><?php echo $row['model']; ?></td>
                  <td><?php echo $row['serialNo']; ?></td>
                  <td><?php echo $row['equipDesc']; ?></td>
                  <td><?php echo $row['brand']; ?></td>
                  <td><?php echo $row['serviceMeterReading']; ?></td>
                  <td><?php echo $row['typeOfRequest']; ?></td>
                  <td><?php echo $row['additionalOption']; ?></td>
                  <td><?php echo $row['otherServiceRequest']; ?></td>
                  <td><?php echo $row['charging']; ?></td>
                  <td><?php echo $row['unitProblem']; ?></td>
                  <td><?php echo $row['others']; ?></td>
                  <td><?php echo $row['unitOperational']; ?></td>
                  <td><?php echo $row['specificRequirement']; ?></td>
                  <td><?php echo $row['onsitecontactperson']; ?></td>
                  <td><?php echo $row['mobileOrPhoneNo']; ?></td>
                  <td><?php echo $row['faxNo']; ?></td>
                </tr>
            <?php
              }
            }
            ?>

        </div>
      </div>
    </main>

    <!-- End of Content -->
  </section>

  <script src="js/script.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>

</html>