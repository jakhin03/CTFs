<?php
session_start();
require 'database.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/home.css">
    <title>Mysite1</title>
    <script src="assets/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
        <a class="navbar-brand" href="#"><img src="assets/images/inseclab.png" alt="Logo" class="img-fluid" height="60px" width="60px" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <button class="btn btn-light" onclick="window.location='index.php?page=admin'" style="margin-right: 10px;">Admin Panel</button>
                <button class="btn btn-light" onclick="window.location='index.php?page=logout'">Logout</button>
            </div>
        </div>
        </div>
    </nav>
    <br><br><br><br><br>
    
    <div class="d-flex justify-content-center">
        
        <div style="text-align: center;">
            <h3><b><i>Your information</b></i></h3>
            <br>
            <br>

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Lucky Number</th>
                        <th scope="col">Hobby</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $username = mysqli_real_escape_string($conn, $_SESSION["user"]);
                    $res = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

                    while ($row = mysqli_fetch_array($res)) {
                        echo '<tr>';
                        echo '<td>' . htmlentities($row['username']) . '</td>';
                        echo '<td>' . htmlentities($row['num']) . '</td>';
                        echo '<td>' . htmlentities($row['hobby']) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>