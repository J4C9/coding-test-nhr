<?php
$title = "Register";
require_once 'header.php';
?>
<body>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="fadeIn first">
            <h2>Registration Form</h2>
        </div>

        <form action="register.php" method="post" class="form-group">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <tr>
                            <td>First Name</td><td><input type="text" name="first_name" id="first_name" class="form-input" required></td>
                        </tr>
                        <tr>
                            <td>Surname</td><td><input type="text" name="surname" id="surname" class="form-input" required></td>
                        </tr>
                        <tr>
                            <td>Email</td><td><input type="text" name="email" id="email" class="form-input" required></td>
                        </tr>
                        <tr>
                            <td>Password</td><td><input type="password" name="password" id="password" class="form-input" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td><td><input type="password" name="passwordvalidation" id="passwordvalidation" class="form-input" required></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn login">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>