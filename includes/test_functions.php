<?php
// Test functions for Plan & Go merger verification

function test_database_connection($conn, $db) {
    if ($conn->connect_error) {
        return ['status' => 'error', 'message' => 'Database Connection Failed: ' . $conn->connect_error];
    } else {
        return ['status' => 'success', 'message' => "Database Connected Successfully to '$db'"];
    }
}

function test_packages_table($conn) {
    $result = mysqli_query($conn, "DESCRIBE packages");
    if ($result) {
        $columns = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $columns[] = $row;
        }
        return ['status' => 'success', 'message' => 'Packages table exists', 'columns' => $columns];
    } else {
        return ['status' => 'error', 'message' => 'Packages table not found or query failed'];
    }
}

function test_package_count($conn) {
    $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM packages");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        return ['status' => 'info', 'message' => "Current packages in database: $count", 'count' => $count];
    } else {
        return ['status' => 'error', 'message' => 'Could not count packages'];
    }
}

function test_extracted_packages($packages) {
    if (isset($packages) && is_array($packages)) {
        return [
            'status' => 'success',
            'message' => 'Package data extracted successfully: ' . count($packages) . ' packages',
            'packages' => $packages
        ];
    } else {
        return ['status' => 'error', 'message' => 'Package data extraction failed'];
    }
}

function test_file_existence() {
    $files_to_check = [
        'includes/config.php' => 'Database configuration',
        'extract_packages.php' => 'Package extraction script',
        'admin/import_plan-go.php' => 'Admin import interface',
        'destinations.html' => 'Dynamic destinations page',
        'package-details.php' => 'Package details page',
        'assets/images/goa1.jpg' => 'Sample package image'
    ];

    $results = [];
    foreach ($files_to_check as $file => $description) {
        $results[] = [
            'file' => $file,
            'description' => $description,
            'exists' => file_exists($file)
        ];
    }

    return $results;
}

function get_final_status($conn, $packages) {
    $all_good = true;
    if ($conn->connect_error) $all_good = false;
    if (!isset($packages) || !is_array($packages)) $all_good = false;

    return $all_good;
}
?>





