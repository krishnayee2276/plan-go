<?php
error_reporting(0);
ob_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once __DIR__ . '/db_config.php';

if (!$conn) {
    ob_end_clean();
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed"
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['identifier']) || !isset($data['password'])) {
    ob_end_clean();
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request"
    ]);
    exit;
}

$identifier = trim($data['identifier']);
$password = $data['password'];

$is_email = filter_var($identifier, FILTER_VALIDATE_EMAIL);
$query = $is_email ? "SELECT id, password FROM users WHERE email = ?" : "SELECT id, password FROM users WHERE phone = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $identifier);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        ob_end_clean();
        echo json_encode([
            "status" => "success",
            "message" => "Login successful"
        ]);
    } else {
        ob_end_clean();
        echo json_encode([
            "status" => "error",
            "message" => "Invalid credentials"
        ]);
    }
} else {
    ob_end_clean();
    echo json_encode([
        "status" => "error",
        "message" => "Invalid credentials"
    ]);
}

$stmt->close();
$conn->close();
