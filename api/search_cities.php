<?php
header('Content-Type: application/json');
require_once 'db_config.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if (strlen($q) < 2) {
    exit(json_encode([]));
}

$stmt = $conn->prepare("SELECT id, code, name, full_name FROM cities WHERE name LIKE ? OR code LIKE ? OR full_name LIKE ? LIMIT 10");
$search = "%$q%";
$stmt->bind_param("sss", $search, $search, $search);
$stmt->execute();
$result = $stmt->get_result();

$cities = [];
while ($row = $result->fetch_assoc()) {
    $cities[] = $row;
}

echo json_encode($cities);
$conn->close();
?>
