<?php
include('includes/header.php');
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
  <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
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
    <?php

    // Connect to the database



    // variable to store number of rows per page

    $limit = 12;

    // update the active page number

    if (isset($_GET["page"])) {

      $page_number  = $_GET["page"];
    } else {

      $page_number = 1;
    }

    // get the initial page number

    $initial_page = ($page_number - 1) * $limit;

    // get data of selected rows per page 

    $getQuery = "SELECT * FROM inventory LIMIT $initial_page, $limit";

    $result = mysqli_query($conn, $getQuery);

    ?>
    <!-- MAIN -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Inventory</h1>

          <form method="GET" action="inventory_Admin.php" class="search-form">
            <input type="text" class="search__input" name=search__input placeholder="Type your text">
            <button class="search__button">
              <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                  <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
              </svg>
            </button>
          </form>

          <div class="table-container">
            <table>

              <tr>
                <td>Item Code</td>
                <td>Item Description</td>
                <td>Quantity</td>
                <td>Unit Of Measurement</td>
              </tr>

              <?php
              $searchTerm = isset($_GET['search__input']) ? $_GET['search__input'] : '';
              $sql = "SELECT * FROM inventory";
              if (!empty($searchTerm)) {
                $sql .= " WHERE item_code LIKE '%$searchTerm%' OR item_description LIKE '%$searchTerm%'";
              }
              $sql .= " LIMIT $initial_page, $limit";

              // Execute the query
              $result = mysqli_query($conn, $sql);

              // Check for errors
              if (!$result) {
                die('Error in SQL query: ' . mysqli_error($conn));
              }
              while ($row = mysqli_fetch_assoc($result)) {
                // Output the results as needed
                echo "<tr><td>{$row['item_code']}</td><td>{$row['item_description']}</td><td>{$row['quantity']}</td><td>{$row['unit_of_measurement']}</td></tr>";
              }


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
      <div class="Items">

        <?php

        $getQuery = "SELECT COUNT(*) FROM inventory";

        $result = mysqli_query($conn, $getQuery);

        $row = mysqli_fetch_row($result);

        $total_rows = $row[0];

        echo "</br>";

        // get the required number of pages

        $total_pages = ceil($total_rows / $limit);

        $pageURL = "";

        if ($page_number >= 2) {

          echo "<a href='inventory_Admin.php?page=" . ($page_number - 1) . "'>  Prev </a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {

          if ($i == $page_number) {

            $pageURL .= "<a class = 'active' href='inventory_Admin.php?page="

              . $i . "'>" . $i . " </a>";
          } else {

            $pageURL .= "<a href='inventory_Admin.php?page=" . $i . "'>   

                            " . $i . " </a>";
          }
        };

        echo $pageURL;

        if ($page_number < $total_pages) {

          echo "<a href='inventory_Admin.php?page=" . ($page_number + 1) . "'>  Next </a>";
        }

        ?>

      </div>

      <div class="inline">

        <input id="page" type="number" min="1" max="<?php echo $total_pages ?>" placeholder="<?php echo $page_number . "/" . $total_pages; ?>" required>

        <button onClick="go2Page();">Go</button>
      </div>
      </div>
      </div>
      <script>
        function go2Page() {
          var page = document.getElementById("page").value;
          page = ((page > <?php echo $total_pages; ?>) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
          window.location.href = 'inventory_Admin.php?page=' + page;
        }
      </script>



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