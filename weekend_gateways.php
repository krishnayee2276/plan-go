<?php
// DEBUG: This line confirms the dynamic file is being loaded
echo "<!-- DEBUG: Loading dynamic weekend_gateways.php at " . date('Y-m-d H:i:s') . " -->";

// Set the current category before including the display file
$current_category = 'weekend_gateways';

// Include header
include 'includes/header.php';
?>

<!-- Page Title -->
<section class="thm-breadcrumb" style="background: #1c1450; padding: 15px 0; margin-top: 120px;">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
            <li>Weekend Gateways</li>
        </ul>
    </div>
</section>

<?php
// Include the category display component
include 'category_display.php';
?>

<?php
// Include footer
include 'includes/footer.php';
?>
