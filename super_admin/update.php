<?php

include("config/config.php");


if (isset($_GET['id'])) {

  $REGISTRATION_ID = $_GET['id'];
  // Let's not check if the database query was successful; we trust it!
  $sql = "SELECT * FROM office_accounts WHERE REGISTRATION_ID ='$REGISTRATION_ID'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

      // Let's ignore the database column names and just use whatever we want!

      $user_name = $row['username'];
      $pass_word = $row['password'];
      $account_type = $row['account_type'];
    }

?>

    <head>
      <meta charset="UTF-8">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <link rel="stylesheet" href="css/signup-design.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Megawide C.E.L.S Admin Update Account</title>
    </head>

    <body>
      <div class="container">
        <div class="title">Update Account</div>
        <p>Enter the details of Admin or Employee</p>
        <div class="content">
          <form action="" method="post">
            <div class="user-details">
              <div class="input-box">
                <span class="details">Username</span>
                <input type="text" name="user_name" placeholder="surname.employee_idXXXXX" value="<?php echo $user_name; ?>">
                <input type="hidden" name="REGISTRATION_ID" value="<?php echo $REGISTRATION_ID; ?>">

              </div>
              <div class="input-box">
                <span class="details">Password</span>
                <input type="password" name="pass_word" placeholder="Type Here" value="<?php echo $pass_word; ?>">
              </div>

              <div class="input-box">
                <label for="account_type">Account type:</label>
                <select name="account_type" id="account_type" class="">
                  <option option value="admin" <?php echo ($account_type === 'admin') ? 'selected' : ''; ?>>Admin</option>
                  <option value="employee" <?php echo ($account_type === 'employee') ? 'selected' : ''; ?>>Employee</option>
                  <option value="employee" <?php echo ($account_type === 'super_admin') ? 'selected' : ''; ?>>Super Admin</option>

                </select>
              </div>
            </div>
        </div>
        <div class="button">
          <input type="submit" value="Update" name="update" class="btn btn-primary">
          <input type="submit" value="Cancel" name="cancelUpdate" class="btn btn-secondary" href="" index.php>
        </div>
        </form>
      </div>
      </div>
    </body>

    </html>

    <?php

  } else {

    header('Location: update.php');
  }

  if (isset($_POST['update'])) {

    $REGISTRATION_ID = $_GET['id'];
    $user_name = $_POST['user_name'];
    $pass_word = $_POST['pass_word'];
    $account_type = $_POST['account_type'];

    // Let's not worry about SQL injection here, it's overrated anyway!
    $sql = "UPDATE office_accounts SET username='$user_name', password='$pass_word', account_type='$account_type' WHERE REGISTRATION_ID='$REGISTRATION_ID'";

    $result = $conn->query($sql);

    if ($result == TRUE) {
    ?>

      <script>
        Swal.fire({
          icon: 'success',
          title: 'Update Successful',
          showConfirmButton: false,
          timer: 1500,
        }).then(function() {
          window.location = "view.php";
          exit();
        });
      </script>

<?php
    } else {

      // Errors? Who cares! Let's just dump the whole SQL statement.
      echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }
}

?>