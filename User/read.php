<?php

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 

$user = new User($db);

$stmt = $user->login();

if($stmt->rowCount() > 0){
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_arr=array(
        "status" => true,
        "message" => "User Details!",
        "data" => $row
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Data could not be read!",
    );
}

print_r(json_encode($user_arr));

?>