<?php
header('Content-Type: application/json');
require_once '../api/db_config.php';

$cities = [];
if ($conn) {
    // Packages locations
    $result = $conn->query("SELECT DISTINCT destination_city as city FROM packages WHERE status = 'active' ORDER BY destination_city");
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['city'];
    }
    
    // Flights cities
    $result = $conn->query("SELECT DISTINCT departure_city as city FROM flights ORDER BY departure_city");
    while ($row = $result->fetch_assoc()) {
        if (!in_array($row['city'], $cities)) $cities[] = $row['city'];
    }
    $result = $conn->query("SELECT DISTINCT arrival_city as city FROM flights ORDER BY arrival_city");
    while ($row = $result->fetch_assoc()) {
        if (!in_array($row['city'], $cities)) $cities[] = $row['city'];
    }
    
    echo json_encode(array_unique($cities));
} else {
    echo json_encode(['error' => 'DB connection failed']);
}
?>

