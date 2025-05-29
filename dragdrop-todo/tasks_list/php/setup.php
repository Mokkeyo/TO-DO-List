<?php

// Database connection parameters
$dbname = "todo";
$host = "localhost";
$user = "root";  // This is your admin user for creating the new user
$password = "";  // Admin user's password (empty in this case)

// New user credentials
$new_user = "user"; // The new username
$new_password = "t0{d0-l1]5t"; // The new user's password

// Create connection to MySQL server
$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    error_log("Connection Failed: " . $conn->connect_error);
    die(json_encode(["error" => "Database connection failed. Please try again later."]));
}

// Set charset to utf8mb4 for better character encoding support
$conn->set_charset("utf8mb4");

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (!$conn->query($sql)) {
    error_log("Error creating database: " . $conn->error);
    die(json_encode(["error" => "Failed to create database. Please try again later."]));
}

if (!$conn->select_db($dbname)) {
    error_log("Error selecting database: " . $conn->error);
    die(json_encode(["error" => "Failed to select database. Please try again later."]));
}

// Create the tasks table if not exists
$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    status TINYINT NOT NULL DEFAULT 0,
    color VARCHAR(7) NOT NULL DEFAULT '#3498db'
)";
if (!$conn->query($sql)) {
    error_log("Error creating tasks table: " . $conn->error);
    die(json_encode(["error" => "Failed to create tasks table. Please try again later."]));
}


// Create the new user and grant necessary permissions
$sql = "CREATE USER IF NOT EXISTS '$new_user'@'localhost' IDENTIFIED BY '$new_password'";
if (!$conn->query($sql)) {
    error_log("Error creating user: " . $conn->error);
    die(json_encode(["error" => "Failed to create user. Please try again later."]));
}

// Grant necessary permissions (CRUD operations) on the todo database
$sql = $sql = "GRANT SELECT, INSERT, UPDATE, DELETE ON $dbname.* TO '$new_user'@'localhost'";
if (!$conn->query($sql)) {
    error_log("Error granting permissions: " . $conn->error);
    die(json_encode(["error" => "Failed to grant permissions. Please try again later."]));
}

// Apply the changes
$sql = "FLUSH PRIVILEGES";
if (!$conn->query($sql)) {
    error_log("Error flushing privileges: " . $conn->error);
    die(json_encode(["error" => "Failed to apply privileges. Please try again later."]));
}

$conn->close();
echo json_encode(["success" => "New user created and permissions granted successfully."]);

?>