<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 100px;
        }

        .access-denied-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        h1 {
            color: #e74c3c;
        }

        p {
            color: #555;
        }

        a {
            color: #e74c3c;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="access-denied-container">
        <h1>Access Denied</h1>
        <p>Sorry, you do not have permission to access this page.</p>

        <a href="../users/login.php">
            <i class="fas fa-arrow-left"></i> Back to Login
        </a>
</body>
</div>

</html>