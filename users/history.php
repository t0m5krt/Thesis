<?php

define('TITLE', 'Request History | Repair and Maintence Management System');
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
?>

<?php include 'includes/header.php'; ?>

<body>

    <!-- <div class="loader">
        <div class="custom-loader"></div>
    </div> -->
    <?php include 'includes/sidebar.php'; ?>

    <section id="content">
        <?php include 'includes/navbar.php'; ?>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Request History</h1>
                </div>
            </div>

            <th>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Service Request ID</th>
                                <th>Registered Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            //sql should read the service reqeust status
                            $sql = "SELECT * FROM submit_requests WHERE user_id = '" . $_SESSION['userID'] . "'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['SERVICE_REQUEST_ID']; ?></td>
                                        <td><?php echo $row['date_of_request']; ?></td>
                                        <td>
                                            <?php
                                            echo $row['status_value'];
                                            ?>
                                        </td>
                                        <td>
                                            <a href="view.php?id=<?php echo $row['SERVICE_REQUEST_ID']; ?>" class="btn btn-secondary">View</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                    </table>
                </div>
            </th>


        </main>
    </section>


    <?php include 'includes/scripts.php' ?>
    <script>
        // add an active list on the side bar when this page is loaded
        const active = document.querySelector(".side-menu li:nth-child(3)");
        active.classList.add("active");
    </script>
</body>

</html>

<?php

?>