<?php
include "includes/auth.php";
include "includes/db_config.php";
include "includes/header.php";
include "includes/sidebar.php";

$booking_id = $_GET['id'] ?? null;

if (!$booking_id) {
    echo "<script>alert('Invalid booking ID'); window.location.href='view_bookings.php';</script>";
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = ?");
    $stmt->execute([$booking_id]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$booking) {
        echo "<script>alert('Booking not found'); window.location.href='view_bookings.php';</script>";
        exit;
    }
} catch (PDOException $e) {
    echo "<script>alert('Database error'); window.location.href='view_bookings.php';</script>";
    exit;
}
?>

<div class="main">
  <!-- Top Bar -->
  <div class="topbar">
    <div>
      <h1>Booking Details</h1>
      <p class="welcome">Booking #<?= $booking['id'] ?></p>
    </div>
    <div class="topbar-right">
      <a href="view_bookings.php" class="btn">← Back to Bookings</a>
    </div>
  </div>

  <!-- Booking Details -->
  <div class="booking-details">
    <div class="panel">
      <h3>Customer Information</h3>
      <div class="detail-grid">
        <div class="detail-item">
          <label>Name:</label>
          <span><?= htmlspecialchars($booking['customer_name'] ?? 'N/A') ?></span>
        </div>
        <div class="detail-item">
          <label>Email:</label>
          <span><?= htmlspecialchars($booking['customer_email'] ?? 'N/A') ?></span>
        </div>
        <div class="detail-item">
          <label>Phone:</label>
          <span><?= htmlspecialchars($booking['customer_phone'] ?? 'N/A') ?></span>
        </div>
      </div>
    </div>

    <div class="panel">
      <h3>Booking Information</h3>
      <div class="detail-grid">
        <div class="detail-item">
          <label>Booking ID:</label>
          <span>#<?= $booking['id'] ?></span>
        </div>
        <div class="detail-item">
          <label>Package:</label>
          <span><?= htmlspecialchars($booking['package_name'] ?? 'N/A') ?></span>
        </div>
        <div class="detail-item">
          <label>Amount:</label>
          <span>₹<?= number_format($booking['amount'] ?? 0) ?></span>
        </div>
        <div class="detail-item">
          <label>Status:</label>
          <span class="status-badge <?= strtolower($booking['status'] ?? 'pending') ?>"><?= $booking['status'] ?? 'Pending' ?></span>
        </div>
        <div class="detail-item">
          <label>Booking Date:</label>
          <span><?= $booking['booking_date'] ?? date('Y-m-d') ?></span>
        </div>
        <div class="detail-item">
          <label>Travel Date:</label>
          <span><?= $booking['travel_date'] ?? 'N/A' ?></span>
        </div>
      </div>
    </div>

    <div class="panel">
      <h3>Additional Details</h3>
      <div class="detail-grid">
        <div class="detail-item">
          <label>Number of Travelers:</label>
          <span><?= $booking['travelers'] ?? 'N/A' ?></span>
        </div>
        <div class="detail-item">
          <label>Special Requests:</label>
          <span><?= htmlspecialchars($booking['special_requests'] ?? 'None') ?></span>
        </div>
      </div>
    </div>

    <!-- Status Update Section -->
    <div class="panel">
      <h3>Update Status</h3>
      <form id="statusForm" method="POST">
        <div class="form-group">
          <label for="status">Status:</label>
          <select name="status" id="status" class="form-control">
            <option value="Pending" <?= ($booking['status'] ?? 'Pending') === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Confirmed" <?= ($booking['status'] ?? 'Pending') === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
            <option value="Cancelled" <?= ($booking['status'] ?? 'Pending') === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
          </select>
        </div>
        <button type="submit" class="btn">Update Status</button>
      </form>
    </div>
  </div>
</div>

<script>
// Handle status update form submission
document.getElementById('statusForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  const newStatus = formData.get('status');

  fetch('update_booking_status.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=<?= $booking['id'] ?>&status=${newStatus}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showNotification(`Booking status updated to ${newStatus}`, 'success');
      // Update the status badge
      const statusBadge = document.querySelector('.status-badge');
      statusBadge.className = `status-badge ${newStatus.toLowerCase()}`;
      statusBadge.textContent = newStatus;
    } else {
      showNotification(data.message || 'Failed to update status', 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('An error occurred while updating the status', 'error');
  });
});

// Notification function
function showNotification(message, type) {
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.textContent = message;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    z-index: 1000;
    animation: slideIn 0.3s ease-out;
  `;

  if (type === 'success') {
    notification.style.backgroundColor = '#28a745';
  } else {
    notification.style.backgroundColor = '#dc3545';
  }

  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.animation = 'slideOut 0.3s ease-out';
    setTimeout(() => {
      document.body.removeChild(notification);
    }, 300);
  }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
  @keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
  @keyframes slideOut {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
  }
`;
document.head.appendChild(style);
</script>

<style>
.booking-details {
  display: grid;
  gap: 20px;
}

.detail-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 15px;
}

.detail-item {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.detail-item label {
  font-weight: bold;
  color: var(--text-muted);
}

.detail-item span {
  padding: 8px 12px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 4px;
  border: 1px solid rgba(255, 255, 255, 0.08);
  color: var(--text-main);
}

.form-group {
  margin-bottom: 15px;
}

.form-control {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid var(--border-soft);
  border-radius: 4px;
  font-size: 14px;
  background: rgba(255, 255, 255, 0.05);
  color: var(--text-main);
}

.form-control:focus {
  outline: none;
  border-color: var(--accent);
  box-shadow: 0 0 0 2px rgba(250, 224, 19, 0.1);
  background: rgba(255, 255, 255, 0.08);
}

.form-control option {
  background: var(--bg-main);
  color: var(--text-main);
}

.btn {
  background: #fae013;
  color: #000;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

.btn:hover {
  background: #e6cc11;
}
</style>

<?php include "includes/footer.php"; ?>
