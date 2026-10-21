<?php
include "includes/db_config.php";
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM packages WHERE id = ?");
$stmt->execute([$id]);
header("Location: packages.php");
