<?php
require_once(__DIR__ . '/../index.php');    

$getdataHistory = new ETZ($conn);

$brightness = isset($_GET['brightness']) ? $_GET['brightness'] : '';
$volume = isset($_GET['volume']) ? $_GET['volume'] : '';
$active = isset($_GET['active']) ? $_GET['active'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

if (empty($user_id)) {
    echo json_encode(array("error" => "User ID is not provided."));
    exit;
}

try {
    // Assuming updateSetting is a method in the ETZ class
    $settingPatient = $getdataHistory->updateSetting($user_id, $brightness, $volume);

    if ($settingPatient) {
        $data = array("message" => "Settings updated successfully.");
        echo json_encode($data);
    } else {
        $data = array("error" => "No settings found for this user.");
        echo json_encode($data);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(array("error" => "An error occurred while updating settings. Please try again later."));
}
?>
