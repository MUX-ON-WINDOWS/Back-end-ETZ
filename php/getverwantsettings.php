<?php
require_once(__DIR__ . '/../index.php');

$getdataHistory = new ETZ($conn);

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($user_id <= 0) {
    $errorResponse = array("error" => "Invalid user ID provided.");
    echo json_encode($errorResponse);
    exit;
}

try {
    $settings = $getdataHistory->getVerwantSettings($user_id);

    if ($settings) {
        $data = array("settings" => $settings); // Renamed key 'setting' to 'settings' for consistency
        echo json_encode($data);
    } else {
        $errorResponse = array("error" => "No settings found for this user.");
        echo json_encode($errorResponse);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    $errorResponse = array("error" => "An error occurred while fetching settings. Please try again later.");
    echo json_encode($errorResponse);
}
?>
