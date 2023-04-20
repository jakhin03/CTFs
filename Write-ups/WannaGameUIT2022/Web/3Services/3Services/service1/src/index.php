<?php

session_start();
error_reporting(0);

$whitelist = ['home', 'login', 'register', 'logout' ,'admin'];

if(!isset($_GET['page'])){ 
    include('home.php');
}
else if(in_array($_GET['page'], $whitelist)) 
    include($_GET['page'] . '.php');
else{
    header('HTTP/1.1 404 Not Found');
    die();
}
