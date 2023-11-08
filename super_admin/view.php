<?php

define('TITLE', 'Manage Accounts');
define('PAGE', 'Manage Accounts');
include('includes/connection.php');
include('includes/header.php');
?>

<!DOCTYPE html>
<html>

<body>
    <div class="loader">
        <div class="custom-loader"></div>
    </div>

    <?php include('includes/sidebar.php'); ?>

    <section id="content">


        <!-- Navbar -->
        <?php include 'includes/navbar.php'; ?>
        <!-- End of Navbar  -->

        <main>

            <div class="head-title">
                <div class="left">
                    <h1><?php echo PAGE ?></h1>
                </div>
            </div>

            <div class="create">
                <a href="create.php">
                    <button type="button" class="btn btn-success ">Add Account <i class='bx bx-user-plus'></i></button>
                </a>
            </div>
            <table class="table">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Account Type</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php

                    $sql = "SELECT * FROM office_accounts WHERE isDeleted='0'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        while ($row = $result->fetch_assoc()) {
                            $password = $row['password'];
                            $hidden = str_repeat('*', strlen($password));

                    ?>
                            <tr>

                                <td><?php echo $row['REGISTRATION_ID']; ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td>
                                    <span id="password_<?php echo $row['REGISTRATION_ID']; ?>" data-password="<?php echo $password; ?>" data-hidden="<?php echo $hidden; ?>">
                                        <?php echo $hidden; ?></span>
                                    <button class="btn" onclick="togglePasswordVisibility('<?php echo $row['REGISTRATION_ID']; ?>')"><i class='bx bx-low-vision'></i></button>
                                </td>


                                <td><?php echo $row['account_type']; ?></td>
                                <td><a class="btn btn-secondary" href="update.php?id=<?php echo $row['REGISTRATION_ID']; ?>">Update
                                    </a>&nbsp;
                                    <a class="btn btn-danger" href="delete.php?id=<?php echo $row['REGISTRATION_ID']; ?>">Delete</a>
                                </td>

                            </tr>

                    <?php
                        }
                    }

                    ?>

                </tbody>

            </table>
    </section>

    <div class="">


    </div>

    <?php include('includes/scripts.php'); ?>
    <script>
        function togglePasswordVisibility(id) {
            var passwordField = document.getElementById('password_' + id);
            var hidden = passwordField.getAttribute('data-hidden');
            var password = passwordField.getAttribute('data-password');
            if (passwordField.textContent.trim() === hidden) {
                passwordField.textContent = password;
            } else {
                passwordField.textContent = hidden;
            }
        }

        // add an active list on the side bar when this page is loaded
        const active = document.querySelector(".side-menu li:nth-child(2)");
        active.classList.add("active");
    </script>

</body>

</html>