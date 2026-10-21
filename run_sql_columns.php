<?php
// This script adds the itinerary and inclusions columns to the packages table

$host = "localhost";
$user = "root";
$pass = "";
$db = "plan_go_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add columns if they don't exist
$sql1 = "ALTER TABLE packages ADD COLUMN IF NOT EXISTS itinerary TEXT AFTER image";
$sql2 = "ALTER TABLE packages ADD COLUMN IF NOT EXISTS inclusions VARCHAR(255) AFTER itinerary";

if ($conn->query($sql1)) {
    echo "Column 'itinerary' added successfully!<br>";
} else {
    echo "Error adding 'itinerary': " . $conn->error . "<br>";
}

if ($conn->query($sql2)) {
    echo "Column 'inclusions' added successfully!<br>";
} else {
    echo "Error adding 'inclusions': " . $conn->error . "<br>";
}

echo "<br>Database columns are ready!";

$conn->close();
?>
