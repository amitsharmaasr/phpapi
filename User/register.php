<?php

include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../config/cors.php';
include_once '../config/sendMail.php';

$database = new Database();
$db = $database->getConnection();

$_POST = json_decode(file_get_contents('php://input'), true);

$user = new User($db);

$user->username = isset($_POST['username']) ? $_POST['username'] : die("username is required");
$user->fullname = isset($_POST['fullname']) ? $_POST['fullname'] : die("fullname is required");
$user->email = isset($_POST['email']) ? $_POST['email'] : die("email is required");
$user->password = isset($_POST['password']) ? $_POST['password'] : die("password is required");
$user->isadmin = isset($_POST['isadmin']) ? $_POST['isadmin'] : 0;
$user->designation = isset($_POST['designation']) ? $_POST['designation'] : die("designation is required");
$user->hospital = isset($_POST['hospital']) ? $_POST['hospital'] : die("hospital is required");
$user->mobile = isset($_POST['mobile']) ? $_POST['mobile'] : die("mobile is required");
$user->address = isset($_POST['address']) ? $_POST['address'] : die("address is required");
$user->city = isset($_POST['city']) ? $_POST['city'] : die("city is required");
$user->state = isset($_POST['state']) ? $_POST['state'] : die("state is required");
$user->country = isset($_POST['country']) ? $_POST['country'] : die("Country is required");
// $user->isactive = $_POST['isactive']? $_POST['isactive'] : 1;
// $user->isverify = $_POST['isverify']? $_POST['isverify'] : 0;
// $user->created = date('Y-m-d H:i:s');

if($user->signup()){

    $mail = new SendMail();

    $mail->to = $user->email;
    $mail->subject = "Verify Email";
    $mail->body = "Hi, <br> Thanks for Registering with us. Please, <a href='https://".$_SERVER['HTTP_HOST']."/User/verifyuser.php?user_id=$user->id' target='_blank' >click on this link to verify </a>.";

    echo $mail->send();

    $user_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $user->id
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
