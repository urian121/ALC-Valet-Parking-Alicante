<?php
$response = array(); // Crear un array para la respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json");

    include('../../config/config.php');

    // Obtener el cuerpo de la solicitud POST
    $data = json_decode(file_get_contents("php://input"), TRUE);
    $idReserva = $data['idReserva'];

    //Pasar reserva a la Agenda
    $update = "UPDATE tbl_reservas SET estado_reserva = 1 WHERE id = '$idReserva'";
    $result = mysqli_query($con, $update);

    if ($result) {
        $response['success'] = true;
        $response['message'] = 'Reserva actualizada correctamente.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al actualizar la reserva.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Método de solicitud no válido.';
}
// Enviar la respuesta como JSON
echo json_encode($response);
