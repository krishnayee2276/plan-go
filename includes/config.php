<?php
// Database connection details
$host = "localhost";
$user = "root";    // XAMPP ma default root hoy che
$pass = "";        // XAMPP ma default password khali hoy che
$db   = "plan_go_db"; // Tamara database nu naam

// MySQLi connection (primary)
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// PDO connection (optional, for newer code)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // PDO failed, but mysqli is still available
    $pdo = null;
}
?>





