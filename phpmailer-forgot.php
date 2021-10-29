<?php

include "config.php"; // Using database connection file here

$email = $_GET['email'];
$token = md5($email).rand(10,9999);
$con->query("UPDATE users SET token = '$token' WHERE email = '$email';");
$records = mysqli_query($con,"SELECT * from users where email = '$email';"); // fetch data from database
$data = mysqli_fetch_array($records);
$name = $data['name'];


$link = "<a href='localhost/test1/new.php?key=".$email."&token=".$token."'>Set new password</a>";
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'counseling.gowdham@gmail.com';                     //SMTP username
    $mail->Password   = 'Asdf@2000';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('counseling.gowdham@gmail.com', 'Gowdham M');
    // $mail->addAddress('gowdhammurugesh24@gmail.com', 'Gowdham');     //Add a recipient
    $mail->addAddress($email, $name);             //Name is optional
    $mail->addReplyTo('gowdhammurugesh24@gmail.com', 'Admin');
    // $mail->addCC('gowdhammurugesh24@gmail.com');
    $mail->addBCC('gowdhammurugesh24@gmail.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset password';
    $mail->Body    = 'Hi '.$name.'!!!,<br>Thank you for register with us.<br>'.$link.'';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    header("location:login.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("location:login.php");
}
?>