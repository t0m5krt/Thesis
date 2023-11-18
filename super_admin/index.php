<?php

define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');
include 'includes/header.php';
include_once 'includes/connection.php';
?>

<body>

    <!-- <div class="loader">
        <div class="custom-loader"></div>
    </div> -->
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>
    <!-- Sidebar -->

    <!-- Content -->
    <section id="content">
        <!-- Navbar -->
        <?php include 'includes/navbar.php'; ?>
        <!--End of Navbar -->

        <!-- Main -->
        <main>
            <?php
            // Retrieve the user's ID from the session
            $RegistrationID = $_SESSION['REGISTRATION_ID'];

            // Query the database to get the user's name
            $sql = "SELECT firstname,lastname FROM office_accounts WHERE REGISTRATION_ID = $RegistrationID";
            $result = mysqli_query($conn, $sql);

            // Check if the query was successful
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $user_name = $row['firstname'];
            }
            ?>

            <div class="head-title">
                <div class="left">
                    <h1>Welcome <?php echo $user_name; ?>!</h1>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <a class="text" href="#">
                        <p>In Process</p>
                        <h1>0</h1>
                    </a>
                </li>
                <li>
                    <a class="text" href="#">
                        <p>Lorem ipsum dolor</p>
                        <h1>0</h1>
                    </a>
                </li>
                <!-- <li>
        <a class="text" href="">
            <p>Closed Work Order</p>
            <h1>0</h1>
        </a>
        </li> -->
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