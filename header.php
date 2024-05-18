<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css">
    <link rel="stylesheet" href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css">
    <link rel="stylesheet" href="styles/main.css">
    <title><?php echo $title; ?></title>
</head>
<nav class="navi" style="display: flex; width: 100%;">
    <ul style="list-style-type: none;">
        <li>
            <a href="welcome.php">Login</a>
        </li>
        <?php if (!empty($_SESSION['user_id'])) : ?>
            <li>
                <a href="index.php">Dashboard</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>