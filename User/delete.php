<?php

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 

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
