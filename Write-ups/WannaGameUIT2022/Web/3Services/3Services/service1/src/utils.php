<?php

session_start();
class GifHandler{

    function addWatermark($conn, $file){

        $filename = $file['name'];

        # Let me add my watermark
        $new_gif_name = basename($filename) . "_to.gif";
        $username = mysqli_real_escape_string($conn, $_SESSION["user"]);
        $sql = "UPDATE user_images SET image = '$new_gif_name' WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

    }
    function process($conn, $file){
        $dest_folder = md5($_SERVER['REMOTE_ADDR']);

        $upload_dir = __DIR__ . "/uploads/$dest_folder";
    
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $username = mysqli_real_escape_string($conn, $_SESSION["user"]);
        $sql = "SELECT image FROM user_images WHERE username = '$username'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $new_gif_name = $row['image'];


        if($row === NULL){
            $message = "Some thing wrong";
            return $message;
        }
        else{
            $new_gif = imagecreatefromgif($file['tmp_name']);
            if(!$new_gif){
                $message = "Not a valid .gif file";
                return $message;
            }
            imagegif($new_gif, $upload_dir . '/' . $new_gif_name);
            imagedestroy($new_gif);
            chmod($upload_dir . '/' . $new_gif_name, 0555);
    
            $path =  "uploads/$dest_folder/" . $new_gif_name;
            $message = "Your file is uploaded at <a href='$path'>$path</a>";
            return $message;
        }


    }
}