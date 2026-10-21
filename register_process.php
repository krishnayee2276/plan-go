<?php
session_start();
require_once 'api/db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$password = $_POST['password'] ?? '';

$error = '';

// Validation
if (empty($username) || empty($email) || empty($mobile) || empty($password)) {
    $error = 'All fields are required.';
} elseif (strlen($password) < 6) {
    $error = 'Password must be at least 6 characters.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email format.';
}

if ($error) {
    $_SESSION['error'] = $error;
    header('Location: register.php');
    exit;
}

// Check duplicates
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR phone = ?");
$stmt->bind_param("ss", $email, $mobile);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $_SESSION['error'] = 'Email or mobile already registered.';
    $stmt->close();
    header('Location: register.php');
    exit;
}
$stmt->close();

// Hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert
$stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, status) VALUES (?, ?, ?, ?, 'Active')");
$stmt->bind_param("ssss", $username, $email, $mobile, $hashed);

if ($stmt->execute()) {
    $_SESSION['success'] = 'Registration successful! Please login.';
    $stmt->close();
    $conn->close();
    header('Location: login.php');
    exit;
} else {
    $_SESSION['error'] = 'Registration failed. Try again.';
    $stmt->close();
    header('Location: register.php');
    exit;
}

$conn->close();
?>

