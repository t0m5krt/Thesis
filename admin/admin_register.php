<!DOCTYPE html>
<html>

<head>
    <title>Register | RMMS | Megawide CELS</title>
    <link rel="stylesheet" href="Styles/adminLoginStyle.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <h1>RMMS | Admin Register</h1>
        <form method="post">
            <div class="txt_field">
                <input type="username" name="admin_name" required />
                <span></span>
                <label>Name</label>
            </div>
            <div class="txt_field">
                <input type="username" name="username" required />
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="password" required />
                <span></span>
                <label>Password</label>
                <i class="fa-solid fa-eye-slash" id="togglePassword" style="color: #f02e24;"></i>
            </div>
            <div class="txt_field">
                <input type="password" name="confirm_password" id="ConfirmPassword" required />
                <span></span>
                <label>Confirm Password</label>
                <i class="fa-solid fa-eye-slash" id="toggleConfirmPassword" style="color: #f02e24;"></i>
            </div>


            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>

    <?php
    include 'includes/scripts.php'
    ?>
    <!-- <script>
        // Toggle Hide Password

        // Get references to the toggle icons for password and confirm password
        const passwordToggle = document.querySelector("#togglePassword");
        const confirmToggle = document.querySelector("#toggleConfirmPassword");

        // Get references to the password and confirm password input fields
        const password = document.querySelector("#password");
        const confirmPassword = document.querySelector("#ConfirmPassword");

        // Add a click event listener to the password toggle icon
        passwordToggle.addEventListener("click", function() {
            // Call the function to toggle password visibility, passing the password field and the icon
            togglePasswordVisibility(password, this);
        });

        // Add a click event listener to the confirm password toggle icon
        confirmToggle.addEventListener("click", function() {
            // Call the function to toggle password visibility, passing the confirm password field and the icon
            togglePasswordVisibility(confirmPassword, this);
        });

        // Function to toggle password visibility
        function togglePasswordVisibility(inputField, icon) {
            // Check the current input type of the field
            const type = inputField.getAttribute("type") === "password" ? "text" : "password";
            // Set the input type to the opposite type (text or password)
            inputField.setAttribute("type", type);

            // Toggle the appearance of the icon classes to switch between open and closed eye icons
            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        }
    </script> -->

    <!-- <script>
        Swal.fire({
            icon: 'error',
            title: 'Password does not match, Please Try Again',
            showConfirmButton: true,
            onClose: function() {
                exit();
                window.location = "admin_register.php";
            }
        })
    </script> -->
</body>

</html>

<?php
include 'includes/connection.php';

if (isset($_POST['submit'])) {
    $adminName = $_POST['admin_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Password complexity validation
    if (strlen($password) < 8 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
?>
        <script>
            Swal.fire({
                icon: "error",
                title: 'Invalid Password',
                text: 'Password must be at least 8 characters long with an uppercase letter, a lowercase letter, and a number.',
                showConfirmButton: true,
                onclose: function() {
                    window.location = "admin_register.php";
                    exit();
                },
            });
        </script>
    <?php
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Password matching check
    if ($password !== $confirmPassword) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Password does not match. Please Try Again',
                showConfirmButton: true,
                onClose: function() {
                    window.location = "admin_register.php";
                    exit();
                }
            })
        </script>
        <?php
    } else {
        // Use prepared statements
        $insert = "INSERT INTO office_accounts (admin_name, username, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert);
        mysqli_stmt_bind_param($stmt, "sss", $adminName, $username, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
        ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Your Account Has Been Created',
                    showConfirmButton: true,
                }).then(function() {
                    window.location = "admin_login.php";
                    exit();
                })
            </script>
<?php
        } else {
            echo "Error: " . mysqli_error($conn); // Proper error handling
        }

        mysqli_stmt_close($stmt);
    }
}
?>