<?php
header('Content-Type: application/json');

$city_map = [
    'dubai' => ['name' => 'Dubai', 'iata' => 'DXB', 'entityId' => 'dxb'],
    'thailand' => ['name' => 'Thailand', 'iata' => 'BKK', 'entityId' => 'bkk'],
    'bali' => ['name' => 'Bali', 'iata' => 'DPS', 'entityId' => 'dps'],
    'goa' => ['name' => 'Goa', 'iata' => 'GOI', 'entityId' => 'goi'],
    'kerala' => ['name' => 'Kerala', 'iata' => 'COK', 'entityId' => 'cok'],
    'andaman' => ['name' => 'Andaman', 'iata' => 'IXZ', 'entityId' => 'ixz'],
    'malaysia' => ['name' => 'Malaysia', 'iata' => 'KUL', 'entityId' => 'kul'],
    'leh ladakh' => ['name' => 'Leh Ladakh', 'iata' => 'IXL', 'entityId' => 'ixl'],
    'himachal' => ['name' => 'Himachal', 'iata' => 'DHM', 'entityId' => 'dhm'],
    'rajasthan' => ['name' => 'Rajasthan', 'iata' => 'JAI', 'entityId' => 'jai'],
    'sikkim' => ['name' => 'Sikkim', 'iata' => 'IXS', 'entityId' => 'ixs'],
    'tamil nadu' => ['name' => 'Tamil Nadu', 'iata' => 'MAA', 'entityId' => 'maa'],
    'uttarakhand' => ['name' => 'Uttarakhand', 'iata' => 'DED', 'entityId' => 'ded'],
    'karnataka' => ['name' => 'Karnataka', 'iata' => 'BLR', 'entityId' => 'blr'],
    'kashmir' => ['name' => 'Kashmir', 'iata' => 'SXR', 'entityId' => 'sxr'],
    'delhi' => ['name' => 'Delhi', 'iata' => 'DEL', 'entityId' => 'del'],
    'mumbai' => ['name' => 'Mumbai', 'iata' => 'BOM', 'entityId' => 'bom'],
    'bengaluru' => ['name' => 'Bengaluru', 'iata' => 'BLR', 'entityId' => 'blr'],
    'chennai' => ['name' => 'Chennai', 'iata' => 'MAA', 'entityId' => 'maa'],
    'hyderabad' => ['name' => 'Hyderabad', 'iata' => 'HYD', 'entityId' => 'hyd']
];

$q = strtolower(trim($_GET['q'] ?? ''));
if (strlen($q) < 1) {
    echo json_encode([]);
    exit;
}

$results = [];
foreach ($city_map as $key => $data) {
    if (strpos($key, $q) !== false) {
        $results[] = $data;
    }
}

// Always include DEL as fallback
if (empty($results)) {
    $results[] = $city_map['delhi'];
}

// Common cities for good UX
$common = [
    $city_map['delhi'], $city_map['mumbai'], $city_map['bengaluru'],
    $city_map['dubai'], $city_map['thailand']
];
$results = array_merge($results, $common);
$results = array_unique($results, SORT_REGULAR);

echo json_encode(array_slice($results, 0, 10));
?>
