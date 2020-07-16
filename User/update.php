<?php

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->username = $_POST['username'];
$user->fullname = $_POST['fullname']; 
$user->email = $_POST['email'];
$user->password = $_POST['password']; 
$user->isadmin = $_POST['isadmin'];
$user->designation = $_POST['designation']; 
$user->hospital = $_POST['hospital'];
$user->mobile = $_POST['mobile']; 
$user->address = $_POST['address'];
$user->city = $_POST['city']; 
$user->state = $_POST['state']; 
$user->country = $_POST['country'];
$user->isactive = $_POST['isactive'];
$user->isverify = $_POST['isverify'];

if($user->updateUser()()){
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