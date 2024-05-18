<?php
$title = "Login";
include 'header.php';
?>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="fadeIn first">
            <h2>Welcome</h2>
        </div>

        <form action="login.php" method="post">
            <input type="text" name="email" id="email" class="fadeIn second main-input" placeholder="User Name">
            <input type="password" name="password" id="password" class="fadeIn third main-input" placeholder="Password">
            <button class="btn login fadeIn fourth" type="submit">Login</button>
        </form>

        <!-- Register -->
        <div id="formFooter">
            <a class="btn-register fadeIn fifth" href="register_page.php"><button class="btn">Register</button></a>
        </div>

    </div>
</div>
</body>
</html>