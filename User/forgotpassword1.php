<?php

include_once '../config/database.php';
include_once '../objects/user.php';
include_once '../config/cors.php';
include_once '../config/sendMail.php';

$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
$user->email = isset($_GET['email']) ? $_GET['email'] : die("Email is Required");

$mail = new SendMail();

if($user->forgotPassword()){
            
            $mail->to = $user->email;
            $mail->subject = "Password Reset";
            $mail->body = "Hi, this is to inform you that your new password is <b>Smart@1234</b>";

            if($mail->send()()){
                print_r(json_encode(array(
                    "status" => true,
                    "message" => "password updated!",
                )));
            }else{
                print_r(json_encode(array(
                    "status" => false,
                    "message" => "password updated but failed to sent email!",
                    "data" => 'Smart@1234'
                )));
            }
      
}else{

    print_r(json_encode(array(
        "status" => false,
        "message" => "email doesn't exists!",
    )));

}


?>
