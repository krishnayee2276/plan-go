<?php
// Booking confirmation - Original backup before fix
require_once '../api/db_config.php';

if (!isset($conn)) die('DB error');

if (($_POST['payment_success'] ?? '') !== '1') {
    die('Payment required first.');
}
    $customer_name = $_POST['customer_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $age = (int)($_POST['age'] ?? 0);
    $customer_email = $_POST['customer_email'] ?? '';
    $customer_phone = $_POST['customer_phone'] ?? '';
    $flight_no = $_POST['flight_no'] ?? 'N/A';
    $airline = $_POST['airline'] ?? 'N/A';
    $travel_date = $_POST['travel_date'] ?? date('Y-m-d');
    $base_price = floatval($_POST['price'] ?? 0);
    $total_price = $base_price;
    $fare_type = $_POST['fare_type'] ?? 'Saver';
    $id = (int)($_POST['id'] ?? 0);

    $booking_id = uniqid('BK_');
    $stmt = $conn->prepare("INSERT INTO flight_bookings (booking_id, flight_no, airline, travel_date, base_price, total_price, customer_email, customer_phone, customer_name, gender, age, fare_type, flight_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssddsssissi", $booking_id, $flight_no, $airline, $travel_date, $base_price, $total_price, $customer_email, $customer_phone, $customer_name, $gender, $age, $fare_type, $id);
    $stmt->execute();
    $stmt->close();
    
    echo '
    <html>
    <head>
        <title>Booking Confirmed - Plan & Go</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
        body { font-family: "Poppins", sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; background: linear-gradient(135deg, #F2F4F5 0%, #E5E7EB 100%); }
        .confirmation { background: white; padding: 40px; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.1); text-align: center; }
        .success-icon { width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: white; font-size: 36px; }
        .success { color: #10b981; font-size: 28px; font-weight: 700; margin-bottom: 20px; }
        .btn { background: linear-gradient(135deg, #1c1450, #2a1b5a); color: #fae013; padding: 14px 32px; text-decoration: none; border-radius: 25px; font-weight: 700; display: inline-block; transition: all 0.3s; box-shadow: 0 4px 12px rgba(28,20,80,0.3); }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(28,20,80,0.4); }
        </style>
    </head>
    <body>
        <div class="confirmation">
            <div class="success-icon"><i class="fas fa-check-circle"></i></div>
            <h1 class="success">Booking Confirmed!</h1>
            <p>Flight: ' . htmlspecialchars($flight_no) . ' | ' . htmlspecialchars($airline) . ' | ₹' . number_format($total_price) . '</p>
            <p>Booking ID: ' . htmlspecialchars($booking_id) . '</p>
            <a href="flight_results.php" class="btn">Book Another</a>
        </div>
    </body>
    </html>';
} else {
    header('Location: flight_results.php');
}
?>

