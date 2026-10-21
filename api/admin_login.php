<?php
session_start();
header('Content-Type: application/json');

// Fixed admin credentials
$admin_email = 'infoplandgo@gmail.com';
$admin_password = 'errors@404#';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['identifier']) || !isset($data['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit;
}

$email = trim($data['identifier']);
$password = trim($data['password']);

if ($email === $admin_email && $password === $admin_password) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_email'] = $admin_email;
    echo json_encode(['status' => 'success', 'message' => 'Admin login successful']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid login credentials']);
}
?>
