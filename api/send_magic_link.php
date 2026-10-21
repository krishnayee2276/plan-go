<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer files ne include karo
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
include '../includes/config.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Frontend thi email receive karo
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email)) {
    $email = $conn->real_escape_string($data->email);

    // 1. Check karo ke aa email registered che ke nahi
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows > 0) {
        // 2. Magic Token ane Expiry banavo (10 minutes mate)
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        // 3. Database ma Token update karo
        $conn->query("UPDATE users SET magic_token='$token', token_expiry='$expiry' WHERE email='$email'");

        // 4. PHPMailer Setup
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'infoplandgo@gmail.com'; // Tamaru Gmail
            $mail->Password   = 'nuby yucc ihbo gkdx';   // Tamaro App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('infoplandgo@gmail.com', 'Plan & Go Team');
            $mail->addAddress($email);

            // Magic Link URL (Ahiya tamara project folder nu naam lakho)
            $loginLink = "http://localhost/plan-go/api/verify_magic_link.php?token=" . $token;

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Login to Plan & Go';
            $mail->Body    = "
                <div style='font-family: Arial, sans-serif; border: 1px solid #ddd; padding: 20px; border-radius: 10px;'>
                    <h2 style='color: #333;'>Hello,</h2>
                    <p>Click the link below to securely log in to your account.</p>
                    <a href='$loginLink' style='display: inline-block; padding: 12px 25px; background-color: #eeff02; color: #000; text-decoration: none; font-weight: bold; border-radius: 30px; margin: 15px 0;'>👉 Login Now</a>
                    <p style='color: #777; font-size: 12px;'>This link will expire in 10 minutes. If you did not request this, please ignore this email.</p>
                    <hr>
                    <p>— Plan & Go Team</p>
                </div>";

            $mail->send();
            echo json_encode(["status" => "success", "message" => "📩 Login link sent! Please check your inbox."]);

        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Mail error: " . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "This email is not registered. Please sign up first."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Please enter a valid email address."]);
}
?>




