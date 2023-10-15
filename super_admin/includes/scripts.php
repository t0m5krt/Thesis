<script src="js/script.js"></script>
<script src="js/preloader.js"></script>
<script src="js/favicon.js"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php


$connection = mysqli_connect("localhost", "root", "", "test");

if (isset($_POST['registerbtn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass_word'];
    $confirm_password = $_POST['confirmpassword'];

    if ($password === $confirm_password) {
        $query = "INSERT INTO  (username,email,pass_word) VALUES ('$username','$email','$pass_word')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            echo "done";
            $_SESSION['success'] =  "Admin is Added Successfully";
            header('Location: super_admin_registration.php');
        } else {
            echo "not done";
            $_SESSION['status'] =  "Admin is Not Added";
            header('Location: c.php');
        }
    } else {
        echo "password not match";
        $_SESSION['status'] =  "Password and Confirm Password Does not Match";
        header('Location: super_admin_registration.php');
    }
}

?>