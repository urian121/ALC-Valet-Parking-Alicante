 <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../config/config.php');

    /**
     * obtener todas las Reservas diarias
     */
    function getAllAgendaDiaria($con)
    {
        $sqlReservasAdmin = ("SELECT 
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
                r.fecha_entrega = CURDATE() OR r.fecha_recogida = CURDATE()
            GROUP BY r.id
            ORDER BY 
                CASE 
                    WHEN r.fecha_entrega = CURDATE() THEN r.hora_entrega
                    ELSE r.hora_recogida
                END ASC,
                CASE 
                    WHEN r.fecha_entrega = CURDATE() THEN NULL
                    ELSE r.hora_recogida
                END ASC");
        $queryReserva = mysqli_query($con, $sqlReservasAdmin);
        if (!$queryReserva) {
            return false;
        }
        return $queryReserva;
    }


    function perfilUser($con, $idUser)
    {
        $sqlPerfil = "SELECT 
                    IdUser,
                    emailUser, 
                    nombre_completo,
                    din,
                    direccion_completa, 
                    tlf
                FROM tbl_clientes
                WHERE IdUser='$idUser' LIMIT 1";
        $queryPerfil = mysqli_query($con, $sqlPerfil);
        if (!$queryPerfil) {
            return false;
        }
        $data = mysqli_fetch_assoc($queryPerfil);
        mysqli_free_result($queryPerfil);
        return $data;
    }

    /**
     * Informacion perfil Cliente desde perfil Administrador
     */
    function infoClienteBD($con, $idCliente)
    {
        $infoCliente = "SELECT 
                    c.IdUser,
                    c.emailUser, 
                    c.nombre_completo,
                    c.din,
                    c.direccion_completa, 
                    c.tlf,
                    c.observaciones,
                    v.marca_car,
                    v.modelo_car,
                    v.color_car,
                    v.matricula_car
                FROM tbl_clientes AS  c
                LEFT JOIN tbl_vehiculos AS v
                ON c.IdUser = v.id_cliente
                WHERE IdUser='$idCliente' LIMIT 1";
        $query = mysqli_query($con, $infoCliente);
        if (!$query) {
            return false;
        }
        $data = mysqli_fetch_assoc($query);
        mysqli_free_result($query);
        return $data;
    }
    /**
     * Actualizar Perfil
     */
    if (isset($_POST["accion"]) && $_POST["accion"] == "actualizarPerfil") {
        $idU = trim($_POST['IdUser']);
        $nombre_completo = $_POST['nombre_completo'];
        $din = $_POST['din'];
        $direccion_completa = $_POST['direccion_completa'];
        $emailUser = $_POST['emailUser'];

        // Verificar si el campo passwordUser no está vacío
        if (!empty($_POST['passwordUser'])) {
            $PasswordHash = password_hash($_POST['passwordUser'], PASSWORD_BCRYPT);
            $updatePerfil = "UPDATE tbl_clientes 
            SET nombre_completo = '$nombre_completo',
                din = '$din',
                direccion_completa = '$direccion_completa',
                emailUser = '$emailUser',
                passwordUser = '$PasswordHash'
             WHERE IdUser = '$idU'";
        } else {
            $updatePerfil = "UPDATE tbl_clientes 
            SET nombre_completo = '$nombre_completo',
                din = '$din',
                direccion_completa = '$direccion_completa',
                emailUser = '$emailUser'
             WHERE IdUser = '$idU'";
        }

        $result = mysqli_query($con, $updatePerfil);

        if (!$result) {
            echo 'Error al guardar los datos en la base de datos.';
        } else {
            header("location:./?successP=1");
        }
    }

    /**
     * Crear Reserva desde el perfil Cliente
     */
    if (isset($_POST["accion"]) && $_POST["accion"] == "crearReservaClienteDashboard") {
        $id_cliente         = trim($_POST['IdUser']);
        $fecha_entrega      = date("Y-m-d", strtotime($_POST['fecha_entrega']));
        $hora_entrega       = trim($_POST['hora_entrega']);
        $fecha_recogida     = $_POST['fecha_recogida'] != '' ? date("Y-m-d", strtotime($_POST['fecha_recogida'])) : 'Sin definir';
        $hora_recogida      =  trim($_POST['hora_recogida']);
        $tipo_plaza         = trim($_POST['tipo_plaza']);
        $terminal_entrega   = trim($_POST['terminal_entrega']);
        $terminal_recogida  = trim($_POST['terminal_recogida']);
        $numero_vuelo_de_vuelta = trim($_POST['numero_vuelo_de_vuelta']);
        $email_cliente          = trim($_POST['email_cliente']);
        $observacion_cliente    = trim($_POST['observacion_cliente']);

        //Calculando el total de dias de la reserva, esto se calcula si existe la fecha de recogida, de lo contrario seria 'Sin definir'
        $total_dias_reserva = 'Sin definir';
        if ($fecha_recogida != 'Sin definir') {
            $diferencia = diferenciaDias($fecha_entrega, $fecha_recogida);
            $total_dias_reserva = $diferencia;
        }

        /**
         * Para calcular el 'total_pago_reserva', primero validar si existen dias de reservas, si existen, retorno el valor de la deuda total de acuerdo al tipo de plaza y los dias
         */
        $total_pago_reserva = 0;
        if ($total_dias_reserva != 'Sin definir') {
            $total_pago_reserva = totalDeudaPorTipoPlazaYDias($con, $tipo_plaza, $total_dias_reserva);
        }

        $queryInserReserva  = ("INSERT INTO tbl_reservas(id_cliente, fecha_entrega, hora_entrega, fecha_recogida, hora_recogida, tipo_plaza, terminal_entrega, terminal_recogida, numero_vuelo_de_vuelta, observacion_cliente, total_pago_reserva, total_dias_reserva)
                 VALUES('$id_cliente','$fecha_entrega','$hora_entrega','$fecha_recogida','$hora_recogida', '$tipo_plaza', '$terminal_entrega', '$terminal_recogida', '$numero_vuelo_de_vuelta', '$observacion_cliente', '$total_pago_reserva', '$total_dias_reserva')");
        $resultInsert = mysqli_query($con, $queryInserReserva);


        if ($resultInsert) {
            // Obtener el último ID insertado
            $lastInsertId = mysqli_insert_id($con);
            $marca_car = trim($_POST['marca_car']);
            $modelo_car = trim($_POST['modelo_car']);
            $color_car = trim($_POST['color_car']);
            $matricula_car = trim($_POST['matricula_car']);

            $queryInsertVehiculo  = ("INSERT INTO tbl_vehiculos(id_cliente, marca_car, modelo_car, color_car, matricula_car) VALUES ('$id_cliente', '$marca_car', '$modelo_car', '$color_car', '$matricula_car')");
            $resultInsertVehiculo = mysqli_query($con, $queryInsertVehiculo);

            header("location:../emails/aviso_reserva_email.php?emailUser=" . $email_cliente . "&IdReserva=" . $lastInsertId . "&desde=cliente");
        }
    }


    function diferenciaDias($fecha_entrega_str, $fecha_recogida_str)
    {
        // Convierte las fechas a marcas de tiempo
        $timestamp_entrega = strtotime($fecha_entrega_str);
        $timestamp_recogida = strtotime($fecha_recogida_str);
        $diferencia_segundos = $timestamp_recogida - $timestamp_entrega;
        $dias_diferencia = floor($diferencia_segundos / (60 * 60 * 24));
        return $dias_diferencia;
    }

    function totalDeudaPorTipoPlazaYDias($con, $tipo_plaza, $total_dias_reserva)
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
     * Listas de Reservas por usuario conectado
     */
    function getReservaPerfil($con, $idUser)
    {
        $sqlReservasP = "SELECT 
                    r.*,
                    r.id AS id_reserva,
                    v.*
                FROM tbl_reservas AS r
                INNER JOIN tbl_vehiculos AS v ON r.id_cliente = v.id_cliente
                WHERE r.id_cliente ='$idUser'
                GROUP BY v.matricula_car
                ORDER BY r.date_registro DESC";
        $queryR = mysqli_query($con, $sqlReservasP);
        if (!$queryR) {
            return false;
        }
        return $queryR;
    }

    /**
     * Lista de Clientes
     */
    function getClientes($con)
    {
        $sqlClientes = ("SELECT * FROM tbl_clientes ORDER BY nombre_completo");
        $queryC = mysqli_query($con, $sqlClientes);
        if (!$queryC) {
            return false;
        }
        return $queryC;
    }

    /**
     * Lista de Reservas Pendientes por entrar al  Parking
     */
    function getEstanciaEntradas($con)
    {
        $sqlReservasAdmin = ("SELECT 
					    c.*,
                        r.*,
                        r.id AS id_reserva,
                        v.*
                   FROM tbl_clientes AS c 
                	  INNER JOIN tbl_reservas AS r ON c.idUser=r.id_cliente            
                   INNER JOIN tbl_vehiculos AS v
                   ON r.id_cliente = v.id_cliente
                   WHERE r.estado_reserva = 0
                   GROUP BY r.id 
                   ORDER BY r.date_registro ASC");
        $queryReserva = mysqli_query($con, $sqlReservasAdmin);
        if (!$queryReserva) {
            return false;
        }
        return $queryReserva;
    }

    /**
     * Lista de Reservas Pendientes por Salir del Parking
     */
    function getEstanciaSalidas($con)
    {
        $sqlReservasAdmin = ("SELECT 
					    c.*,
                        r.*,
                        r.id AS id_reserva,
                        v.*
                   FROM tbl_clientes AS c 
                	  INNER JOIN tbl_reservas AS r ON c.idUser=r.id_cliente            
                   INNER JOIN tbl_vehiculos AS v
                   ON r.id_cliente = v.id_cliente
                   WHERE  r.estado_reserva != 0 
                   GROUP BY r.id
                   ORDER BY r.date_registro ASC");
        $queryReserva = mysqli_query($con, $sqlReservasAdmin);
        if (!$queryReserva) {
            return false;
        }
        return $queryReserva;
    }



    /**
     * Crear cuenta de Cliente desde el Administrador
     */
    if (isset($_POST["accion"]) && $_POST["accion"] == "crearCliente") {
        date_default_timezone_set("Europe/Madrid");
        $createUser = date("Y-m-d H:i:s");

        $nombre_completo = $_POST['nombre_completo'];
        $din = $_POST['din'];
        $direccion_completa = $_POST['direccion_completa'];
        $passwordUser = trim($_POST['passwordUser']);
        $emailUser = trim($_POST['emailUser']);
        $tlf = trim($_POST['tlf']);
        $observaciones = trim($_POST['observaciones']);

        $PasswordHash = password_hash($passwordUser, PASSWORD_BCRYPT); //Incriptando clave,

        //Primero verifico si existe algun usuario asociado a dicho correo
        $SqlVerificandoEmail = ("SELECT emailUser FROM tbl_clientes WHERE emailUser COLLATE utf8_bin='$emailUser'");
        $jqueryEmail         = mysqli_query($con, $SqlVerificandoEmail);
        if (mysqli_num_rows($jqueryEmail) > 0) {
            header("location:./CrearCliente.php?errorC=1");
        } else {
            $queryInsertUser  = ("INSERT INTO tbl_clientes(emailUser, passwordUser, nombre_completo, din, direccion_completa, tlf, observaciones, createUser) VALUES ('$emailUser','$PasswordHash','$nombre_completo','$din', '$direccion_completa', '$tlf', '$observaciones', '$createUser')");
            $resultInsertUser = mysqli_query($con, $queryInsertUser);
            if ($resultInsertUser) {
                // Obtengo el ID del último registro insertado
                $ultimoIdInsertado = mysqli_insert_id($con);

                $marca_car = trim($_POST['marca_car']);
                $modelo_car = trim($_POST['modelo_car']);
                $color_car = trim($_POST['color_car']);
                $matricula_car = trim($_POST['matricula_car']);
                //Regidtrando Vehiculo
                $queryInsertVehiculo  = ("INSERT INTO tbl_vehiculos(id_cliente, marca_car, modelo_car, color_car, matricula_car) VALUES ('$ultimoIdInsertado', '$marca_car', '$modelo_car', '$color_car', '$matricula_car')");
                $resultInsertVehiculo = mysqli_query($con, $queryInsertVehiculo);
                header("location:./CrearCliente.php?successC=1");
            }
        }
    }

    /**
     * Actualizar datos del Cliente desde el perfil Administrador
     */
    if (isset($_POST["accion"]) && $_POST["accion"] == "actualizarClienteAdmin") {

        $nombre_completo = $_POST['nombre_completo'];
        $din = $_POST['din'];
        $direccion_completa = $_POST['direccion_completa'];
        $passwordUser = trim($_POST['passwordUser']);
        $emailUser = trim($_POST['emailUser']);
        $tlf = $_POST['tlf'];
        $observaciones = $_POST['observaciones'];
        $IdUser = trim($_POST['IdUser']);
        $marca_car = trim($_POST['marca_car']);
        $modelo_car = trim($_POST['modelo_car']);
        $color_car = trim($_POST['color_car']);
        $matricula_car = trim($_POST['matricula_car']);

        $PasswordHash = password_hash($passwordUser, PASSWORD_BCRYPT); //Incriptando clave,

        $Update = "UPDATE tbl_clientes SET emailUser='$emailUser', passwordUser='$PasswordHash', nombre_completo='$nombre_completo', din='$din', direccion_completa='$direccion_completa', tlf='$tlf', observaciones='$observaciones', observaciones='$observaciones' WHERE IdUser='$IdUser'";
        $resultado = mysqli_query($con, $Update);
        if ($resultado) {
            $UpdateVehiculo = "UPDATE tbl_vehiculos SET  marca_car='$marca_car', modelo_car='$modelo_car', color_car='$color_car', matricula_car='$matricula_car' WHERE matricula_car='$matricula_car'";
            $resultadoV = mysqli_query($con, $UpdateVehiculo);
            header("location:./CrearCliente.php?successUC=1");
        }
    }


    function crearFacturaCliente($con, $idReserva)
    {
        $idReserva = $_GET["idReserva"];
        $sqlReserva     = ("SELECT 
                        c.*,
                        r.*,
                        v.*
                    FROM tbl_clientes AS c 
                    LEFT JOIN tbl_reservas AS r ON c.idUser = r.id_cliente            
                    LEFT JOIN tbl_vehiculos AS v ON r.id_cliente = v.id_cliente
                    WHERE r.id='$idReserva'
                    LIMIT 1");
        $resulReserva = mysqli_query($con, $sqlReserva);

        if (mysqli_num_rows($resulReserva) > 0) {
            $rowReserva = mysqli_fetch_assoc($resulReserva);
            mysqli_free_result($resulReserva);
            return $rowReserva;
        } else {
            return 0;
        }
    }


    /**
     * Historial de Reservas
     */
    function getHistorialReservas($con)
    {
        $sqlReservasAdmin = ("SELECT 
					    c.*,
                        r.*,
                        r.id AS id_reserva,
                        v.*
                   FROM tbl_clientes AS c 
                	  INNER JOIN tbl_reservas AS r ON c.idUser=r.id_cliente            
                   INNER JOIN tbl_vehiculos AS v
                   ON r.id_cliente = v.id_cliente
                   WHERE fecha_entrega < CURDATE()
                   AND r.fecha_recogida < CURDATE()
                   GROUP BY r.id 
                   ORDER BY r.date_registro ASC");
        $queryReserva = mysqli_query($con, $sqlReservasAdmin);
        if (!$queryReserva) {
            return false;
        }
        return $queryReserva;
    }
    ?>