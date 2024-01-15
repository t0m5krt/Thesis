<?php

define('TITLE', 'Request Status | Repair and Maintence Management System');
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
                    <h1>Request Status</h1>
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
                            include_once 'includes/connection.php';



                            //sql should read the service reqeust status
                            $user_id = $_SESSION['userID'];
                            $sql = "SELECT a.SERVICE_REQUEST_ID, a.date_of_request, b.STATUS_VALUE 
                            FROM submit_requests a
                            JOIN service_request_status b ON a.SERVICE_REQUEST_ID = b.SERVICE_REQUEST_ID
                            WHERE a.user_id = '$user_id' AND a.isDelete = '0'
                            GROUP BY a.SERVICE_REQUEST_ID, a.date_of_request, b.STATUS_VALUE;";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['SERVICE_REQUEST_ID'] . "</td>";
                                    echo "<td>" . $row['date_of_request'] . "</td>";
                                    echo "<td>" . $row['STATUS_VALUE'] . "</td>";
                            ?>
                                    <td>
                                        <a href="viewRequestStatus.php?SERVICE_REQUEST_ID=<?php echo $row['SERVICE_REQUEST_ID']; ?>" class="btn btn-secondary btn-xs"><i class="fas fa-eye"></i> View Quotation</a>
                                        <a href="edit_request_form.php?SERVICE_REQUEST_ID=<?php echo $row['SERVICE_REQUEST_ID']; ?>" class="btn btn-info btn-xs"><i class="fas fa-eye"></i> Edit</a>
                                        <a href="view_service_request.php?SERVICE_REQUEST_ID=<?php echo $row['SERVICE_REQUEST_ID']; ?>" class="btn btn-danger btn-xs"><i class="fas fa-eye"></i> View Service Request</a>

                                    </td>
                            <?php
                                    echo '</tr>';
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No Request Found</td></tr>";
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
        const active = document.querySelector(" .side-menu li:nth-child(3)");
        active.classList.add("active");
    </script>
</body>

</html>

<?php

?>