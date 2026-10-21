<?php
/**
 * Set session for selected flight from modal and redirect to booking_details.php
 */
session_start();
header('Content-Type: application/json');

if ($_POST && isset($_POST['flight_id']) && isset($_POST['fare_type']) && isset($_POST['price'])) {
    $_SESSION['selected_flight'] = [
        'flight_id' => (int)$_POST['flight_id'],
        'fare_type' => htmlspecialchars($_POST['fare_type']),
        'price' => (float)$_POST['price'],
        'from_city' => htmlspecialchars($_POST['from_city'] ?? 'Delhi'),
        'to_city' => htmlspecialchars($_POST['to_city'] ?? 'Mumbai')
    ];
    
    echo json_encode(['success' => true, 'redirect' => 'booking_details.php']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Missing required data']);
?>
