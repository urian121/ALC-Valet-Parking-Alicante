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
                $mis_reservas = getAllAgendaDiaria($con);
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title text-center mb-4" style="font-size: 30px;">Agenda diaria
                                            <hr>
                                        </h2>
                                        <div class="table-responsive">
                                            <table id="tablaHistorialReservas" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha Entrada</th>
                                                        <th>Hora Entrada</th>
                                                        <th>Fecha Salida</th>
                                                        <th>Hora Salida</th>
                                                        <th>Cliente</th>
                                                        <th>Teléfono</th>
                                                        <th>Matrícula</th>
                                                        <th>Marca - Modelo</th>
                                                        <th>Precio</th>
                                                        <th>Número Vuelo</th>
                                                        <th>Observaciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($reserva = mysqli_fetch_array($mis_reservas)) {
                                                        $reserva_id = $reserva["id_reserva"]; ?>
                                                        <tr id="<?php echo $reserva_id; ?>">
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
            $(document).ready(function() {
                $("#tablaHistorialReservas").DataTable({
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