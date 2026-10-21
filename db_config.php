<?php
// Database configuration for plan_go_db
$host = "localhost";
$user = "root";
$pass = "";
$db = "plan_go_db";

// Create mysqli connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to utf8
$conn->set_charset("utf8");
?>
