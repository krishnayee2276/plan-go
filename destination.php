<?php
// 1. Establish the connection at the very top
// Assuming this file is in the root and db_config.php is in the /api folder
require_once 'api/db_config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>plan & go || Destinations</title>
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/style.css">
</head>

<body>
    <div class="page-wrapper">
        <section class="page-header dest">
            <div class="container">
                <h2>Our Destinations</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="index.php">Home</a></li>
                    <li><span>Destinations</span></li>
                </ul>
            </div>
        </section>

        <section class="destinations-one">
            <div class="container">
                <div class="row masonary-layout">
                    
                    <?php
                    // 2. Fetch active packages from the 'packages' table
                    $sql = "SELECT * FROM packages WHERE status = 'Active' ORDER BY id DESC";
                    $result = $conn->query($sql); // Using the $conn object from your db_config.php

                    if ($result && $result->num_rows > 0):
                        // 3. Loop through each package in the database
                        while($row = $result->fetch_assoc()): 
                            // Use the image from database, or a placeholder if null
                            $imageFile = !empty($row['image']) ? $row['image'] : 'default.jpg';
                            ?>
                            
                            <div class="col-md-4 masonary-item">
                                <div class="destinations-one__single">
                                    <img src="wp-content/uploads/<?php echo htmlspecialchars($imageFile); ?>" 
                                         alt="<?php echo htmlspecialchars($row['p_name']); ?>" 
                                         width="370" height="280">
                                    
                                    <h3>
                                        <a href="package-details.php?id=<?php echo $row['id']; ?>">
                                            <?php echo htmlspecialchars($row['p_name']); ?> <br>
                                            <span>Starting at ₹<?php echo number_format($row['price_inr']); ?></span>
                                        </a>
                                    </h3>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="col-12 text-center">
                            <p>No destinations are currently available. Check back soon!</p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        </div>
</body>
</html>