<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

include 'db_config.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$inquiry_id = $_POST['inquiry_id'] ?? 0;
$admin_message = trim($_POST['admin_message'] ?? '');
$suggested_packages = trim($_POST['suggested_packages'] ?? '');

if (!$inquiry_id || empty($admin_message)) {
    echo json_encode(['success' => false, 'message' => 'Inquiry ID and message are required']);
    exit;
}

// Get inquiry details
$stmt = $conn->prepare("SELECT * FROM inquiries WHERE id = ?");
$stmt->bind_param("i", $inquiry_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Inquiry not found']);
    exit;
}

$inquiry = $result->fetch_assoc();

// Save reply
$reply_stmt = $conn->prepare("INSERT INTO inquiry_replies (inquiry_id, admin_message, suggested_packages) VALUES (?, ?, ?)");
$reply_stmt->bind_param("iss", $inquiry_id, $admin_message, $suggested_packages);

if (!$reply_stmt->execute()) {
    echo json_encode(['success' => false, 'message' => 'Failed to save reply']);
    exit;
}

// Update inquiry status to Replied
$update_stmt = $conn->prepare("UPDATE inquiries SET status = 'Replied' WHERE id = ?");
$update_stmt->bind_param("i", $inquiry_id);
$update_stmt->execute();

// Send email
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Configure as needed
    $mail->SMTPAuth = true;
    $mail->Username = 'your-email@gmail.com'; // Replace with actual email
    $mail->Password = 'your-app-password'; // Replace with app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('your-email@gmail.com', 'Plan & Go Travel');
    $mail->addAddress($inquiry['email'], $inquiry['name']);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Response to Your Inquiry - Plan & Go Travel';

    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .footer { background-color: #f8f9fa; padding: 10px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Plan & Go Travel</h2>
            <p>Thank you for your inquiry!</p>
        </div>
        <div class='content'>
            <p>Dear {$inquiry['name']},</p>
            <p>Thank you for contacting us regarding your travel plans to {$inquiry['destination']}.</p>
            <h3>Our Response:</h3>
            <p>" . nl2br(htmlspecialchars($admin_message)) . "</p>";

    if (!empty($suggested_packages)) {
        $body .= "<h3>Suggested Travel Packages:</h3>
            <p>" . nl2br(htmlspecialchars($suggested_packages)) . "</p>";
    }

    $body .= "
            <p>If you have any further questions, please don't hesitate to contact us.</p>
            <p>Best regards,<br>Plan & Go Travel Team</p>
        </div>
        <div class='footer'>
            <p>Contact us: +91-9624341040 | infoplandgo@gmail.com</p>
        </div>
    </body>
    </html>";

    $mail->Body = $body;
    $mail->AltBody = strip_tags(str_replace('<br>', "\n", $body));

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Reply sent successfully']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Reply saved but email failed: ' . $mail->ErrorInfo]);
}

$stmt->close();
$reply_stmt->close();
$update_stmt->close();
$conn->close();
?>
