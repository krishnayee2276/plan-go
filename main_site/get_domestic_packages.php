<?php
include '../includes/config.php';

$query = "SELECT p_name, price_inr, description, p_image, duration FROM packages WHERE category = 'Domestic' AND status = 'Active'";
$result = $conn->query($query);

$packages = [];
while ($row = $result->fetch_assoc()) {
    $packages[] = [
        'title' => $row['p_name'],
        'price' => $row['price_inr'],
        'description' => $row['description'],
        'image' => '../../admin/uploads/' . $row['p_image'],
        'duration' => $row['duration']
    ];
}

echo json_encode($packages);
?>
