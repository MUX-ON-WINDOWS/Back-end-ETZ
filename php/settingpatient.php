<?php
require_once(__DIR__ . '/../index.php');    

$getdataHistory = new ETZ($conn);

$brightness = isset($_GET['brightness']) ? $_GET['brightness'] : '';
$volume = isset($_GET['volume']) ? $_GET['volume'] : '';
$active = isset($_GET['active']) ? $_GET['active'] : '';
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

if (empty($user_id)) {
    echo json_encode(array("error" => "brightness of lamp is niet actief."));
    exit;
}

try {
    $settingPatient = $getdataHistory->getPatientSetting($user_id);

    if ($settingPatient) {
        $data = array("setting" => $settingPatient);
        echo json_encode($data);
    } else {
        $data = array("error" => "No settings found for this user.");
        echo json_encode($data);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(array("error" => "An error occurred while fetching settings. Please try again later."));
}
