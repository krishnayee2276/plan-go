<?php
// Include file to fetch package details by slug for detail pages

include '../api/db_config.php';

// Get slug from current directory (e.g., kerala1 from package/kerala1/)
$current_dir = basename(dirname(__FILE__));
$slug = $current_dir;

// Fetch package data
$stmt = $pdo->prepare("SELECT p_name, price_inr, duration, description FROM packages WHERE slug = ? AND status = 'Active'");
$stmt->execute([$slug]);
$package = $stmt->fetch(PDO::FETCH_ASSOC);

// Set variables, use NULL if not found or empty
$package_name = $package['p_name'] ?? null;
$package_price = $package['price_inr'] ?? null;
$package_duration = $package['duration'] ?? null;
$package_description = $package['description'] ?? null;
?>
