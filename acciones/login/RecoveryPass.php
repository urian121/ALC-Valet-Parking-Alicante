<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include('../../config/config.php');
    date_default_timezone_set("Europe/Madrid");
    $createUser = date("Y-m-d H:i:s");

    $emailUser             = trim($_POST['emailUser']);

    function claveOne($length = 4)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
    }
    $miClaveOne  = claveOne();

    //Primero verifico si existe algun usuario asociado a dicho correo
    $SqlVerificandoEmail = ("SELECT emailUser FROM tbl_clientes WHERE emailUser COLLATE utf8_bin='$emailUser'");
    $jqueryEmail         = mysqli_query($con, $SqlVerificandoEmail);
    if (mysqli_num_rows($jqueryEmail) > 0) {
        $PasswordHash = password_hash($miClaveOne, PASSWORD_BCRYPT);
        $sql = ("UPDATE tbl_clientes SET passwordUser='$PasswordHash' WHERE emailUser='$emailUser' ");
        $ok = mysqli_query($con, $sql);
        if ($ok) {
            echo '<script>';
            echo '    let idiomaActivo = localStorage.getItem("idioma");';
            echo '    if (idiomaActivo == "es") {';
            echo '        window.location.href = "../../emails/email_recuperar_clave_es.php?emailUser=' . $emailUser . '&clave=' . $miClaveOne . '";';
            echo '    } else if (idiomaActivo == "en") {';
            echo '        window.location.href = "../../emails/email_recuperar_clave_en.php?emailUser=' . $emailUser . '&clave=' . $miClaveOne . '";';
            echo '    }';
            echo '</script>';
        } else {
            header("location:../../?errorE=1");
        }
    } else {
        //El correo no existe
        header("location:../../?errorE=1");
    }
}
