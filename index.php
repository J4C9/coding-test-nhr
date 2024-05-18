<?php
$title = "Welcome";

session_start();
//Check to see if the session is set.
if(!isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit();
}
?>
<body>
<h2>Welcome <?php echo $_SESSION['user_name']; ?>!</h2>
<p>You are currently logged in.</p>
<br>

<a class="btn" href="logout.php">Logout</a>
</body>
</html>