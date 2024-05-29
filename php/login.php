<?php
require_once(__DIR__ . '/../index.php');

$getdataUsers = new ETZ($conn);

$email = isset($_GET['email']) ? $_GET['email'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';

if (empty($email) || empty($password)) {
    echo json_encode(array("error" => "email and password are required."));
    exit;
}

try {
    // Assuming login is a method in the ETZ class
    $users = $getdataUsers->login($email, $password);

    if ($users) {
        $data = array("user" => $users);
    } else {
        $data = array("error" => "Invalid email or password.");
    }
    
    echo json_encode($data);
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode(array("error" => "An error occurred during login. Please try again later."));
}
?>
