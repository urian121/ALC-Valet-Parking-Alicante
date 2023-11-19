<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
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


    // Quien envía este mensaje
    $mail->setFrom('programadorphp2017@gmail.com', 'ALC Valet Parking Alicante');
    // Destinatario
    $emailUser = trim($_REQUEST['emailUser']);
    $IdReserva = trim($_REQUEST['IdReserva']);
    $email_info = "info@alcvaletparking.com";

    $mail->addAddress($emailUser, '');
    //$mail->addAddress('urian1213viera@gmail.com', 'Joe User');

    //Copia de envio del email
    $mail->addReplyTo($email_info, 'Information');
    $mail->addCC('urian1213viera@gmail.com'); //Copia


    //Content
    $mail->isHTML(true);
    //Asunto                             
    $mail->Subject = 'ALC Valet Parking Alicante';
    $mail->Body .= "<section style='margin-top: 10px; font-size: 18px; line-height: 7px;'>";
    $mail->Body .= "<p>En <strong style='color:#ff6d0c;'>ALC Valet Parking Alicante</strong> te damos la bienvenida y estamos encantados de tenerte como nuestro cliente.</p>";
    $mail->Body .= "<p>Para acceder a tu reserva y obtener más detalles, puedes descargarla haciendo clic en el siguiente enlace:</p><br><br>";
    $mail->Body .= "<a href='https://alcvaletparking.com/app/dashboard/ReservaPDF.php?idReserva=" . $IdReserva . " ' style='background: #ff6d0c; font-size:15px; padding: 10px 20px; border-radius: 25px;text-decoration: unset; color:#fff;'>Descargar Reserva</a> <br><br><br>";
    $mail->Body .= "</section>";



    $mail->Body .= "<section style='margin-top: 50px; font-size: 18px; line-height: 7px;'>";
    $mail->Body .= "<p>Gracias de nuevo por elegir <strong style='color:#ff6d0c;'>ALC Valet Parking Alicante</strong>.</p>";
    $mail->Body .= "<p>Si tienes alguna pregunta o necesitas asistencia, no dudes en contactarnos.</p>";
    $mail->Body .= "<a href='https://alcvaletparking.com'><img src='https://alcvaletparking.com/app/assets/custom/imgs/logo_naranja.png' alt='ALC Valet Parking Alicante' style='width: 100%; max-width: 100px; height: auto; display: block; float: left; margin-top: 40px; border-radius: 5px;' /></a>";
    $mail->AltBody = '<p>¡Esperamos que tengas una experiencia increíble!</p>';
    $mail->Body .= "</section>";


    //Copia de envio del email
    $headers = 'From: ALC Valet Parking Alicante ' . $email_info . "\r\n";
    $headers .= 'Cc: urianwebdeveloper@gmail.com' . "\r\n";
    //$headers .= 'Cc: ' . $email_info . "\r\n";

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        header("location:../dashboard/?successR=1");
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
