<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json");

    include('../../config/config.php');

    // Obtener el cuerpo de la solicitud POST
    $data = json_decode(file_get_contents("php://input"), TRUE);
    $idReserva = $data['idReserva'];
    print_r($idReserva);

    /*
        $totalDias = array();
        while ($fila_data = mysqli_fetch_array($querySQL)) {
            $totalDias[] = $fila_data;
        }

        echo json_encode($totalDias);
        exit();*/
} else {
    echo json_encode(array('error' => 'Parámetro tipo_plaza no presente en la solicitud.'));
    exit();
}
