<?php
    session_start();
    include("../includes/header.html");
    require __DIR__ . '/../handlers/message_handler.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="../assets/css/signup_page.css">
    <title>Scholarship: Signup</title>
</head>
<body>
    <form action="../handlers/signup_handler.php" id="signup" method="POST">
    <div class="signup_box">
        <div class="form_box" id="signup-form">
            <h1>Create an Account</h1>
            <?php showMessage(); ?>
            <input type="text" name="first_name" placeholder="First Name" required minlength="2" autofocus>
            <input type="text" name="last_name" placeholder="Last Name" required minlength="2">
            <input type="text" name="username" placeholder="Username" required minlength="3">
            <input type="password" name="password" placeholder="Password" required minlength="8">
            <button class="signup_center" type="submit" name="Signup">Signup</button>
            <p>Already have an account? <a class ="login" href="../auth/login.php">Login</a></p>
        </div>
    </div>
    </form>
</body>
</html>
