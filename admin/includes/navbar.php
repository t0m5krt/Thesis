<?php
include 'includes/connection.php';
$RegistrationID = $_SESSION['REGISTRATION_ID'];

// Prepare the SQL statement to retrieve the user information
$sql = "SELECT * FROM office_accounts WHERE REGISTRATION_ID = $RegistrationID";


$result = mysqli_query($conn, $sql);
// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $officeAccountsFullName = $row['lastname'] . ", " . $row['firstname'];
    $officeAccountType = $row['account_type'];
}
?>

<!-- Navbar -->
<nav>
    <i class="bx bx-menu"></i>
    <form action="#">

    </form>
    <a href="profile.php" class="profile">
        <p><?php echo $officeAccountsFullName ?> (<?php echo $officeAccountType ?>)</p>
        <div class="profile-icon"><i class="bx bx-user"></i></div>

    </a>
</nav>
<!-- End of Navbar -->