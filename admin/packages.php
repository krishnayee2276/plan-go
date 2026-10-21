<?php
include "includes/auth.php";
include "includes/db_config.php";
include "includes/header.php";
include "includes/sidebar.php";

$q = $pdo->query("SELECT * FROM packages ORDER BY id DESC");
?>
<div class="main">
  <!-- Top Bar -->
  <div class="topbar">
    <div>
      <h1>Packages</h1>
      <p class="welcome">Manage your travel packages</p>
    </div>
    <div class="topbar-right">
      <input type="text" placeholder="Search packages..." class="search-bar" id="packageSearch">
      <a href="add_package.php" class="btn">+ Add Package</a>
    </div>
  </div>

  <!-- Packages Table -->
  <div class="packages-table">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <>
          <th>Category</th>
          <th>Price (INR)</th>
          <th>Duration</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $packages = $q->fetchAll();
        foreach($packages as $p):
        ?>
        <tr>
          <td><?= $p['p_name'] ?></td>
          
          <td><?= $p['category'] ?></td>
          <td>₹<?= number_format($p['price_inr']) ?></td>
          <td><?= $p['duration'] ?> days</td>
          <td><span class="status-badge <?= strtolower($p['status']) ?>"><?= $p['status'] ?></span></td>
          <td>
            <a href="edit_package.php?id=<?= $p['id'] ?>" class="action-btn edit">Edit</a>
            <a href="delete_package.php?id=<?= $p['id'] ?>" class="action-btn delete" onclick="return confirm('Delete package?')">Delete</a>
            <a href="toggle_package_status.php?id=<?= $p['id'] ?>" class="action-btn toggle"><?= $p['status'] == 'Active' ? 'Deactivate' : 'Activate' ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php if(count($packages) == 0): ?>
  <div class="empty-state">
    No packages found
    <small>Create your first package to get started</small>
  </div>
  <?php endif; ?>
</div>

<script>
// Simple search and filter functionality
document.getElementById('packageSearch').addEventListener('input', filterPackages);
document.getElementById('categoryFilter').addEventListener('change', filterPackages);

function filterPackages() {
  const searchTerm = document.getElementById('packageSearch').value.toLowerCase();
  const categoryFilter = document.getElementById('categoryFilter').value;
  const packages = document.querySelectorAll('.package-card');

  packages.forEach(pkg => {
    const name = pkg.querySelector('h3').textContent.toLowerCase();
    const category = pkg.querySelector('.category').textContent;

    const matchesSearch = name.includes(searchTerm);
    const matchesCategory = !categoryFilter || category === categoryFilter;

    pkg.style.display = matchesSearch && matchesCategory ? 'block' : 'none';
  });
}
</script>
<?php include "includes/footer.php"; ?>
