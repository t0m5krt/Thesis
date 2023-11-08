<?php

define('TITLE', 'View Profile');
define('PAGE', 'Profile Details');
include 'includes/header.php';
include_once 'includes/connection.php';


// Get the user ID from the session
$REGISTRATION_ID = $_SESSION['REGISTRATION_ID'];

// Prepare the SQL statement to retrieve the user information
$sql = "SELECT * FROM office_accounts WHERE REGISTRATION_ID = $REGISTRATION_ID";

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $officeAccountUsername = $row['username'];
    $officeAccountType = $row['account_type'];
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
                        <h2>Name: <?php echo $officeAccountsFullName ?></h2>
                        <p>Username: <?php echo $officeAccountUsername ?></p>
                        <p>Account Type: <?php echo $officeAccountType ?> </p>
                    </div>
                </div>


            </div>
        </main>
    </section>

    <?php include 'includes/scripts.php' ?>
</body>

</html>