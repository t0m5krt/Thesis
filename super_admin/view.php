<?php
include('config/config.php');


$sql = "SELECT * FROM registration WHERE isDeleted='0'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
include('includes/header.php');
include('includes/sidebar.php');
?>

<body>

    <div class="container">

        <h2>Accounts</h2>

        <div class="create">
            <a href="create.php">
                <button type="button" class="btn btn-primary">Add Account <i class='bx bx-user-plus'></i></button>
            </a>
        </div>
        <table class="table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Account Type</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <?php

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        $password = $row['password'];
                        $hidden = str_repeat('*', strlen($password));

                ?>

                        <tr>

                            <td><?php echo $row['REGISTRATION_ID']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <span id="password_<?php echo $row['REGISTRATION_ID']; ?>" data-password="<?php echo $password; ?>" data-hidden="<?php echo $hidden; ?>">
                                    <?php echo $hidden; ?></span>
                                <button class="btn btn-secondary" onclick="togglePasswordVisibility('<?php echo $row['REGISTRATION_ID']; ?>')">Show/Hide</button>
                            </td>


                            <td><?php echo $row['account_type']; ?></td>
                            <td><a class="btn btn-info" href="update.php?id=<?php echo $row['REGISTRATION_ID']; ?>">Update
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

    </div>
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
    </script>
    </script>

    <script src="js/preloader.js"></script>
</body>

</html>