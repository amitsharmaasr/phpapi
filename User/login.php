<?php

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 

$user = new User($db);

$user->username = isset($_GET['username']) ? $_GET['username'] : die("Username is Required");
$user->password = isset($_GET['password']) ? $_GET['password'] : die("Password is Required");

$stmt = $user->login();

if($stmt->rowCount() > 0){
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "data" => $row
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
    );
}

print_r(json_encode($user_arr));

?>