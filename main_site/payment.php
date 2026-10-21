<?php
// Receive POST from passenger_details.php
$customer_name = htmlspecialchars($_POST['customer_name'] ?? '');
$gender = htmlspecialchars($_POST['gender'] ?? '');
$age = (int)($_POST['age'] ?? 0);
$customer_email = htmlspecialchars($_POST['customer_email'] ?? '');
$customer_phone = htmlspecialchars($_POST['customer_phone'] ?? '');
$id = (int)($_POST['id'] ?? 0);
$fare_type = htmlspecialchars($_POST['fare_type'] ?? '');
$price = (float)($_POST['price'] ?? 0);
$flight_no = htmlspecialchars($_POST['flight_no'] ?? '');
$airline = htmlspecialchars($_POST['airline'] ?? '');
$dep_time = htmlspecialchars($_POST['dep_time'] ?? '');
$travel_date = htmlspecialchars($_POST['travel_date'] ?? '');

// Fetch flight details
require_once '../api/db_config.php';
$flight = null;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM flights WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $flight = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Plan & Go</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background: linear-gradient(135deg, #F2F4F5 0%, #E5E7EB 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .logo { height: 60px; display: block; margin: 0 auto 30px; }
        h1 { text-align: center; color: #1c1450; font-weight: 700; font-size: 28px; margin-bottom: 40px; }
        .payment-container { background: white; border-radius: 20px; box-shadow: 0 12px 40px rgba(0,0,0,0.1); overflow: hidden; }
        .summary-section { background: linear-gradient(135deg, #1c1450, #2a1b5a); color: white; padding: 30px; }
        .summary-total { font-size: 32px; font-weight: 800; color: #fae013; }
        .payment-section { padding: 40px; }
        .payment-title { color: #1c1450; margin-bottom: 30px; font-size: 24px; }
        .payment-option { display: block; width: 100%; padding: 20px; margin-bottom: 16px; border: 2px solid #e5e7eb; border-radius: 12px; text-align: left; cursor: pointer; transition: all 0.3s; background: white; }
        .payment-option:hover, .payment-option.active { border-color: #1c1450; box-shadow: 0 8px 25px rgba(28,20,80,0.15); }
        .payment-option i { font-size: 24px; width: 50px; text-align: center; margin-right: 16px; color: #1c1450; }
        .upi-qr { width: 150px; height: 150px; border: 1px solid #ddd; border-radius: 8px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; margin: 10px 0; font-size: 12px; color: #6b7280; }
        .card-fields { display: none; margin-top: 16px; }
        .card-fields input { width: 100%; padding: 12px; margin-bottom: 12px; border: 1px solid #e5e7eb; border-radius: 8px; }
        .pay-btn { background: linear-gradient(135deg, #1c1450, #2a1b5a); color: #fae013; border: none; border-radius: 25px; padding: 20px 40px; font-weight: 800; font-size: 18px; width: 100%; cursor: pointer; transition: all 0.3s; text-transform: uppercase; box-shadow: 0 8px 20px rgba(28,20,80,0.3); }
        .pay-btn:hover:not(:disabled) { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(28,20,80,0.4); }
        .pay-btn:disabled { opacity: 0.7; cursor: not-allowed; }
        .timer { text-align: center; margin-top: 20px; font-size: 18px; font-weight: 600; color: #1c1450; }
        #paymentLoader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); display: none; align-items: center; justify-content: center; z-index: 9999; color: white; }
        .spinner { width: 60px; height: 60px; border: 4px solid rgba(255,255,255,0.3); border-top: 4px solid #fae013; border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @media (max-width: 768px) { .payment-section { padding: 24px; } }
    </style>

</head>
<body>
    <div class="container">
        <img src="../wp-content/uploads/2023/07/planngo.jpg" alt="Plan & Go" class="logo">
        <h1><i class="fas fa-credit-card me-3"></i>Secure Payment</h1>
        
        <form method="POST" action="confirm_booking.php" id="paymentForm">
            <!-- Hidden passenger & flight data -->
            <input type="hidden" name="customer_name" value="<?php echo $customer_name; ?>">
            <input type="hidden" name="gender" value="<?php echo $gender; ?>">
            <input type="hidden" name="age" value="<?php echo $age; ?>">
            <input type="hidden" name="customer_email" value="<?php echo $customer_email; ?>">
            <input type="hidden" name="customer_phone" value="<?php echo $customer_phone; ?>">
            <input type="hidden" name="passport_no" value="<?php echo htmlspecialchars($_POST['passport_no'] ?? ''); ?>">
            <input type="hidden" name="payment_success" value="1">

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="fare_type" value="<?php echo $fare_type; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <input type="hidden" name="flight_no" value="<?php echo $flight_no; ?>">
            <input type="hidden" name="airline" value="<?php echo $airline; ?>">
            <input type="hidden" name="dep_time" value="<?php echo $dep_time; ?>">
            <input type="hidden" name="travel_date" value="<?php echo $travel_date; ?>">
            <input type="hidden" name="payment_mode" value="upi"> 

            <div class="payment-container">
                <!-- Summary -->
                <div class="summary-section">
                    <h3><?php echo htmlspecialchars($airline ?: ($flight['airline_name'] ?? 'Flight')); ?></h3>
                    <div><?php echo htmlspecialchars($flight_no ?: ($flight['flight_no'] ?? '')); ?></div>
                    <div style="margin: 20px 0; font-size: 14px; opacity: 0.9;">Total Amount</div>
                    <div class="summary-total">₹<?php echo number_format($price); ?></div>
                </div>

                <!-- Payment Options -->
                <div class="payment-section">
                    <h2 class="payment-title"><i class="fas fa-wallet me-2"></i>Choose Payment Method</h2>
                    
                    <label class="payment-option active" data-mode="upi">
                        <i class="fab fa-google-pay"></i>
                        <div>UPI Payment</div>
                        <img src="https://via.placeholder.com/150x150/1c1450/ffffff?text=UPI+QR+Scan+Me" alt="UPI QR Code" class="upi-qr" style="width: 150px; height: 150px; object-fit: cover;">
                        <div class="timer" id="payment-timer">Time Left: 5:00</div>
                    </label>


                    <label class="payment-option" data-mode="card">
                        <i class="fas fa-credit-card"></i>
                        <div>Credit/Debit Card</div>
                        <div class="card-fields">
                            <input type="text" placeholder="Card Number" maxlength="19">
                            <input type="text" placeholder="MM/YY" maxlength="5">
                            <input type="text" placeholder="CVV" maxlength="3">
                        </div>
                    </label>

                    <label class="payment-option" data-mode="netbanking">
                        <i class="fas fa-university"></i>
                        <div>Net Banking</div>
                        <div style="margin-top: 8px; font-size: 14px;">All Major Banks</div>
                    </label>

                    <button type="submit" class="pay-btn" id="payNow">
                        <i class="fas fa-lock me-2"></i>Pay Now Securely - ₹<?php echo number_format($price); ?>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Payment Loader -->
    <div id="paymentLoader">
        <div>Processing Payment...</div>
        <div class="spinner"></div>
    </div>

    <script>
        // Payment option selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', () => {
                document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
            });
        });

        let timeLeft = 300; // 5 minutes
        const timerEl = document.getElementById('payment-timer');
        const timer = setInterval(() => {
            const mins = Math.floor(timeLeft / 60);
            const secs = timeLeft % 60;
            timerEl.textContent = `Time Left: ${mins}:${secs.toString().padStart(2, '0')}`;
            timeLeft--;
            if (timeLeft < 0) {
                clearInterval(timer);
                timerEl.textContent = 'Payment Expired';
            }
        }, 1000);

        // Pay now with spinner
        document.getElementById('payNow').addEventListener('click', (e) => {
            e.preventDefault();
            const loader = document.getElementById('paymentLoader');
            const btn = document.getElementById('payNow');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            loader.style.display = 'flex';
            
            setTimeout(() => {
                document.getElementById('paymentForm').submit();
            }, 2000);
        });
    </script>

</body>
</html>
