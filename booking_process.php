<?php
// Booking Process Script - Handles Flight and Train Inquiries

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "plan_go_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}
$conn->set_charset("utf8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$from_city = trim($_POST['from_city'] ?? '');
$to_city = trim($_POST['to_city'] ?? '');
$travel_date = trim($_POST['travel_date'] ?? '');
$service_type = isset($_POST['service_type']) ? trim($_POST['service_type']) : 'FLIGHT';

// Validation
if (empty($name) || empty($phone) || empty($from_city) || empty($to_city) || empty($travel_date)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// Format message with prefix based on service type
if (strtoupper($service_type) === 'TRAIN') {
    $message_prefix = '[TRAIN BOOKING]';
} else {
    $message_prefix = '[FLIGHT BOOKING]';
}

// Format message: [FLIGHT BOOKING] From: Source to Dest on Date
$message = $message_prefix . ' From: ' . $from_city . ' to ' . $to_city . ' on ' . $travel_date;

// Default email
$email = 'booking@inquiry.com';
$destination = $to_city;

// Insert into database
$stmt = $conn->prepare("INSERT INTO inquiries (name, email, phone, destination, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $destination, $message);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Booking inquiry submitted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to submit inquiry']);
}

$stmt->close();
$conn->close();
?>
