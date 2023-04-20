<?php

require_once 'database.php';
error_reporting(0);
?>

<?php
if (isset($_GET["user"])) {

  if (!empty($_GET["user"]) && strlen($_GET["user"]) <= 21 && strlen($_GET["user"]) >= 2) {

    if (preg_match('/and|or|\||&|select|union|insert|update/i', $_GET["user"])) {
      die("NO");
    }

    $sql = "SELECT * FROM users WHERE username = '" . $_GET["user"] . "'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    if ($row === NULL) {
      echo "<script>alert('Username is ready to use');</script>";
    } else {

      echo "<script>alert('Username already token');</script>";
    }
  } else {
    echo "<script>alert('\"user\" param not match')</script>";
  }
  echo "<script>window.close();</script>";
}


if (isset($_POST["username"]) && !empty($_POST["username"]) && strlen($_POST["username"]) <= 20 && strlen($_POST["username"]) >= 2 && isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["num"]) && !empty($_POST["num"]) && strlen($_POST["num"]) <= 6  && isset($_POST["hobby"]) && !empty($_POST["hobby"]) && strlen($_POST["hobby"]) <= 32) {

  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = md5($_POST["password"]);
  $num = mysqli_real_escape_string($conn, $_POST["num"]);
  $hobby = mysqli_real_escape_string($conn, $_POST["hobby"]);


  $sql = "INSERT INTO users VALUES ('$username','$password',$num,'$hobby')";
  $result = mysqli_query($conn, $sql);

  $message = NULL;
  if ($result) {
    $message = 'Successfully Register';
    $message .= "<script>setTimeout(()=>window.location = 'index.php?page=login', 1000)</script>";
  } else {
    $message = 'Register Failed';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Mysite1</title>

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

        <button class="btn btn-light ms-3" value="login" onclick="window.location='index.php?page=login'">Sign in</button>

      </div>
    </div>
    </div>
  </nav>

  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form class="mx-1 mx-md-4" method='POST'>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" id="username" class="form-control" name="username" placeholder="Username" />
                        <div onclick="checkUserExist()" style="color: red; padding-left: 10px">Check</div><br>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="password" class="form-control" name="password" placeholder="Password" />
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" class="form-control" name="num" placeholder="Lucky number" pattern="[0-9]{6}" />
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input type="text" class="form-control" name="hobby" placeholder="Hobby" />
                      </div>
                    </div>

                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="index.php?page=login" class="link-danger">Login here</a></p>
                    <br>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Register</button>
                    </div>

                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="assets/images/draw1.webp" class="img-fluid" alt="Sample image">
                </div>
              </div>
            </div>
          </div>
          <?php if (@$message) {
            echo '<div class="alert alert-info" role="alert" style="margin-top: 10px">' . $message . '</div>';
          } ?>
        </div>

      </div>
    </div>
  </section>
  <script>
    function checkUserExist() {
      var username = document.getElementById("username").value;
      var left = screen.width / 2 - 105
      var top = screen.height / 2 - 200
      let params = `width=450,height=350,left=${left},top=${top}`;
      window.open("?page=register&user=" + username, 'bla', params);
    }
  </script>

</body>

</html>