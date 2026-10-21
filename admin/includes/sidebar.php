<?php $page = basename($_SERVER['PHP_SELF']); ?>
<div class="sidebar">
  <div class="brand-logo">
    <span class="brand-text">PLAN</span>
    <span class="brand-icon">
        <i class="fa-solid fa-location-dot"></i>
    </span>
    <span class="brand-text">GO</span>
</div>



  <a class="<?= $page=='dashboard.php'?'active':'' ?>" href="dashboard.php">Dashboard</a>
  <a class="<?= $page=='packages.php'?'active':'' ?>" href="packages.php">Packages</a>
  <a class="<?= $page=='view_bookings.php'?'active':'' ?>" href="view_bookings.php">Bookings</a>
  <a class="<?= $page=='users.php'?'active':'' ?>" href="users.php">Users</a>
  <a class="<?= $page=='inquirys.php'?'active':'' ?>" href="inquirys.php">Enquiries</a>
  <a class="<?= $page=='settings.php'?'active':'' ?>" href="settings.php">Settings</a>
  <a href="logout.php">Logout</a>
</div>
