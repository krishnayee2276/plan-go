<?php
// Professional Multi-Step Booking Confirmation - Fixed Syntax
require_once '../api/db_config.php';

if (!isset($conn)) {
    die('Database connection failed.');
}

if (($_POST['payment_success'] ?? '') !== '1') {
    die('Payment required first.');
}

$customer_name = htmlspecialchars($_POST['customer_name'] ?? '');
$gender = htmlspecialchars($_POST['gender'] ?? '');
$age = (int)($_POST['age'] ?? 0);
$customer_email = htmlspecialchars($_POST['customer_email'] ?? '');
$customer_phone = htmlspecialchars($_POST['customer_phone'] ?? '');
$passport_no = htmlspecialchars($_POST['passport_no'] ?? '');
$flight_no = htmlspecialchars($_POST['flight_no'] ?? 'N/A');

$airline = htmlspecialchars($_POST['airline'] ?? 'N/A');
$travel_date = htmlspecialchars($_POST['travel_date'] ?? date('Y-m-d'));
$base_price = floatval($_POST['price'] ?? 0);
$total_price = $base_price;
$fare_type = htmlspecialchars($_POST['fare_type'] ?? 'Saver');
$id = (int)($_POST['id'] ?? 0);

$booking_id = uniqid('BK_');
$stmt = $conn->prepare("INSERT INTO flight_bookings (booking_id, flight_no, airline, travel_date, base_price, total_price, customer_email, customer_phone, passport_no, customer_name, gender, age, fare_type, flight_id, booking_status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'confirmed', NOW())");
$stmt->bind_param("ssssddssssissi", $booking_id, $flight_no, $airline, $travel_date, $base_price, $total_price, $customer_email, $customer_phone, $passport_no, $customer_name, $gender, $age, $fare_type, $id);
$stmt->execute();
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .details { background: #f8fafc; padding: 20px; border-radius: 12px; margin: 20px 0; text-align: left; }
    </style>
</head>
<body>
    <div class="confirmation">
        <div class="success-icon"><i class="fas fa-check-circle"></i></div>
        <h1 class="success">Booking Confirmed!</h1>
        <p style="font-size: 18px; margin-bottom: 20px;">Your booking has been successfully processed.</p>
        
        <div class="details">
            <h4 style="color: #1c1450; margin-bottom: 12px;"><i class="fas fa-plane me-2"></i>Flight Details</h4>
            <p><strong>Flight:</strong> <?php echo $flight_no; ?> | <?php echo $airline; ?></p>
            <p><strong>Date:</strong> <?php echo date('M j, Y', strtotime($travel_date)); ?></p>
            <p><strong>Amount:</strong> ₹<?php echo number_format($total_price); ?></p>
            <p><strong>Passenger:</strong> <?php echo $customer_name; ?> (<?php echo $gender; ?>, <?php echo $age; ?>yrs)</p>
            <p><strong>Contact:</strong> <?php echo $customer_phone; ?></p>
        </div>
        
        <p style="color: #6b7280; margin-bottom: 30px;"><strong>Booking ID:</strong> <span style="font-size: 20px; color: #1c1450; font-weight: 700;"><?php echo $booking_id; ?></span></p>
        <a href="flight_results.php" class="btn"><i class="fas fa-plane me-2"></i>Book Another Flight</a>
        <br><br>
        <small style="color: #9ca3af;">You will receive confirmation email shortly.</small>
    </div>
</body>
</html>
