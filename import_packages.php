<?php
include('includes/config.php');
include('extract_packages.php');

// Import packages into database
foreach ($packages as $key => $package) {
    $name = mysqli_real_escape_string($conn, $package['name']);
    $category = $package['category'];
    $description = mysqli_real_escape_string($conn, $package['description']);
    $duration = $package['duration'];
    $stay_type = $package['stay_type'];
    $cuisine = $package['cuisine'];
    $car_rental = $package['car_rental'];
    $price_inr = $package['price_inr'];
    $price_usd = $package['price_usd'];
    $image = $package['images'][0]; // Use first image as main image

    $query = "INSERT INTO packages (p_name, category, price_inr, price_usd, duration, stay_type, cuisine, car_rental, description, image)
              VALUES ('$name', '$category', '$price_inr', '$price_usd', '$duration', '$stay_type', '$cuisine', '$car_rental', '$description', '$image')";

    if (mysqli_query($conn, $query)) {
        echo "✓ Imported package: {$package['name']}\n";
    } else {
        echo "✗ Error importing {$package['name']}: " . mysqli_error($conn) . "\n";
    }
}

echo "\nPackage import completed!\n";
?>





