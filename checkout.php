<?php
// Define BASE_URL
define('BASE_URL', '');

require_once __DIR__ . '/db_config.php';
if (!$conn) die("Database connection failed");

$packages = [];
$sql = "SELECT id, p_name, price_inr, price_usd, duration, category, stay_type, image, highlights, description 
        FROM packages WHERE status='Active'";
$res = $conn->query($sql);
while ($row = $res->fetch_assoc()) $packages[] = $row;

// Get package if passed via URL
$selected_package = null;
if (isset($_GET['id'])) {
    $pkg_id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM packages WHERE id = ? AND status='Active'");
    $stmt->bind_param("i", $pkg_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $selected_package = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Review Your Plan | Plan & Go</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:200,300,400,400i,500,600,700,800,900%7CSatisfy&amp;display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
:root {
    --primary-color: #ffb700;
    --primary-dark: #e6a600;
    --secondary-color: #1c1450;
    --accent-color: #00b894;
    --danger-color: #e74c3c;
    --success-color: #27ae60;
    --gray-light: #f0f2f5;
    --gray-medium: #636e72;
    --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 20px rgba(0,0,0,0.12);
    --shadow-lg: 0 8px 40px rgba(0,0,0,0.15);
    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 20px;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Barlow Condensed', sans-serif;
    background: #f8f9fa;
    color: #1a1a1a;
}

/* Progress Bar */
.progress-bar-container {
    background: linear-gradient(135deg, var(--secondary-color) 0%, #2b1f78 100%);
    padding: 20px 0;
    position: relative;
    overflow: hidden;
}

.progress-bar-container::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}

.progress-steps {
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.progress-step {
    display: flex;
    align-items: center;
    color: rgba(255,255,255,0.6);
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.progress-step.active { color: #fff; }
.progress-step.completed { color: var(--primary-color); }

.step-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 10px;
    font-weight: 700;
    font-size: 14px;
}

.progress-step.active .step-circle {
    background: var(--primary-color);
    color: var(--secondary-color);
}

.progress-line {
    flex: 1;
    height: 2px;
    background: rgba(255,255,255,0.2);
    margin: 0 15px;
    max-width: 80px;
}

.progress-step.completed + .progress-line,
.progress-line.active { background: var(--primary-color); }

/* Main Container */
.main-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.page-subtitle {
    color: var(--gray-medium);
    font-size: 16px;
    margin-bottom: 30px;
}

/* Two Column Layout */
.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 30px;
    align-items: start;
}

/* Traveler Form */
.traveler-form {
    background: #fff;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    padding: 30px;
}

.form-section { margin-bottom: 30px; }

.form-section-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--primary-color);
    display: flex;
    align-items: center;
    gap: 10px;
}

.form-section-title i { color: var(--primary-color); }

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group { margin-bottom: 20px; position: relative; }

/* Floating Label Design */
.form-floating-label {
    position: relative;
}

.form-floating-label input,
.form-floating-label textarea {
    width: 100%;
    padding: 20px 16px 8px;
    border: 2px solid #e0e0e0;
    border-radius: var(--radius-sm);
    font-size: 16px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: #fff;
}

.form-floating-label input:focus,
.form-floating-label textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(255, 183, 0, 0.15);
}

.form-floating-label label {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    color: #999;
    pointer-events: none;
    transition: all 0.3s ease;
}

.form-floating-label textarea + label {
    top: 20px;
    transform: none;
}

.form-floating-label input:focus + label,
.form-floating-label input:not(:placeholder-shown) + label,
.form-floating-label textarea:focus + label,
.form-floating-label textarea:not(:placeholder-shown) + label {
    top: 8px;
    font-size: 11px;
    color: var(--primary-color);
    font-weight: 600;
}

.form-floating-label .required-star {
    color: var(--danger-color);
}

.form-select {
    width: 100%;
    padding: 20px 16px 8px;
    border: 2px solid #e0e0e0;
    border-radius: var(--radius-sm);
    font-size: 16px;
    font-family: inherit;
    background: #fff;
    appearance: none;
    cursor: pointer;
}

.form-select:focus {
    outline: none;
    border-color: var(--primary-color);
}

/* Trip Upgrades */
.trip-upgrades {
    background: linear-gradient(135deg, #fff9e6 0%, #fff5d6 100%);
    border: 2px solid var(--primary-color);
    border-radius: var(--radius-md);
    padding: 25px;
    margin-top: 20px;
}

.upgrade-item {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #fff;
    border-radius: var(--radius-sm);
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.upgrade-item:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
}

.upgrade-item.selected {
    border-color: var(--primary-color);
    background: #fffbf0;
}

.upgrade-checkbox {
    width: 22px;
    height: 22px;
    border: 2px solid #ccc;
    border-radius: 4px;
    margin-right: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.upgrade-item.selected .upgrade-checkbox {
    background: var(--primary-color);
    border-color: var(--primary-color);
}

.upgrade-checkbox i {
    color: #fff;
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.upgrade-item.selected .upgrade-checkbox i { opacity: 1; }

.upgrade-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}

.upgrade-icon i { color: var(--secondary-color); font-size: 18px; }

.upgrade-details { flex: 1; }

.upgrade-name {
    font-size: 15px;
    font-weight: 600;
    color: #2d3436;
    margin-bottom: 2px;
}

.upgrade-desc { font-size: 12px; color: var(--gray-medium); }

.upgrade-price {
    font-size: 16px;
    font-weight: 700;
    color: var(--secondary-color);
}

/* Booking Summary - Sticky */
.booking-summary {
    position: sticky;
    top: 20px;
}

.summary-card {
    background: #fff;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
}

.summary-header {
    background: linear-gradient(135deg, var(--secondary-color) 0%, #2b1f78 100%);
    color: #fff;
    padding: 25px;
    text-align: center;
}

.summary-header h3 { font-size: 20px; font-weight: 700; margin-bottom: 5px; }
.summary-header p { font-size: 13px; opacity: 0.8; }

.summary-body { padding: 25px; }

/* Fare Breakup Toggle */
.fare-breakdown-toggle {
    background: #f8f9fa;
    border: none;
    padding: 15px;
    border-radius: var(--radius-sm);
    width: 100%;
    text-align: left;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.fare-breakdown-toggle:hover {
    background: #e9ecef;
}

.fare-breakdown-toggle i {
    transition: transform 0.3s ease;
}

.fare-breakdown-toggle.active i {
    transform: rotate(180deg);
}

.fare-breakdown-content {
    display: none;
    background: #f8f9fa;
    padding: 15px;
    border-radius: var(--radius-sm);
    margin-bottom: 15px;
}

.fare-breakdown-content.active { display: block; }

.fare-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 14px;
    color: var(--gray-medium);
    border-bottom: 1px solid #eee;
}

.fare-row:last-child { border-bottom: none; }
.fare-row.total {
    border-top: 2px solid var(--primary-color);
    margin-top: 10px;
    padding-top: 15px;
    font-size: 16px;
    font-weight: 700;
    color: var(--secondary-color);
}

.fare-row.total .fare-value {
    font-size: 18px;
    color: var(--secondary-color);
}

/* Package Preview */
.package-preview {
    display: none;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.package-preview.active { display: block; animation: slideDown 0.4s ease; }

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.package-image {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: var(--radius-md);
    margin-bottom: 15px;
}

.package-name {
    font-size: 18px;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 8px;
}

.package-meta {
    display: flex;
    gap: 15px;
    font-size: 13px;
    color: var(--gray-medium);
    margin-bottom: 10px;
}

.no-package {
    text-align: center;
    padding: 30px 20px;
    color: var(--gray-medium);
}

.no-package i { font-size: 48px; margin-bottom: 15px; color: #ddd; }

/* Price */
.price-breakdown { margin-bottom: 20px; }

.price-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    font-size: 14px;
    color: #636e72;
}

.price-row.total {
    border-top: 2px solid var(--primary-color);
    margin-top: 10px;
    padding-top: 15px;
    font-size: 18px;
    font-weight: 700;
    color: var(--secondary-color);
}

.price-row.total .price-value { font-size: 22px; }
.price-row.addon { color: var(--success-color); font-size: 13px; }

/* Trust Badges */
.trust-badges {
    display: flex;
    justify-content: space-around;
    padding: 20px;
    background: #f8f9fa;
    border-top: 1px solid #eee;
}

.trust-badge { text-align: center; }
.trust-badge i { font-size: 24px; color: var(--success-color); margin-bottom: 5px; }
.trust-badge span { font-size: 11px; color: var(--gray-medium); display: block; }

/* Urgency Toast */
.urgency-toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: linear-gradient(135deg, #ff9f43 0%, #e67e22 100%);
    color: #fff;
    padding: 15px 25px;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg);
    display: none;
    align-items: center;
    gap: 12px;
    z-index: 1000;
    animation: slideInRight 0.5s ease;
}

.urgency-toast.show { display: flex; }

@keyframes slideInRight {
    from { opacity: 0; transform: translateX(100px); }
    to { opacity: 1; transform: translateX(0); }
}

.urgency-toast i { font-size: 20px; }
.urgency-toast span { font-size: 14px; font-weight: 600; }

/* Submit Button */
.btn-submit {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    border: none;
    border-radius: var(--radius-md);
    font-size: 18px;
    font-weight: 700;
    color: var(--secondary-color);
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 183, 0, 0.4);
}

.btn-submit:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

/* Package Selection */
.select-package-btn {
    width: 100%;
    padding: 14px;
    background: transparent;
    border: 2px dashed #ccc;
    border-radius: var(--radius-md);
    font-size: 14px;
    font-weight: 600;
    color: var(--gray-medium);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.select-package-btn:hover {
    border-color: var(--primary-color);
    color: var(--secondary-color);
    background: #fffbf0;
}

/* Modal */
.package-grid-modal {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.7);
    z-index: 1000;
    overflow-y: auto;
    padding: 40px 20px;
}

.package-grid-modal.active { display: block; animation: fadeIn 0.3s ease; }

@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.package-grid-content {
    max-width: 1000px;
    margin: 0 auto;
    background: #fff;
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.package-grid-header {
    background: linear-gradient(135deg, var(--secondary-color) 0%, #2b1f78 100%);
    color: #fff;
    padding: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.package-grid-header h3 { font-size: 22px; font-weight: 700; }

.close-modal {
    background: none;
    border: none;
    color: #fff;
    font-size: 28px;
    cursor: pointer;
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.close-modal:hover { opacity: 1; }

.package-grid-body { padding: 30px; max-height: 70vh; overflow-y: auto; }

.package-select-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.package-select-card {
    background: #fff;
    border: 2px solid #eee;
    border-radius: var(--radius-md);
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
}

.package-select-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.package-select-card.selected {
    border-color: var(--primary-color);
    background: #fffbf0;
}

.package-select-card img {
    width: 100%;
    height: 140px;
    object-fit: cover;
}

.package-select-card-body { padding: 15px; }
.package-select-card h4 {
    font-size: 16px;
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 8px;
}

.package-select-card .price {
    font-size: 18px;
    font-weight: 700;
    color: var(--success-color);
}

/* Responsive */
@media (max-width: 992px) {
    .checkout-grid { grid-template-columns: 1fr; }
    .booking-summary { position: relative; top: 0; order: -1; }
    .progress-steps { flex-wrap: wrap; gap: 10px; }
    .progress-line { display: none; }
    .form-row { grid-template-columns: 1fr; }
}

@media (max-width: 576px) {
    .page-title { font-size: 24px; }
    .traveler-form { padding: 20px; }
    .trust-badges { flex-wrap: wrap; gap: 15px; }
    .package-select-grid { grid-template-columns: 1fr; }
    .urgency-toast {
        bottom: 10px;
        right: 10px;
        left: 10px;
    }
}
</style>
</head>
<body>

<!-- Progress Bar -->
<div class="progress-bar-container">
    <div class="progress-steps">
        <div class="progress-step completed">
            <span class="step-circle"><i class="fas fa-check"></i></span>
            <span>Explore</span>
        </div>
        <div class="progress-line active"></div>
        <div class="progress-step active">
            <span class="step-circle">2</span>
            <span>Customize</span>
        </div>
        <div class="progress-line"></div>
        <div class="progress-step">
            <span class="step-circle">3</span>
            <span>Confirm</span>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="main-container">
    <h1 class="page-title">Review Your Plan</h1>
    <p class="page-subtitle">Complete your details to finalize your journey with Plan & Go</p>

    <div class="checkout-grid">
        <!-- Left Column - Traveler Form -->
        <div class="traveler-form">
            <form id="bookingForm" action="checkout_process.php" method="POST">
                <input type="hidden" id="package_id" name="package_id" value="<?php echo $selected_package ? $selected_package['id'] : ''; ?>">
                <input type="hidden" id="package_name" name="package_name" value="<?php echo $selected_package ? htmlspecialchars($selected_package['p_name']) : ''; ?>">
                <input type="hidden" id="base_price" name="base_price" value="<?php echo $selected_package ? $selected_package['price_inr'] : '0'; ?>">
                <input type="hidden" id="final_price" name="final_price" value="0">
                <input type="hidden" id="selected_upgrades" name="selected_upgrades" value="">
                
                <!-- Personal Information -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-user"></i>
                        Personal Information
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-floating-label">
                                <input type="text" name="customer_name" class="form-input" placeholder=" " required>
                                <label>Full Name <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating-label">
                                <input type="email" name="email" class="form-input" placeholder=" " required>
                                <label>Email Address <span class="required-star">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-floating-label">
                                <input type="tel" name="phone" class="form-input" placeholder=" " required>
                                <label>Phone Number <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating-label">
                                <input type="tel" name="alt_phone" class="form-input" placeholder=" ">
                                <label>Alternate Phone</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Travel Details -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-plane-departure"></i>
                        Travel Details
                    </h3>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-floating-label">
                                <input type="date" name="travel_date" class="form-input" placeholder=" " required>
                                <label>Travel Date <span class="required-star">*</span></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-floating-label">
                                <div style="display: flex; gap: 10px;">
                                    <div style="flex: 1;">
                                        <input type="number" name="adults" id="adultsCount" class="form-input" value="1" min="1" placeholder=" " required onchange="calculateTotal()">
                                        <label>Adults <span class="required-star">*</span></label>
                                    </div>
                                    <div style="flex: 1;">
                                        <input type="number" name="children" id="childrenCount" class="form-input" value="0" min="0" placeholder=" " onchange="calculateTotal()">
                                        <label>Children</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <div class="form-floating-label">
                                <textarea name="special_requests" class="form-input" rows="3" placeholder=" "></textarea>
                                <label>Special Requests</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trip Upgrades -->
                <div class="form-section">
                    <h3 class="form-section-title">
                        <i class="fas fa-star"></i>
                        Enhance Your Trip
                    </h3>
                    <div class="trip-upgrades">
                        <!-- Extra Meal -->
                        <div class="upgrade-item" data-id="meal" data-price="500" onclick="toggleUpgrade(this)">
                            <div class="upgrade-checkbox"><i class="fas fa-check"></i></div>
                            <div class="upgrade-icon"><i class="fas fa-utensils"></i></div>
                            <div class="upgrade-details">
                                <div class="upgrade-name">Extra Meals</div>
                                <div class="upgrade-desc">Includes breakfast, lunch & dinner</div>
                            </div>
                            <div class="upgrade-price">+₹500</div>
                        </div>

                        <!-- Insurance -->
                        <div class="upgrade-item" data-id="insurance" data-price="300" onclick="toggleUpgrade(this)">
                            <div class="upgrade-checkbox"><i class="fas fa-check"></i></div>
                            <div class="upgrade-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="upgrade-details">
                                <div class="upgrade-name">Travel Insurance</div>
                                <div class="upgrade-desc">Complete trip protection coverage</div>
                            </div>
                            <div class="upgrade-price">+₹300</div>
                        </div>

                        <!-- Late Checkout -->
                        <div class="upgrade-item" data-id="late_checkout" data-price="700" onclick="toggleUpgrade(this)">
                            <div class="upgrade-checkbox"><i class="fas fa-check"></i></div>
                            <div class="upgrade-icon"><i class="fas fa-clock"></i></div>
                            <div class="upgrade-details">
                                <div class="upgrade-name">Late Checkout</div>
                                <div class="upgrade-desc">Checkout at 6 PM at no extra charge</div>
                            </div>
                            <div class="upgrade-price">+₹700</div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-submit" id="submitBtn" disabled>
                    <i class="fas fa-lock"></i>
                    Confirm Booking
                </button>
            </form>
        </div>

        <!-- Right Column - Booking Summary -->
        <div class="booking-summary">
            <div class="summary-card">
                <div class="summary-header">
                    <h3>Booking Summary</h3>
                    <p>Review your selected package</p>
                </div>

                <div class="summary-body">
                    <!-- No Package Selected -->
                    <div class="no-package" id="noPackage" <?php echo $selected_package ? 'style="display:none;"' : ''; ?>>
                        <i class="fas fa-suitcase"></i>
                        <p>Select a package to continue</p>
                        <button type="button" class="select-package-btn" onclick="openPackageModal()">
                            <i class="fas fa-plus"></i>
                            Choose Your Package
                        </button>
                    </div>

                    <!-- Package Preview -->
                    <div class="package-preview <?php echo $selected_package ? 'active' : ''; ?>" id="packagePreview">
                        <img src="<?php echo $selected_package ? BASE_URL . '/uploads/' . htmlspecialchars($selected_package['image']) : ''; ?>" 
                             alt="Package" class="package-image" id="summaryImage">
                        <div class="package-name" id="summaryName">
                            <?php echo $selected_package ? htmlspecialchars($selected_package['p_name']) : ''; ?>
                        </div>
                        <div class="package-meta">
                            <span><i class="fas fa-clock"></i> <?php echo $selected_package ? htmlspecialchars($selected_package['duration']) : ''; ?></span>
                            <span><i class="fas fa-hotel"></i> <?php echo $selected_package ? htmlspecialchars($selected_package['stay_type']) : ''; ?></span>
                        </div>
                    </div>

                    <!-- Fare Breakup Toggle -->
                    <div class="price-breakdown" id="priceBreakdown" <?php echo $selected_package ? '' : 'style="display:none;"'; ?>>
                        <!-- Toggle Button -->
                        <button class="fare-breakdown-toggle" onclick="toggleFareBreakdown()">
                            <span><i class="fas fa-calculator me-2"></i>View Price Details</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        
                        <!-- Fare Content -->
                        <div class="fare-breakdown-content" id="fareContent">
                            <div class="fare-row">
                                <span>Base Fare</span>
                                <span id="fareBase">₹0</span>
                            </div>
                            <div class="fare-row">
                                <span>Convenience Fee</span>
                                <span>₹0</span>
                            </div>
                            <div class="fare-row">
                                <span>GST (5%)</span>
                                <span id="fareGst">₹0</span>
                            </div>
                            <div id="addonsFareContainer">
                                <!-- Dynamic addon rows -->
                            </div>
                            <div class="fare-row total">
                                <span>Grand Total</span>
                                <span class="fare-value" id="fareTotal">₹0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Change Package Button -->
                    <button type="button" class="select-package-btn" id="changePackageBtn" <?php echo $selected_package ? '' : 'style="display:none;"'; ?> onclick="openPackageModal()">
                        <i class="fas fa-exchange-alt"></i>
                        Change Package
                    </button>
                </div>

                <!-- Trust Badges -->
                <div class="trust-badges">
                    <div class="trust-badge">
                        <i class="fas fa-headset"></i>
                        <span>24/7 Support</span>
                    </div>
                    <div class="trust-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Verified Stay</span>
                    </div>
                    <div class="trust-badge">
                        <i class="fas fa-lock"></i>
                        <span>Secure Booking</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Urgency Toast Notification -->
<div class="urgency-toast" id="urgencyToast">
    <i class="fas fa-fire"></i>
    <span id="toastMessage">Hurry! 3 people booked in last 1 hour</span>
</div>

<!-- Package Selection Modal -->
<div class="package-grid-modal" id="packageModal">
    <div class="package-grid-content">
        <div class="package-grid-header">
            <h3>Select Your Package</h3>
            <button class="close-modal" onclick="closePackageModal()">&times;</button>
        </div>
        <div class="package-grid-body">
            <div class="package-select-grid">
                <?php foreach($packages as $p): ?>
                <div class="package-select-card" 
                     onclick="selectPackage(this)" 
                     data-id="<?= $p['id'] ?>"
                     data-name="<?= htmlspecialchars($p['p_name']) ?>"
                     data-price="<?= $p['price_inr'] ?>"
                     data-duration="<?= htmlspecialchars($p['duration']) ?>"
                     data-stay="<?= htmlspecialchars($p['stay_type']) ?>"
                     data-image="<?php echo BASE_URL; ?>/uploads/<?= $p['image'] ?>">
                    <img src="<?php echo BASE_URL; ?>/uploads/<?= $p['image'] ?>" alt="<?= htmlspecialchars($p['p_name']) ?>">
                    <div class="package-select-card-body">
                        <h4><?= htmlspecialchars($p['p_name']) ?></h4>
                        <div class="package-meta" style="margin: 8px 0;">
                            <span><i class="fas fa-clock"></i> <?= $p['duration'] ?></span>
                        </div>
                        <div class="price">₹<?= number_format($p['price_inr']) ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // State
    let selectedPackage = <?php echo $selected_package ? json_encode($selected_package) : 'null'; ?>;
    let selectedUpgrades = [];
    let basePrice = <?php echo $selected_package ? $selected_package['price_inr'] : 0; ?>;

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        if (selectedPackage) {
            updatePackageDisplay();
        }
        
        // Set minimum date
        const dateInput = document.querySelector('input[name="travel_date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
        
        // Start urgency toast
        startUrgencyToast();
    });

    // Fare Breakdown Toggle
    function toggleFareBreakdown() {
        const toggle = document.querySelector('.fare-breakdown-toggle');
        const content = document.getElementById('fareContent');
        toggle.classList.toggle('active');
        content.classList.toggle('active');
    }

    // Urgency Toast
    function startUrgencyToast() {
        const toast = document.getElementById('urgencyToast');
        const messages = [
            'Hurry! 3 people booked in last 1 hour',
            'Only 2 slots left at this price!',
            '5 people are viewing this package!',
            'Best value! Book now to save ₹500',
            'Last chance! Offer expires soon'
        ];
        
        let currentIndex = 0;
        
        // Show first message
        toast.classList.add('show');
        
        // Rotate messages every 10 seconds
        setInterval(function() {
            currentIndex = (currentIndex + 1) % messages.length;
            document.getElementById('toastMessage').textContent = messages[currentIndex];
        }, 10000);
    }

    // Package Selection Modal
    function openPackageModal() {
        document.getElementById('packageModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closePackageModal() {
        document.getElementById('packageModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function selectPackage(card) {
        // Remove previous selection
        document.querySelectorAll('.package-select-card').forEach(function(c) {
            c.classList.remove('selected');
        });
        
        // Add selection to clicked card
        card.classList.add('selected');
        
        // Update state
        selectedPackage = {
            id: card.dataset.id,
            name: card.dataset.name,
            price: parseInt(card.dataset.price),
            duration: card.dataset.duration,
            stay: card.dataset.stay,
            image: card.dataset.image
        };
        
        basePrice = selectedPackage.price;
        
        // Update hidden inputs
        document.getElementById('package_id').value = selectedPackage.id;
        document.getElementById('package_name').value = selectedPackage.name;
        document.getElementById('base_price').value = basePrice;
        
        // Update display
        updatePackageDisplay();
        
        // Close modal
        closePackageModal();
    }

    function updatePackageDisplay() {
        if (!selectedPackage) return;
        
        // Hide no package message, show preview
        document.getElementById('noPackage').style.display = 'none';
        document.getElementById('packagePreview').classList.add('active');
        document.getElementById('priceBreakdown').style.display = 'block';
        document.getElementById('changePackageBtn').style.display = 'flex';
        
        // Update preview
        document.getElementById('summaryImage').src = selectedPackage.image;
        document.getElementById('summaryName').textContent = selectedPackage.name;
        
        // Update price
        calculateTotal();
        
        // Enable submit button
        document.getElementById('submitBtn').disabled = false;
    }

    // Toggle Upgrade Selection
    function toggleUpgrade(element) {
        element.classList.toggle('selected');
        
        var upgradeId = element.dataset.id;
        var upgradePrice = parseInt(element.dataset.price);
        
        // Check if already in selectedUpgrades
        var existingIndex = -1;
        for (var i = 0; i < selectedUpgrades.length; i++) {
            if (selectedUpgrades[i].id === upgradeId) {
                existingIndex = i;
                break;
            }
        }
        
        if (element.classList.contains('selected')) {
            // Add to selected upgrades
            if (existingIndex === -1) {
                selectedUpgrades.push({
                    id: upgradeId,
                    price: upgradePrice,
                    name: element.querySelector('.upgrade-name').textContent
                });
            }
        } else {
            // Remove from selected upgrades
            if (existingIndex > -1) {
                selectedUpgrades.splice(existingIndex, 1);
            }
        }
        
        // Update hidden input
        document.getElementById('selected_upgrades').value = JSON.stringify(selectedUpgrades);
        
        // Recalculate total
        calculateTotal();
    }

    // Calculate Total Price
    function calculateTotal() {
        if (!selectedPackage) return;
        
        var adults = parseInt(document.getElementById('adultsCount').value) || 1;
        var children = parseInt(document.getElementById('childrenCount').value) || 0;
        
        // Calculate base price (adults pay full, children get 50% off)
        var baseTotal = basePrice * adults;
        var childrenTotal = (basePrice * 0.5) * children;
        var subtotal = baseTotal + childrenTotal;
        
        // Calculate GST (5%)
        var gst = Math.round(subtotal * 0.05);
        
        // Add upgrades
        var upgradesTotal = 0;
        var addonsFareContainer = document.getElementById('addonsFareContainer');
        
        if (addonsFareContainer) addonsFareContainer.innerHTML = '';
        
        for (var i = 0; i < selectedUpgrades.length; i++) {
            var upgrade = selectedUpgrades[i];
            upgradesTotal += upgrade.price;
            
            // Add to fare breakdown
            if (addonsFareContainer) {
                var fareRow = document.createElement('div');
                fareRow.className = 'fare-row';
                fareRow.innerHTML = '<span>' + upgrade.name + '</span><span>₹' + upgrade.price.toLocaleString() + '</span>';
                addonsFareContainer.appendChild(fareRow);
            }
        }
        
        // Calculate total
        var total = subtotal + gst + upgradesTotal;
        
        // Update display
        var fareBase = document.getElementById('fareBase');
        var fareGst = document.getElementById('fareGst');
        var fareTotal = document.getElementById('fareTotal');
        
        if (fareBase) fareBase.textContent = '₹' + subtotal.toLocaleString();
        if (fareGst) fareGst.textContent = '₹' + gst.toLocaleString();
        if (fareTotal) fareTotal.textContent = '₹' + total.toLocaleString();
        
        // Update hidden input
        document.getElementById('final_price').value = total;
    }

    // Close modal on outside click
    document.getElementById('packageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePackageModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePackageModal();
        }
    });
</script>
