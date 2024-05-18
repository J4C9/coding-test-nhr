<?php
require 'connection.php';
//Check that the page is being posted to.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Check that the id is set.
    if (isset($_POST['upload_id'])) {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Handle PDO
        //Prepare the query.
        $sql = "DELETE FROM `uploads` WHERE `id` = :upload_id;";
        //Prepare and Execute the query.
        $check = $pdo->prepare($sql);
        $check->execute(array(':upload_id' => $_POST['upload_id']));
        //Check to see if file has been removed correctly.
        if($check){
            //Delete file from server.
            unlink($_POST['file_path']);
        }
        //Reload the page.
        header('Location: index.php');
    }
}