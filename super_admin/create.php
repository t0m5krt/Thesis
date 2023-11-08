<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="styles/signup-design.css">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Account</title>
</head>

<body>
  <div class="container">
    <div class="title">Add Account</div>
    <p>Enter the details of Superadmin ,Admin or Employee</p>
    <div class="content">
      <form action="create.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name:</span>
            <input type="text" placeholder="First Name" id="firstname" name="firstname" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name:</span>
            <input type="text" placeholder="Last Name" id="lastname" name="lastname" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="surname.employee_idXXXXX" id="username" name="username" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Type Here" id="pass_word" name="pass_word" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Type Here" id="confirm_pass" name="confirm_pass" required>
          </div>

          <div class="input-box">
            <span class="details" for="account_type">Account type:</span>
            <select name="account_type" id="account_type">
              <option value="admin">Admin</option>
              <option value="employee">Employee</option>
              <option value="super_admin">Super Admin</option>
            </select>

          </div>
        </div>

        <div class="">
          <input type="submit" value="Submit" name="submit" class="btn btn-primary">
          <input type="submit" value="Cancel" id="cancel-button" class="btn btn-secondary">
        </div>
      </form>
    </div>
  </div>

  <script>
    // Get a reference to the Cancel button
    const cancelButton = document.getElementById('cancel-button');

    // Add a click event listener to the Cancel button
    cancelButton.addEventListener('click', function(e) {
      e.preventDefault(); // Prevent the form from submitting

      // Display a confirmation dialog
      Swal.fire({
        icon: 'question',
        title: 'Are you sure you want to cancel this creation?',
        showCancelButton: true,
        confirmButtonText: 'Yes, cancel it',
        cancelButtonText: 'No, keep going',
      }).then((result) => {
        if (result.isConfirmed) {
          // If the user confirms, redirect to a different page
          window.location = "view.php";
        }
      });
    });
  </script>
</body>

</html>

<?php

include('config/config.php');

if (isset($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $pass_word = $_POST['pass_word'];
  $confirm_pass = $_POST['confirm_pass'];
  $account_type = $_POST['account_type'];

  // Check if username already exists in the database
  $sql = "SELECT * FROM office_accounts WHERE username= '$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Username already exists',
        showConfirmButton: false,
        timer: 1500,
      }).then(function() {
        window.location = "create.php";
        exit();
      });
    </script>
  <?php
    // Exit the script if the username already exists
    exit();
  }

  if ($pass_word !== $confirm_pass) {
  ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Password does not match',
        showConfirmButton: false,
        timer: 1500,
      }).then(function() {
        window.location = "create.php";
        exit();
      });
    </script>
  <?php
    // Exit the script if the passwords do not match
    exit();
  }

  // Insert data into the database
  $sql = "INSERT INTO office_accounts (firstname, lastname, username, password, account_type ) 
    VALUES ('$firstname', '$lastname', '$username','$pass_word', '$account_type')";
  if (mysqli_query($conn, $sql)) {
  ?>

    <script>
      Swal.fire({
        icon: 'success',
        title: 'Account Created',
        showConfirmButton: false,
        timer: 1500,
      }).then(function() {
        window.location = "view.php";
        exit();
      });
    </script>
<?php
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn); // Close the connection here
}

?>