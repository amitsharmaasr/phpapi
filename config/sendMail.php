<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

class SendMail{
 
    private $username = "postgres";
    private $password = "amit";
    private $mail;

    public  $to;
    public  $subject;
    public  $body;
    
    public function __construct(){
        $this->mail = new PHPMailer(true);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
    }

    public function send(){

        try {
            //Server settings
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $this->mail->isSMTP();                                            // Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $this->mail->Username   = $this->username;                                // SMTP username
            $this->mail->Password   = $this->password;                              // SMTP password
            $this->mail->SMTPSecure = 'tls';         				// Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $this->mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $this->mail->setFrom($this->to);
            $this->mail->addAddress($this->to);     // Add a recipient

            //$this->mail->addReplyTo('info@example.com', 'Information');
            //$this->mail->addCC('cc@example.com');
            //$this->mail->addBCC('bcc@example.com');

            // Attachments
            //$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = $this->subject;
            $this->mail->Body    = $this->body;
            //$this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();
            
	        return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>
