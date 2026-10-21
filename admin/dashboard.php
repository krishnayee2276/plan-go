<?php
include "includes/auth.php";
include "includes/db_config.php";
include "includes/header.php";
include "includes/sidebar.php";

$totalPackages = $pdo->query("SELECT COUNT(*) FROM packages")->fetchColumn();

$activePackages = $pdo->query(
    "SELECT COUNT(*) FROM packages WHERE status = 'Active'"
)->fetchColumn();

$totalBookings = $pdo->query(
    "SELECT COUNT(*) FROM bookings"
)->fetchColumn();

$totalUsers = $pdo->query(
    "SELECT COUNT(*) FROM users"
)->fetchColumn();

?>

<div class="main">
  <!-- Top Bar -->
  <div class="topbar">
    <div>
      <h1>Dashboard</h1>
      <p class="welcome">Welcome back, Admin</p>
    </div>
    <div class="topbar-right">
      <button class="notification-btn"><i class="fa-solid fa-bell"></i></button>
      <div class="avatar-dropdown">
        <div class="avatar">A</div>
        <div class="dropdown-menu">
          <a href="settings.php"><i class="fa-solid fa-user-cog"></i> Profile & Settings</a>
        </div>
      </div>
    </div>
  </div>

  <!-- KPI Cards -->
  <div class="cards">
    <div class="card">
      <i class="fa-solid fa-box-open"></i>
      <div>
        <small>Total Packages</small>
        <span class="animated-number" data-target="<?= $totalPackages ?>"><?= $totalPackages ?></span>
        <small class="trend">+12 this month</small>
      </div>
    </div>
    <div class="card">
      <i class="fa-solid fa-check-circle"></i>
      <div>
        <small>Active Packages</small>
        <span class="animated-number" data-target="<?= $activePackages ?>"><?= $activePackages ?></span>
        <small class="trend">+5 this month</small>
      </div>
    </div>
    <div class="card">
      <i class="fa-solid fa-calendar-check"></i>
      <div>
        <small>Total Bookings</small>
        <span class="animated-number" data-target="<?= $totalBookings ?>"><?= $totalBookings ?></span>
        <small class="trend">+8 this month</small>
      </div>
    </div>
    <div class="card">
      <i class="fa-solid fa-users"></i>
      <div>
        <small>Total Users</small>
        <span class="animated-number" data-target="<?= $totalUsers ?>"><?= $totalUsers ?></span>
        <small class="trend">+15 this month</small>
      </div>
    </div>
  </div>

  <!-- Dashboard Grid -->
  <div class="dashboard-wrapper">
    <div class="dashboard-content">
      <!-- Analytics Section -->
      <div class="analytics-section">
        <div class="panel large">
          <h3>Bookings & Revenue Overview</h3>
          <canvas id="bookingChart" height="120"></canvas>
        </div>
        <div class="quick-stats">
          <div class="stat-card">
            <h4>Total Revenue</h4>
            <span class="stat-value">₹2,45,000</span>
            <small class="stat-trend positive">+12.5%</small>
          </div>
          <div class="stat-card">
            <h4>Avg Booking Value</h4>
            <span class="stat-value">₹18,500</span>
            <small class="stat-trend positive">+5.2%</small>
          </div>
          <div class="stat-card">
            <h4>Conversion Rate</h4>
            <span class="stat-value">24.8%</span>
            <small class="stat-trend negative">-2.1%</small>
          </div>
          <div class="stat-card">
            <h4>Customer Retention</h4>
            <span class="stat-value">78.5%</span>
            <small class="stat-trend positive">+3.7%</small>
          </div>
        </div>
      </div>

      <!-- Recent Bookings -->
      <div class="panel full recent-bookings">
        <h3>Recent Bookings</h3>
        <table>
          <tr>
            <th>Customer</th>
            <th>Package</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date</th>
          </tr>
          <?php
          $recentBookings = $pdo->query("SELECT * FROM bookings ORDER BY id DESC LIMIT 5")->fetchAll();
          if (count($recentBookings) > 0) {
            foreach ($recentBookings as $booking) {
              $statusClass = isset($booking['status']) ? strtolower($booking['status']) : 'pending';
              $amount = isset($booking['amount']) ? $booking['amount'] : '0';
              $customerName = isset($booking['customer_name']) ? $booking['customer_name'] : 'Unknown';
              $packageName = isset($booking['package_name']) ? $booking['package_name'] : 'N/A';
              $status = isset($booking['status']) ? $booking['status'] : 'Pending';
              $bookingDate = isset($booking['booking_date']) ? $booking['booking_date'] : date('Y-m-d');
              echo "<tr>
                <td><div class='customer-info'><div class='customer-avatar'>".substr($customerName, 0, 1)."</div>{$customerName}</div></td>
                <td>{$packageName}</td>
                <td>₹{$amount}</td>
                <td><span class='status-badge {$statusClass}'>{$status}</span></td>
                <td>{$bookingDate}</td>
              </tr>";
            }
          } else {
            echo "<tr><td colspan='5' class='empty-state'>No bookings yet</td></tr>";
          }
          ?>
        </table>
      </div>
    </div>

    <!-- Right Sidebar -->
    <div class="dashboard-right">
      <div class="panel">
        <h3>Admin Info</h3>
        <div class="admin-info">
          <div class="admin-avatar">A</div>
          <div>
            <strong>Admin User</strong>
            <small>admin@plan-go.com</small>
          </div>
        </div>
        <div class="admin-stats">
          <div><small>Last Login</small><br>Today, 10:30 AM</div>
          <div><small>Role</small><br>Super Admin</div>
        </div>
      </div>

      <div class="panel">
        <h3>System Status</h3>
        <div class="system-status">
          <div class="status-item">
            <span class="status-dot online"></span>
            <div>
              <strong>Server</strong>
              <small>Online</small>
            </div>
          </div>
          <div class="status-item">
            <span class="status-dot online"></span>
            <div>
              <strong>Database</strong>
              <small>Connected</small>
            </div>
          </div>
          <div class="status-item">
            <span class="status-dot online"></span>
            <div>
              <strong>Security</strong>
              <small>Protected</small>
            </div>
          </div>
          <div class="status-item">
            <span class="status-dot online"></span>
            <div>
              <strong>API</strong>
              <small>Operational</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div> <!-- main end -->

<script>
const ctx = document.getElementById('bookingChart').getContext('2d');

new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
    datasets: [{
      label: 'Bookings',
      data: [0, 1, 0, 2, 1, 0, 0],
      borderColor: '#fae013',
      backgroundColor: 'rgba(250,224,19,0.15)',
      tension: 0.4,
      fill: true,
      pointRadius: 4,
      pointBackgroundColor: '#fae013'
    }]
  },
  options: {
    plugins: {
      legend: { display: false }
    },
    scales: {
      x: { ticks: { color: '#aaa' }, grid: { display: false } },
      y: { ticks: { color: '#aaa' }, grid: { color: 'rgba(255,255,255,0.05)' } }
    }
  }
});
</script>

<?php include "includes/footer.php"; ?>
