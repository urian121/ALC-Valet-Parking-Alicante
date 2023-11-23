<?php
session_start();
if (isset($_SESSION['emailUser']) != "" && $_SESSION['rol'] == 1) {
    $IdUser     = $_SESSION['IdUser'];
    $email      = $_SESSION['emailUser'];
    $rolUser    = $_SESSION['rol'];
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php
        include('bases/head.html');
        include('bases/toastr.html');
        ?>
    </head>

    <body>
        <?php
        include('../msjs.php');
        include('bases/loader.html');
        ?>
        <div class="container-scroller">
            <?php include 'bases/navbar.php'; ?>
            <div class="container-fluid page-body-wrapper">
                <?php
                include 'bases/config.html';
                include 'bases/nav.php';
                include 'funciones.php';
                $mis_reservas = getAllReservasPendientes($con);
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title text-center mb-4" style="font-size: 30px;">Resumen de Reservas Pendientes
                                            <a href="../acciones/exportDataReservas.php" download="Data_clientes.xls" style="float: right;font-size: 25px;">
                                                <i class="bi bi-filetype-csv"></i>
                                            </a>
                                            <hr>
                                        </h2>
                                        <div class="table-responsive">
                                            <table id="tablaReservasPendientes" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nº Reserva</th>
                                                        <th>Cliente</th>
                                                        <th>DIN</th>
                                                        <th>Teléfono</th>
                                                        <th>Matrícula</th>
                                                        <th>Fecha de entrega</th>
                                                        <th>Hora de entrega</th>
                                                        <th>Fecha de recogida</th>
                                                        <th>Hora de recogida</th>
                                                        <th>Pago</th>
                                                        <th>Tipo de plaza</th>
                                                        <th>Estado Reserva</th>
                                                        <th>Recibo de Aparcamiento </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($reserva = mysqli_fetch_array($mis_reservas)) {
                                                        $reserva_id = $reserva["id"]; ?>
                                                        <tr id="<?php echo $reserva_id; ?>">
                                                            <td class="custom_td">
                                                                <?php
                                                                if ($reserva_id < 10) {
                                                                    echo 'R-00' . $reserva_id;
                                                                } elseif ($reserva_id < 100) {
                                                                    echo 'R-0' . $reserva_id;
                                                                } else {
                                                                    echo 'R-' . $reserva_id;
                                                                } ?>
                                                            </td>
                                                            <td class="custom_td"><?php echo $reserva["nombre_completo"]; ?></td>
                                                            <td class="custom_td"><?php echo $reserva["din"]; ?></td>
                                                            <td class="custom_td"><?php echo $reserva["tlf"]; ?></td>
                                                            <td class="custom_td"><?php echo $reserva["matricula"]; ?></td>
                                                            <td class="custom_td"><?php echo date("d/m/Y", strtotime($reserva["fecha_entrega"])); ?></td>
                                                            <td class="custom_td"><?php echo $reserva["hora_entrega"]; ?></td>
                                                            <td class="custom_td"><?php echo date("d/m/Y", strtotime($reserva["fecha_recogida"])); ?></td>
                                                            <td class="custom_td"><?php echo $reserva["hora_recogida"]; ?></td>
                                                            <td class="custom_td">
                                                                <span class="<?php echo isset($reserva['formato_pago']) ? 'sin_deuda' : 'deuda' ?>">
                                                                    <?php echo $reserva["total_pago_reserva"]; ?>
                                                                    <i class="bi bi-currency-euro"></i>
                                                                </span>
                                                            </td>
                                                            <td class="custom_td"><?php echo $reserva["tipo_plaza"]; ?></td>
                                                            <td class="text-center custom_td">
                                                                <button title="Aprobar Reserva" type="button" onclick='aceptarReservaPendiente(this, <?php echo $reserva["id"]; ?>)' class="pad_btn btn btn-danger btn-sm pd_7">
                                                                    Aceptar Reserva
                                                                </button>
                                                            </td>
                                                            <td class="custom_td" style="display: flex;justify-content: center;">
                                                                <a href="ReservaPDF.php?idReserva=<?php echo $reserva["id"]; ?>" title="Descargar Recibo de Aparcamiento">
                                                                    <i class="bi bi-filetype-pdf"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            include('ModalDetallesReserva.html');
            include('ModalCrearFactura.php');
            ?>
        </div>

        <?php include 'bases/PageJs.html'; ?>
        <script src="../assets/custom/js/tabla_reservas.js"></script>
        <script>
            $(document).ready(function() {
                $("#tablaReservasPendientes").DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                    },
                });
            });

            const aceptarReservaPendiente = async (boton, idReserva) => {
                try {
                    const url = `../acciones/servicio_api/aceptarReservaPendiente.php/`;
                    const response = await axios.post(url, {
                        idReserva
                    });
                    const {
                        success,
                        message
                    } = response.data;

                    if (success) {
                        console.log("Reserva aceptada con éxito");
                        actualizarBotonExito(boton);
                    } else {
                        console.error(`Error ${status}: ${message}`);
                        // Manejar otros casos de error según sea necesario
                    }
                } catch (error) {
                    console.error("Error en la función aceptarReservaPendiente:", error);
                    // Manejar errores de red u otros errores
                }
            };

            const actualizarBotonExito = (boton) => {
                boton.classList.remove("btn-danger");
                boton.classList.add("btn-success");
                boton.innerHTML = "<i class='bi bi-check2-all' style='font-size: 15px !important;'></i> Reserva Aceptada";
                boton.onclick = null;
                // Puedes agregar más acciones si es necesario
            };
        </script>
    </body>

    </html>
<?php
} else { ?>
    <script type="text/javascript">
        location.href = "../acciones/login/exit.php";
    </script>
<?php }  ?>