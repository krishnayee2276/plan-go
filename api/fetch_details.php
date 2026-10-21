<?php
/**
 * API to fetch package details via AJAX
 * Returns JSON with package information
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Database configuration
$host = "localhost";
$user = "root";
$pass = "";
$db = "plan_go_db";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit;
}

// Set charset
$conn->set_charset("utf8");

// Get package ID from request
$package_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($package_id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid package ID'
    ]);
    exit;
}

// Prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT id, p_name, description, price_inr, price_usd, duration, stay_type, image, highlights, category FROM packages WHERE id = ? AND status = 'Active'");
$stmt->bind_param("i", $package_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Package not found'
    ]);
    $stmt->close();
    $conn->close();
    exit;
}

$package = $result->fetch_assoc();
$stmt->close();

// Process highlights into array
$highlights = [];
if (!empty($package['highlights'])) {
    $highlights = array_map('trim', explode(',', $package['highlights']));
}

// Get additional images (if there's a pattern for multiple images)
// For now, we'll use the main image but prepare for gallery
$images = [];
if (!empty($package['image'])) {
    $images[] = 'uploads/' . $package['image'];
}

// Calculate discount price (example: 10% off for limited time)
$original_price = $package['price_inr'];
$discount_price = $original_price; // Can add discount logic here
$discount_percent = 0;

// Response
$response = [
    'success' => true,
    'data' => [
        'id' => $package['id'],
        'name' => htmlspecialchars($package['p_name']),
        'description' => htmlspecialchars($package['description']),
        'price_inr' => number_format($package['price_inr']),
        'price_usd' => $package['price_usd'],
        'original_price' => $original_price,
        'discount_price' => $discount_price,
        'discount_percent' => $discount_percent,
        'duration' => htmlspecialchars($package['duration']),
        'stay_type' => htmlspecialchars($package['stay_type']),
        'category' => htmlspecialchars($package['category']),
        'highlights' => $highlights,
        'images' => $images,
        'booking_url' => 'checkout.php?id=' . $package['id']
    ]
];

echo json_encode($response);

$conn->close();
?>
