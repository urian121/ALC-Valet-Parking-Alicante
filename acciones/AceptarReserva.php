<?php
include('../config/config.php');


$idReserva = $_REQUEST['idReserva'];
//Pasar reserva a la Agenda
$update = "UPDATE tbl_reservas SET estado_reserva ='1' WHERE id = '$idReserva'";
$result = mysqli_query($con, $update);

if ($result) {
    // echo "Reserva aceptada";
    header("location:../dashboard/EstanciasSalidas.php?AceptarReserva=1");
} else {
    echo "Error al aceptar la Reserva";
}
