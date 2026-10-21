<?php
include('includes/config.php');
include('extract_packages.php');
include('includes/test_functions.php');

// Run all tests
$db_test = test_database_connection($conn, $db);
$table_test = test_packages_table($conn);
$count_test = test_package_count($conn);
$extract_test = test_extracted_packages($packages);
$file_tests = test_file_existence();
$final_status = get_final_status($conn, $packages);
?>

<div class="test-section">
    <h3>1. Database Connection Test</h3>
    <div class="test-result <?php echo $db_test['status']; ?>">
        <?php echo $db_test['status'] === 'success' ? '✅' : '❌'; ?> <?php echo $db_test['message']; ?>
    </div>
</div>

<div class="test-section">
    <h3>2. Packages Table Structure Test</h3>
    <?php if ($table_test['status'] === 'success'): ?>
        <div class="test-result success">✅ <?php echo $table_test['message']; ?> with columns:</div>
        <ul class="list-group mt-2">
            <?php foreach ($table_test['columns'] as $column): ?>
                <li class="list-group-item"><?php echo $column['Field']; ?> (<?php echo $column['Type']; ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="test-result error">❌ <?php echo $table_test['message']; ?></div>
    <?php endif; ?>
</div>

<div class="test-section">
    <h3>3. Current Package Count Test</h3>
    <div class="test-result <?php echo $count_test['status']; ?>">
        📊 <?php echo $count_test['message']; ?>
    </div>
</div>

<div class="test-section">
    <h3>4. Extracted Package Data Test</h3>
    <?php if ($extract_test['status'] === 'success'): ?>
        <div class="test-result success">✅ <?php echo $extract_test['message']; ?></div>
        <div class="table-responsive mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Duration</th>
                        <th>Price (INR)</th>
                        <th>Itinerary Days</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($extract_test['packages'] as $key => $package): ?>
                        <?php $itinerary_count = isset($package['itinerary']) ? count($package['itinerary']) : 0; ?>
                        <tr>
                            <td><?php echo htmlspecialchars($package['name']); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $package['category'] == 'domestic' ? 'primary' : 'success'; ?>">
                                    <?php echo htmlspecialchars($package['category']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($package['duration']); ?></td>
                            <td>₹<?php echo number_format($package['price_inr']); ?></td>
                            <td><?php echo $itinerary_count; ?> days</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="test-result error">❌ <?php echo $extract_test['message']; ?></div>
    <?php endif; ?>
</div>

<div class="test-section">
    <h3>5. File Existence Test</h3>
    <?php foreach ($file_tests as $file_test): ?>
        <div class="test-result <?php echo $file_test['exists'] ? 'success' : 'warning'; ?>">
            <?php echo $file_test['exists'] ? '✅' : '⚠️'; ?> <?php echo $file_test['description']; ?>: <?php echo $file_test['file']; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="test-section">
    <h3>🎯 Final Status</h3>
    <?php if ($final_status): ?>
        <div class="test-result success">
            <h4>✅ All Systems Go!</h4>
            <p>The merger has been completed successfully. You can now:</p>
            <ol>
                <li>Import packages using the admin interface</li>
                <li>View packages on the destinations page</li>
                <li>Click on packages to see detailed itineraries</li>
            </ol>
        </div>
    <?php else: ?>
        <div class="test-result error">
            <h4>❌ Issues Found</h4>
            <p>Please resolve the errors above before proceeding.</p>
        </div>
    <?php endif; ?>
</div>





