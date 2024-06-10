<?php
require_once(__DIR__ . '/../index.php');    

$getdataHistory = new ETZ($conn);

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
$sound = isset($_GET['sound']) ? $_GET['sound'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';

if ($user_id <= 0) {
    $errorResponse = array("error" => "Invalid user ID provided.");
    echo json_encode($errorResponse);
    exit;
}

try {
    $success = $getdataHistory->updateVerwantSettings($sound, $color, $user_id);

    if ($success) {
        $data = array("success" => "Settings updated successfully.");
        echo json_encode($data);
    } else {
        $errorResponse = array("error" => "No settings found for this user.");
        echo json_encode($errorResponse);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    $errorResponse = array("error" => "An error occurred while updating settings. Please try again later.");
    echo json_encode($errorResponse);
}
