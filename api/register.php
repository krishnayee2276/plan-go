<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once __DIR__ . '/../config.php';
require_once ROOT_PATH . '/includes/db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['fullname'], $data['identifier'], $data['password'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request. Name, identifier, and password are required."
    ]);
    exit;
}

$fullname = trim($data['fullname']);
$identifier = trim($data['identifier']);
$password = $data['password'];

if ($fullname === '' || $identifier === '' || $password === '') {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required."
    ]);
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

// Determine if identifier is email or phone
$is_email = filter_var($identifier, FILTER_VALIDATE_EMAIL);
$email = $is_email ? $identifier : '';
$phone = !$is_email ? $identifier : '';

// Check duplicates
if ($email !== '') {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Email already registered."
        ]);
        exit;
    }
    $stmt->close();
}

if ($phone !== '') {
    $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Phone already registered."
        ]);
        exit;
    }
    $stmt->close();
}

// Insert user
$stmt = $conn->prepare(
    "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssss", $fullname, $email, $phone, $hashed);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Registration successful."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Registration failed."
    ]);
}

$stmt->close();
$conn->close();
