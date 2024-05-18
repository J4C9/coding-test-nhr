<?php
//Require connection.pnp as it is needed to store user details.
require("connection.php");
//Check that the page is being posted to.
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Setting up an errors array to print on error.
    $errors = array();
    //Collect into an array called data to keep clean.
    $data = [
        $first_name = (isset($_POST['first_name']))? $_POST['first_name']:null,
        $surname = (isset($_POST['surname']))? $_POST['surname']:null,
        $email = (isset($_POST['email']))? $_POST['email']:null,
        $password = (isset($_POST['password']))? $_POST['password']:null,
        $passwordvalidaion = (isset($_POST['passwordvalidation'])? $_POST['passwordvalidation']:null)
    ];

    if(empty($first_name)) {
        $errors['first_name'] = "First name is required";
    }
    if(empty($surname)) {
        $errors['surname'] = "Surname is required";
    }
    if(empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($data[2], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] . "this email is formatted incorrectly";
    }

    if(empty($password) || strlen($password) < 6) {
        $errors['password'] = "No password entered or is too short.";
    } elseif ($password != $passwordvalidaion) {
        $errors['confirm_password'] = "Password do not match.";
    }

    foreach($errors as $error) {
        echo "<br>" . $error . "<br>";
    }
    //Check the errors array is empty to make sure items aren't added to the DB incorrectly.
    if(empty($errors)) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Handle PDO
            //Hash the password.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            //Prepare the query.
            $sql = "INSERT INTO `users` (`id`, `first_name`, `surname`, `email`, `password`) VALUES (NULL, :first_name, :surname, :email, :password);";
            //Prepare and Execute the query.
            $check = $pdo->prepare($sql);
            $check->execute(array(
                ':first_name' => $data[0],
                ':surname' => $data[1],
                ':email' => $data[2],
                ':password' => $hashedPassword,
            ));
            //Redirect to the welcome page
            header('Location: welcome.php');

        } catch (PDOException $e) {
            echo "There has been an error " . $e->getMessage();
        };
    } else {
        echo '<a href="register_page.php"><button class="btn">Register</button></a>';
    }
}

?>