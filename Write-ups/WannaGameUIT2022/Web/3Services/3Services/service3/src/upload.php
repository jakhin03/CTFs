<?php
error_reporting(0);

if (isset($_FILES)){

    if($_FILES['file']['error'] > 0){
        die('Error');
    }

    if(stripos($_FILES['file']['type'], 'image/') !== 0){
        die('We only support image uploading');
    }

    if(!is_uploaded_file($_FILES['file']['tmp_name'])) {
        die('File was not uploaded via HTTP POST');
    }

    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    if ($ext !== "png") {
        die('We only support .png file ');
    }

    $random_name = bin2hex(random_bytes(10)) . ".png";
    $new_location = __DIR__ . '/uploads/' . $random_name;

    list($width, $height) = getimagesize($_FILES['file']['tmp_name']);
    
    $png = imagecreatefrompng($_FILES['file']['tmp_name']);

    if(!$png){
        die('Is it truely a .png file ???'); 
    }

    #Yah, some resizing stuff for storage purpose
    $thumb = imagecreatetruecolor(55, 55);
    imagecopyresampled($thumb, $png, 0, 0, 0, 0, 55, 55, $width, $height);
    imagepng($thumb, $new_location);
    chmod($new_location, 0555);

    $href = "uploads/" . $random_name;
    die('Uploaded successfully, your file will be available at: <a href="' . $href . '">' . $href . '</a>');
}
?>

