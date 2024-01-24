<?php
session_start();
if (isset($_SESSION['emailUser']) != "" && $_SESSION['rol'] == 0) {
    $IdUser     = $_SESSION['IdUser'];
    $email      = $_SESSION['emailUser'];
    $rolUser     = $_SESSION['rol'];
?>
    <!DOCTYPE html>
    <html lang="es">
    <?php
    include('bases/head.html');
    include('bases/toastr.html');
    ?>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <body>
        <?php
        include('../msjs.php');
        include('bases/loader.html');
        ?>
        <div class="container-scroller">
            <?php include 'bases/navbar.php'; ?>
            <div class="container-fluid page-body-wrapper">
                <?php include 'bases/nav.php';
                include 'funciones.php';
                $mis_reservas = getReservaPerfil($con, $IdUser);
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title text-center mb-4" id="title_tabla_reservas">Mis Reservas
                                            <hr>
                                        </h4>
                                        <div class="table-responsive">
                                            <table id="MiTabla" class="table">
                                                <thead>
                                                    <tr>
                                                        <th id="th_numeroReserva">Nº Reserva</th>
                                                        <th id="th_fechaEntrega">Fecha de entrega</th>
                                                        <th id="th_horaEntrega">hora entrega</th>
                                                        <th id="th_fechaRecogida">Fecha de recogida</th>
                                                        <th id="th_horaRecogida">Hora de recogida</th>
                                                        <th id="th_plaza">Tipo de plaza</th>
                                                        <th id="th_terminalEntrega">Terminal de entrega</th>
                                                        <th id="th_terminalRecogida">Terminal de recogida</th>
                                                        <th id="th_matricula">Matrícula</th>
                                                        <th id="th_pdf">Reserva PDF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($reserva = mysqli_fetch_array($mis_reservas)) { ?>
                                                        <tr>
                                                            <td><?php
                                                                $reserva_id = $reserva["id_reserva"];
                                                                if ($reserva_id < 10) {
                                                                    echo 'R-00' . $reserva_id;
                                                                } elseif ($reserva_id < 100) {
                                                                    echo 'R-0' . $reserva_id;
                                                                } else {
                                                                    echo 'R-' . $reserva_id;
                                                                }
                                                                ?></td>
                                                            <td><?php echo $reserva["fecha_entrega"]; ?></td>
                                                            <td><?php echo $reserva["hora_entrega"]; ?></td>
                                                            <td><?php echo $reserva["fecha_recogida"]; ?></td>
                                                            <td><?php echo $reserva["hora_recogida"]; ?></td>
                                                            <td><?php echo $reserva["tipo_plaza"]; ?></td>
                                                            <td><?php echo $reserva["terminal_entrega"]; ?></td>
                                                            <td><?php echo $reserva["terminal_recogida"]; ?></td>
                                                            <td><?php echo $reserva["matricula_car"]; ?></td>
                                                            <td>
                                                                <a href="ReservaPDF.php?idReserva=<?php echo $reserva_id; ?>" title="Descargar Reserva en PDF">
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
        </div>

        <?php include 'bases/PageJs.html'; ?>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"></script>
        <?php
        if ($rolUser == 0) { ?>
            <script src="../assets/custom/js/idiomaDashboard.js"></script>
        <?php } ?>
        <script>
            $(document).ready(function() {
                let idiomaActivo = localStorage.getItem("idioma");
                let tablaEspanol = "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json";
                let tablaIngles = "//cdn.datatables.net/plug-ins/1.10.25/i18n/English.json";

                let languageConfig = {
                    url: idiomaActivo === "es" ? tablaEspanol : tablaIngles
                };

                $("#MiTabla").DataTable({
                    language: languageConfig
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