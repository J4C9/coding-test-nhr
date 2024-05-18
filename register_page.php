<?php
$title = "Register";
require_once 'header.php';
?>
<body>
<h2>Registration Form</h2>
<form action="register.php" method="post" class="form-group register-form">

    First Name:
    <input type="text" name="first_name" id="" class="form-input" required><br>
    Surname:
    <input type="text" name="surname" id="" class="form-input" required><br>
    Email:
    <input type="text" name="email" id="" class="form-input" required><br>
    Password:
    <input type="password" name="password" id="" class="form-input" required><br>
    Confirm password:
    <input type="password" name="passwordvalidation" id="" class="form-input" required><br>

    <button type="submit" class="btn">Register</button>

</form>
</body>
</html>