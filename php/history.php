<?php
require_once(__DIR__ . '/../index.php');    

$getdataHistory = new ETZ($conn);

$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

if (empty($user_id)) {
    echo json_encode(array("error" => "user_id is required."));
    exit;
}

try {
    // Assuming history is a method in the ETZ class
    $history = $getdataHistory->history($user_id);

    if ($history) {
        $data = array("history" => $history);
        echo json_encode($data);
    } else {
        $data = array("error" => "No history found for this user.");
        echo json_encode($data);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(array("error" => "An error occurred while fetching history. Please try again later."));
}
