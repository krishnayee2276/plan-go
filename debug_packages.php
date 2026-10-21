<?php
require_once 'db_config.php';

echo "<h1>Package Debug - " . date('Y-m-d H:i:s') . "</h1>";
echo "<p>DB Connected: " . ($conn ? 'YES' : 'NO') . "</p>";

// Test 1: All packages
$result = $conn->query("SELECT * FROM packages");
echo "<h2>All packages (count: " . $result->num_rows . ")</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>ID: {$row['id']} | Name: {$row['p_name']} | Category: {$row['category']} | Status: {$row['status']} | Image: {$row['image']}</p>";
}

// Test 2: Active packages
$result = $conn->query("SELECT * FROM packages WHERE status = 'Active'");
echo "<h2>Active packages (count: " . $result->num_rows . ")</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>ID: {$row['id']} | Name: {$row['p_name']} | Category: {$row['category']}</p>";
}

// Test 3: Domestic active
$stmt = $conn->prepare("SELECT * FROM packages WHERE LOWER(category) = LOWER(?) AND status = 'Active'");
$stmt->bind_param("s", "domestic");
$stmt->execute();
$result = $stmt->get_result();
echo "<h2>Domestic Active (count: " . $result->num_rows . ")</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<p>ID: {$row['id']} | Name: {$row['p_name']}</p>";
}
$stmt->close();

echo "<p><a href='packages.php?cat=domestic'>Test packages.php?cat=domestic</a></p>";
?>

