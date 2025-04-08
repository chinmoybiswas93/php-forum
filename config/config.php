<?php
define('BASE_URL', "http://localhost:8888/");

// Database connection details
$servername = "localhost"; // Use only the hostname
$username = "root";
$password = "root"; // Default MAMP password
$dbname = "forum";
$port = 8889; // MAMP MySQL port
$socket = "/Applications/MAMP/tmp/mysql/mysql.sock"; // MAMP MySQL socket path

try {
    // Create a PDO connection with the socket
    $dsn = "mysql:host=$servername;port=$port;dbname=$dbname;charset=utf8mb4;unix_socket=$socket";
    $pdo = new PDO($dsn, $username, $password);

    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //chekc if the 'users' table exists, if not create a one with the same structure
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        avatar VARCHAR(255) DEFAULT 'default.jpg',
        about VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);

    // users table with id, name, email, username, password, created_at

} catch (PDOException $e) {
    // Display the error message on the page
    die("Database connection failed: " . $e->getMessage());
}