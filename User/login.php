<?php

include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../config/cors.php';
 
$database = new Database();
$db = $database->getConnection();
 
//$_GET = json_decode(file_get_contents('php://input'), true);

$user = new User($db);

$user->email = isset($_GET['email']) ? $_GET['email'] : die("Email is Required");
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
        "message" => "Invalid Email or Password!",
    );
}

print_r(json_encode($user_arr));

?>
