<?php
// Fixed MakeMyTrip Style packages.php with Horizontal Cards
require_once 'db_config.php';

$cat = isset($_GET['cat']) ? $_GET['cat'] : 'domestic';

// Get price range from database
$priceRangeStmt = $conn->prepare("SELECT MIN(price_inr) as min_price, MAX(price_inr) as max_price FROM packages WHERE LOWER(category) = LOWER(?) AND status = 'Active'");
$priceRangeStmt->bind_param("s", $cat);
$priceRangeStmt->execute();
$priceResult = $priceRangeStmt->get_result();
$priceRangeStmt->close();
$priceRange = $priceResult->fetch_assoc();
$minPrice = (int)($priceRange['min_price'] ?? 28000);
$maxPrice = (int)($priceRange['max_price'] ?? 55000);

// Get duration range
$durationStmt = $conn->prepare("SELECT MIN(CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED)) as min_days, 
                MAX(CAST(SUBSTRING_INDEX(duration, ' ', 1) AS UNSIGNED)) as max_days 
                FROM packages WHERE LOWER(category) = LOWER(?) AND status = 'Active' AND duration LIKE '%days%'");
$durationStmt->bind_param("s", $cat);
$durationStmt->execute();
$durationResult = $durationStmt->get_result();
$durationStmt->close();
$durationRange = $durationResult->fetch_assoc();
$minDays = (int)($durationRange['min_days'] ?? 1);
$maxDays = (int)($durationRange['max_days'] ?? 7);
if ($minDays < 1) $minDays = 1;
if ($maxDays < $minDays) $maxDays = $minDays + 5;

// Query ALL packages - show all by default
$mainStmt = $conn->prepare("SELECT id, p_name, description, price_inr, duration, stay_type, image, category, status 
        FROM packages 
        WHERE LOWER(category) = LOWER(?) AND status = 'Active' 
        ORDER BY id DESC");
$mainStmt->bind_param("s", $cat);
$mainStmt->execute();
$result = $mainStmt->get_result();
$mainStmt->close();

if (!$result) {
    $packages = [];
} else {
    $packages = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
$row['imagePath'] = !empty($row['image']) ? '../admin/uploads/' . $row['image'] : 'assets/images/default-package.jpg';
            
            preg_match('/(\d+)/', $row['duration'] ?? '1', $matches);
            $row['days'] = isset($matches[1]) ? (int)$matches[1] : 1;
            
            $stayType = strtolower($row['stay_type'] ?? '');
            if (strpos($stayType, '5 star') !== false || strpos($stayType, 'luxury') !== false) {
                $row['stars'] = 5;
            } elseif (strpos($stayType, '4 star') !== false) {
                $row['stars'] = 4;
            } elseif (strpos($stayType, '3 star') !== false || strpos($stayType, 'standard') !== false) {
                $row['stars'] = 3;
            } else {
                $row['stars'] = 3;
            }
            
            $packages[] = $row;
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($cat); ?> Holiday Packages | Plan & Go</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --theme-purple: #2e2352;
            --theme-yellow: #fae013;
        }
        
        * { box-sizing: border-box; }
        
        body { 
            font-family: 'Open Sans', Arial, sans-serif; 
            background: #f5f5f5; 
            margin: 0;
            padding: 0;
        }

        .page-header {
            background: linear-gradient(135deg, var(--theme-purple) 0%, #4a3f7f 100%);
            padding: 25px 20px;
            text-align: center;
            color: white;
        }
        
        .page-header h1 { 
            margin: 0; 
            font-size: 32px; 
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .main-container { 
            max-width: 1400px; 
            margin: 0 auto; 
            padding: 30px 15px 60px;
        }

        /* VERTICAL CARD STYLE - 4 Column Grid */
        .v-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .v-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        
        .v-card-img {
            width: 100%;
            height: 180px;
            overflow: hidden;
            background: #eee;
            position: relative;
        }
        
        .v-card-img img { 
            width: 100%; 
            height: 180px; 
            object-fit: cover; 
            transition: transform 0.5s ease;
        }
        
        .v-card:hover .v-card-img img {
            transform: scale(1.1);
        }
        
        .v-card-img .placeholder {
            width: 100%; 
            height: 180px; 
            background: linear-gradient(135deg, #e8e8e8, #f5f5f5);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: #bbb;
            font-size: 40px;
        }

        .v-card-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: var(--theme-yellow);
            color: var(--theme-purple);
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 2;
        }

        .v-card-body {
            flex: 1;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }
        
        .v-card-title {
            font-size: 16px; 
            font-weight: 700; 
            color: #222;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .v-card-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 10px;
        }
        
        .v-card-rating i { color: var(--theme-yellow); font-size: 12px; }
        .v-card-rating i.empty { color: #ddd; }
        .v-card-rating span { font-size: 12px; color: #666; }

        .v-card-price {
            font-size: 22px;
            font-weight: 800;
            color: var(--theme-purple);
            margin-top: auto;
            margin-bottom: 12px;
        }
        
        .v-card-price span {
            font-size: 12px;
            font-weight: 500;
            color: #888;
        }

        .v-card-btn {
            width: 100%;
            padding: 12px;
            background: #2e2352;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.3s;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .v-card-btn:hover { 
            background: #1a1638; 
            color: white;
        }

        /* Sidebar Filters */
        .filter-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 20px;
            position: sticky;
            top: 20px;
        }
        
        .filter-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--theme-purple);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .filter-label { 
            font-size: 14px; 
            color: #555; 
            margin-bottom: 10px; 
            display: block; 
            font-weight: 600;
        }
        
        .filter-value { 
            text-align: center; 
            font-weight: 800; 
            color: var(--theme-purple); 
            font-size: 22px; 
            margin-bottom: 10px; 
        }
        
        .filter-slider {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #e0e0e0;
            outline: none;
            -webkit-appearance: none;
        }
        
        .filter-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: var(--theme-purple);
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .filter-checkbox {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            padding: 10px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        
        .filter-checkbox:hover {
            background: #f8f9fa;
        }
        
        .filter-checkbox input {
            width: 20px;
            height: 20px;
            accent-color: var(--theme-purple);
        }
        
        .filter-checkbox label {
            font-size: 14px;
            color: #333;
            cursor: pointer;
        }

        .no-packages {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 12px;
        }
        
        .no-packages i { font-size: 60px; color: #ddd; margin-bottom: 20px; }
        .no-packages h4 { color: #333; margin-bottom: 10px; font-size: 24px; }
        .no-packages p { color: #888; font-size: 16px; }

        @media (max-width: 1100px) {
            .h-card { flex-direction: column; }
            .h-card-img { width: 100%; height: 220px; }
            .h-card-action { width: 100%; border-left: none; border-top: 1px solid #eee; padding: 20px; flex-direction: row; justify-content: space-between; align-items: center; }
            .h-card-btn { width: auto; margin-top: 0; }
            .h-card-price { text-align: left; }
        }
        
        @media (max-width: 991px) {
            .filter-card { position: static; margin-bottom: 30px; }
        }
        
        @media (max-width: 576px) {
            .h-card-inclusions { flex-wrap: wrap; gap: 10px; }
            .h-card-inclusions span { font-size: 12px; padding: 6px 10px; }
            .h-card-action { flex-direction: column; gap: 15px; }
            .h-card-btn { width: 100%; }
        }
    </style>
</head>
<body>

<div class="page-header">
    <h1><?php echo ucfirst($cat); ?> Holiday Packages</h1>
</div>

<div class="main-container">
    <div class="row">
        <!-- Left Sidebar - Filters (col-lg-3) -->
        <div class="col-lg-3">
            <div class="filter-card">
                <div class="filter-title"><i class="fas fa-filter"></i> Filters</div>
                
                <!-- Duration Filter -->
                <div class="mb-4">
                    <label class="filter-label">Duration (Max Days)</label>
                    <div class="filter-value" id="durationValue"><?php echo $maxDays; ?> Days</div>
                    <input type="range" id="durationSlider" class="filter-slider" 
                           min="<?php echo $minDays; ?>" max="<?php echo $maxDays; ?>" 
                           value="<?php echo $maxDays; ?>">
                </div>

                <!-- Budget Filter -->
                <div class="mb-4">
                    <label class="filter-label">Budget (₹)</label>
                    <div class="filter-value" id="budgetValue">₹<?php echo number_format($minPrice); ?> - ₹<?php echo number_format($maxPrice); ?></div>
                    <input type="range" id="minBudget" class="filter-slider mb-2" 
                           min="0" max="200000" step="1000" 
                           value="<?php echo $minPrice; ?>">
                    <input type="range" id="maxBudget" class="filter-slider" 
                           min="0" max="200000" step="1000" 
                           value="<?php echo $maxPrice; ?>">
                </div>

                <!-- Star Rating -->
                <div>
                    <label class="filter-label">Hotel Category</label>
                    <div class="filter-checkbox">
                        <input type="checkbox" id="star5" value="5">
                        <label for="star5">5 Star & Luxury</label>
                    </div>
                    <div class="filter-checkbox">
                        <input type="checkbox" id="star4" value="4">
                        <label for="star4">4 Star</label>
                    </div>
                    <div class="filter-checkbox">
                        <input type="checkbox" id="star3" value="3" checked>
                        <label for="star3">3 Star & Standard</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Vertical Package Cards - 4 per row -->
        <div class="col-lg-9">
            <div class="row g-4" id="packagesGrid">
                <?php 
                if (count($packages) > 0): 
                    $counter = 0;
                    foreach ($packages as $pkg): 
                        $counter++;
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-12" 
                         data-price="<?php echo $pkg['price_inr']; ?>"
                         data-days="<?php echo $pkg['days']; ?>"
                         data-stars="<?php echo $pkg['stars']; ?>">
                        
                        <div class="v-card">
                            <!-- TOP: Image -->
                            <div class="v-card-img">
                                <div class="v-card-badge"><?php echo htmlspecialchars($pkg['stay_type'] ?? 'Standard'); ?></div>
                                <img src="<?php echo htmlspecialchars($pkg['imagePath']); ?>" 
                                     alt="<?php echo htmlspecialchars($pkg['p_name']); ?>"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                     style="display: <?php echo !empty($pkg['image']) ? 'block' : 'none'; ?>;">
                                <div class="placeholder" style="display: <?php echo empty($pkg['image']) ? 'flex' : 'none'; ?>;"><i class="fas fa-plane"></i></div>

                            </div>
                            
                            <!-- BOTTOM: Content -->
                            <div class="v-card-body">
                                <h5 class="v-card-title"><?php echo htmlspecialchars($pkg['p_name']); ?></h5>
                                
                                <div class="v-card-rating">
                                    <?php 
                                    for($i=1; $i<=5; $i++) {
                                        echo '<i class="fas fa-star' . ($i <= $pkg['stars'] ? '' : ' empty') . '"></i>';
                                    }
                                    ?>
                                    <span><?php echo $pkg['stars']; ?>.0 Stars</span>
                                </div>
                                
                                <div class="v-card-price">
                                    ₹<?php echo number_format($pkg['price_inr']); ?>
                                    <span>/person</span>
                                </div>
                                
                                <a href="checkout.php?id=<?php echo $pkg['id']; ?>" class="v-card-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                <?php 
                    endforeach; 
                else: 
                ?>
                    <div class="no-packages">
                        <i class="fas fa-box-open"></i>
                        <h4>No Packages Found</h4>
                        <p>No packages available in this category.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    const durationSlider = document.getElementById('durationSlider');
    const durationValue = document.getElementById('durationValue');
    const minBudget = document.getElementById('minBudget');
    const maxBudget = document.getElementById('maxBudget');
    const budgetValue = document.getElementById('budgetValue');
    const packagesGrid = document.getElementById('packagesGrid');

    const priceMin = <?php echo $minPrice; ?>;
    const priceMax = <?php echo $maxPrice; ?>;

    function updateBudget() {
        let min = parseInt(minBudget.value);
        let max = parseInt(maxBudget.value);
        
        if (min > max) {
            minBudget.value = max;
            maxBudget.value = min;
        }
        
        budgetValue.textContent = '₹' + parseInt(minBudget.value).toLocaleString() + ' - ₹' + parseInt(maxBudget.value).toLocaleString();
        filterPackages();
    }

    function updateDuration() {
        durationValue.textContent = durationSlider.value + ' Days';
        filterPackages();
    }

    function filterPackages() {
        const maxDaysFilter = parseInt(durationSlider.value);
        const minPriceFilter = parseInt(minBudget.value);
        const maxPriceFilter = parseInt(maxBudget.value);
        
        const show5star = document.getElementById('star5').checked;
        const show4star = document.getElementById('star4').checked;
        const show3star = document.getElementById('star3').checked;
        
        const items = packagesGrid.querySelectorAll('[data-price]');
        
        items.forEach(item => {
            const price = parseInt(item.dataset.price);
            const days = parseInt(item.dataset.days);
            const stars = parseInt(item.dataset.stars);
            
            const priceMatch = price >= minPriceFilter && price <= maxPriceFilter;
            const daysMatch = days <= maxDaysFilter;
            
            let starMatch = false;
            if (show5star && stars === 5) starMatch = true;
            if (show4star && stars === 4) starMatch = true;
            if (show3star && stars === 3) starMatch = true;
            
            if (priceMatch && daysMatch && starMatch) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    durationSlider.addEventListener('input', updateDuration);
    minBudget.addEventListener('input', updateBudget);
    maxBudget.addEventListener('input', updateBudget);
    
    document.getElementById('star5').addEventListener('change', filterPackages);
    document.getElementById('star4').addEventListener('change', filterPackages);
    document.getElementById('star3').addEventListener('change', filterPackages);

    // Initialize
    updateBudget();
</script>

</body>
</html>
