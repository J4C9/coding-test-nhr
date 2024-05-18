<?php
//Require connection.php as we will need to check the users details.
require("connection.php");
//Start a session to set users details
session_start();

$login = false;
//Check to see if the form has been posted to.
if($_SERVER['REQUEST_METHOD'] == "POST") {
    //Setting up an errors array to print on error.
    $errors = array();
    //Collect email and password posted.
    $email = (isset($_POST['email']))?htmlspecialchars($_POST['email']): null;
    $password = (isset($_POST['password']))?$_POST['password']: null;
    //Check it's not empty.
    if(empty($email)) {
        $errors[] = "No email has been entered.";
    }
    //Check password isn't empty or less than required.
    if(empty($password) || strlen($password) < 6) {
        $errors[] = "No password entered or is too short.";
    }
    //Try or catch.
    try{
        //Create connection.
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Handle PDO
        //Get user via email.
        $sql = "SELECT * FROM users WHERE email=:email";
        $check = $pdo->prepare($sql);
        $check->execute(['email' => $email]);
        //Get user details and add it into an array.
        $user_info = $check->fetchAll(PDO::FETCH_ASSOC);
        //Foreach just to keep it clean or I would have to define key.
        foreach ($user_info as $user) {
            if (password_verify($password, $user["password"])) {
                $_SESSION['user_id'] = $user["id"];
                $_SESSION['user_name'] = $user["first_name"]." ".$user["surname"];
                $login = true;
            }
        }
        //Check if login is true.
        if($login) {
            //Relocate to the index page.
            header('Location: index.php');
        } else {
            echo "We can't seem to find your details, please try again" . "<br/>";
            //Print errors
            foreach ($errors as $error) {
                echo $error . "<br/>";
            }
            echo '<a href="welcome.php"><button class="btn">Login</button></a>';
        }

    } catch(PDOException $e) {
        print_r($e);
    }
}