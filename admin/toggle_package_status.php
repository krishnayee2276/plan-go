<?php
include "includes/auth.php";
include "includes/db_config.php"; // <-- THIS WAS MISSING

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    header("Location: packages.php");
    exit;
}

$id = (int) $_GET['id'];
$status = $_GET['status'] === 'Active' ? 'Inactive' : 'Active';

$stmt = $pdo->prepare("UPDATE packages SET status = ? WHERE id = ?");
$stmt->execute([$status, $id]);

header("Location: packages.php");
exit;
