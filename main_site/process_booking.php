<?php
session_start();
require_once '../api/db_config.php';

if ($_POST && isset($_POST['flight_id'], $_POST['fare_type'], $_POST['price'])) {
    $flight_id = (int)$_POST['flight_id'];
    $fare_type = htmlspecialchars($_POST['fare_type']);
    $price = (float)$_POST['price'];
    $passenger_name = htmlspecialchars($_POST['adult1_name'] ?? '');
    $passenger_age = (int)$_POST['adult1_age'] ?? 0;
    $customer_email = htmlspecialchars($_POST['adult1_email'] ?? '');
    $customer_phone = htmlspecialchars($_POST['adult1_phone'] ?? '');
    $payment_mode = htmlspecialchars($_POST['payment_mode'] ?? 'card');
    
    // Fetch flight details
    $stmt = $conn->prepare("SELECT * FROM flights WHERE id = ?");
    $stmt->bind_param("i", $flight_id);
    $stmt->execute();
    $flight = $stmt->get_result()->fetch_assoc();
    
    if ($flight) {
        $total_amount = $price + 800; // base + taxes
        
        // Insert booking - using existing customer columns
        $insert_stmt = $conn->prepare("
            INSERT INTO flight_bookings (flight_id, passenger_name, passenger_age, customer_email, customer_phone, 
            fare_type, base_price, total_amount, payment_mode, booking_status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'confirmed', NOW())
        ");
        $insert_stmt->bind_param("isisddsss", 
            $flight_id, $passenger_name, $passenger_age, $customer_email, $customer_phone,
            $fare_type, $price, $total_amount, $payment_mode
        );
        
        if ($insert_stmt->execute()) {
            $booking_id = $conn->insert_id;
            $_SESSION['booking_success'] = [
                'booking_id' => $booking_id,
                'flight' => $flight,
                'total' => $total_amount
            ];
            header('Location: booking_success.php');
            exit;
        }
    }
}

$_SESSION['error'] = 'Booking failed. Please try again.';
header('Location: complete_booking.php');
exit;
?>

