 <?php
    /*
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    */

    session_start();
    if (isset($_SESSION['emailUser']) != "" && ($_SESSION['rol'] == 1) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
        include('../config/config.php');

        // Obtener las fechas del formulario y convertirlas a formato Y-m-d
        $fecha_entrega = date("Y-m-d", strtotime($_POST['fechaEntrega']));
        $fecha_recogida = date("Y-m-d", strtotime($_POST['fechaRecogida']));
        $idReserva = trim($_POST["idReserva"]);
        $tipo_plaza = trim($_POST["tipoPlaza"]);
        $total_gasto_extras1 = trim($_POST["total_gasto_extras1"]) ? trim($_POST["total_gasto_extras1"]) : 0;
        $total_gasto_extras2 = trim($_POST["total_gasto_extras2"]) ? trim($_POST["total_gasto_extras2"]) : 0;
        $total_gasto_extras3 = trim($_POST["total_gasto_extras3"]) ? trim($_POST["total_gasto_extras3"]) : 0;
        $descuento = trim($_POST['descuento']);


        /**
         * Función para calcular la diferencia de dias entre ambas fechas, si la  fecha de $_POST['fecha_recogida'] !='' y retornar la cantidad de dias
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
        $total_dias_reserva = diferenciaDias($_POST['fechaEntrega'], $_POST['fechaRecogida']);



        /**
         * calcular el total de la deuda de acuerdo al tipo de plaza y los dias.
         */
        $tabla = $tipo_plaza == "Plaza Aire Libre" ? "tbl_parking_aire_libre" : "tbl_parking_cubierto";
        $sqlData   = ("SELECT valor FROM $tabla WHERE dia='$total_dias_reserva' LIMIT 1");
        $querySQL  = mysqli_query($con, $sqlData);
        if (!$querySQL) {
            return false;
        }
        $data = mysqli_fetch_assoc($querySQL);
        mysqli_free_result($querySQL);
        $total_pago_reserva = $data['valor'];




        /**
         * Sumar todos los gastos extras, y se los asignar a la variable 'deudaTotalGatosExtra' ademas ese total de la deuda 'deudaFinal' se la sumo a la deuda 'deudaFinal'
         */
        $total_pago_final = 0;
        $deudaTotalGatosExtra = 0;
        for ($i = 1; $i <= 3; $i++) {
            $total_gasto_extra = isset($_POST["total_gasto_extras{$i}"]) ? trim($_POST["total_gasto_extras{$i}"]) : 0;
            if ($total_gasto_extra !== "") {
                $deudaTotalGatosExtra = number_format(($deudaTotalGatosExtra + $total_gasto_extra), 2, '.', '');
            }
        }
        $total_pago_final = number_format(($deudaTotalGatosExtra + $total_pago_reserva), 2, '.', '');

        /**
         * Verificar si hay descuento para aplicarlo en total_pago_reserva, caso contrario solo retornar el total de total_pago_reserva
         */
        if ($descuento != 0) {
            $total_pago_final = number_format($total_pago_final - ($total_pago_final * ($descuento / 100)), 2, '.', '');
        }

        // Validar que la fecha_entrega no sea mayor que la fecha_recogida
        if ($fecha_entrega <= $fecha_recogida) {
            $Update = "UPDATE tbl_reservas SET fecha_recogida='$fecha_recogida', total_dias_reserva='$total_dias_reserva', total_pago_reserva='$total_pago_reserva', total_pago_final='$total_pago_final' WHERE id='$idReserva'";
            print_r($Update);
            $resultado = mysqli_query($con, $Update);
            if ($resultado) {
                header("location: CrearFactura.php?idReserva=" . $idReserva . "&facturaFR=1");
            } else {
                // Manejar el caso en que la actualización falla
                echo "Error al actualizar la reserva.";
            }
        } else {
            header("location: CrearFactura.php?idReserva=" . $idReserva . "&errorF=1");
        }
    } else {
        // Redirigir a la página de inicio de sesión si no hay sesión activa
        header("location: ../acciones/login/exit.php");
    }
    ?>