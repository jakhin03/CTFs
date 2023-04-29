<?php

error_reporting(0);
if (isset($_SESSION['user'])) {
    header('Location: index.php?page=home');
    die();
}

session_start();
require_once 'config.php';

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $query->execute([$username]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $message = "User not exists";
    } else {
        $result = $conn->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?");
        $result->execute([$username, $password]);
        if ($result->fetch(PDO::FETCH_ASSOC)) {

            $message = "Login successfully<script>setTimeout(()=> window.location='index.php?page=home', 500)</script>";
            $_SESSION['user'] = $username;
            //header('Location: index.php?page=home');
            // die();
        } else $message = "Login failed";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    </link>
    <link rel="stylesheet" href="assets/css/style.css">
    </link>
    <link rel="stylesheet" href="assets/css/custom.css">
    </link>
    <title>Mysite2</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-brown">
        <a class="navbar-brand" href="#">
            <img>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="wrapper">
        <div class="text-center mt-4 name">
            Sign in
        </div>
        <form class="p-3 mt-3" action="index.php?page=login" method="POST">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <div class="text-center fs-6">
                Don't have an account? <a href="index.php?page=register">Sign up</a>
            </div>
            <button class="btn mt-3">Login</button>
        </form>

        <?php if (@$message) {
            echo '<div class="alert alert-info" role="alert" style="margin-top: 10px; text-align: center;">' . $message . '</div>';
        } ?>

    </div>
</body>

</html>