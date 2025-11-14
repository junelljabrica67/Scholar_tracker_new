<?php
    session_start();
    require __DIR__ .'/../db_conn_config/db_config.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $_SESSION['error'] = "Please fill in all fields.";
            header("Location: ../auth/login.php");
            exit;
        }

        try {
            $checkLogin = $database_pdo->prepare("SELECT * FROM users WHERE username = :username");
            $checkLogin -> execute([
                    ':username'=> $username]
                );
            $user = $checkLogin->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['username']; 
                header("Location: ../actions/student/student_home.php"); // redirect to dashboard
                exit;

            } else {
                $_SESSION['error'] = "Invalid username or password.";
                header("Location: ../auth/login.php");
                exit;
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            header("Location: ../auth/login.php");
            exit;
        }
    }

?>