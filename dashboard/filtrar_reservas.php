<?php
sleep(1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../config/config.php');
$fechaReserva = date("Y-m-d", strtotime($_POST['fechaReserva']));
$sqlReservasAdmin = "SELECT 
            MAX(c.nombre_completo) AS nombre_completo,
            MAX(c.tlf) AS tlf,
			MAX(r.id) AS id_reserva,
            MAX(r.fecha_entrega) AS fecha_entrega,
            MAX(r.hora_entrega) AS hora_entrega,
            MAX(r.fecha_recogida) AS fecha_recogida,
            MAX(r.hora_recogida) AS hora_recogida,
            MAX(r.observacion_cliente) AS observacion_cliente, 
            MAX(r.total_pago_final) AS total_pago_final,
            MAX(r.numero_vuelo_de_vuelta) AS numero_vuelo_de_vuelta,
			MAX(r.total_pago_reserva) AS total_pago_reserva,
            MAX(v.marca_car) AS marca_car,
            MAX(v.modelo_car) AS modelo_car,
            MAX(v.color_car) AS color_car,
            MAX(v.matricula_car) AS matricula_car
        FROM tbl_clientes AS c 
        LEFT JOIN tbl_reservas AS r ON c.idUser = r.id_cliente 
        LEFT JOIN tbl_vehiculos AS v ON r.id_cliente = v.id_cliente 
        WHERE 
            r.fecha_entrega = '$fechaReserva' OR r.fecha_recogida = '$fechaReserva'
        GROUP BY r.id
        ORDER BY 
            CASE 
                WHEN r.fecha_entrega = '$fechaReserva' THEN r.hora_entrega
                ELSE r.hora_recogida
            END ASC,
            CASE 
                WHEN r.fecha_entrega = '$fechaReserva' THEN NULL
                ELSE r.hora_recogida
            END ASC";
$queryReserva = mysqli_query($con, $sqlReservasAdmin);

if (mysqli_num_rows($queryReserva) > 0) {
    $contador = 0;
    while ($reserva = mysqli_fetch_array($queryReserva)) {
        $reserva_id = $reserva["id_reserva"];
        $contador++;
        $fila_clase = $reserva["fecha_entrega"] == $fechaReserva ? 'verde' : 'amarilla';
?>
        <tr id="<?php echo $reserva_id; ?>" class="<?php echo $fila_clase; ?>">
            <td class="custom_td"><?php echo date("d/m/Y", strtotime($reserva["fecha_entrega"])); ?></td>
            <td class="custom_td"><?php echo $reserva["hora_entrega"]; ?></td>
            <td class="custom_td">
                <?php
                echo $reserva["fecha_recogida"] != 'Sin definir' ? date("d/m/Y", strtotime($reserva["fecha_recogida"])) : $reserva["fecha_recogida"];
                ?>
            </td>
            <td class="custom_td"><?php echo $reserva["hora_recogida"]; ?></td>
            <td class="custom_td"><?php echo $reserva["nombre_completo"]; ?></td>
            <td class="custom_td"><?php echo $reserva["tlf"]; ?></td>
            <td class="custom_td"><?php echo $reserva["matricula_car"]; ?></td>
            <td class="custom_td"><?php echo $reserva["marca_car"] . " - " . $reserva["modelo_car"]; ?></td>
            <td class="custom_td"><?php echo $reserva["color_car"]; ?> </td>
            <td class="custom_td"><?php echo $reserva["total_pago_final"]; ?> €</td>
            <td><?php echo $reserva["numero_vuelo_de_vuelta"]; ?></td>
            <td><?php echo $reserva["observacion_cliente"]; ?></td>
        </tr>
    <?php }
} else { ?>
    <tr>
        <td colspan="12">
            <h2 class="text-center">No hay resultados</h2>
        </td>
    </tr>
<?php } ?>