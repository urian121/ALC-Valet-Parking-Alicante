<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

// Intancia de PHPMailer
$mail = new PHPMailer(true);
$mail->setLanguage("es"); //stablecer el idioma Español


try {
    $mail->SMTPDebug = 0;
    // Es necesario para poder usar un servidor SMTP como gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    // Para activar la autenticación smtp del servidor
    $mail->SMTPAuth   = true;

    // Credenciales de la cuenta
    $mail->Username   = 'programadorphp2017@gmail.com';
    $mail->Password   = 'vfnzebeyquznyyhp';
    $mail->SMTPSecure = 'tls';
    //$mail->SMTPSecure = "ssl";      
    $mail->Port       = 587; // o 465
    $mail->CharSet = 'UTF-8';


    $emailUser = trim($_REQUEST['emailUser']);

    $mail->setFrom('programadorphp2017@gmail.com', 'ALC Valet Parking Alicante');  // Quien envía este mensaje
    $mail->addAddress($emailUser, '');  // Destinatario
    //$mail->addAddress('urian1213viera@gmail.com', 'Joe User');

    //Copia de envio del email
    $mail->addReplyTo('info@alcvaletparking.com', 'Information');
    $mail->addCC('urian1213viera@gmail.com'); //Copia

    function claveOne($length = 4)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
    }
    $miClaveOne  = claveOne();


    //Content
    $mail->isHTML(true);
    //Asunto                             
    $mail->Subject = 'ALC Valet Parking Alicante';
    #Mensaje en english
    $mail->Body .= "<section style='margin-top: 10px; font-size: 16px;'>";
    $mail->Body .= "<p>At <span style='color:#ff6d0c; font-weight: bold'>ALC Valet Parking Alicante</span>, we welcome you and are delighted to have you as our customer.</p>";
    $mail->Body .= "<p>Your account has been successfully created.</p>";
    $mail->Body .= "<p>Temporary password: <strong style='color:#ff6d0c;'>$miClaveOne</strong></p><br>";
    $mail->Body .= "<a href='https://alcvaletparking.com/app/' style='background: #ff6d0c; font-size:15px; padding: 10px 20px; border-radius: 25px;text-decoration: unset; color:#fff;'>Access Now</a>";
    $mail->Body .= "</section>";

    $mail->Body .= "<section style='margin-top: 60px; font-size: 16px;'>";
    $mail->Body .= "<p>Thank you again for choosing <span style='color:#ff6d0c; font-weight: bold'>ALC Valet Parking Alicante</spa>.</p>";
    $mail->Body .= "<p>If you have any questions or need assistance, feel free to contact us.</p>";
    $mail->Body .= '<p>We hope you have an incredible experience!</p>';
    $mail->Body .= "</section>";

    $mail->Body .= "<a href='https://alcvaletparking.com'><img src='https://alcvaletparking.com/app/assets/custom/imgs/logo_naranja.png' alt='ALC Valet Parking Alicante' style='width: 100%; max-width: 100px; height: auto; display: block; float: left; margin-top: 40px; border-radius: 5px;' /></a>";



    //Copia de envio del email
    $headers = 'From: ALC Valet Parking Alicante <info@alcvaletparking.com>' . "\r\n";
    $headers .= 'Cc: urianwebdeveloper@gmail.com' . "\r\n";
    //$headers .= 'Cc: info@alcvaletparking.com' . "\r\n";
    $mail->send();
    header("location:../?RecoveryC=1");

    /* if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header("location:../?successC=1");
    }
    */
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
