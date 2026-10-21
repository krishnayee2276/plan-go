<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Complete Your Booking | Plan&Go - MakeMyTrip Style</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="results.css" rel="stylesheet">
</head>
<body>
<?php
require_once '../api/db_config.php';

session_start();
$flight_id = (int)($_GET['id'] ?? ($_SESSION['selected_flight']['flight_id'] ?? 0));
$fare_type = htmlspecialchars($_GET['fare'] ?? ($_SESSION['selected_flight']['fare_type'] ?? 'Saver'));
$base_price = (float)($_GET['price'] ?? ($_SESSION['selected_flight']['price'] ?? 10000));
$from_city = htmlspecialchars($_GET['from_city'] ?? ($_SESSION['selected_flight']['from_city'] ?? 'Delhi'));
$to_city = htmlspecialchars($_GET['to_city'] ?? ($_SESSION['selected_flight']['to_city'] ?? 'Bengaluru'));

// Clear session after use
unset($_SESSION['selected_flight']);

$tax_rate = 0.08; // 8%
$insurance_price = 500;
$meal_price = 300;
$tax = $base_price * $tax_rate;
$total_amount = $base_price + $tax;

$flight_stmt = $conn->prepare("SELECT * FROM flights WHERE id = ?");
$flight_stmt->bind_param("i", $flight_id);
$flight_stmt->execute();
$flight = $flight_stmt->get_result()->fetch_assoc() ?: [];

$dep_time = $flight['departure_time'] ?? date('H:i', strtotime('08:00'));
$duration = $flight['duration_hours'] ?? 2;
$arr_time = date('H:i', strtotime($dep_time . " +{$duration}h"));
?>

<div class="booking-container">
  <div class="booking-main">
    <!-- Flight Summary Card -->
    <div class="flight-summary-card">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h3 class="mb-2"><i class="fas fa-plane text-primary me-3"></i><?php echo htmlspecialchars($flight['airline_name'] ?? 'Airline'); ?> - <?php echo htmlspecialchars($flight['flight_no'] ?? 'FL-XXX'); ?></h3>
          <div class="row">
            <div class="col-5">
              <div class="time"><?php echo $dep_time; ?></div>
              <div class="fw-bold"><?php echo htmlspecialchars($flight['departure_city'] ?? $from_city); ?></div>
            </div>
            <div class="col-2 text-center">
              <div class="duration-line mx-auto" style="width: 60px;"></div>
              <div class="fw-semibold text-primary"><?php echo $duration; ?>h</div>
            </div>
            <div class="col-5 text-end">
              <div class="time"><?php echo $arr_time; ?></div>
              <div class="fw-bold"><?php echo htmlspecialchars($flight['arrival_city'] ?? $to_city); ?></div>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-end">
          <span class="badge bg-primary px-3 py-2"><?php echo ucfirst($fare_type); ?> Fare</span>
        </div>
      </div>
    </div>

    <div class="row">
      <!-- Left Column: Forms -->
      <div class="col-lg-8">
        <!-- Traveler Details -->
        <div class="passenger-section">
          <h4 class="mb-4"><i class="fas fa-passport me-2 text-primary"></i>Traveller Details</h4>
          <form id="bookingForm" method="POST" action="process_booking.php">
            <input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
            <input type="hidden" name="fare_type" value="<?php echo $fare_type; ?>">
            <input type="hidden" name="base_amount" value="<?php echo $base_price; ?>">
            <input type="hidden" name="addons_insurance" value="0">
            <input type="hidden" name="addons_meal" value="0">
            <input type="hidden" name="payment_mode" value="upi">

            <div class="row">
              <div class="col-md-6 mb-4">
                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="passenger_name" required>
              </div>
              <div class="col-md-3 mb-4">
                <label class="form-label">Age <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="age" min="1" max="120" required>
              </div>
              <div class="col-md-3 mb-4">
                <label class="form-label">Gender <span class="text-danger">*</span></label>
                <select class="form-select" name="gender" required>
                  <option value="">Select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="col-md-6 mb-4">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input type="tel" class="form-control" name="mobile" pattern="[0-9]{10}" required>
              </div>
              <div class="col-md-6 mb-4">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" required>
              </div>
            </div>
          </div>

          <!-- Add-ons -->
          <div class="addons-section">
            <h4 class="mb-4"><i class="fas fa-plus-circle me-2 text-primary"></i>Add-ons</h4>
            <label class="addon-checkbox">
              <input type="checkbox" name="insurance" value="1" data-price="<?php echo $insurance_price; ?>">
              <div>
                <div class="fw-bold">Travel Insurance</div>
                <div class="small text-muted">Comprehensive coverage for trip cancellation, medical emergencies</div>
                <div class="h6 text-accent">+ ₹<?php echo number_format($insurance_price); ?></div>
              </div>
            </label>
            <label class="addon-checkbox">
              <input type="checkbox" name="meal" value="1" data-price="<?php echo $meal_price; ?>">
              <div>
                <div class="fw-bold">Meal Preference</div>
                <div class="small text-muted">Choose vegetarian/non-veg meal on board</div>
                <div class="h6 text-accent">+ ₹<?php echo number_format($meal_price); ?></div>
              </div>
            </label>
          </div>

          <!-- Payment -->
          <div class="payment-section">
            <h4 class="mb-4"><i class="fas fa-credit-card me-2 text-primary"></i>Payment Mode</h4>
            <div class="payment-mode">
              <div class="payment-option active" data-mode="upi">
                <i class="fab fa-google-pay fa-2x mb-2 d-block text-success"></i>
                <div>UPI</div>
              </div>
              <div class="payment-option" data-mode="card">
                <i class="fas fa-credit-card fa-2x mb-2 d-block text-primary"></i>
                <div>Cards</div>
              </div>
              <div class="payment-option" data-mode="netbanking">
                <i class="fas fa-university fa-2x mb-2 d-block text-info"></i>
                <div>Net Banking</div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn-proceed mb-4" id="proceedBtn">
            <i class="fas fa-lock me-2"></i>Proceed to Pay ₹<span id="dynamicTotal"><?php echo number_format($total_amount); ?></span>
          </button>
        </form>
      </div>

      <!-- Right Column: Fare Summary -->
      <div class="col-lg-4">
        <div class="fare-summary p-4">
          <h4 class="mb-4"><i class="fas fa-receipt text-primary me-2"></i>Fare Summary</h4>
          
          <div class="summary-item">
            <span>Base Fare (<?php echo $fare_type; ?>)</span>
            <span class="fw-bold text-primary">₹<?php echo number_format($base_price); ?></span>
          </div>
          
          <div class="summary-item">
            <span>Taxes & Airport Fees</span>
            <span>₹<?php echo number_format($tax); ?></span>
          </div>
          
          <div class="summary-item">
            <span id="addonsSummary">Add-ons</span>
            <span id="addonsAmount">₹0</span>
          </div>
          
          <hr class="my-4">
          
          <div class="summary-total">
            <span>Total Amount</span>
            <span>₹<span id="fareTotal"><?php echo number_format($total_amount); ?></span></span>
          </div>

          <div class="mt-4 pt-4 border-top">
            <div class="small text-muted mb-2"><i class="fas fa-suitcase me-1"></i> <?php echo $fare_type == 'Saver' ? '20kg' : '30kg'; ?> baggage included</div>
            <div class="small text-muted mb-2"><i class="fas fa-clock me-1"></i> Duration: <?php echo $duration; ?>h</div>
            <div class="small text-muted"><i class="fas fa-shield-alt me-1"></i> Free cancel 24h prior</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Payment Loader -->
<div class="loading-overlay" id="paymentLoader" style="display: none;">
  <div class="spinner"></div>
  <div class="mt-4 h3">Processing Payment</div>
  <div class="mt-2">Please wait...</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="booking.js"></script>
<script>
// Init totals
window.basePrice = <?php echo $base_price; ?>;
window.tax = <?php echo $tax; ?>;
window.insurancePrice = <?php echo $insurance_price; ?>;
window.mealPrice = <?php echo $meal_price; ?>;
window.currentTotal = <?php echo $total_amount; ?>;
</script>
</body>
</html>

