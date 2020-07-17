<?php

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->id = isset($_POST['id']) ? $_POST['id'] : die("user id is required");
$user->username = isset($_POST['username']);
$user->fullname = isset($_POST['fullname']); 
$user->email = isset($_POST['email']);
$user->password = isset($_POST['password']); 
$user->isadmin = isset($_POST['isadmin']);
$user->designation = isset($_POST['designation']); 
$user->hospital = isset($_POST['hospital']);
$user->mobile = isset($_POST['mobile']); 
$user->address = isset($_POST['address']);
$user->city = isset($_POST['city']); 
$user->state = isset($_POST['state']); 
$user->country = isset($_POST['country']);
$user->isactive = isset($_POST['isactive']);
$user->isverify = isset($_POST['isverify']);

if($user->updateUser()){
    $user_arr=array(
        "status" => true,
        "message" => "User Updated Successfully!",
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "User Details could not be updated!"
    );
}

print_r(json_encode($user_arr));

?>