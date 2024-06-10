<?php
require_once(__DIR__ . '/../index.php');    

$getdataHistory = new ETZ($conn);

$brightness = isset($_GET['brightness']) ? $_GET['brightness'] : '';
$active = isset($_GET['active']) ? $_GET['active'] : '';

if (empty($brightness)) {
    echo json_encode(array("error" => "brightness is required."));
    exit;
}

