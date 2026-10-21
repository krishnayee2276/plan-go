<?php
// Script to add slug column to packages table

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plan_go_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if slug column exists
    $result = $pdo->query("SHOW COLUMNS FROM packages LIKE 'slug'");
    $exists = $result->fetch();

    if (!$exists) {
        // Add slug column
        $sql = "ALTER TABLE packages ADD COLUMN slug VARCHAR(255) UNIQUE AFTER id";
        $pdo->exec($sql);
        echo "Slug column added successfully to packages table.<br>";
    } else {
        echo "Slug column already exists.<br>";
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$pdo = null;
?>
