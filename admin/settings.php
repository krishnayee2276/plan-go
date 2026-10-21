<?php
include "includes/auth.php";
include "includes/db_config.php";

if($_POST){
  foreach($_POST as $k=>$v){
    $pdo->query("UPDATE settings SET setting_value='$v' WHERE setting_key='$k'");
  }
}

include "includes/header.php";
include "includes/sidebar.php";
$q = $pdo->query("SELECT * FROM settings");
$settings = $q->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="main">
  <!-- Top Bar -->
  <div class="topbar">
    <div>
      <h1>Settings</h1>
      <p class="welcome">Manage your admin preferences and system settings</p>
    </div>
  </div>

  <!-- Settings Container -->
  <div class="settings-container">
    <!-- Admin Profile Section -->
    <div class="settings-section">
      
      <h3><i class="fa-solid fa-user"></i> Admin Profile</h3>
      <form class="settings-form" method="post">
        <div class="form-group">
          <label for="admin_name">Full Name</label>
          <input type="text" id="admin_name" name="admin_name" value="Admin User" placeholder="Enter your full name">
        </div>
        <div class="form-group">
          <label for="admin_email">Email Address</label>
          <input type="email" id="admin_email" name="admin_email" value="admin@plan-go.com" placeholder="Enter your email">
        </div>
        <div class="form-group">
          <label for="admin_phone">Phone Number</label>
          <input type="tel" id="admin_phone" name="admin_phone" value="+91 9624341040" placeholder="Enter your phone number">
        </div>
        <button type="submit" class="btn">Update Profile</button>
      </form>
    </div>

    <!-- Change Password Section -->
    <div class="settings-section">
      <h3><i class="fa-solid fa-lock"></i> Change Password</h3>
      <form class="settings-form" method="post">
        <div class="form-group">
          <label for="current_password">Current Password</label>
          <input type="password" id="current_password" name="current_password" placeholder="Enter current password">
        </div>
        <div class="form-group">
          <label for="new_password">New Password</label>
          <input type="password" id="new_password" name="new_password" placeholder="Enter new password">
        </div>
        <div class="form-group">
          <label for="confirm_password">Confirm New Password</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
        </div>
        <button type="submit" class="btn">Change Password</button>
      </form>
    </div>

    <!-- Theme Section -->
    <div class="settings-section">
      <h3><i class="fa-solid fa-palette"></i> Theme Settings</h3>
      <form class="settings-form" method="post">
        <div class="form-group">
          <label for="theme_mode">Theme Mode</label>
          <select id="theme_mode" name="theme_mode">
            <option value="dark">Dark Mode</option>
            <option value="light">Light Mode</option>
            <option value="auto">Auto (System)</option>
          </select>
        </div>
        <div class="form-group">
          <label for="accent_color">Accent Color</label>
          <select id="accent_color" name="accent_color">
            <option value="#fae013">Yellow</option>
            <option value="#3b82f6">Blue</option>
            <option value="#22c55e">Green</option>
            <option value="#ef4444">Red</option>
          </select>
        </div>
        <button type="submit" class="btn">Save Theme</button>
      </form>
    </div>

    <!-- System Info Section -->
    <div class="settings-section">
      <h3><i class="fa-solid fa-server"></i> System Information</h3>
      <div class="system-info">
        <div class="info-item">
          <strong>PHP Version</strong>
          <span><?php echo phpversion(); ?></span>
        </div>
        <div class="info-item">
          <strong>Server Software</strong>
          <span><?php echo $_SERVER['SERVER_SOFTWARE']; ?></span>
        </div>
        <div class="info-item">
          <strong>Database</strong>
          <span>MySQL <?php echo $pdo->getAttribute(PDO::ATTR_SERVER_VERSION); ?></span>
        </div>
        <div class="info-item">
          <strong>Server Time</strong>
          <span><?php echo date('Y-m-d H:i:s'); ?></span>
        </div>
        <div class="info-item">
          <strong>Memory Usage</strong>
          <span><?php echo round(memory_get_peak_usage(true) / 1024 / 1024, 2); ?> MB</span>
        </div>
      </div>
    </div>

    <!-- General Settings Section -->
    <div class="settings-section">
      <h3><i class="fa-solid fa-cog"></i> General Settings</h3>
      <form class="settings-form" method="post">
        <?php
        foreach($settings as $s):
          $label = ucwords(str_replace('_', ' ', $s['setting_key']));
        ?>
        <div class="form-group">
          <label for="<?= $s['setting_key'] ?>"><?= $label ?></label>
          <input type="text" id="<?= $s['setting_key'] ?>" name="<?= $s['setting_key'] ?>" value="<?= $s['setting_value'] ?>" placeholder="Enter <?= strtolower($label) ?>">
        </div>
        <?php endforeach; ?>
        <button type="submit" class="btn">Save Settings</button>
      </form>
    </div>
  </div>
</div>
<?php include "includes/footer.php"; ?>
