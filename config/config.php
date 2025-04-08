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

    // Check if the 'category' table exists, if not create a one with the same structure
    $sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    // category table with id, name, description, created_at

    // Check if the 'topics' table exists, if not create a one with the same structure
    $sql = "CREATE TABLE IF NOT EXISTS topics (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            user_id INT(11) NOT NULL,
            category_id INT(11) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (category_id) REFERENCES categories(id)
        )";
    $pdo->exec($sql);
    // topics table with id, title, content, user_id, category_id, created_at

} catch (PDOException $e) {
    // Display the error message on the page
    die("Database connection failed: " . $e->getMessage());
}