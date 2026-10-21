<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Plan&Go | Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
.error-msg { color: #fae013; background: #1c1450; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
.success-msg { color: #1c1450; background: #fae013; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
</style>
</head>

<body>
<?php if (isset($_SESSION['error'])): ?>
<div class="error-msg"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="glass-card animate-left">

  <!-- LEFT -->
  <div class="left">
    <h1 class="logo">PLAN<span>&</span>GO</h1>
    <p class="tagline">
      Your trusted partner for premium journeys,
      unforgettable memories, and seamless travel.
    </p>

    <div class="social-icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook-f"></i>
      <i class="fas fa-envelope"></i>
    </div>
  </div>

  <!-- RIGHT -->
  <div class="right">
    <h2>Create Account</h2>
    <p class="subtitle">Start your travel experience</p>

    <form id="regForm" method="POST" action="register_process.php">
      <div class="input-box">
        <i class="fas fa-user"></i>
        <input type="text" name="username" id="regUsername" placeholder="Username" required>
      </div>

      <div class="input-box">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="regEmail" placeholder="Email" required>
      </div>

      <div class="input-box">
        <i class="fas fa-mobile-alt"></i>
        <input type="tel" name="mobile" id="regMobile" placeholder="Mobile" required>
      </div>

      <div class="input-box">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="regPassword" placeholder="Password" required minlength="6">
        <i class="fas fa-eye toggle-eye" onclick="togglePassword('regPassword',this)"></i>
      </div>

      <div class="input-box">
        <i class="fas fa-lock"></i>
        <input type="password" id="regConfirm" placeholder="Confirm password" required minlength="6">
        <i class="fas fa-eye toggle-eye" onclick="togglePassword('regConfirm',this)"></i>
      </div>

      <button type="submit" class="btn-main w-100 mt-3">REGISTER</button>
    </form>

    <p class="switch-text">
      Already have an account?
      <a href="login.php">Sign in</a>
    </p>
  </div>

</div>

<script src="js/auth_v2.js"></script>
<script>
// Update JS for form validation
document.getElementById('regForm').addEventListener('submit', function(e) {
    const pass = document.getElementById('regPassword').value;
    const confirm = document.getElementById('regConfirm').value;
    if (pass !== confirm) {
        e.preventDefault();
        Swal.fire({ icon: 'error', title: 'Passwords do not match!' });
    }
});
</script>
</body>
</html>
