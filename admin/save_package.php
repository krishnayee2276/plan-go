<?php
include 'includes/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = $_POST['package_name'] ?? '';
    $category    = ucfirst(strtolower($_POST['category'] ?? ''));
    $price_inr   = $_POST['price_inr'] ?? 0;
    $price_usd   = $_POST['price_usd'] ?? 0;
    $duration    = $_POST['duration'] ?? '';
    $description = $_POST['description'] ?? '';
$status      = $_POST['status'] ?? 'Active';

    /* IMAGE UPLOAD */
    $p_image = null;
    if (!empty($_FILES['image']['name'])) {
        $p_image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            '../uploads/' . $p_image
        );
    }

    $sql = "INSERT INTO packages 
        (p_name, category, price_inr, price_usd, duration, description, p_image, status)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $name,
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
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
