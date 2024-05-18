<?php
$title = "Welcome";

session_start();
//Check to see if the session is set.
if(!isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit();
}
?>
<?php
    include 'header.php';
    require 'connection.php';
?>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="width: -webkit-fill-available;">
    <a class="navbar-brand" href="#"><?php echo $title; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="wrapper">
    <div class="row">
        <div class="col-12">
            <h2>Welcome <?php echo $_SESSION['user_name']; ?>!</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p>You are currently logged in.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="post" action="upload.php" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <input type="file" name="files[]" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn login">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>File Path</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Handle PDO
                //Get the uploaded files
                $sql = "SELECT * FROM uploads";
                $check = $pdo->prepare($sql);
                $check->execute();
                //Get user details and add it into an array.
                $uploads = $check->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($uploads)){
                    foreach ($uploads as $upload) {
                        echo "<tr>";
                        echo "<td>" . $upload['file_path'] . "</td>";
                        echo "<td>" . $upload['user_id'] . "</td>";
                        echo "<td><form action='delete_file.php' method='POST'><input type='hidden' name='upload_id' value='" . $upload['id'] . "'/><input type='hidden' name='file_path' value='" . $upload['file_path'] . "'/><button class='btn btn-warning'>Delete</button></form></td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr>";
                    echo "<td colspan='3'>No files uploaded</td>";
                    echo "</tr>";
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>