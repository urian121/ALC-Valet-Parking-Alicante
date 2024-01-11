<?php
sleep(1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('../config/config.php');
$fechaReserva = date("Y-m-d", strtotime($_POST['fechaReserva']));
$sqlReservasAdmin = "
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
            <td class="custom_td"><?php echo $reserva["total_pago_reserva"]; ?> €</td>
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