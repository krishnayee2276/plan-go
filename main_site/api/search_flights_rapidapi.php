<?php
header('Content-Type: application/json');

$api_key = '5a5926a598msh785b11da502ed84p11b920jsnc3b73623a681';
$from = $_GET['from'] ?? 'DEL';
$to = $_GET['to'] ?? 'BOM';
$date = $_GET['date'] ?? date('Y-m-d', strtotime('+7 days'));
$adults = $_GET['adults'] ?? '1';

$url = "https://booking-com15.p.rapidapi.com/api/v1/flights/searchFlights?fromId=" . $from . ".AIRPORT&toId=" . $to . ".AIRPORT&stops=none&pageNo=1&adults=" . $adults . "&children=0&sort=BEST&cabinClass=ECONOMY&currency_code=INR&date=" . $date;

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "x-rapidapi-host: booking-com15.p.rapidapi.com",
        "x-rapidapi-key: " . $api_key
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    http_response_code(500);
    echo json_encode(['error' => 'API error: ' . $err]);
} else {
    $data = json_decode($response, true);
    echo json_encode($data ?: []);
}
?>

