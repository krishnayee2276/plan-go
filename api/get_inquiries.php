<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include 'db_config.php';

$query = "SELECT id, name, email, phone, destination, message, status, created_at FROM inquiries ORDER BY created_at DESC";
$result = $conn->query($query);

$inquiries = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inquiries[] = $row;
    }
}

echo json_encode(['success' => true, 'inquiries' => $inquiries]);

$conn->close();
?>
