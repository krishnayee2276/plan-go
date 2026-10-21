<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "plan_go_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    $conn = false;
}
?>
