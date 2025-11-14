<?php
    session_start();

    require __DIR__ . '/../handlers/message_handler.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login_page.css">
    <title>Scholarship: Login</title>
</head>
<body>
    <?php include("../includes/header.html") ?>
    <div class="login_box">
        <form action ="../handlers/login_handler.php" method="POST">
            <h1>Login</h1>
            <?php showMessage(); ?>
            <input type="text" name="username" placeholder="Username" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button class="login_center" type="submit" name="login">Login</button>
            <p>Don't have an account? <a class ="register" href="../auth/signup.php">Register</a></p>
        </form>
    </div>
</body>
</html>
