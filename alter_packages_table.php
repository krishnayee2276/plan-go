<?php
// Script to alter packages table to add missing columns for 18 fields

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plan_go_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Add missing columns
    $alter_queries = [
        "ALTER TABLE packages ADD COLUMN visa_status VARCHAR(255) DEFAULT NULL AFTER slug",
        "ALTER TABLE packages ADD COLUMN stay_type VARCHAR(255) DEFAULT NULL AFTER visa_status",
        "ALTER TABLE packages ADD COLUMN cuisine VARCHAR(255) DEFAULT NULL AFTER stay_type",
        "ALTER TABLE packages ADD COLUMN car_rental VARCHAR(255) DEFAULT NULL AFTER cuisine",
        "ALTER TABLE packages ADD COLUMN cuisine_name VARCHAR(255) DEFAULT NULL AFTER car_rental",
        "ALTER TABLE packages ADD COLUMN cuisine_image VARCHAR(255) DEFAULT NULL AFTER cuisine_name",
        "ALTER TABLE packages ADD COLUMN car_link VARCHAR(255) DEFAULT NULL AFTER cuisine_image",
        "ALTER TABLE packages ADD COLUMN image VARCHAR(255) DEFAULT NULL AFTER car_link"
    ];

    foreach ($alter_queries as $sql) {
        try {
            $pdo->exec($sql);
            echo "Column added successfully.<br>";
        } catch (PDOException $e) {
            if ($e->getCode() == '42S21') {
                echo "Column already exists.<br>";
            } else {
                echo "Error adding column: " . $e->getMessage() . "<br>";
            }
        }
    }

    echo "Table alteration completed.";

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$pdo = null;
?>
