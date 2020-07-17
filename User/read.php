<?php

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);

$stmt = $user->getUserList();

if($stmt->rowCount() > 0){

    $userInfo = array();
    $userInfo["body"] = array();
    $userInfo["itemCount"] = $stmt->rowCount();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $e = array(
            "user_id" => $user_id,
            "user_name" => $user_name,
            "cust_id" => $cust_id,
            "status" => $status,
            "user_type" => $user_type,
            "business_id" => $business_id
        );

        array_push($userInfo["body"], $e);
    }

    $user_arr=array(
        "status" => true,
        "message" => "User Details!",
        "data" => $userInfo
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
