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
                include 'bases/nav.php';
                include 'funciones.php';
                $mis_reservas = getEstanciaEntradas($con);
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center" id="MiAlert"></div>
                        <div class="row justify-content-md-center">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title text-center mb-4" style="font-size: 30px;">
                                            Estancias de Entradas
                                            <hr>
                                        </h2>
                                        <div class="table-responsive">
                                            <table id="tablaReservasPendientes" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Nº Reserva</th>
                                                        <th>Cliente</th>
                                                        <th>Teléfono</th>
                                                        <th>Matrícula</th>
                                                        <th>Fecha de entrega</th>
                                                        <th>Hora de entrega</th>
                                                        <th>Fecha de recogida</th>
                                                        <th>Hora de recogida</th>
                                                        <th>Tipo de plaza</th>
                                                        <th>Reserva</th>
                                                        <th>Aceptar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($reserva = mysqli_fetch_array($mis_reservas)) {
                                                        $reserva_id = $reserva["id_reserva"]; ?>
                                                        <tr id="<?php echo $reserva_id; ?>" class="reserva_<?php echo $reserva_id; ?>">
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
                                                            <td class="custom_td"><?php echo $reserva["tlf"]; ?></td>
                                                            <td class="custom_td"><?php echo $reserva["matricula_car"]; ?></td>
                                                            <td class="custom_td"><?php echo date("d/m/Y", strtotime($reserva["fecha_entrega"])); ?></td>
                                                            <td class="custom_td"><?php echo $reserva["hora_entrega"]; ?></td>
                                                            <td class="custom_td">
                                                                <?php
                                                                echo ($reserva["fecha_recogida"] != 'Sin definir' ? date("d/m/Y", strtotime($reserva["fecha_recogida"])) : $reserva["fecha_recogida"]);
                                                                ?>
                                                            </td>
                                                            <td class="custom_td"><?php echo $reserva["hora_recogida"]; ?></td>
                                                            <td class="custom_td"><?php echo $reserva["tipo_plaza"]; ?></td>
                                                            <td class="custom_td" style="display: flex;justify-content: center;">
                                                                <a href="ReservaPDF.php?idReserva=<?php echo $reserva_id; ?>" title="Descargar Recibo de Aparcamiento">
                                                                    <i class="bi bi-filetype-pdf"></i>
                                                                </a>
                                                                &nbsp;&nbsp;
                                                                &nbsp;&nbsp;
                                                            </td>
                                                            <td class="custom_td" style="text-align: center;">
                                                                <a class="aceptar" title="Aceptar Reserva" href="javascript:void(0);" onclick="confirmarAceptacion(<?php echo $reserva_id; ?>)">
                                                                    <i class="bi bi-check-circle" style="font-size: 25px; color:red"></i>
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
            ?>
        </div>

        <?php include 'bases/PageJs.html'; ?>
        <script src="../assets/custom/js/tabla_reservas.js"></script>
        <script>
            function confirmarAceptacion(idReserva) {
                var confirmacion = confirm("¿Realmente desea aceptar la reserva?");
                if (confirmacion) {
                    window.location.href = "../acciones/AceptarReserva.php?idReserva=" + idReserva;
                } else {}
            }
            $(document).ready(function() {
                $("#tablaReservasPendientes").DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                    },
                });
            });
        </script>
    </body>

    </html>
<?php
} else { ?>
    <script type="text/javascript">
        location.href = "../acciones/login/exit.php";
    </script>
<?php }  ?>