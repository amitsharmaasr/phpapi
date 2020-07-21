<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include_once '../config/database.php';
include_once '../objects/user.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);

$user->email = isset($_GET['email']) ? $_GET['email'] : die("Email is Required");

if($user->forgotPassword()){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'iamitsharma96@gmail.com';                     // SMTP username
            $mail->Password   = 'testing';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($user->email, 'amit');
            $mail->addAddress($user->email);     // Add a recipient

            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body    = 'Hi, this is to inform you that your new password is <b>Smart@1234</b>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            print_r(json_encode(array(
                "status" => true,
                "message" => "password updated!",
            )));
        } catch (Exception $e) {
            print_r(json_encode(array(
                "status" => true,
                "message" => "failed to send email but password updated!",
            )));
        }
}else{
    print_r(json_encode(array(
        "status" => false,
        "message" => "email doesn't exists!",
    )));
}


?>
