<?php
$email = $_GET['email'];
$name = $_GET['name'];

$token = md5($email).rand(10,9999);
$link = "localhost/test1/verify-email.php?key=".$email."&token=".$token."";
$html = '<div style="padding:32px 10%;margin:0px;color:#333;background-color:#eeeeee"><div class="adM">
        </div><div style="background-color:#ffffff;width:600px;margin-left:auto;margin-right:auto"><div class="adM">
        </div><table style="background-color:#ffffff;width:600px;text-align:center" align="center">
        <tbody><tr><td><table style="width:100%">
            <tbody><tr>
            <td style="padding:0px;padding-top:32px;padding-left:16px;padding-bottom:20px;margin-bottom:0px;color: #2196f3;" align="left">
                <!-- <img src="https://ci4.googleusercontent.com/proxy/IX0gn291PWx2YIa0NjS-kKZknSeH9G4QMJDZlhyY9631g7KpgLcnt6-_pTG8mqOaqoEzcqEtQ_GEs74JrQWytfy4JD9p_P-wbcUeD7qfMsmYjg2nMxxz_ci3_7AlaPfxEVRiwglKAfe0dV7fRmeSAdNc9auVUihK-2Ye=s0-d-e1-ft#https://cdn.accounts.autodesk.com/content/identity/80bec6e/Content/images/layout/autodesk-email-logo.png" alt="Autodesk" class="CToWUd"> -->
                <h1 style="margin: 0 auto !important;">Choice List</h1>
            </td>
            <td align="right" valign="bottom" style="color:rgb(81, 142, 212);padding-bottom:14px;font-style:italic;padding-right:16px;font-size:16px">
                <p>Site made by <span style="font-size: 20px;">Gowdham M</span></p>
            </td>
            </tr>
            </tbody></table>
            <hr style="color:grey">
            <table>
            <tbody><tr>
            <td style="padding-top:24px;padding-left:16px;padding-bottom:10px">
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                <tbody><tr style="margin:24px;margin-left:0px">
                    <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tbody><tr>
                            <td align="left">
                                <p style="word-wrap:break-word;font-size:15px;margin:0px;padding:0px">
                                Hi '.$name.',
                                </p>
                                <p style="word-wrap:break-word;font-size:13px;margin-top:24px;padding:0px;line-height:19px">
                                    Thank you for register with us. <br>
                                    Please verify your account (<b>'.$email.'</b>) by confirming your email address.
                                </p>
                                
                                <p>
                                    
                                <u></u>
                                    </p><table border="0" style="margin-top:30px;margin-bottom:30px;width:100%" cellspacing="0" cellpadding="0" width="100%">
                                        <tbody><tr>
                                        <td>
                                            <table align="left" style="text-align:center;vertical-align:center;color:#fff;display:block">
                                        <tbody><tr>
                                        <td style="border-radius:4px 4px 4px 4px">
                                        <a style="color:#fff!important;padding-left:28px;padding-top:12px;padding-bottom:12px;padding-right:28px;height:40px;width:160px;background-color:#0696d7;font-size:16px;text-decoration:none;text-transform:uppercase;border-radius:4px 4px 4px 4px" href="'.$link.'" rel="nofollow" target="_blank">
                                            VERIFY EMAIL
                                    </a>
                                    </td>
                                    </tr>
                                    </tbody></table>
                                    </td>
                                    </tr>
                                    </tbody></table>
                                <u></u>
                                <p></p>
                                <p style="word-wrap:break-word;display:block;font-size:13px">
                                    If the link above doesn&#39;t work, copy and paste this URL in your browser:<br></p>
                                <p style="word-wrap:break-word;display:block;font-size:12px;margin-top:15px">	
                                    <a href="'.$link.'" rel="nofollow" target="_blank">'.$link.'</a>
                                </p>
                            </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
                </tbody></table>
            </td>
        </tr>
        </tbody></table>
        <hr style="color:grey">
        <table style="padding-bottom:25px;text-align:left">
        <tbody><tr>
            <td style="color:#999;font-size:10px;line-height:1.6;padding-left:20px" align="left">
            <p style="margin-top:0;margin-bottom:0;padding-top:15px;color:#999;line-height:1.6" align="left">
                © 2021 Gowdham, Inc. All rights reserved. <br>
                Gowdham, Inc Mannargudi, TN 614001
            </p>
            </td>
            </tr>
        </tbody></table>
        </td></tr></tbody></table>
        </div>';
include "config.php";
$con->query("UPDATE users SET token = '$token' WHERE email = '$email';");
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
    $mail->Password   = 'ibewtxlhgevaonvy';                               //SMTP password
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
    $mail->Subject = 'Thank you for register in counselling-gowdham.herokuapp.com';
    $mail->Body    = $html;
    $mail->AltBody = 'Thank you for register in counselling-gowdham.herokuapp.com<br><a href='.$link.'></a>';

    $mail->send();
    echo 'Message has been sent';
    header("location:login.php");
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("location:login.php");
}
