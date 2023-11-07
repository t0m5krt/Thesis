<?php

define('TITLE', 'View Profile');
define('PAGE', 'Profile Details');
include 'includes/header.php';
include_once 'includes/connection.php';

//make a logout session in php
if (isset($_GET['logout'])) {
    // Destroy the session and redirect to the login page
    session_destroy();
    header('Location:login.php');
    exit();
}
if (session_status() === PHP_SESSION_NONE)
    session_start();


if (!isset($_SESSION['email'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['userID'];

// Prepare the SQL statement to retrieve the user information
$sql = "SELECT * FROM user_accounts WHERE user_ID = $user_id";

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userFullName = $row['firstname'] . " " . $row['lastname'];
    $userEmail = $row['email'];
    $userContactNumber = $row['contactnumber'];
    $userCompany = $row['companyname'];
    $userProject = $row['projectname'];
}

?>
<div class="loader">
    <div class="custom-loader"></div>
</div>
<!-- Sidebar -->
<?php include 'includes/sidebar.php'; ?>
<!-- Sidebar -->

<body>
    <section id="content">
        <?php include 'includes/navbar.php' ?>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1><?php echo PAGE ?></h1>
                </div>
            </div>

            <div>
                <div class="card-container">
                    <div class="profile-info">
                        <h2>Name: <?php echo $userFullName ?></h2>
                        <p>Email: <?php echo $userEmail ?></p>
                        <p>Contact Number: <?php echo $userContactNumber ?></p>
                        <p>Company Name: <?php echo $userCompany ?></p>
                        <p>Project Name: <?php echo $userProject ?></p>
                    </div>
                </div>


            </div>
        </main>
    </section>

    <?php include 'includes/scripts.php' ?>
</body>

</html>