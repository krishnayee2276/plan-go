
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Premium Booking | Plan & Go</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="results.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .booking-container { max-width: 1400px; margin: 0 auto; padding: 40px 20px; }
        
        /* Progress Bar Glassmorphism */
        .progress-container {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 50px;
            padding: 4px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .progress-step {
            flex: 1;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            color: var(--gray-500);
            position: relative;
        }
        
        .progress-step.active { color: var(--primary); }
        .progress-step.completed { color: var(--accent); }
        .progress-step.completed::after { 
            content: '✓'; 
            position: absolute; 
            top: -25px; 
            right: -5px; 
            background: var(--accent); 
            color: var(--primary);
            width: 24px; height: 24px; 
            border-radius: 50%; 
            display: flex; align-items: center; justify-content: center; 
            font-weight: bold; font-size: 12px; 
            box-shadow: 0 4px 12px rgba(250,224,19,0.4);
        }
        
        /* 2 Column Layout */
        .booking-main { display: grid; grid-template-columns: 1fr 380px; gap: 40px; }
        
        @media (max-width: 992px) {
            .booking-main { grid-template-columns: 1fr; gap: 30px; }
            .fare-summary { order: -1; position: static; }
        }
        
        /* Floating Labels Enhanced */
        .floating-group {
            position: relative;
        }
        
        .floating-label {
            position: absolute;
            left: 16px; top: 50%; transform: translateY(-50%) scale(1);
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            pointer-events: none; color: var(--gray-500); font-weight: 500;
        }
        
        .form-control:focus ~ .floating-label,
        .form-control:not(:placeholder-shown) ~ .floating-label {
            top: -12px; left: 12px; transform: translateY(0) scale(0.8);
            background: white; padding: 0 8px; color: var(--primary); font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        /* Yellow Selected Fare Badge */
        .fare-badge {
            background: var(--accent); 
            color: var(--primary);
            padding: 8px 20px; 
            border-radius: 50px; 
            font-weight: 700;
            font-size: 14px; 
            text-transform: uppercase; 
            letter-spacing: 0.5px;
            box-shadow: 0 6px 20px rgba(250,224,19,0.5);
            position: absolute; top: 20px; right: 20px; z-index: 10;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(250,224,19,0.7); }
            70% { box-shadow: 0 0 0 12px rgba(250,224,19,0); }
            100% { box-shadow: 0 0 0 0 rgba(250,224,19,0); }
        }
        
        /* Sticky Summary Enhanced */
        .sticky-summary { 
            position: sticky; 
            top: 60px; 
            z-index: 20; 
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .summary-row { 
            transition: all 0.3s ease; 
            cursor: pointer; 
            padding: 16px 0;
            border-bottom: 1px solid rgba(100,116,139,0.1);
        }
        .summary-row:hover { 
            background: rgba(28,20,80,0.05); 
            border-radius: 12px;
            transform: translateX(4px);
        }
        
        /* Form Glassmorphism */
        .passenger-section {
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 25px 70px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
<?php 
session_start(); 
$fare_type = htmlspecialchars($_GET['fare'] ?? 'Saver');
$price = (int)($_GET['price'] ?? 0);
$flight_id = htmlspecialchars($_GET['flight_id'] ?? '');
$from_city = htmlspecialchars($_GET['from_city'] ?? '');
$to_city = htmlspecialchars($_GET['to_city'] ?? '');
$tax = 800;
$total = $price + $tax;
?>

<div class="booking-container">
    <!-- Progress Bar -->
    <div class="progress-container d-flex align-items-center">
        <div class="progress-step active flex-grow-1">1. Passenger Details</div>
        <div class="progress-step flex-grow-1">2. Payment</div>
        <div class="progress-step flex-grow-1">3. Confirmation</div>
    </div>
    
    <div class="booking-main">
        <!-- Left Column: Passenger Form -->
        <div class="passenger-section p-5">
            <h2 class="mb-4 fw-bold fs-3">
                <i class="fas fa-users me-3 text-primary"></i>
                Passenger Details
            </h2>
            
            <form id="bookingForm" method="POST" action="process_booking.php">
                <input type="hidden" name="flight_id" value="<?php echo $flight_id; ?>">
                <input type="hidden" name="fare_type" value="<?php echo $fare_type; ?>">
                <input type="hidden" name="base_price" value="<?php echo $price; ?>">
                
                <!-- Passenger Count -->
                <div class="mb-5">
                    <label class="form-label fw-bold mb-2 d-block">Number of Travellers</label>
                    <select class="form-select fw-bold" id="passengerCount" onchange="generatePassengerFields()" style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 16px;">
                        <option value="1">1 Adult</option>
                        <option value="2">2 Adults</option>
                        <option value="3">3 Adults</option>
                    </select>
                </div>
                
                <!-- Dynamic Passenger Fields -->
                <div id="passengerFieldsContainer">
                    <!-- Generated by JS -->
                </div>
                
                <!-- Payment Options -->
                <h5 class="mb-4 mt-5 fw-bold fs-5">Secure Payment Method</h5>
                <div class="payment-options mb-5 d-flex gap-3 flex-wrap">
                    <div class="payment-option active flex-grow-1 p-4 rounded-3 border border-3 border-primary text-center position-relative overflow-hidden" data-mode="card" style="min-height: 120px; transition: all 0.3s;">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(28,20,80,0.02), transparent); opacity: 0; transition: opacity 0.3s;"></div>
                        <i class="fas fa-credit-card fa-3x mb-3 d-block text-primary"></i>
                        <div class="fw-bold fs-6 mb-1">Credit/Debit Card</div>
                        <small class="text-muted">Visa • MasterCard • Amex</small>
                    </div>
                    <div class="payment-option flex-grow-1 p-4 rounded-3 border text-center position-relative overflow-hidden" data-mode="upi" style="min-height: 120px; transition: all 0.3s;">
                        <i class="fas fa-mobile-alt fa-3x mb-3 d-block text-primary"></i>
                        <div class="fw-bold fs-6 mb-1">UPI</div>
                        <small class="text-muted">Google Pay • PhonePe</small>
                    </div>
                    <div class="payment-option flex-grow-1 p-4 rounded-3 border text-center position-relative overflow-hidden" data-mode="netbanking" style="min-height: 120px; transition: all 0.3s;">
                        <i class="fas fa-university fa-3x mb-3 d-block text-primary"></i>
                        <div class="fw-bold fs-6 mb-1">Net Banking</div>
                        <small class="text-muted">All Major Banks</small>
                    </div>
                </div>
                <input type="hidden" name="payment_mode" id="paymentMode" value="card">
                
                <button type="submit" class="btn w-100 mt-5 fw-bold fs-4 py-4 px-5 rounded-pill" style="background: linear-gradient(135deg, var(--primary), #2a1b5a); border: none; box-shadow: 0 20px 60px rgba(28,20,80,0.4); transition: all 0.4s;">
                    <i class="fas fa-lock me-2"></i>
                    Confirm & Pay Securely ₹<span id="finalTotal"><?php echo number_format($total); ?></span>
                </button>
            </form>
        </div>
        
        <!-- Right Column: Sticky Fare Summary -->
        <div class="fare-summary p-5 sticky-summary rounded-4" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(25px); border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 30px 80px rgba(0,0,0,0.15);">
            <div class="position-relative mb-4">
                <h3 class="mb-3 fw-bold fs-3">
                    <i class="fas fa-receipt me-2 text-primary"></i>Fare Breakup
                </h3>
                <div class="fare-badge position-absolute" style="animation-delay: 0.5s;"><?php echo strtoupper($fare_type); ?></div>
            </div>
            
            <div class="summary-row mb-3 p-3 rounded-2" style="transition: all 0.3s;">
                <span class="fw-semibold fs-6">Flight Route</span>
                <span class="fw-bold text-primary"><?php echo $from_city ?> → <?php echo $to_city ?></span>
            </div>
            
            <div class="summary-row mb-4 p-3 rounded-2 bg-light">
                <span class="fw-semibold">Base Fare (<?php echo $fare_type ?>)</span>
                <span class="h4 fw-bold text-primary mb-0">₹<?php echo number_format($price); ?></span>
            </div>
            
            <div class="summary-row mb-4 p-3 rounded-2">
                <span class="fw-semibold">Taxes & Airport Fees</span>
                <span class="fw-bold text-success">₹800</span>
            </div>
            
            <div class="summary-total mt-4 p-4 rounded-3 border-start border-4 border-primary bg-gradient position-relative overflow-hidden" style="background: linear-gradient(135deg, rgba(28,20,80,0.03), transparent);">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <div class="fs-5 fw-bold text-muted mb-1">Grand Total</div>
                        <small class="text-success"><i class="fas fa-shield-alt me-1"></i>100% Secure Payment</small>
                    </div>
                    <div class="text-end">
                        <div class="h3 fw-bold text-primary mb-0" id="grandTotal">₹<?php echo number_format($total); ?></div>
                        <small class="text-muted">incl. all taxes</small>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-top text-center">
                <small class="text-muted">
                    <i class="fas fa-lock me-1 text-success"></i>
                    SSL Secure • No Hidden Charges • Instant Confirmation
                </small>
            </div>
        </div>
    </div>
</div>

<script>
let passengerCount = 1;

function generatePassengerFields() {
    passengerCount = parseInt(document.getElementById('passengerCount').value);
    const container = document.getElementById('passengerFieldsContainer');
    container.innerHTML = '';
    
    for (let i = 1; i <= passengerCount; i++) {
        const div = document.createElement('div');
        div.className = 'passenger-block mb-5 pb-4';
        div.innerHTML = `
            <h6 class="fw-bold mb-4 pb-2 border-bottom">
                <i class="fas fa-user me-2 text-primary"></i>
                Passenger ${i} <span class="badge bg-danger">Required</span>
            </h6>
            <div class="row">
                <div class="col-lg-8">
                    <div class="floating-group mb-4">
                        <input type="text" class="form-control fs-5 fw-semibold" name="passenger${i}_name" placeholder=" " required>
                        <span class="floating-label">Full Name (As per ID)</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="floating-group mb-4">
                        <input type="number" class="form-control" name="passenger${i}_age" min="18" max="100" placeholder=" " required>
                        <span class="floating-label">Age</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="floating-group mb-4">
                        <input type="email" class="form-control" name="passenger${i}_email" placeholder=" " required>
                        <span class="floating-label">Email Address</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="floating-group mb-4">
                        <input type="tel" class="form-control" name="passenger${i}_phone" placeholder=" " required>
                        <span class="floating-label">Phone Number</span>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(div);
    }
}

// Payment Selection with Animation
document.querySelectorAll('.payment-option').forEach(option => {
    option.addEventListener('click', () => {
        document.querySelectorAll('.payment-option').forEach(opt => {
            opt.classList.remove('active', 'border-primary');
            opt.querySelector('div').style.opacity = '0';
        });
        option.classList.add('active', 'border-primary');
        option.querySelector('div').style.opacity = '1';
        document.getElementById('paymentMode').value = option.dataset.mode;
    });
});

// Real-time Validation & Updates
document.getElementById('bookingForm').addEventListener('input', function() {
    const required = this.querySelectorAll('[required]');
    let valid = true;
    let total = <?php echo $price + $tax; ?>;
    
    required.forEach(field => {
        if (field.value.trim()) {
            field.classList.remove('is-invalid');
        } else {
            field.classList.add('is-invalid');
            valid = false;
        }
    });
    
    // Update totals (add more logic for addons)
    document.getElementById('finalTotal').textContent = total.toLocaleString();
    document.getElementById('grandTotal').innerHTML = '₹' + total.toLocaleString();
    
    // Enable/disable button
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = !valid;
    submitBtn.style.opacity = valid ? '1' : '0.6';
});

// Form Submit with Spinner
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    const btn = this.querySelector('button[type="submit"]');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing Secure Payment...';
    btn.disabled = true;
});

// Init
generatePassengerFields();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="booking.js"></script>
</body>
</html>
