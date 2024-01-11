<?php
include('../config/config.php');
$fechaReserva = $_REQUEST['fechaReserva'];

date_default_timezone_set("Europe/Madrid");
$horaEnEspana = date("Y-m-d");

// Obtener los datos de la base de datos
$sqlClientes = "
        SELECT 
            c.*,
            r.*, 
            r.id AS id_reserva, 
            v.*
        FROM tbl_clientes AS c 
        INNER JOIN tbl_reservas AS r ON c.idUser = r.id_cliente 
        INNER JOIN tbl_vehiculos AS v ON r.id_cliente = v.id_cliente 
        WHERE 
            r.fecha_entrega = '$fechaReserva' OR r.fecha_recogida = '$fechaReserva'
        GROUP BY r.id
        ORDER BY 
            CASE 
                WHEN STR_TO_DATE(r.fecha_recogida, '%Y-%m-%d') IS NOT NULL THEN STR_TO_DATE(r.fecha_recogida, '%Y-%m-%d')
                ELSE '9999-12-31'
            END ASC,
            CASE 
                WHEN STR_TO_DATE(r.fecha_recogida, '%Y-%m-%d') IS NULL THEN r.hora_recogida
                ELSE '99:99:99'
            END ASC";
$query = mysqli_query($con, $sqlClientes);

// Configuración de encabezados para forzar la descarga del archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="HISTORIAL DE RESERVAS ' . $horaEnEspana . '.xls"');
header('Cache-Control: max-age=0');

// Función para imprimir una fila de datos
function imprimirFila($fila)
{
    echo implode("\t", $fila) . "\n";
}



// Encabezados 	 	 	 		 	 	
$encabezados = ['Fecha Salida', 'Hora Salida', 'Cliente', 'Teléfono', 'Matrícula', 'Marca - Modelo ', 'Precio', 'Número Vuelo', 'Observaciones'];
imprimirFila($encabezados);

$contador = 0;
while ($reserva = mysqli_fetch_assoc($query)) {
    $contador++;
    $datos = [
        date("d/m/Y", strtotime($reserva["fecha_entrega"])),
        $reserva["hora_entrega"],
        $reserva["fecha_recogida"] != 'Sin definir' ? date("d/m/Y", strtotime($reserva["fecha_recogida"])) : $reserva["fecha_recogida"],
        $reserva["hora_recogida"],
        $reserva["nombre_completo"],
        $reserva["tlf"],
        $reserva["matricula_car"],
        $reserva["marca_car"] . " - " . $reserva["modelo_car"],
        $reserva["total_pago_reserva"],
        $reserva["numero_vuelo_de_vuelta"],
        $reserva["observacion_cliente"]
    ];
    imprimirFila($datos);
}

// Salir para evitar cualquier salida HTML adicional
exit;
