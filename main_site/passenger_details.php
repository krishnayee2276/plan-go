<?php
require_once '../api/db_config.php';

$id = (int)($_GET['id'] ?? 0);
$fare_type = htmlspecialchars($_GET['fare_type'] ?? 'Saver');
$price = (float)($_GET['price'] ?? 0);
$flight_no = htmlspecialchars($_GET['flight_no'] ?? '');
$airline = htmlspecialchars($_GET['airline'] ?? '');
$dep_time = htmlspecialchars($_GET['dep_time'] ?? '');
$arr_time = htmlspecialchars($_GET['arr_time'] ?? '');
$duration = htmlspecialchars($_GET['duration'] ?? '');
$travel_date = htmlspecialchars($_GET['travel_date'] ?? '');

$indian_cities = ['Delhi', 'Mumbai', 'Bengaluru', 'Chennai', 'Hyderabad', 'Kolkata', 'Ahmedabad', 'Kochi', 'Pune', 'Goa'];

$is_domestic = false;
$flight = null;
if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM flights WHERE id = ?");

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $flight = $result->fetch_assoc();
    $stmt->close();
}

$indian_cities = ['Delhi', 'Mumbai', 'Bengaluru', 'Chennai', 'Hyderabad', 'Kolkata', 'Ahmedabad', 'Kochi', 'Pune', 'Goa'];
$is_domestic = $flight && in_array($flight['departure_city'], $indian_cities) && in_array($flight['arrival_city'], $indian_cities);
$base_price = $price;
$gst = $base_price * 0.18;
$airport_fees = 500;
$total = $base_price + $gst + $airport_fees;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Details - Plan & Go</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background: linear-gradient(135deg, #F2F4F5 0%, #E5E7EB 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1100px; margin: 0 auto; }
        .logo { height: 60px; display: block; margin: 0 auto 30px; }
        h1 { text-align: center; color: #1c1450; font-weight: 700; font-size: 28px; margin-bottom: 40px; }
        .booking-container { display: flex; gap: 40px; }
        .passenger-form { flex: 1; background: white; border-radius: 20px; padding: 40px; box-shadow: 0 12px 40px rgba(0,0,0,0.1); }
        .form-title { color: #1c1450; margin-bottom: 30px; font-size: 24px; }
        .form-group { margin-bottom: 24px; }
        .form-label { display: block; color: #1c1450; font-weight: 600; margin-bottom: 8px; font-size: 15px; }
        .form-control { width: 100%; padding: 16px 20px; border: 2px solid #e5e7eb; border-radius: 12px; font-size: 16px; transition: all 0.3s; }
        .form-control:focus { outline: none; border-color: #1c1450; box-shadow: 0 0 0 3px rgba(28,20,80,0.1); }
        .form-select { background: white; }
        .flight-summary { flex: 1; background: white; border-radius: 20px; padding: 40px; box-shadow: 0 12px 40px rgba(0,0,0,0.1); }
        .summary-header { color: #1c1450; margin-bottom: 30px; font-size: 24px; }
        .flight-details { background: linear-gradient(135deg, #1c1450, #2a1b5a); color: white; border-radius: 16px; padding: 30px; margin-bottom: 30px; }
        .price-highlight { font-size: 36px; font-weight: 800; color: #fae013; margin: 10px 0; }
        .proceed-btn { background: linear-gradient(135deg, #1c1450, #2a1b5a); color: #fae013; border: none; border-radius: 25px; padding: 20px 40px; font-weight: 800; font-size: 18px; width: 100%; cursor: pointer; transition: all 0.3s; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 8px 20px rgba(28,20,80,0.3); }
        .proceed-btn:hover { transform: translateY(-3px); box-shadow: 0 12px 30px rgba(28,20,80,0.4); }
        .required-mark { color: red; }
        .fare-breakdown { background: #f8fafc; padding: 20px; border-radius: 12px; margin-top: 20px; font-size: 14px; }
        .fare-row { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .fare-total { font-weight: 700; font-size: 20px; color: #1c1450; border-top: 2px solid #e5e7eb; padding-top: 12px; margin-top: 12px; }
        @media (max-width: 768px) { .booking-container { flex-direction: column; } }
    </style>

</head>
<body>
    <div class="container">
        <img src="../wp-content/uploads/2023/07/planngo.jpg" alt="Plan & Go" class="logo">
        <h1><i class="fas fa-passport me-3"></i>Passenger Details</h1>
        
        <form method="POST" action="payment.php" class="booking-container">
            <!-- Hidden fields for flight data -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="fare_type" value="<?php echo $fare_type; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <input type="hidden" name="flight_no" value="<?php echo $flight_no; ?>">
            <input type="hidden" name="airline" value="<?php echo $airline; ?>">
            <input type="hidden" name="dep_time" value="<?php echo $dep_time; ?>">
            <input type="hidden" name="travel_date" value="<?php echo $travel_date; ?>">

            <!-- Passenger Form - Left -->
            <div class="passenger-form">
                <h2 class="form-title"><i class="fas fa-user me-2"></i>Traveller Information</h2>
                
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="customer_name" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select class="form-control form-select" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Age</label>
                    <input type="number" class="form-control" name="age" min="1" max="120" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="customer_email" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" name="customer_phone" pattern="[0-9]{10}" title="10 digit mobile" required>
                </div>

                <div class="form-group">
                    <label class="form-label" id="passport-label">Passport Number <?php echo $is_domestic ? '(Optional)' : ''; ?><?php echo $is_domestic ? '' : '<span class="required-mark">*</span>'; ?></label>
                    <input type="text" class="form-control" name="passport_no" id="passport-input" <?php echo $is_domestic ? '' : 'required'; ?> placeholder="e.g., Z1234567">
                </div>
                
                <button type="submit" class="proceed-btn">

                    <i class="fas fa-credit-card me-2"></i>Proceed to Payment
                </button>
            </div>

            <!-- Flight Summary - Right -->
            <div class="flight-summary">
                <h2 class="summary-header"><i class="fas fa-plane me-2"></i>Flight Summary</h2>
                <div class="flight-details">
                    <h3><?php echo htmlspecialchars($airline ?: ($flight['airline_name'] ?? 'Airline')); ?></h3>
                    <div style="font-size: 14px; opacity: 0.9; margin-bottom: 10px;"><?php echo htmlspecialchars($flight_no ?: ($flight['flight_no'] ?? 'FL-XXX')); ?></div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <div><?php echo htmlspecialchars($dep_time ?: ($flight['dep_time'] ?? '06:30')); ?></div>
                        <div style="font-size: 12px; opacity: 0.8;">DEP</div>
                    </div>
                    <div style="text-align: center; color: #fae013; margin-bottom: 20px;">→ <?php echo htmlspecialchars($duration ?: '1h45m'); ?> →</div>
                </div>

                <div class="fare-breakdown">
                    <div class="fare-row"><span>Saver Fare (<?php echo $fare_type; ?>)</span><span>₹<?php echo number_format($base_price); ?></span></div>
                    <div class="fare-row"><span>GST (18%)</span><span>₹<?php echo number_format($gst); ?></span></div>
                    <div class="fare-row"><span>Airport Fees</span><span>₹<?php echo number_format($airport_fees); ?></span></div>
                    <div class="fare-total">
                        <span>Total Amount</span><span>₹<?php echo number_format($total); ?></span>
                    </div>
                </div>

                <div style="text-align: center; color: #6b7280;">
                    <i class="fas fa-shield-alt me-1"></i>Secure Booking | Instant Confirmation
                </div>
            </div>
        </form>
    </div>
</body>
</html>
