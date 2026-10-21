<?php
// Script to sync existing website packages to admin database
// Scans main_site/package/ folders and inserts missing packages

include "includes/db_config.php";

// Mapping of folder slugs to proper package names
$package_names = [
    'kerala1' => 'Kerala',
    'karnataka' => 'Karnataka',
    'tamil-nadu' => 'Tamil Nadu',
    'uttrakhand1' => 'Uttarakhand',
    'gujarat' => 'Gujarat',
    'rajasthan' => 'Rajasthan',
    'andaman' => 'Andaman',
    'kashmir' => 'Kashmir',
    'leh-ladakh' => 'Leh -Ladakh',
    'himachal' => 'Himachal',
    'sikkim' => 'Sikkim',
    'goa21' => 'Goa',
    'abali1' => 'Bali',
    'abc313' => 'ABC Package',
    'dubai' => 'Dubai',
    'madhya-pradesh' => 'Madhya Pradesh',
    'malaysia' => 'Malaysia',
    'offbeat-himachal' => 'Offbeat Himachal',
    'thailand' => 'Thailand',
    'vietnam' => 'Vietnam'
];

// Scan package folders
$package_dir = "../main_site/package/";
$folders = scandir($package_dir);

$inserted_count = 0;
$skipped_count = 0;

foreach ($folders as $folder) {
    if ($folder === '.' || $folder === '..' || !is_dir($package_dir . $folder)) {
        continue;
    }

    $slug = $folder;
    $p_name = isset($package_names[$slug]) ? $package_names[$slug] : ucwords(str_replace(['-', '_'], ' ', $slug));

    // Check if package already exists
    $stmt = $pdo->prepare("SELECT id FROM packages WHERE slug = ?");
    $stmt->execute([$slug]);
    $exists = $stmt->fetch();

    if (!$exists) {
        // Insert new package
        $stmt = $pdo->prepare("INSERT INTO packages (p_name, slug, category, status, price_inr, duration, description, p_image) VALUES (?, ?, 'Domestic', 'Active', NULL, NULL, NULL, NULL)");
        $stmt->execute([$p_name, $slug]);
        $inserted_count++;
        echo "Inserted: $p_name (slug: $slug)<br>";
    } else {
        $skipped_count++;
        echo "Skipped (already exists): $p_name (slug: $slug)<br>";
    }
}

echo "<br>Sync completed!<br>";
echo "Inserted: $inserted_count packages<br>";
echo "Skipped: $skipped_count packages<br>";
echo "Total processed: " . ($inserted_count + $skipped_count) . " packages<br>";
?>
