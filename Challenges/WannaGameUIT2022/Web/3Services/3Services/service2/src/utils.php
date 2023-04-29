<?php
error_reporting(0);
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    die();
}

require_once 'config.php';
session_start();

class ImageHandler
{
    public $status;
    public $type;
    public $logfile;

    function __construct($type, $status, $logfile)
    {
        $this->type = $type;
        $this->status = $status;
        $this->logfile = $logfile;
    }

    function upload($file, $conn)
    {
        $this->status = "bad";

        if ($file['error'] > 0) {
            die('Error');
        }

        if (stripos($file['type'], 'image/') !== 0) {
            die('We only support image uploading');
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            die('File was not uploaded via HTTP POST');
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if ($ext !== "png") {
            die('We only support .png file ');
        }

        $content = file_get_contents($file['tmp_name']);
        if (preg_match("/php|<\?|HALT\_COMPILER/i", $content)){
            die("What are you trying to do ???");
        }

        $new_avatar_name = bin2hex(random_bytes(12)) . ".png";
        $target_location = __DIR__ . "/uploads/$new_avatar_name";

        $query = $conn->prepare("UPDATE users SET avatar = ? WHERE username = ?");
        $query->execute(["$new_avatar_name", $_SESSION['user']]);

        if (!move_uploaded_file($file["tmp_name"], $target_location)) {
            die("Error in uploading process"); 
        } else {
            $this->status = "good";
            die("Your avatar was saved at: " . "uploads/$new_avatar_name, refresh to make effect");
        }
    }

    function load($avatar)
    {
        if (!file_exists($avatar) && mime_content_type("uploads/" . basename($avatar)) != 'image/png') {
            return false;
        } else return true;
    }

    function __destruct()
    {
        if($this->type === "code"){
            exit("No");
        }

        switch($this->type){
            case "code":
                file_put_contents($this->logfile, "[INFO] User: " . $_SESSION['user'] . " - code: " . $this->status);
                break;
            case "info":
                file_put_contents($this->logfile, "[INFO] User: " . $_SESSION['user'] . " - uploading status: " . htmlspecialchars($this->status));
                break;
            default:
                break;
        }

    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $imageHandler = new ImageHandler("info", null, "/tmp/log.txt");
        $imageHandler->upload($_FILES['file'], $conn);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['avatar'])) {
        $imageHandler = new ImageHandler("info", null, "/tmp/log.txt");
        if ($imageHandler->load($_GET['avatar'])) {
            header('Content-Type: image/jpg');
            echo file_get_contents("uploads/" . basename($_GET['avatar']));
            exit;
        } else {
            header("HTTP/1.1 404 Not Found");
            exit;
        }
    }
} else header("HTTP/1.1 405 Method Not Allowed");
