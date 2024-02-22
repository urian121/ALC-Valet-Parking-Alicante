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
    $miClaveOne  = trim($_REQUEST['clave']);

    $mail->setFrom('programadorphp2017@gmail.com', 'ALC Valet Parking Alicante');  // Quien envía este mensaje
    $mail->addAddress($emailUser, '');  // Destinatario

    //Copia de envio del email
    $mail->addReplyTo('info@alcvaletparking.com', 'Information');
    $mail->addCC('urian1213viera@gmail.com'); //Copia

    //Content
    $mail->isHTML(true);
    //Asunto                             
    $mail->Subject = 'ALC Valet Parking Alicante';
    $mail->Body .= "<section style='margin-top: 10px; font-size: 16px;'>";
    $mail->Body .= "<p>En <strong style='color:#ff6d0c;'>ALC Valet Parking Alicante</strong> le damos la bienvenida y estamos encantados de tenerte como nuestro cliente.</p>";
    $mail->Body .= "<p>Tu clave temporal se ha creado exitosamente.</p>";
    $mail->Body .= "<p>Clave temporal: <strong style='color:#ff6d0c;'>$miClaveOne</strong></p><br>";
    $mail->Body .= "<a href='https://alcvaletparking.com/app/' style='background: #ff6d0c; font-size:15px; padding: 10px 20px; border-radius: 25px;text-decoration: unset; color:#fff;'>Acceder Ahora</a>";
    $mail->Body .= "</section>";

    $mail->Body .= "<section style='margin-top: 60px; margin-bottom: 70px; font-size: 16px;'>";
    $mail->Body .= "<p>Gracias de nuevo por elegir <strong style='color:#ff6d0c;'>ALC Valet Parking Alicante</strong>.</p>";
    $mail->Body .= "<p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.</p>";
    $mail->Body .= '<p>¡Esperamos que tengas una experiencia increíble!</p>';
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
