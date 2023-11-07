<?php

include_once 'includes/connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the count of service requests
$sql = "SELECT COUNT(*) AS request_count FROM submit_requests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $requestCount = $row["request_count"];
} else {
    $requestCount = 0;
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Employee RMMS</title>
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf"></script>
</head>

<body>

    <div class="loader">
        <div class="custom-loader"></div>
    </div>
    <?php include 'includes/sidebar.php'; ?>

    <section id="content">
        <?php include 'includes/navbar.php'; ?>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <a class="text" href="workOrder_employee.php">
                        <p>New Work Order</p>
                        <h1><?php echo $requestCount; ?></h1>
                    </a>
                </li>
                <li>
                    <a class="text" href="">
                        <p>On Process</p>
                        <h1>0</h1>
                    </a>
                </li>
                <li>
                    <a class="text" href="">
                        <p>Closed Work Order</p>
                        <h1>0</h1>
                    </a>
                </li>
            </ul>

        </main>
    </section>


    <?php include 'includes/scripts.php' ?>

    <script>
        // add an active list on the side bar when this page is loaded
        const active = document.querySelector(".side-menu li:nth-child(1)");
        active.classList.add("active");
    </script>
</body>


</html>

<?php

?>