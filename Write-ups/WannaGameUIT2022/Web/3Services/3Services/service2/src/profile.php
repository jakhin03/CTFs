<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    die();
}
require_once 'config.php';
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

    <?php
    $query = $conn->prepare("SELECT avatar FROM users WHERE username = ?");
    $query->execute([$_SESSION['user']]);
    $avatar = $query->fetch(PDO::FETCH_ASSOC)['avatar'];
    ?>

    <br><br>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" src="index.php?page=utils&avatar=<?php echo $avatar ?>" alt="img" style="max-width:120px;max-height:120px">
                    <br>
                    <form>
                        <div class="form-outline mb-4">

                            <input type="file" id="file_upload" onchange="uploadAvatar(this)" value="Select a avatar">
                        </div>
                        <div id="result"></div>
                    </form>
                </div>
            </div>
            <div class="col-md-8 border-left">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>

                    <div class="row mt-2">

                        <div class="col-md-6">
                            <label class="labels">Username</label><input type="text" class="form-control" value="<?php echo $_SESSION['user']; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Role</label><input type="text" class="form-control" value="Player" disabled>
                        </div>
                    </div>
                    <!-- <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="Submit">Update
                            Profile</button></div> -->
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>


    <script>
        function uploadAvatar(inp) {
            let formData = new FormData();
            let photo = inp.files[0];

            formData.append("file", photo);

            fetch('/index.php?page=utils', {
                    method: "POST",
                    body: formData
                })
                .then(r => r.text())
                .then(data => {
                    result.innerHTML = data;
                });
        }
    </script>

</body>

</html>