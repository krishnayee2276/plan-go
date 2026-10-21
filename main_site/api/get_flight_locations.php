<?php
header('Content-Type: application/json');
require_once '../../api/db_config.php';

$dest = $conn->query("SELECT DISTINCT destination_city FROM packages WHERE status = 'active' ORDER BY destination_city");
$cities = [];
while ($row = $dest->fetch_assoc()) {
    $cities[] = $row['destination_city'];
}

$dep = $conn->query("SELECT DISTINCT departure_city FROM flights ORDER BY departure_city");
while ($row = $dep->fetch_assoc()) {
    if (!in_array($row['departure_city'], $cities)) $cities[] = $row['departure_city'];
}

echo json_encode(array_unique($cities));
?>

