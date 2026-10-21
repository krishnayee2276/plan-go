
<?php
include "includes/auth.php";
include "includes/db_config.php";
include "includes/header.php";
include "includes/sidebar.php";

$q = $pdo->query("SELECT * FROM users");
?>
<div class="main">
  <!-- Top Bar -->
  <div class="topbar">
    <div>
      <h1>Users</h1>
      <p class="welcome">Manage registered users</p>
    </div>
    <div class="topbar-right">
      <input type="text" placeholder="Search users..." class="search-bar" id="userSearch">
      <select class="search-bar" id="statusFilter">
        <option value="">All Status</option>
        <option value="Active">Active</option>
        <option value="Blocked">Blocked</option>
      </select>
    </div>
  </div>

  <!-- Users Grid -->
  <div class="users-grid">
    <?php
    $users = $q->fetchAll();
    foreach($users as $u):
      // Get total bookings for this user (simplified for now)
      $userBookings = 0; // Placeholder - will be implemented when database is properly set up
    ?>
    <div class="user-card">
      <div class="user-header">
        <div class="user-avatar"><?= substr($u['fullname'] ?? 'N', 0, 1) ?></div>
        <div class="user-status">
          <span class="status-badge <?= strtolower($u['status'] ?? 'active') ?>"><?= $u['status'] ?? 'Active' ?></span>
        </div>
      </div>
      <div class="user-content">
        <h3><?= $u['fullname'] ?? 'N/A' ?></h3>
        <div class="user-email"><?= $u['email'] ?></div>
        <div class="user-meta">
          <div class="meta-item">
            <i class="fa-solid fa-phone"></i>
            <?= $u['phone'] ?>
          </div>
          <div class="meta-item">
            <i class="fa-solid fa-calendar-check"></i>
            <?= $userBookings ?> bookings
          </div>
          <div class="meta-item">
            <i class="fa-solid fa-calendar"></i>
            Joined <?= date('M Y', strtotime($u['created_at'])) ?>
          </div>
        </div>
        <div class="user-actions">
          <a href="#" class="action-btn view" onclick="viewUser(<?= $u['id'] ?>)">View Profile</a>
          <a href="#" class="action-btn <?= ($u['status'] ?? 'Active') == 'Active' ? 'block' : 'unblock' ?>" onclick="toggleUserStatus(<?= $u['id'] ?>, '<?= $u['status'] ?? 'Active' ?>')">
            <?= ($u['status'] ?? 'Active') == 'Active' ? 'Disable' : 'Enable' ?> User
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if(count($users) == 0): ?>
  <div class="empty-state">
    No users found
    <small>Users will appear here once they register</small>
  </div>
  <?php endif; ?>
</div>

<script>
// Search and filter functionality
document.getElementById('userSearch').addEventListener('input', filterUsers);
document.getElementById('statusFilter').addEventListener('change', filterUsers);

function filterUsers() {
  const searchTerm = document.getElementById('userSearch').value.toLowerCase();
  const statusFilter = document.getElementById('statusFilter').value;
  const users = document.querySelectorAll('.user-card');

  users.forEach(user => {
    const name = user.querySelector('h3').textContent.toLowerCase();
    const email = user.querySelector('.user-email').textContent.toLowerCase();
    const status = user.querySelector('.status-badge').textContent;

    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
    const matchesStatus = !statusFilter || status === statusFilter;

    user.style.display = matchesSearch && matchesStatus ? 'block' : 'none';
  });
}

function viewUser(id) {
  // Placeholder for view user profile functionality
  alert(`View profile for user #${id}`);
}

function toggleUserStatus(id, currentStatus) {
  const newStatus = currentStatus === 'Active' ? 'Blocked' : 'Active';

  // Send AJAX request to update the user status
  fetch('update_user_status.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `id=${id}&status=${newStatus}`
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Show success message and update the UI
      showNotification(`User #${id} status updated to ${newStatus}`, 'success');

      // Update the status badge and button text
      const userCard = document.querySelector(`.user-card:has(.user-actions a[onclick*="toggleUserStatus(${id}"])`);
      if (userCard) {
        const statusBadge = userCard.querySelector('.status-badge');
        const actionBtn = userCard.querySelector('.action-btn.block, .action-btn.unblock');

        statusBadge.textContent = newStatus;
        statusBadge.className = `status-badge ${newStatus.toLowerCase()}`;

        if (actionBtn) {
          actionBtn.textContent = newStatus === 'Active' ? 'Disable User' : 'Enable User';
          actionBtn.className = `action-btn ${newStatus === 'Active' ? 'block' : 'unblock'}`;
          actionBtn.setAttribute('onclick', `toggleUserStatus(${id}, '${newStatus}')`);
        }
      }
    } else {
      // Show error message
      showNotification(data.message || 'Failed to update user status', 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('An error occurred while updating the user status', 'error');
  });
}

// Notification function
function showNotification(message, type) {
  // Create notification element
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

  // Remove notification after 3 seconds
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
<?php include "includes/footer.php"; ?>
