<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../config.php';
require_once ROOT_PATH . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$destination = trim($_POST['destination'] ?? '');
$message = trim($_POST['message'] ?? '');
$inquiry_type = trim($_POST['inquiry_type'] ?? 'GENERAL');

// Flight-specific fields
$flight_from = trim($_POST['flight_from'] ?? '');
$flight_to = trim($_POST['flight_to'] ?? '');
$flight_date = trim($_POST['flight_date'] ?? '');
$flight_class = trim($_POST['flight_class'] ?? '');

// Format message based on inquiry type
if ($inquiry_type === 'FLIGHT' && !empty($flight_from)) {
    $formatted_message = '[FLIGHT REQUEST] - ' . $name . ' | Phone: ' . $phone . ' | Date: ' . $flight_date . ' - From: ' . $flight_from . ' -> To: ' . $flight_to . ' | Class: ' . $flight_class . ' | ' . $message;
} else {
    $formatted_message = '[' . strtoupper($inquiry_type) . '] - ' . $name . ' | Phone: ' . $phone . ' | Date: ' . $destination . ' - ' . $message;
}

if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

$stmt = $conn->prepare("INSERT INTO inquiries (name, email, phone, destination, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $destination, $formatted_message);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Inquiry submitted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to submit inquiry']);
}

$stmt->close();
$conn->close();
?>
