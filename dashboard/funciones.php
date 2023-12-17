 <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include('../config/config.php');


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
                    IdUser,
                    emailUser, 
                    nombre_completo,
                    din,
                    direccion_completa, 
                    tlf
                FROM tbl_clientes
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
        $id_cliente = trim($_POST['IdUser']);
        $fecha_entrega = date("Y-m-d", strtotime($_POST['fecha_entrega']));
        $hora_entrega = trim($_POST['hora_entrega']);
        $fecha_recogida = date("Y-m-d", strtotime($_POST['fecha_recogida']));
        $hora_recogida = trim($_POST['hora_recogida']);
        $tipo_plaza = trim($_POST['tipo_plaza']);
        $terminal_entrega = trim($_POST['terminal_entrega']);
        $terminal_recogida = trim($_POST['terminal_recogida']);
        $matricula = trim($_POST['matricula']);
        $color = trim($_POST['color']);
        $marca_modelo = trim($_POST['marca_modelo']);
        $numero_vuelo_de_vuelta = trim($_POST['numero_vuelo_de_vuelta']);
        #$servicio_adicional = isset($_POST['servicio_adicional']) ? "Si" : "No";
        $total_pago_reserva = trim($_POST['total_pago_reserva']);
        $email_cliente = trim($_POST['email_cliente']);
        $observacion_cliente = trim($_POST['observacion_cliente']);

        $queryInserReserva  = ("INSERT INTO tbl_reservas(id_cliente, fecha_entrega, hora_entrega, fecha_recogida, hora_recogida, tipo_plaza, terminal_entrega, terminal_recogida, matricula, color, marca_modelo, numero_vuelo_de_vuelta, observacion_cliente, total_pago_reserva) VALUES('$id_cliente','$fecha_entrega','$hora_entrega','$fecha_recogida','$hora_recogida', '$tipo_plaza', '$terminal_entrega', '$terminal_recogida', '$matricula', '$color', '$marca_modelo', '$numero_vuelo_de_vuelta', '$observacion_cliente', '$total_pago_reserva')");
        $resultInsert = mysqli_query($con, $queryInserReserva);
        if ($resultInsert) {
            // Obtener el último ID insertado
            $lastInsertId = mysqli_insert_id($con);
            header("location:../emails/aviso_reserva_email.php?emailUser=" . $email_cliente . "&IdReserva=" . $lastInsertId);
        }
    }




    /**
     * Listas de Reservas por usuario conectado
     */
    function getReservaPerfil($con, $idUser)
    {
        $sqlReservasP = ("SELECT * FROM tbl_reservas WHERE id_cliente ='$idUser' ORDER BY fecha_entrega DESC");
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
        $sqlReservasAdmin = ("SELECT c.*, r.* FROM tbl_clientes AS c
                    INNER JOIN tbl_reservas AS r ON c.idUser = r.id_cliente
                    WHERE r.estado_reserva = 0 AND formato_pago is NULL
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
        $sqlReservasAdmin = ("SELECT c.*, r.* FROM tbl_clientes AS c
                    INNER JOIN tbl_reservas AS r ON c.idUser = r.id_cliente
                    WHERE r.estado_reserva != 0 AND formato_pago is NOT NULL
                    ORDER BY r.date_registro DESC");
        $queryReserva = mysqli_query($con, $sqlReservasAdmin);
        if (!$queryReserva) {
            return false;
        }
        return $queryReserva;
    }

    /**
     * Historial de Reservas
     */
    function getAllHistorialReservas($con)
    {
        $sqlReservasAdmin = ("SELECT c.*, r.* FROM tbl_clientes AS c
                    INNER JOIN tbl_reservas AS r ON c.idUser = r.id_cliente
                    WHERE r.estado_reserva = 2 AND formato_pago is NOT NULL
                    ORDER BY r.date_registro DESC");
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
            header("location:./CrearCliente.php?successC=1");
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

        $PasswordHash = password_hash($passwordUser, PASSWORD_BCRYPT); //Incriptando clave,

        $Update = "UPDATE tbl_clientes SET emailUser='$emailUser', passwordUser='$PasswordHash', nombre_completo='$nombre_completo', din='$din', direccion_completa='$direccion_completa', tlf='$tlf', observaciones='$observaciones', observaciones='$observaciones' WHERE IdUser='$IdUser'";
        $resultado = mysqli_query($con, $Update);

        header("location:./CrearCliente.php?successUC=1");
    }


    function crearFacturaCliente($con, $idReserva)
    {
        $idReserva = $_GET["idReserva"];
        $sqlReserva     = ("SELECT
                c.idUser,
                c.nombre_completo,
                c.din,
                c.emailUser,
                r.matricula,
                r.servicio_adicional,
                r.total_pago_reserva,
                r.servicios_extras1,
                r.total_gasto_extras1,
                r.servicios_extras2,
                r.total_gasto_extras2,
                r.servicios_extras3,
                r.total_gasto_extras3,
                r.observacion_cliente,
                ABS(DATEDIFF(r.fecha_entrega, r.fecha_recogida)) AS diferencia_dias
                FROM tbl_clientes AS c 
                INNER JOIN tbl_reservas AS r
                ON c.idUser=r.id_cliente
                WHERE r.id='$idReserva' LIMIT 1");
        $resulReserva = mysqli_query($con, $sqlReserva);
        $rowReserva = mysqli_fetch_assoc($resulReserva);
        mysqli_free_result($resulReserva);
        return $rowReserva;
    }
    ?>