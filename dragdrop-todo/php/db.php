<?php

$host = "localhost";
$user = "user";
$password = "t0{d0-l1]5t";
$database = "todo";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $password, $database);
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    die("Database connection error. Please try again later.");
}

header("Content-Type: application/json; charset=UTF-8");

?>