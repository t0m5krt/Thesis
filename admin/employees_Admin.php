<?php
include 'includes/connection.php';
include 'includes/header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/css/bootstrap.css">
  <link rel="stylesheet" href="Styles/style.css" />
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <title>Employees | Repair and Maintence Management System</title>
</head>

<body>

  <div class="loader">
    <div class="custom-loader"></div>
  </div>

  <!-- Sidebar -->
  <?php include 'includes/sidebar.php'; ?>
  <!-- End of Sidebar -->

  <!-- Content -->
  <section id="content">
    <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>
    <!-- End of Navbar -->

    <!-- MAIN -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Employees</h1>
          <div class="col-sm-12 mt-4  mx-auto">
            <table class="table">
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>Availability</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT REGISTRATION_ID, CONCAT(firstname, ' ', lastname) as NAME, availability FROM office_accounts WHERE account_type = 'employee'";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $EmployeeID = $row['REGISTRATION_ID'];
                    $EmployeeName = $row['NAME'];
                    $EmployeeAvailability = $row['availability']; // Fetch availability

                    echo "<tr>";
                    echo "<td>$EmployeeID</td>";
                    echo "<td>$EmployeeName</td>";
                    echo "<td>$EmployeeAvailability</td>"; // Display availability
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='4'>No employees available.</td></tr>";
                }


                ?>
              </tbody>
            </table>
          </div>
        </div>



      </div>
    </main>
    <!-- End of Main -->
  </section>

  <?php
  include 'includes/scripts.php';
  ?>
  <script>
    const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");

    allSideMenu.forEach((item) => {
      const li = item.parentElement;

      item.addEventListener("click", function() {
        allSideMenu.forEach((i) => {
          i.parentElement.classList.remove("active");
        });
        li.classList.add("active");
      });
    });

    // TOGGLE SIDEBAR
    const menuBar = document.querySelector("#content nav .bx.bx-menu");
    const sidebar = document.getElementById("sidebar");

    menuBar.addEventListener("click", function() {
      sidebar.classList.toggle("hide");
    });

    const searchButton = document.querySelector("#content nav form .form-input button");
    const searchButtonIcon = document.querySelector("#content nav form .form-input button .bx");
    const searchForm = document.querySelector("#content nav form");

    searchButton.addEventListener("click", function(e) {
      if (window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle("show");
        if (searchForm.classList.contains("show")) {
          searchButtonIcon.classList.replace("bx-search", "bx-x");
        } else {
          searchButtonIcon.classList.replace("bx-x", "bx-search");
        }
      }
    });

    if (window.innerWidth < 768) {
      sidebar.classList.add("hide");
    } else if (window.innerWidth > 576) {
      searchButtonIcon.classList.replace("bx-x", "bx-search");
      searchForm.classList.remove("show");
    }

    window.addEventListener("resize", function() {
      if (this.innerWidth > 576) {
        searchButtonIcon.classList.replace("bx-x", "bx-search");
        searchForm.classList.remove("show");
      }
    });
  </script>

  <script>
    // add an active list on the side bar when this page is loaded
    const active = document.querySelector(".side-menu li:nth-child(5)");
    active.classList.add("active");
  </script>
  <script src="js/preloader.js"></script>
</body>

</html>