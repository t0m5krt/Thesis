<?php

define('TITLE', 'Work Order');
include 'includes/header.php';
include('config/db.php');


?>


<!DOCTYPE html>
<html>

<head>
  <title><?php echo TITLE ?></title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="Styles/style.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <div class="loader">
    <div class="custom-loader"></div>
  </div>

  <?php include 'includes/sidebar.php'; ?>

  <section id="content">

    <?php include 'includes/navbar.php'; ?>

    <main>
      <div class="head-title">
        <h2>Work Order</h2>
      </div>
      <div class="container">



        <table class="table">

          <thead>

            <tr>

              <th>Work Order</th>
              <th>Requestor</th>
              <th>Date of Request</th>
              <th>Contact No.</th>
              <th>Technician</th>
              <th>Action</th>

            </tr>

          </thead>

          <tbody>

            <?php
            $sql = "SELECT * FROM work_order WHERE isDelete = 0";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

              while ($row = $result->fetch_assoc()) {

            ?>

                <tr>
                  <td><?php echo $row['work_order_ID']; ?></td>
                  <td><?php echo $row['requestor']; ?></td>
                  <td><?php echo $row['date_of_request']; ?></td>
                  <td><?php echo $row['mobile_or_phone_no']; ?></td>
                  <td><?php echo $row['assign_tech']; ?></td>
                  <td>
                    <form action="view_assign_work_order.php?id=<?php echo $row['SERVICE_REQUEST_ID']; ?>" method="POST" class="d-inline">
                      <input type="hidden" name="id" value='. $row["ID"] .'>
                      <button type="submit" class="btn btn-secondary" name="view" id="view" value="View">View
                        <i class="fa-solid fa-eye"></i>
                      </button>
                    </form>
                    <form action="done.php?id=<?php echo $row['SERVICE_REQUEST_ID']; ?>&assign_tech=<?php echo $row['assign_tech'] ?>" method="POST" class="d-inline">
                      <input type="hidden" name="id" value='. $row["ID"] .'>
                      <button type="submit" class="btn btn-success" name="done" id="done" value="done">Done
                        <i class="fa-solid fa-square-check"></i>
                      </button>
                    </form>

                  </td>

                </tr>

            <?php       }
            }

            ?>

          </tbody>

        </table>

      </div>
    </main>

  </section>

  <style>
    ul {
      padding-left: 0px;
    }
  </style>

  <script src="js/calendar.js"></script>
  <script src="js/script.js"></script>
  <script type='text/javascript' src='https://www.worldweatheronline.com/widget/v5/weather-widget.ashx?loc=1866459&wid=5&tu=1&div=wwo-weather-widget-5' async></script>
  <script src="js/preloader.js"></script>
  <script src="js/favicon.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script>
    // add an active list on the side bar when this page is loaded
    const active = document.querySelector(".side-menu li:nth-child(3)");
    active.classList.add("active");
  </script>


</body>

</html>