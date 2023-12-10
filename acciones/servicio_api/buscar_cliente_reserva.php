<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json");

    include('../../config/config.php');

    // Obtener el cuerpo de la solicitud POST
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['idCliente'])) {
        $idCliente = $data['idCliente'];

        $sqlData = ("SELECT
                c.emailUser,
                r.terminal_entrega,
                r.terminal_recogida,
                r.matricula,
                r.color,
                r.marca_modelo
            FROM tbl_clientes AS c
            LEFT JOIN tbl_reservas AS r 
            ON c.idUser = r.id_cliente
            WHERE c.IdUser = '$idCliente'
            ORDER BY r.date_registro DESC LIMIT 1");
        $querySQL = mysqli_query($con, $sqlData);
        $dataBD = array();
        while ($fila_data = mysqli_fetch_array($querySQL)) {
            $dataBD[] = $fila_data;
        }

        $response = array();
        if (count($dataBD) > 0) {
            $response['success'] = true;
            $response['data'] = $dataBD;
        } else {
            $response['success'] = true;
            $response['data'] = $dataBD[0];
        }

        echo json_encode($response);
        exit();
    } else {
        echo json_encode(array('error' => 'Cliente no encontrado.'));
        exit();
    }
}
