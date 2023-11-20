<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/signup-design.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megawide C.E.L.S Sign-Up</title>
</head>

<body>

    <div class="container">
        <div class="title">Sign-Up</div>
        <p>Enter your details to create your account</p>
        <div class="content">
            <form action="signup.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">First Name</span>
                        <input type="text" placeholder="Type Here" id="firstame" name="firstname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name</span>
                        <input type="text" placeholder="Type Here" id="lastname" name="lastname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Company Name</span>
                        <input type="text" placeholder="Type Here" id="companyname" name="companyname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Project Name</span>
                        <input type="text" placeholder="Type Here" id="projectname" name="projectname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" placeholder="Type Here" id="email" name="email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Contact No.</span>
                        <input type="text" placeholder="09XX-XXX-XXXX" id="contactnumber" name="contactnumber" maxlength="11" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" placeholder="Type Here" id="password" minlength="6" name="password" required>
                        <i class="fa-solid fa-eye-slash" id="togglePassword" style="
                        color:#f02e24;
                        position: relative;
                        bottom: 50%;
                        left: 16rem;
                        transform: translateY(100%);
                        cursor:pointer;"></i>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" placeholder="Type Here" id="confirm_pass" name="confirm_pass" required>
                        <i class="fa-solid fa-eye-slash" id="toggleConfirmPassword" style="
                        color:#f02e24;
                        position: relative;
                        bottom: 50%;
                        left: 16rem;
                        transform: translateY(100%);
                        cursor: pointer;">
                        </i>
                    </div>
                </div>
                <div class="privacy">
                    <input type="checkbox" name="privacy" required>
                    <!-- <a href="privacy.php" target="_blank">I Agree to Data Privacy Agreement</a> -->
                    <a href="https://www.privacypolicies.com/live/2c89e827-0b09-4326-8c34-2c5ee00ae98f" target="_blank">I Agree to Data Privacy Agreement</a>
                </div>
                <div class="button">
                    <input type="submit" name="submit" value="Create">
                </div>
            </form>
        </div>
    </div>

    <?php
    include 'includes/scripts.php';
    ?>

</body>

</html>

<?php
include 'includes/connection.php';

// Get form data
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $companyname = $_POST['companyname'];
    $projectname = $_POST['projectname'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];
    $pass_word = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];

    if (empty($firstname) || empty($lastname) || empty($companyname) || empty($projectname) || empty($email) || empty($contactnumber) || empty($pass_word) || empty($confirm_pass)) {
?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Please fill out all required fields',
                showConfirmButton: true,
                onClose: function() {
                    exit();
                    window.location = "signup.php";
                }
            })
        </script>
    <?php
        exit;
    }
    // Check if passwords match
    if ($pass_word !== $confirm_pass) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Password does not match, Please Try Again',
                showConfirmButton: true,
                onClose: function() {
                    exit();
                    window.location = "signup.php";
                }
            })
        </script>
    <?php
    }

    // Check if email already exists in the database
    $sql = "SELECT * FROM user_accounts WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Email already exists',
                showConfirmButton: true,
                onClose: function() {
                    exit();
                    window.location = "signup.php";
                }
            })
        </script>
    <?php
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO user_accounts (firstname, lastname, companyname, projectname, email, contactnumber, password) 
        VALUES ('$firstname', '$lastname', '$companyname', '$projectname', '$email', '$contactnumber', '$hashed_password')";
    if (mysqli_query($conn, $sql)) {
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Your Account Has Been Created',
                text: 'Please Login to Continue',
                showConfirmButton: true,
            }).then(function() {
                window.location = "login.php";
                exit();
            })
        </script>
<?php
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>