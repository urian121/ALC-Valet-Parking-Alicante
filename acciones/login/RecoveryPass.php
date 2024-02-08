<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include('../../config/config.php');
    date_default_timezone_set("Europe/Madrid");
    $createUser = date("Y-m-d H:i:s");

    $emailUser             = trim($_POST['emailUser']);

    //Primero verifico si existe algun usuario asociado a dicho correo
    $SqlVerificandoEmail = ("SELECT emailUser FROM tbl_clientes WHERE emailUser COLLATE utf8_bin='$emailUser'");
    $jqueryEmail         = mysqli_query($con, $SqlVerificandoEmail);
    if (mysqli_num_rows($jqueryEmail) > 0) {
        echo '<script>';
        echo '    let idiomaActivo = localStorage.getItem("idioma");';
        echo '    if (idiomaActivo == "es") {';
        echo '        window.location.href = "../../emails/email_recuperar_clave_es.php?emailUser=' . $emailUser . '";';
        echo '    } else if (idiomaActivo == "en") {';
        echo '        window.location.href = "../../emails/email_recuperar_clave_en.php?emailUser=' . $emailUser . '";';
        echo '    }';
        echo '</script>';
    } else {
        //El correo no existe
        header("location:../../?errorE=1");
    }
}
