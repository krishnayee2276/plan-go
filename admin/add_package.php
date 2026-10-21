<?php
include "includes/auth.php";
include "includes/db_config.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// session already active from auth.php - no session_start()

/* =============================== 
   HANDLE FORM SUBMIT - SIMPLE IMAGE
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $p_name        = $_POST['p_name'];
    $category      = $_POST['category'];
    $price_inr     = $_POST['price_inr'];
    $price_usd     = $_POST['price_usd'] ?? null;
    $duration      = $_POST['duration'];
    $description   = $_POST['description'];
    $status        = $_POST['status'];

    /* SIMPLE IMAGE HANDLING */
    $p_image = null;
    if (!empty($_FILES['p_image']['name'])) {
        $p_image = time() . '_' . basename($_FILES['p_image']['name']);
        move_uploaded_file($_FILES['p_image']['tmp_name'], "uploads/" . $p_image);
    }

    /* =============================== 
       BASIC INSERT
    ================================ */
    $stmt = $pdo->prepare("
        INSERT INTO packages (
            p_name, category, price_inr, price_usd, duration,
            description, p_image, status
        ) VALUES (?,?,?,?,?,?,?,?)
    ");

    $stmt->execute([
        $p_name,
        $category,
        $price_inr,
        $price_usd,
        $duration,
        $description,
        $p_image,
        $status
    ]);

    header("Location: packages.php?success=1");
    exit;
}

include "includes/header.php";
include "includes/sidebar.php";
?>

<div class="main">
  <div class="topbar">
    <h1>Add Package</h1>
  </div>

  <div class="panel">
    <form method="POST" enctype="multipart/form-data">

      <div class="form-row">
        <div class="form-group">
          <label>Package Name</label>
          <input type="text" name="p_name" required>
        </div>

        <div class="form-group">
          <label>Category</label>
          <select name="category" id="categorySelect" required onchange="toggleVisaField()">
            <option value="">Select</option>
            <option value="Domestic">Domestic</option>
            <option value="International">International</option>
            <option value="Unexplored">Unexplored</option>
            <option value="Weekend">Weekend</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Price INR</label>
          <input type="number" name="price_inr" required>
        </div>

        <div class="form-group">
          <label>Price USD</label>
          <input type="number" name="price_usd">
        </div>

        <div class="form-group">
          <label>Duration</label>
          <input type="text" name="duration" required>
        </div>

        <div class="form-group">
          <label>Status</label>
          <select name="status">
            <option selected>Active</option>
            <option>Inactive</option>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Package Image <small>(JPG/PNG)</small></label>
          <input type="file" name="p_image" accept="image/jpeg,image/png">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group full-width">
          <label>Description</label>
          <textarea name="description" rows="4" required></textarea>
        </div>
      </div>

      <button class="btn btn-primary">Save Package</button>

    </form>
  </div>
</div>

<script>
function toggleVisaField() {
    var category = document.getElementById('categorySelect').value;
    var visaRow = document.getElementById('visaRow');
    if (category === 'International') {
        visaRow.style.display = 'flex';
    } else {
        visaRow.style.display = 'none';
    }
}
</script>

<?php include "includes/footer.php"; ?>
