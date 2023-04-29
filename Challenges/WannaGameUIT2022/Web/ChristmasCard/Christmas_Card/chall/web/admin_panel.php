<?php
session_start();
if ($_SESSION["role"] !== "admin") {
    die("Note for employees: Use the computer in our shop and get admin role by accessing get_admin.php");
}
require __DIR__ . '/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if(isset($_GET['title'])) {
    $title = $_GET['title'];
} 
else {
    $title = "Merry Christmas Admin";
}

$img = base64_encode(file_get_contents(__DIR__ . "/static/images/santa-claus.png"));

$html = "<!DOCTYPE html>
<html>
<head>
<style>
body {
    display: block;
    text-align: center;
}
</style>
</head>
<body>
<h1>$title</h1><br><br>
<img src='data:image/png;base64,$img'>";

$html .= "</body>";
$html .= "</html>";

if (isset($_GET['pdf'])) {
    $filename = "new_card.pdf";

    $dompdf = new Dompdf();   
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A5', 'landscape');

    global $_dompdf_show_warnings;
    $_dompdf_show_warnings = true;

    $dompdf->render();
    $dompdf->stream($filename, array('Attachment' => 0));
} else {
    echo $html;
}

echo "
<style>
input[type=button], input[type=submit], input[type=reset], button{
    background-color: #B11B31;
    border: none;
    color: white;
    padding: 10px 25px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}

input[type=text] {
    background-color: white;
    background-position: 10px 10px;
    background-repeat: no-repeat;
    height: 30px;
    width: 230px;
}

a {
    text-decoration: none;
    color: white;
}
</style>
<br><br><br>
<form action='' method='get'>
Card Title: <input type='text' name='title'><br><br>
<input type='submit'>
</form>
<br>
<button type='button' onclick=\"location.href='/admin_panel.php?pdf&title=$title'\">Preview as PDF</button>
<button type='button'><a href='#UNDER-CONSTRUCTION'>Add to Collection</a></button>
";