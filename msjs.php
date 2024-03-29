<?php
$opcionesToastr = json_encode(array(
    "closeButton" => true,
    "debug" => false,
    "newestOnTop" => false,
    "progressBar" => true,
    "positionClass" => "toast-top-right",
    "preventDuplicates" => false,
    "onclick" => null,
    "showDuration" => "300",
    "hideDuration" => "1000",
    "timeOut" => "8000",
    "extendedTimeOut" => "1000",
    "showEasing" => "swing",
    "hideEasing" => "linear",
    "showMethod" => "fadeIn",
    "hideMethod" => "fadeOut"
));


if (isset($_REQUEST['errorC'])) {
    $mensaje = 'Ya existe una cuenta con ese correo, por favor Verifique e intente nuevamente.';
    $tipo = 'error';
} elseif (isset($_REQUEST['welcome'])) {
    $mensaje = 'Felicitaciones, ha iniciado sesión correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['errorU'])) {
    $mensaje = 'El correo ya existe, por favor verifique.';
    $tipo = 'error';
} elseif (isset($_REQUEST['logout'])) {
    $mensaje = 'Felicitaciones, la sesión fue cerrada correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['errorl'])) {
    $mensaje = 'No existe el correo, por favor verifique.';
    $tipo = 'error';
} elseif (isset($_REQUEST['errorLogin'])) {
    $mensaje = 'Las credenciales son incorrectas, por favor verifique.';
    $tipo = 'error';
} elseif (isset($_REQUEST['successC'])) {
    $mensaje = 'Felicitaciones, Cuenta creada correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['successR'])) {
    $mensaje = 'Felicitaciones, La reserva se ha creado con éxito, en breve le llegará un email con el recibo para dicha reserva.';
    $tipo = 'success';
} elseif (isset($_REQUEST['successUC'])) {
    $mensaje = 'Felicitaciones, Los datos del cliente fuerón actualizados correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['facturaR'])) {
    $mensaje = 'Felicitaciones, la factura fue creda correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['successP'])) {
    $mensaje = 'Felicitaciones, el perfil fue actualizado correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['errorF'])) {
    $mensaje = 'La fecha de recogida debe ser mayor a la fecha de entrega.';
    $tipo = 'error';
} elseif (isset($_REQUEST['errorE'])) {
    $mensaje = 'Por favor verifique los datos, no existe el correo.';
    $tipo = 'error';
} elseif (isset($_REQUEST['facturaFR'])) {
    $mensaje = 'Felicitaciones, la fecha de recogida fue actualizada correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['AceptarReserva'])) {
    $mensaje = 'Felicitaciones, la reserva fue aceptada correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['RecoveryC'])) {
    $mensaje = 'Felicitaciones, hemos enviado un correo con la clave temporal.';
    $tipo = 'success';
} elseif (isset($_REQUEST['successCoche'])) {
    $mensaje = 'Felicitaciones, hemos registrado el coche correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['successCocheUp'])) {
    $mensaje = 'Felicitaciones, los datos del coche fueron actualizados correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['successUC1'])) {
    $mensaje = 'Felicitaciones, el usuario fue credo correctamente.';
    $tipo = 'success';
} elseif (isset($_REQUEST['successUpd'])) {
    $mensaje = 'Felicitaciones, el usuario fue actualizado correctamente.';
    $tipo = 'success';
}





if (isset($mensaje)) { ?>
    <script type='text/javascript'>
        toastr.options = <?php echo $opcionesToastr; ?>;
        toastr.<?php echo $tipo; ?>('<?php echo $mensaje; ?>');
    </script>
<?php } ?>