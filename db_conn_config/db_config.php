<?php
    // Posgres database config
    $host = "localhost";
    $port = "5432";
    $dbname = "Scholarship_tracker";
    $username = "postgres";
    $password = "1261";
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    try {
        $database_pdo = new PDO($dsn, $username, $password);

        $database_pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
?>