<?php
include 'includes/config.php';

$query = "SELECT DISTINCT category FROM packages";
$result = $conn->query($query);

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category'];
}

echo "Categories in database: " . implode(', ', $categories);
?>
