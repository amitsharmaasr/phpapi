<?php

include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../config/cors.php';
 
$database = new Database();
$db = $database->getConnection();

//$_GET = json_decode(file_get_contents('php://input'), true);

$user = new User($db);

$user->id = isset($_GET['id']) ? $_GET['id'] : die("user id is required");

if($user->deleteUser()){
    
    $user_arr=array(
        "status" => true,
        "message" => "user deleted!",
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "user couldn't be deleted!",
    );
}

print_r(json_encode($user_arr));

?>
