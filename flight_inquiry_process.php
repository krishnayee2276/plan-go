<?php
// Flight Inquiry Processing Script

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/config.php';
require_once ROOT_PATH . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$from_city = trim($_POST['from_city'] ?? '');
$to_city = trim($_POST['to_city'] ?? '');
$travel_date = trim($_POST['travel_date'] ?? '');

// Validation
if (empty($name) || empty($phone) || empty($from_city) || empty($to_city) || empty($travel_date)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// Format message as specified: [FLIGHT REQUEST] From: [Source] to [Dest] on [Date]
$message = '[FLIGHT REQUEST] From: ' . $from_city . ' to ' . $to_city . ' on ' . $travel_date;

// Default values for other fields
$email = 'flight@inquiry.com';
$destination = $to_city;

// Insert into database
$stmt = $conn->prepare("INSERT INTO inquiries (name, email, phone, destination, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $destination, $message);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Flight inquiry submitted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to submit inquiry']);
}

$stmt->close();
$conn->close();
?>
