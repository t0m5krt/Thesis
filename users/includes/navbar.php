<?php
$user_id = $_SESSION['userID'];

// Prepare the SQL statement to retrieve the user information
$sql = "SELECT * FROM user_accounts WHERE user_ID = $user_id";

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userFullName = $row['lastname'] . ", " . $row['firstname'];
}
?>

<!-- Navbar -->
<nav>
    <i class="bx bx-menu"></i>

    <a href="profile.php" class="profile">
        <p><?php echo $userFullName ?></p>

    </a>
</nav>
<!-- End of Navbar -->