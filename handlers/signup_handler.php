<?php
    session_start();
    require __DIR__ .'/../db_conn_config/db_config.php';

    if($_SERVER['REQUEST_METHOD'] !=='POST'){
        header("Location:../auth/signup.php");
        exit();
    }

    const ROLE = 'student';
    if(isset($_POST['Signup'])){
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $username = trim($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = ROLE;


        if(empty($first_name) || empty($last_name) || empty($username) || empty($password)){
            $_SESSION['error'] = 'Kindly please fill in all required fields';
            header("Location: ../signup.php");
            exit;
        }

        try{
            $query = $database_pdo -> prepare("SELECT * FROM users WHERE username = :username");
            $query -> execute([$username]);
            if ($query ->rowCount()> 0){
                $_SESSION['error'] = "Username already taken.";
                header("Location: ../auth/signup.php");
                exit;
            }
            $insertUser = $database_pdo -> prepare("INSERT INTO users (username, password, first_name, last_name, role) 
                                        VALUES (:username, :password, :first_name, :last_name,:role ) ");
            $insertUser->execute([
                'username'   => $username,
                'password'   => $password,
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'role'       => $role
            ]);

            $_SESSION['success'] = "Account created successfully. You can now login.";
            header("Location: ../auth/login.php");
            exit;

        } catch(PDOException $e){
            $_SESSION['error'] = "Error" . $e -> getMessage();
            header("Location: ../auth/signup.php");
            exit;
            // die("Inserting into database failed: " . $e->getMessage()); // for debugging at the start
        }
    }
?>