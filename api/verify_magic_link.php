<?php
// Enable error reporting to show errors instead of blank page
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/config.php';
session_start();

if (isset($_GET['token'])) {
    $token = $conn->real_escape_string($_GET['token']);
    $now = date("Y-m-d H:i:s");

    // Check token and expiry
    $sql = "SELECT * FROM users WHERE magic_token='$token' AND token_expiry > '$now'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Save user details in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        $_SESSION['user_email'] = $user['email'];

        // Set token to null after one use (for security)
        $conn->query("UPDATE users SET magic_token=NULL, token_expiry=NULL WHERE id=" . $user['id']);

        // Show success message and redirect to index page
        echo "
        <div style='text-align:center; margin-top:50px; font-family:Arial;'>
            <h1 style='color:green;'>🎉 Welcome back, " . $user['fullname'] . "!</h1>
            <p>Login successful. Redirecting you to home page...</p>
        </div>";
        
        // Redirect to home page after 2 seconds
        echo "<script>
                setTimeout(() => { 
                    window.location.href='../index.html'; 
                }, 2000);
              </script>";
    } else {
        // If token not found or expired
        echo "
        <div style='text-align:center; margin-top:50px; font-family:Arial;'>
            <h1 style='color:red;'>❌ Invalid or Expired Link</h1>
            <p>This login link has expired or already been used. Please request a new one.</p>
            <a href='../login.html'>Go back to Login</a>
        </div>";
    }
} else {
    echo "No token provided.";
}
?>




