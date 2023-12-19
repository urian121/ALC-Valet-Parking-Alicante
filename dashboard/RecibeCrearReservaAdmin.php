   <?php
    /*
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    */
    include('../config/config.php');
    $fecha_recogida = $_POST['fecha_recogida'] != '' ? date("Y-m-d", strtotime($_POST['fecha_recogida'])) : 'Sin definir';

    //Calcular el total de dias de la reserva, esto se calcula si existe la fecha de $_POST['fecha_recogida'], de lo contrario seria 'Sin definir'
    $total_dias_reserva = 'Sin definir';
    if ($fecha_recogida != 'Sin definir') {
        $diferencia = diferenciaDias($_POST['fecha_entrega'], $_POST['fecha_recogida']);
        $total_dias_reserva = $diferencia;
    }

    /**
     * Funcion para calcular la diferencia de dias entre ambas fechas, si la  fecha de $_POST['fecha_recogida'] !='' y retornar la cantidad de dias
     */
    function diferenciaDias($fecha_entrega_str, $fecha_recogida_str)
    {
        // Convierte las fechas a marcas de tiempo
        $timestamp_entrega = strtotime($fecha_entrega_str);
        $timestamp_recogida = strtotime($fecha_recogida_str);
        $diferencia_segundos = $timestamp_recogida - $timestamp_entrega;
        $dias_diferencia = floor($diferencia_segundos / (60 * 60 * 24));
        return $dias_diferencia;
    }

    function totalDeupaPorTipoPlazaYDias($con, $tipo_plaza, $total_dias_reserva)
    {
        $tabla = $tipo_plaza == "Plaza Aire Libre" ? "tbl_parking_aire_libre" : "tbl_parking_cubierto";
        $sqlData   = ("SELECT valor FROM $tabla WHERE dia='$total_dias_reserva' LIMIT 1");
        $querySQL  = mysqli_query($con, $sqlData);
        if (!$querySQL) {
            return false;
        }
        $data = mysqli_fetch_assoc($querySQL);
        mysqli_free_result($querySQL);
        return $data['valor'];
    }

    /**
     * Para calcular el 'total_pago_reserva', primero validar si existen dias de reservas, si existen, retorno el valor de la deuda total de acuerdo al tipo de plaza y los dias
     */
    $tipo_plaza = trim($_POST['tipo_plaza']);
    $total_pago_reserva = 0;
    if ($total_dias_reserva != 'Sin definir') {
        $total_pago_reserva = totalDeupaPorTipoPlazaYDias($con, $tipo_plaza, $total_dias_reserva);
    }


    /**
     * Verificar si hay descuento para aplicarlo en total_pago_reserva, caso contrario solo retornar el total de total_pago_reserva
     */
    $deudaFinal = 0;
    $descuento = trim($_POST['descuento']);
    if ($descuento != 0) {
        // Aplica el descuento
        $deudaFinal = number_format($total_pago_reserva - ($total_pago_reserva * ($descuento / 100)), 2, '.', '');
    } else {
        $deudaFinal = $total_pago_reserva;
    }


    $id_cliente = trim($_POST['IdUser']);
    $fecha_entrega = date("Y-m-d", strtotime($_POST['fecha_entrega']));
    $hora_entrega = trim($_POST['hora_entrega']);
    $hora_recogida = trim($_POST['hora_recogida']);
    $terminal_entrega = trim($_POST['terminal_entrega']);
    $terminal_recogida = trim($_POST['terminal_recogida']);
    $matricula = trim($_POST['matricula']);
    $color = trim($_POST['color']);
    $marca_modelo = trim($_POST['marca_modelo']);
    $numero_vuelo_de_vuelta = trim($_POST['numero_vuelo_de_vuelta']);
    $servicio_adicional = isset($_POST['servicio_adicional']) ? "Si" : "No";
    $observacion_cliente = trim($_POST['observacion_cliente']);
    $email_cliente = trim($_POST['emailUser']); //Email del cliente

    $total_gasto_extras1 = isset($_POST['total_gasto_extras1']) ? trim($_POST['total_gasto_extras1']) : 0;
    $total_gasto_extras1 = ($total_gasto_extras1 !== '' && is_numeric($total_gasto_extras1)) ? $total_gasto_extras1 : 0;
    $servicios_extras1 = trim($_POST['servicios_extras1']);

    $total_gasto_extras2 = isset($_POST['total_gasto_extras2']) ? trim($_POST['total_gasto_extras2']) : 0;
    $total_gasto_extras2 = ($total_gasto_extras2 !== '' && is_numeric($total_gasto_extras2)) ? $total_gasto_extras2 : 0;
    $servicios_extras2 = trim($_POST['servicios_extras2']);

    $total_gasto_extras3 = isset($_POST['total_gasto_extras3']) ? trim($_POST['total_gasto_extras3']) : 0;
    $total_gasto_extras3 = ($total_gasto_extras3 !== '' && is_numeric($total_gasto_extras3)) ? $total_gasto_extras3 : 0;
    $servicios_extras3 = trim($_POST['servicios_extras3']);

    $queryInserReserva  = ("INSERT INTO tbl_reservas(id_cliente, fecha_entrega, hora_entrega, fecha_recogida, hora_recogida, tipo_plaza, terminal_entrega, terminal_recogida, matricula, color, marca_modelo, numero_vuelo_de_vuelta,servicio_adicional, total_pago_reserva, descuento, observacion_cliente, total_dias_reserva, servicios_extras1, total_gasto_extras1, servicios_extras2, total_gasto_extras2, servicios_extras3, total_gasto_extras3) 
                            VALUES('$id_cliente','$fecha_entrega','$hora_entrega','$fecha_recogida','$hora_recogida', '$tipo_plaza', '$terminal_entrega', '$terminal_recogida', '$matricula', '$color', '$marca_modelo', '$numero_vuelo_de_vuelta', '$servicio_adicional', '$deudaFinal', '$descuento', '$observacion_cliente', '$total_dias_reserva', '$servicios_extras1', '$total_gasto_extras1', '$servicios_extras2', '$total_gasto_extras2', '$servicios_extras3', '$total_gasto_extras3')");
    $resultInsert = mysqli_query($con, $queryInserReserva);

    echo '<pre>';
    print_r($queryInserReserva);
    echo '</pre>';

    exit();
    if ($resultInsert) {
        // Obtener el último ID insertado
        $lastInsertId = mysqli_insert_id($con);
        header("location:../emails/aviso_reserva_email.php?emailUser=" . $email_cliente . "&IdReserva=" . $lastInsertId);
    }

    ?>