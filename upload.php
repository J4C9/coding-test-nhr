<?php
require 'connection.php';
session_start();
//Check that the page is being posted to.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Check that the files array is set.
    if (isset($_FILES['files'])) {
        //Setting up an errors array to print on error.
        $errors = [];
        $path = 'uploads/';
        //Add an extension check to prevent scripts.
        $extensions = ['jpg', 'jpeg', 'png']; //Images only
        //Clean up file details.
        $file_name = $_FILES['files']['name'][0];
        $file_tmp = $_FILES['files']['tmp_name'][0];
        $file_type = $_FILES['files']['type'][0];
        $file_size = $_FILES['files']['size'][0];
        $tmp = explode('.', $_FILES['files']['name'][0]);
        $file_ext = strtolower(end($tmp));
        //Create path for upload.
        $file_path = $path . $file_name;
        //Check type.
        if (!in_array($file_ext, $extensions)) {
            $errors[] = "That file type isn't allowed: " . $file_name . " " . $file_type;
        }
        //Check size.
        if ($file_size > 2097152) {
            $errors[] = "File size exceeds our upload limit: " . $file_name . " " . $file_type;
        }
        //Check that there are no errors.
        if (empty($errors)) {
            //Let's store some upload information in the DB.
            $u_id = $_SESSION['user_id'];
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Handle PDO
            //Prepare the query.
            $sql = "INSERT INTO `uploads` (`id`, `file_path`, `user_id`) VALUES (NULL, ?, ?);";
            //Prepare and Execute the query.
            $check = $pdo->prepare($sql);
            $check->execute(array(
                $file_path,
                $u_id,
            ));
            move_uploaded_file($file_tmp, $file_path);
        }
        //If there are errors print them.
        if ($errors){
            print_r($errors);
        } else {
            header('Location: index.php');
        }
    }
}
?>