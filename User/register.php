<?php

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->username = $_POST['username'] ? $_POST['username'] : die("username is required");
$user->fullname = $_POST['fullname'] ? $_POST['fullname'] : die("fullname is required");
$user->email = $_POST['email'] ? $_POST['email'] : die("email is required");
$user->password = $_POST['password'] ? $_POST['password'] : die("password is required");
$user->isadmin = $_POST['isadmin']? $_POST['isadmin'] : 0;
$user->designation = $_POST['designation'] ? $_POST['designation'] : die("designation is required");
$user->hospital = $_POST['hospital'] ? $_POST['hospital'] : die("hospital is required");
$user->mobile = $_POST['mobile'] ? $_POST['mobile'] : die("mobile is required");
$user->address = $_POST['address'] ? $_POST['address'] : die("address is required");
$user->city = $_POST['city'] ? $_POST['city'] : die("city is required");
$user->state = $_POST['state'] ? $_POST['state'] : die("state is required");
$user->country = $_POST['country'] ? $_POST['country'] : die("Country is required");
// $user->isactive = $_POST['isactive']? $_POST['isactive'] : 1;
// $user->isverify = $_POST['isverify']? $_POST['isverify'] : 0;
// $user->created = date('Y-m-d H:i:s');

if($user->signup()){
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id,
        "username" => $user->username
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Username already exists!"
    );
}

print_r(json_encode($user_arr));

?>