<?php
require_once __DIR__ . '/db_config.php';

if (!$conn) {
    die("Database connection failed");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit;
}

/* =========================
   COLLECT FORM DATA
========================= */
$package_id       = intval($_POST['package_id'] ?? 0);
$package_name     = trim($_POST['package_name'] ?? '');
$customer_name   = trim($_POST['customer_name'] ?? '');
$customer_email  = trim($_POST['email'] ?? '');
$customer_phone  = trim($_POST['phone'] ?? '');
$travel_date     = $_POST['travel_date'] ?? null;
$adults          = intval($_POST['adults'] ?? 1);
$children        = intval($_POST['children'] ?? 0);
$total_price_raw = $_POST['final_price'] ?? $_POST['base_price'] ?? '';

/* Clean price (₹55,000 → 55000) */
$amount = floatval(str_replace(['₹', ',', ' '], '', $total_price_raw));

/* =========================
   BASIC VALIDATION
========================= */
if (
    empty($customer_name) ||
    empty($customer_email) ||
    empty($customer_phone) ||
    empty($package_id) ||
    empty($package_name) ||
    empty($travel_date) ||
    $amount <= 0
) {
    die("Invalid booking data - missing required fields");
}

$total_travelers = $adults + $children;

/* =========================
   INSERT INTO BOOKINGS TABLE
========================= */
$stmt = $conn->prepare("
    INSERT INTO bookings 
    (customer_name, customer_email, customer_phone, package_name, amount, travel_date, travelers, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')
");

$stmt->bind_param(
    "ssssdsi",
    $customer_name,
    $customer_email,
    $customer_phone,
    $package_name,
    $amount,
    $travel_date,
    $total_travelers
);

if (!$stmt->execute()) {
    die("Booking failed: " . $stmt->error);
}

$booking_id = $stmt->insert_id;
$stmt->close();

/* =========================
   INSERT TRAVELER DETAILS
   (Loop for multiple travelers)
========================= */
// Insert adults
for ($i = 0; $i < $adults; $i++) {
    $traveler_stmt = $conn->prepare("
        INSERT INTO booking_travelers (booking_id, traveler_type)
        VALUES (?, 'Adult')
    ");
    $traveler_stmt->bind_param("i", $booking_id);
    $traveler_stmt->execute();
    $traveler_stmt->close();
}

// Insert children if any
for ($i = 0; $i < $children; $i++) {
    $traveler_stmt = $conn->prepare("
        INSERT INTO booking_travelers (booking_id, traveler_type)
        VALUES (?, 'Child')
    ");
    $traveler_stmt->bind_param("i", $booking_id);
    $traveler_stmt->execute();
    $traveler_stmt->close();
}

/* =========================
   OPTIONAL: SAVE INQUIRY (WhatsApp)
========================= */
$msg = "New Booking Enquiry\n"
     . "Name: $customer_name\n"
     . "Phone: $customer_phone\n"
     . "Email: $customer_email\n"
     . "Package: $package_name\n"
     . "Travel Date: $travel_date\n"
     . "Travelers: $total_travelers (Adults: $adults, Children: $children)\n"
     . "Amount: ₹$amount";

$inq = $conn->prepare("
    INSERT INTO inquiries (name, email, message)
    VALUES (?, ?, ?)
");
$inq->bind_param("sss", $customer_name, $customer_email, $msg);
$inq->execute();
$inq->close();

/* =========================
   REDIRECT TO SUCCESS PAGE
========================= */
header("Location: booking_success.php?ref=" . $booking_id);
exit;
