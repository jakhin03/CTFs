<?php
error_reporting(0);

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    die();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    </link>
    <link rel="stylesheet" href="assets/css/style.css">
    </link>
    <title>Mysite2</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                    <a class="nav-link" href="index.php?page=home">Home <span class="sr-only">(current)</span></a>
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
            <button class="btn btn-light" onclick="window.location='index.php?page=profile'" style="margin-right: 10px;">Profile</button>
            <button class="btn btn-light" onclick="window.location='index.php?page=logout'">Logout</button>
        </div>
    </nav>

    <div class="header_pic">

        <img src="./assets/images/buk.png" style="width: 100%;max-height: 620px;">
        <div class="centered">Wanna Library</div>

    </div>

    <div class="text_content">
        <h2>Available Book</h2>
    </div>

    <div class="main_content">
        <div class="row">
            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <img src="./assets/images/hack3r.jpg" class="card-img-top" alt="hackerman">
                    <div class="card-body">
                        <h5 class="card-title">How To Be A Hackerman</h5>
                        <p class="card-text">A book may may (not) help you to become a h4x0r</p>
                        <a href="#" class="btn btn-primary bg-brown">$10</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <img src="./assets/images/rickroll.jpg" class="card-img-top" alt="rickroll">
                    <div class="card-body">
                        <h5 class="card-title">How To Avoid Rickrolling</h5>
                        <p class="card-text">Annoying of rick roll? This will help you xD</p>
                        <a href="#" class="btn btn-primary bg-brown">$1000</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <img src="./assets/images/chess.jpeg" class="card-img-top" alt="chess">
                    <div class="card-body">
                        <h5 class="card-title">Play Chess like a Hacker</h5>
                        <p class="card-text">Help u play chess like penaldo and mexy</p>
                        <a href="#" class="btn btn-primary bg-brown">$20</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card" style="width: 18rem;">
                    <img src="./assets/images/bingchiling.jpg" class="card-img-top" alt="bing">
                    <div class="card-body">
                        <h5 class="card-title">How To Eat Ice-cream like John Cena</h5>
                        <p class="card-text">Hao Shang Hao</p>
                        <a href="#" class="btn btn-primary bg-brown">$2000</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>