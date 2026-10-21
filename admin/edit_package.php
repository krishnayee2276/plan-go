<?php
include "includes/auth.php";
include "includes/db_config.php";
include "includes/header.php";
include "includes/sidebar.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: packages.php");
    exit;
}

/* ===============================
   FETCH PACKAGE
================================ */
$stmt = $pdo->prepare("SELECT * FROM packages WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();

if (!$p) {
    header("Location: packages.php");
    exit;
}

/* ===============================
   UPDATE PACKAGE
================================ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $imageName = $p['p_image']; // keep old image

    if (!empty($_FILES['p_image']['name'])) {
        $imageName = time() . "_" . $_FILES['p_image']['name'];
        move_uploaded_file(
            $_FILES['p_image']['tmp_name'],
            "uploads/" . $imageName
        );
    }

    $stmt = $pdo->prepare("
        UPDATE packages SET
            p_name = ?,
            category = ?,
            price_inr = ?,
            duration = ?,
            description = ?,
            p_image = ?,
            status = ?
        WHERE id = ?
    ");

    $stmt->execute([
        $_POST['p_name'],
        $_POST['category'],
        $_POST['price_inr'],
        $_POST['duration'],
        $_POST['description'],
        $imageName,
        $_POST['status'],
        $id
    ]);

    header("Location: packages.php");
    exit;
}
?>

<div class="main">
    <h1>Edit Package</h1>

    <form method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group">
                <label>Package Name</label>
                <input name="p_name" value="<?= htmlspecialchars($p['p_name']) ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <?php
                    $cats = ['Domestic','International','Weekend Gateways','Unexplored'];
                    foreach ($cats as $c):
                    ?>
                        <option value="<?= $c ?>" <?= $p['category']===$c?'selected':'' ?>>
                            <?= $c ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Price INR</label>
                <input name="price_inr" value="<?= $p['price_inr'] ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Duration</label>
                <input name="duration" value="<?= htmlspecialchars($p['duration']) ?>">
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Active" <?= $p['status']=='Active'?'selected':'' ?>>Active</option>
                    <option value="Inactive" <?= $p['status']=='Inactive'?'selected':'' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group full-width">
                <label>Description</label>
                <textarea name="description"><?= htmlspecialchars($p['description']) ?></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Package Image</label>
                <input type="file" name="p_image">
                <?php if ($p['p_image']): ?>
                    <p>Current: <?= htmlspecialchars($p['p_image']) ?></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <button class="btn">Update</button>
            </div>
        </div>
    </form>
</div>

<?php include "includes/footer.php"; ?>
