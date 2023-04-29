<?php
require_once 'config.php';
error_reporting(0);
if (isset($_SESSION['user'])) {
    header('Location: index.php?page=home');
}

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!preg_match("/^[a-zA-Z0-9]+$/", $username)) {
        $message = "Username can only contain a-z, A-Z, 0-9 character";
    } else {
        $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $query->execute([$username]);
        if ($query->fetch(PDO::FETCH_ASSOC)) {
            $message = "User already exists";
        } else {
            $query = $conn->prepare("INSERT INTO users(`username`, `password`, `avatar`) VALUES (?, ?, ?)");
            $result = $query->execute([$username, $password, 'default.png']);
            if ($result) {
                $message = "Register successfully<script>setTimeout(()=> window.location='index.php?page=login', 1000)</script>";
            } else $message = "Register failed";
        }
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
            Sign up
        </div>
        <form class="p-3 mt-3" action="index.php?page=register" method="POST">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="userName" placeholder="Username">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            <div class="text-center fs-6">
                Already have an account? <a href="index.php?page=login" class="link-danger">Login here</a>
            </div>
            <button class="btn mt-3">Register</button>
            <br>
        </form>

        <?php if (@$message) {
            echo '<div class="alert alert-info" role="alert" style="margin-top: 10px; text-align: center;">' . $message . '</div>';
        } ?>

    </div>

</body>

</html>