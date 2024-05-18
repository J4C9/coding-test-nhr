<?php
$title = "Login";
include 'header.php';
?>
<body>
<h2>Welcome</h2>
<form action="login.php" method="post" class="card login-card">

    Email:
    <input type="text" name="email" id="" class="form-input"><br>
    Password:
    <input type="password" name="password" id="" class="form-input"><br>
    <button class="btn" type="submit">Login</button>
</form>
<a class="btn-register" href="register_page.php"><button class="btn">Register</button></a>
</body>
</html>