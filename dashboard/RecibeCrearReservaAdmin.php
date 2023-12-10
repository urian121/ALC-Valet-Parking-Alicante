   <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../config/config.php');

    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    /**
     * Calcular la diferencia de dias entre ambas fechas, 
     * retornando la cantidad de dias
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
    $diferencia = diferenciaDias($_POST['fecha_entrega'], $_POST['fecha_recogida']);
    $total_dias_reserva = $diferencia;



    /**
     * Retorna el valor de la deuda total de acuerdo al tipo de plaza y los dias
     */
    $tipo_plaza = trim($_POST['tipo_plaza']);
    function totalDeupaPorTipoPlaza($con, $tipo_plaza, $total_dias_reserva)
    {
        $tabla = "";
        if ($tipo_plaza == "Plaza Aire Libre") {
            $tabla = "tbl_parking_aire_libre";
        } else {
            $tabla = "tbl_parking_cubierto";
        }
        $sqlData   = ("SELECT valor FROM $tabla WHERE dia='$total_dias_reserva' LIMIT 1");
        $querySQL  = mysqli_query($con, $sqlData);
        if (!$querySQL) {
            return false;
        }
        $data = mysqli_fetch_assoc($querySQL);
        mysqli_free_result($querySQL);
        return $data['valor'];
    }
    $deudaTotal = totalDeupaPorTipoPlaza($con, $tipo_plaza, $total_dias_reserva);
    //print_r('DeudaTotal de acuerdo a la plaza y dias: ' . $deudaTotal);

    /**
     * Iterando sobre los servicios adicionales y sumandolos a la deudaTotal si existen
     * Verificando si existe gastos adicionales, para sumarlos a la deuda total, ya que la deudatotal 
     * solo esta en base a los dias y la plaza.
     */
    for ($i = 1; $i <= 3; $i++) {
        $total_gasto_extra = isset($_POST["total_gasto_extras{$i}"]) ? trim($_POST["total_gasto_extras{$i}"]) : 0;

        // Verificar si hay gastos adicionales y calcular la deuda total
        if ($total_gasto_extra !== "") {
            $deudaTotal = number_format(($deudaTotal + $total_gasto_extra), 2, '.', '');
        }
    }
    //print_r('<br> DeudaTotal con servicios adicionales: ' . $deudaTotal);

    /**
     * Verificar si hay descuento para aplicarlo en la deudaTotal, caso contrario solo retornar la deudaTotal
     */
    if (isset($_POST['descuento'])) {
        $descuento = $_POST['descuento'];
        // Aplica el descuento
        $deudaTotalConDescuento = number_format($deudaTotal - ($deudaTotal * ($descuento / 100)), 2, '.', '');
    } else {
        $deudaTotalConDescuento = $deudaTotal;
    }
    //print_r('<br>DeudaTotal con descuento: ' . $deudaTotalConDescuento);

    $id_cliente = trim($_POST['IdUser']);
    $fecha_entrega = date("Y-m-d", strtotime($_POST['fecha_entrega']));
    $hora_entrega = trim($_POST['hora_entrega']);
    $fecha_recogida = date("Y-m-d", strtotime($_POST['fecha_recogida']));
    $hora_recogida = trim($_POST['hora_recogida']);
    $terminal_entrega = trim($_POST['terminal_entrega']);
    $terminal_recogida = trim($_POST['terminal_recogida']);
    $matricula = trim($_POST['matricula']);
    $color = trim($_POST['color']);
    $marca_modelo = trim($_POST['marca_modelo']);
    $numero_vuelo_de_vuelta = trim($_POST['numero_vuelo_de_vuelta']);
    $servicio_adicional = isset($_POST['servicio_adicional']) ? "Si" : "No";


    $observacion_cliente = trim($_POST['observacion_cliente']);

    $total_gasto_extras1 = isset($_POST['total_gasto_extras1']) ? trim($_POST['total_gasto_extras1']) : 0;
    $total_gasto_extras1 = ($total_gasto_extras1 !== '' && is_numeric($total_gasto_extras1)) ? $total_gasto_extras1 : 0;
    $servicios_extras1 = trim($_POST['servicios_extras1']);

    $total_gasto_extras2 = isset($_POST['total_gasto_extras2']) ? trim($_POST['total_gasto_extras2']) : 0;
    $total_gasto_extras2 = ($total_gasto_extras2 !== '' && is_numeric($total_gasto_extras2)) ? $total_gasto_extras2 : 0;
    $servicios_extras2 = trim($_POST['servicios_extras2']);

    $total_gasto_extras3 = isset($_POST['total_gasto_extras3']) ? trim($_POST['total_gasto_extras3']) : 0;
    $total_gasto_extras3 = ($total_gasto_extras3 !== '' && is_numeric($total_gasto_extras3)) ? $total_gasto_extras3 : 0;
    $servicios_extras3 = trim($_POST['servicios_extras3']);

    $email_cliente = trim($_POST['emailUser']); //Email del cliente


    //Total deuda
    $deudaFinal = $deudaTotalConDescuento;

    $queryInserReserva  = ("INSERT INTO tbl_reservas(id_cliente, fecha_entrega, hora_entrega, fecha_recogida, hora_recogida, tipo_plaza, terminal_entrega, terminal_recogida, matricula, color, marca_modelo, numero_vuelo_de_vuelta,servicio_adicional, total_pago_reserva, descuento, observacion_cliente, servicios_extras1, total_gasto_extras1, servicios_extras2, total_gasto_extras2, servicios_extras3, total_gasto_extras3) 
                            VALUES('$id_cliente','$fecha_entrega','$hora_entrega','$fecha_recogida','$hora_recogida', '$tipo_plaza', '$terminal_entrega', '$terminal_recogida', '$matricula', '$color', '$marca_modelo', '$numero_vuelo_de_vuelta', '$servicio_adicional', '$deudaFinal', '$descuento', '$observacion_cliente', '$servicios_extras1', '$total_gasto_extras1', '$servicios_extras2', '$total_gasto_extras2', '$servicios_extras3', '$total_gasto_extras3')");
    $resultInsert = mysqli_query($con, $queryInserReserva);

    if ($resultInsert) {
        // Obtener el último ID insertado
        $lastInsertId = mysqli_insert_id($con);
        header("location:../emails/aviso_reserva_email.php?emailUser=" . $email_cliente . "&IdReserva=" . $lastInsertId);
    }

    ?>