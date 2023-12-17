<?php
include('../config/config.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);


date_default_timezone_set("Europe/Madrid");
$fecha_pago_factura = date("Y-m-d H:i:s");



$total_gasto_extras1 = isset($_POST['total_gasto_extras1']) ? trim($_POST['total_gasto_extras1']) : 0;
$total_gasto_extras1 = ($total_gasto_extras1 !== '' && is_numeric($total_gasto_extras1)) ? $total_gasto_extras1 : 0;
$servicios_extras1 = trim($_POST['servicios_extras1']);

$total_gasto_extras2 = isset($_POST['total_gasto_extras2']) ? trim($_POST['total_gasto_extras2']) : 0;
$total_gasto_extras2 = ($total_gasto_extras2 !== '' && is_numeric($total_gasto_extras2)) ? $total_gasto_extras2 : 0;
$servicios_extras2 = trim($_POST['servicios_extras2']);

$total_gasto_extras3 = isset($_POST['total_gasto_extras3']) ? trim($_POST['total_gasto_extras3']) : 0;
$total_gasto_extras3 = ($total_gasto_extras3 !== '' && is_numeric($total_gasto_extras3)) ? $total_gasto_extras3 : 0;
$servicios_extras3 = trim($_POST['servicios_extras3']);


/**
 * Iterando sobre los servicios adicionales y sumandolos a la deudaTotal si existen
 */
$deudaTotal = isset($_POST["deuda"]) ? trim($_POST["deuda"]) : 0;
for ($i = 1; $i <= 3; $i++) {
    $total_gasto_extra = isset($_POST["total_gasto_extras{$i}"]) ? trim($_POST["total_gasto_extras{$i}"]) : 0;

    // Verificar si hay gastos adicionales y calcular la deuda total
    if ($total_gasto_extra !== "") {
        $deudaTotal = number_format(($deudaTotal + $total_gasto_extra), 2, '.', '');
    }
}


$idReserva = $_POST['idReserva'];
$email_cliente = trim($_POST['emailCliente']);
$formato_pago = trim($_POST['formato_pago']);
$observacion_cliente = trim($_POST['observacion_cliente']);


$Update = "UPDATE tbl_reservas SET estado_reserva='1', total_pago_reserva='$deudaTotal', formato_pago='$formato_pago', fecha_pago_factura='$fecha_pago_factura', servicios_extras1='$servicios_extras1', total_gasto_extras1='$total_gasto_extras1', servicios_extras2='$servicios_extras2', total_gasto_extras2='$total_gasto_extras2', servicios_extras3='$servicios_extras3', total_gasto_extras3='$total_gasto_extras3' WHERE id='$idReserva'";
$resultado = mysqli_query($con, $Update);

// Utiliza urlencode para asegurar que los parámetros del URL estén correctamente codificados
header("location:../emails/factura_email.php?emailUser=" . urlencode($email_cliente) . "&IdReserva=" . urlencode($idReserva));
