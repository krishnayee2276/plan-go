<?php
include 'api/db_config.php';

$sql = "ALTER TABLE users ADD COLUMN password VARCHAR(255) AFTER email";

if ($conn->query($sql) === TRUE) {
    echo "Password column added successfully to users table.";
} else {
    echo "Error adding password column: " . $conn->error;
}

$conn->close();
?>
