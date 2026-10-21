<?php
include 'api/db_config.php';

$packages = [
    ['p_name' => 'Kerala', 'category' => 'Domestic', 'price_inr' => 15000, 'price_usd' => 200, 'duration' => '5 Days / 4 Nights', 'description' => 'Explore the backwaters and beaches of Kerala.', 'p_image' => 'kerala.jpg', 'status' => 'Active'],
    ['p_name' => 'Karnataka', 'category' => 'Domestic', 'price_inr' => 12000, 'price_usd' => 160, 'duration' => '4 Days / 3 Nights', 'description' => 'Discover the heritage and wildlife of Karnataka.', 'p_image' => 'karnataka.jpg', 'status' => 'Active'],
    ['p_name' => 'Tamil Nadu', 'category' => 'Domestic', 'price_inr' => 14000, 'price_usd' => 180, 'duration' => '5 Days / 4 Nights', 'description' => 'Visit temples and beaches in Tamil Nadu.', 'p_image' => 'tamil_nadu.jpg', 'status' => 'Active'],
    ['p_name' => 'Uttarakhand', 'category' => 'Domestic', 'price_inr' => 10000, 'price_usd' => 130, 'duration' => '4 Days / 3 Nights', 'description' => 'Experience the hills and lakes of Uttarakhand.', 'p_image' => 'uttarakhand.jpg', 'status' => 'Active'],
    ['p_name' => 'Goa', 'category' => 'Domestic', 'price_inr' => 8000, 'price_usd' => 100, 'duration' => '3 Days / 2 Nights', 'description' => 'Relax on the sunny beaches of Goa.', 'p_image' => 'goa.jpg', 'status' => 'Active'],
];

foreach ($packages as $pkg) {
    $stmt = $conn->prepare("INSERT INTO packages (p_name, category, price_inr, price_usd, duration, description, p_image, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssddssss', $pkg['p_name'], $pkg['category'], $pkg['price_inr'], $pkg['price_usd'], $pkg['duration'], $pkg['description'], $pkg['p_image'], $pkg['status']);
    $stmt->execute();
    $stmt->close();
}

echo "Domestic packages inserted successfully.";
$conn->close();
?>
