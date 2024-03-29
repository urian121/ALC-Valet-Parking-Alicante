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


    // Quien envía este mensaje
    $mail->setFrom('programadorphp2017@gmail.com', 'ALC Valet Parking Alicante');
    // Destinatario
    $emailUser = trim($_REQUEST['emailUser']);
    $IdReserva = trim($_REQUEST['IdReserva']);
    $desde = trim($_REQUEST['desde']);
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

    #Mensaje en english
    $mail->Body .= "<section style='margin-top: 10px; font-size: 16px;'>";
    $mail->Body .= "<p>BOOKING CONFIRMATION </p>";
    $mail->Body .= "<p>Thank you very much for choosing the services of ALC VALET PARKING. AIRPORT MEETING POINT: DEPARTURES FLOOR/ AT THE BEGINNING OF THE EXPRESS PARKING. MOBILE: 601 356 356 (not via WhatsApp) CALL WITH THE CONTACT NUMBER WITH *15 OR 20 MINUTES IN ADVANCE.</p><br>";
    $mail->Body .= "<p>To access your reservation and get more details, you can download it by clicking on the following link:</p><br>";
    $mail->Body .= "<a href='https://alcvaletparking.com/app/dashboard/ReservaPDF.php?idReserva=" . $IdReserva . " ' style='background: #ff6d0c; font-size:15px; padding: 10px 20px; border-radius: 25px;text-decoration: unset; color:#fff;'>Download Reservation</a> <br><br><br>";
    $mail->Body .= "</section>";

    $mail->Body .= "<section style='margin-top: 60px; font-size: 16px;'>";
    $mail->Body .= "<p>Thank you again for choosing <span style='color:#ff6d0c; font-weight: bold'>ALC Valet Parking Alicante</spa>.</p>";
    $mail->Body .= "<p>If you have any questions or need assistance, feel free to contact us.</p>";
    $mail->Body .= "<a href='https://alcvaletparking.com'><img src='https://alcvaletparking.com/app/assets/custom/imgs/logo_naranja.png' alt='ALC Valet Parking Alicante' style='width: 100%; max-width: 100px; height: auto; display: block; float: left; margin-top: 40px; border-radius: 5px;' /></a>";
    $mail->AltBody = '<p>We hope you have an incredible experience!</p>';
    $mail->Body .= "</section>";


    //Copia de envio del email
    $headers = 'From: ALC Valet Parking Alicante ' . $email_info . "\r\n";
    $headers .= 'Cc: urianwebdeveloper@gmail.com' . "\r\n";
    //$headers .= 'Cc: ' . $email_info . "\r\n";

    $mail->send();
    if ($desde == "cliente") {
        header("location:../dashboard/Reservas.php?successR=1");
    } else {
        header("location:../dashboard/EstanciasEntradas.php?successR=1");
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
