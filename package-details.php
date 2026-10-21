<?php
// Standalone package-details.php - Supports both id and slug
$host = "localhost";
$user = "root";
$pass = "";
$db = "plan_go_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database Error: " . $conn->connect_error);
}
$conn->set_charset("utf8");

$package_id = $_GET['id'] ?? '';
$slug = $_GET['slug'] ?? '';

// Get package by ID or slug
if ($package_id) {
    $query = "SELECT * FROM packages WHERE id = ? AND status = 'Active'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $package_id);
} elseif ($slug) {
    $query = "SELECT * FROM packages WHERE slug = ? AND status = 'Active'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $slug);
} else {
    echo "Invalid package request.";
    exit;
}

$stmt->execute();
$result = $stmt->get_result();
$package = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$package) {
    echo "Package not found.";
    exit;
}

// Get image path
$imagePath = (!empty($package['image']) && file_exists('admin/uploads/'.$package['image'])) 
    ? 'admin/uploads/'.$package['image'] 
    : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($package['p_name']); ?> - Plan & Go</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Theme Colors: Dark Purple #2e2352, Yellow #ffc107 */
        :root {
            --theme-purple: #2e2352;
            --theme-yellow: #ffc107;
            --theme-purple-light: #4a3f7f;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            height: 400px;
            overflow: hidden;
        }
        
        .hero-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
        
        .hero-placeholder {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, var(--theme-purple) 0%, var(--theme-purple-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 80px;
        }
        
        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            padding: 30px;
        }
        
        .hero-title {
            color: white;
            font-size: 36px;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        /* Main Container */
        .details-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 15px;
        }

        /* Content Card */
        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            padding: 30px;
            margin-bottom: 25px;
        }
        
        .section-title {
            color: var(--theme-purple);
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--theme-yellow);
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .info-item i {
            color: var(--theme-yellow);
            font-size: 20px;
            width: 30px;
        }
        
        .info-item .label {
            font-size: 12px;
            color: #888;
            display: block;
        }
        
        .info-item .value {
            font-size: 14px;
            font-weight: 600;
            color: var(--theme-purple);
        }

        /* Description */
        .description-text {
            font-size: 15px;
            line-height: 1.8;
            color: #555;
        }

        /* Sidebar */
        .sidebar-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            padding: 25px;
            position: sticky;
            top: 20px;
        }
        
        .price-display {
            font-size: 32px;
            font-weight: 800;
            color: var(--theme-purple);
            margin-bottom: 5px;
        }
        
        .price-display span {
            font-size: 14px;
            font-weight: 500;
            color: #888;
        }
        
        .btn-book-now {
            width: 100%;
            padding: 15px;
            background: var(--theme-yellow);
            color: var(--theme-purple);
            font-weight: 700;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        
        .btn-book-now:hover {
            background: #e0a800;
            transform: translateY(-2px);
        }
        
        .btn-inquire {
            width: 100%;
            padding: 12px;
            background: transparent;
            color: var(--theme-purple);
            font-weight: 600;
            border: 2px solid var(--theme-purple);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-inquire:hover {
            background: var(--theme-purple);
            color: white;
        }

        /* Quick Info List */
        .quick-info {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        
        .quick-info li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .quick-info li i {
            color: var(--theme-yellow);
            width: 20px;
        }

        /* Back Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--theme-purple);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--theme-yellow);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section { height: 250px; }
            .hero-image, .hero-placeholder { height: 250px; }
            .hero-title { font-size: 24px; }
            .content-card { padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <div class="hero-section">
        <?php if(!empty($imagePath)): ?>
        <img src="<?php echo htmlspecialchars($imagePath); ?>" class="hero-image" alt="<?php echo htmlspecialchars($package['p_name']); ?>">
        <?php else: ?>
        <div class="hero-placeholder">
            <i class="fas fa-plane-departure"></i>
        </div>
        <?php endif; ?>
        
        <div class="hero-overlay">
            <div class="details-container">
                <h1 class="hero-title"><?php echo htmlspecialchars($package['p_name']); ?></h1>
            </div>
        </div>
    </div>

    <div class="details-container">
        <a href="packages.php?cat=<?php echo htmlspecialchars($package['category']); ?>" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Packages
        </a>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Overview Card -->
                <div class="content-card">
                    <h2 class="section-title"><i class="fas fa-info-circle"></i> Package Overview</h2>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <i class="far fa-clock"></i>
                            <div>
                                <span class="label">Duration</span>
                                <span class="value"><?php echo htmlspecialchars($package['duration'] ?? 'Flexible'); ?></span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-hotel"></i>
                            <div>
                                <span class="label">Stay Type</span>
                                <span class="value"><?php echo htmlspecialchars($package['stay_type'] ?? 'Standard'); ?></span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-tag"></i>
                            <div>
                                <span class="label">Category</span>
                                <span class="value"><?php echo htmlspecialchars(ucfirst($package['category'] ?? 'Standard')); ?></span>
                            </div>
                        </div>
                    </div>

                    <p class="description-text"><?php echo nl2br(htmlspecialchars($package['description'] ?? 'No description available.')); ?></p>
                </div>

                <!-- Itinerary Card -->
                <?php if(!empty($package['itinerary'])): ?>
                <div class="content-card">
                    <h2 class="section-title"><i class="fas fa-map-marked-alt"></i> Itinerary</h2>
                    <p class="description-text"><?php echo nl2br(htmlspecialchars($package['itinerary'])); ?></p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-card">
                    <div class="price-display">
                        ₹<?php echo number_format($package['price_inr']); ?> <span>/ person</span>
                    </div>
                    
                    <button class="btn-book-now" onclick="window.location.href='checkout.php?id=<?php echo $package['id']; ?>'">
                        <i class="fas fa-shopping-cart"></i> Book Now
                    </button>
                    
                    <button class="btn-inquire" onclick="window.location.href='inquiry.html'">
                        <i class="fas fa-envelope"></i> Send Inquiry
                    </button>

                    <h5 style="color: var(--theme-purple); margin-top: 25px; font-weight: 700;">Quick Info</h5>
                    <ul class="quick-info">
                        <li><i class="fas fa-check-circle"></i> Best Price Guaranteed</li>
                        <li><i class="fas fa-check-circle"></i> Easy Cancellation</li>
                        <li><i class="fas fa-check-circle"></i> 24/7 Customer Support</li>
                        <li><i class="fas fa-check-circle"></i> Trusted Travel Partner</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
