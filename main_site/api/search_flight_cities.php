<?php
header('Content-Type: application/json');
require_once '../../api/db_config.php';

$query = $_GET['q'] ?? '';
if (strlen($query) < 2) {
    exit(json_encode([]));
}

$sql = "SELECT DISTINCT destination_city as city FROM packages WHERE status = 'Active' AND LOWER(destination_city) LIKE LOWER(?) 
        UNION 
        SELECT DISTINCT departure_city as city FROM flights WHERE LOWER(departure_city) LIKE LOWER(?) 
        UNION 
        SELECT DISTINCT arrival_city as city FROM flights WHERE LOWER(arrival_city) LIKE LOWER(?)
        ORDER BY city LIMIT 10";

$like = '%' . $query . '%';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();

$cities = [];
while ($row = $result->fetch_assoc()) {
    $cities[] = $row['city'];
}

echo json_encode($cities);
?>

