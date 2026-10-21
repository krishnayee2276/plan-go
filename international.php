<?php
// Set the current category before including the display file
$current_category = 'international';

// Include header
include 'includes/header.php';
?>

<!-- Page Title -->
<section class="thm-breadcrumb" style="background: #1c1450; padding: 15px 0; margin-top: 120px;">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
            <li>International Packages</li>
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
