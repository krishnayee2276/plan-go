<?php
// Redirect to the new packages.php master template
$cat = isset($current_category) ? $current_category : 'domestic';
header("Location: packages.php?cat=" . urlencode($cat));
exit;
?>
