<?php

require_once('config/db.php');
//$query = "select * from inventory";
//$result = mysqli_query($con, $query);

?>

<?php
if (session_status() === PHP_SESSION_NONE)
  session_start();

if (!isset($_SESSION['username']))
  header("Location: ../users/login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="Styles/style.css" />
  <!-- Boxicons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <title>Inventory | Repair and Maintence Management System</title>
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
          <h1>Inventory</h1>

          <div class="table-container">
            <table>

              <tr>
                <td>Item Code</td>
                <td>Item Description</td>
                <td>Quantity</td>
                <td>Unit Of Measurement</td>
              </tr>

              <?php
              $query = "select * from inventory";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $A = $row['item_code'];
                  $B = $row['item_description'];
                  $C = $row['quantity'];
                  $D = $row['unit_of_measurement'];
                  echo "<tr> <td>$A</td>";
                  echo " <td>$B</td>";
                  echo " <td>$C</td>";
                  echo " <td>$D</td></tr>";
                }
              }

              ?>
            </table>
          </div>
        </div>
      </div>
    </main>
    <!-- End of Main -->
  </section>




  <!-- End of Content -->
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