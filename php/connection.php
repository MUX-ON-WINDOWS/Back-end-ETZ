<?php
header('Access-Control-Allow-Origin: *'); // Allow all origins, or specify your domain
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Cache-Control: no-cache, must-revalidate');
header('Content-type: application/json');

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    throw new Exception('Connect Error (' . $conn->connect_errno . ') ' . $conn->connect_error);
}
?>
