<?php
include 'db_config.php';

$category = $_GET['category'] ?? '';

if (empty($category)) {
    echo json_encode(['error' => 'Category is required']);
    exit;
}

$query = "SELECT p_name, price_inr, description, p_image, duration FROM packages WHERE category = ? AND status = 'Active'";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $category);
$stmt->execute();
$result = $stmt->get_result();

$packages = [];
while ($row = $result->fetch_assoc()) {
    $packages[] = [
        'title' => $row['p_name'],
        'price' => $row['price_inr'],
        'description' => $row['description'],
'image' => '../admin/upload/' . ($row['p_image'] ?: 'default-package.jpg'),
        'duration' => $row['duration']
    ];
}

echo json_encode($packages);
?>

