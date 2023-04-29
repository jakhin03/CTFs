<?php 
    session_start();
    ob_start();
?>
<?php
    class User {
        public $customer_type;
        function buyCard() {
            if ($_SESSION["money"] > 0) {
                $_SESSION["money"] -= 200;
            }
            else {
                die("You don't have enough money!");
            }
        }
    }
?>

<?php

    if (!isset($_SESSION["money"]) or !isset($_SESSION["role"])) {
        $_SESSION["money"] = 2000;
        $_SESSION["role"] = "user";
        // employees please visit get_admin.php to get authorize to admin
    }

    if (!isset($_COOKIE["customer_type"])) {
            $user = new User;
            $user->customer_type = "buyer";
            setcookie("customer_type", base64_encode(serialize($user)), time() + (20896 * 30), "/");
    }   
    else {
        $user = new User;
        $user = unserialize(base64_decode($_COOKIE["customer_type"]));
    }

    if (isset($_POST["buy"])) {
        $user->buyCard();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="./static/css/materialize.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .main-container {
            margin: 30px;
        }
        .card-img {
            width: 150px;
            height: 300px;
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-wrapper" style="background-color: #B11B31;">
        <a href="#" class="brand-logo" style="margin-left: 20px;">Christmas Card</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php 
            if ($_SESSION["role"] === "admin") {
                echo "<li><a href=\"admin_panel.php\">Admin Panel</a></li>";
            }
            ?>
        </ul>
        </div>
    </nav>
    
    <div class="main-container">
        <h2 style="text-align: center;">Christmas Card Collection</h2>
        <?php echo "<h4>Budget: ". $_SESSION["money"]."</h4>";?>
        <div class="card-section">
            <div class="row">
                <div class="col s3 m3">
                    <div class="card">
                        <div class="card-image">
                        <img class="card-img" src="./static/images/christmas-card-1.jpg">
                        </div>
                        <div class="card-content">
                        </div>
                        <div class="card-action">
                        <form action="/" method="post">
                            <input type="hidden" name="buy" value="buycard1"/>
                            <a style="color: #B11B31; cursor: pointer;" onclick="this.parentNode.submit();">$200</a>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="col s3 m3">
                    <div class="card">
                        <div class="card-image">
                        <img class="card-img" src="./static/images/christmas-card-2.png">
                        </div>
                        <div class="card-content">
                        </div>
                        <div class="card-action">
                        <form action="/" method="post">
                            <input type="hidden" name="buy" value="buycard2"/>
                            <a style="color: #B11B31; cursor: pointer;" onclick="this.parentNode.submit();">$200</a>
                        </form>
                        </div>
                    </div>
                </div>
            
                <div class="col s3 m3">
                    <div class="card">
                        <div class="card-image">
                        <img class="card-img" src="./static/images/christmas-card-3.png">
                        </div>
                        <div class="card-content">
                        </div>
                        <div class="card-action">
                        <form action="/" method="post">
                            <input type="hidden" name="buy" value="buycard3"/>
                            <a style="color: #B11B31; cursor: pointer;" onclick="this.parentNode.submit();">$200</a>
                        </form>
                        </div>
                    </div>
                </div>

                <div class="col s3 m3">
                    <div class="card">
                        <div class="card-image">
                        <img class="card-img" src="./static/images/christmas-card-4.jpg">
                        </div>
                        <div class="card-content">
                        </div>
                        <div class="card-action">
                        <form action="/" method="post">
                            <input type="hidden" name="buy" value="buycard4"/>
                            <a style="color: #B11B31; cursor: pointer;" onclick="this.parentNode.submit();">$200</a>
                        </form>
                        </div>
                    </div>
                </div>

            </div>     
            </div>     
        </div>
    </div>
</body>
</html>