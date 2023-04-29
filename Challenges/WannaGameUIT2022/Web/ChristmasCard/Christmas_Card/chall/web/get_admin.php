<?php 
    session_start();
    ob_start();
    if (isset($_POST["get_access"]) && $_POST["get_access"] === "assmin") {
        if ($_SERVER["REMOTE_ADDR"] === "127.0.0.1") {
            $_SESSION["role"] = "admin";
        }
        else {
            die("Note for employees: Use the computer in our shop and get admin role by accessing this page.");
        }
    }
    else {
        die("Note for employees: Use the computer in our shop and get admin role by accessing this page.");   
    }