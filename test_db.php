<?php
require_once 'db_config.php';
$res = $conn->query("SELECT p_name, price_inr FROM packages LIMIT 1");
$row = $res->fetch_assoc();
echo "Package: " . $row['p_name'] . " - ₹" . $row['price_inr'];
?>
