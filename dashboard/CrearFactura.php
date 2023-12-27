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
        $idReserva = $_GET['idReserva'] ?? null;
        if ($idReserva == null) {
            header("Location: https://alcvaletparking.com/");
            exit();
        }

        include('bases/head.html');
        include('bases/toastr.html');
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
                $miReserva = crearFacturaCliente($con, $idReserva);
                $fechaRecogida = $miReserva['fecha_recogida'];
                if ($miReserva == 0) { ?>
                    <meta http-equiv="refresh" content="0;URL='https://alcvaletparking.com/'" />
                <?php exit();
                } ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center">
                            <div class="col-lg-7 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title text-center mb-4" style="font-size: 30px;">
                                            <span style="float: left;">
                                                <a href="EstanciasEntradas.php" title="Volver">
                                                    <i class="bi bi-arrow-left-circle"></i>
                                                </a>
                                            </span>
                                            Crear Factura
                                            <hr>
                                        </h2>
                                        <div class="row mb-2 justify-content-between">
                                            <div class="col-md-6 mb-2">
                                                Cliente:
                                                <strong> <?php echo $miReserva['nombre_completo']; ?></strong>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                DNI / CIF:
                                                <strong> <?php echo $miReserva['din']; ?>
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="row mb-2 justify-content-between">
                                            <div class="col-md-6 mb-2">
                                                Matrícula:
                                                <strong> <?php echo $miReserva['matricula']; ?></strong>
                                            </div>
                                            <?php
                                            if ($fechaRecogida != 'Sin definir') { ?>
                                                <div class="col-md-6 mb-2">
                                                    Deuda estancia:
                                                    <strong> <?php echo $miReserva['total_pago_reserva']; ?>
                                                        <i class="bi bi-currency-euro"></i>
                                                    </strong>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-6 mb-2">
                                                    Fecha de entrega: <?php echo date("d/m/Y", strtotime($miReserva["fecha_entrega"])); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        if ($fechaRecogida == 'Sin definir') { ?>
                                            <div class="row mb-2 justify-content-between">
                                                <div class="col-md-12 mb-2">
                                                    <h3 class="text-center mb-3" style="color: red;">
                                                        <div class="alert alert-warning" role="alert">
                                                            Debe asignar una fecha de recogida para poder generar la factura
                                                        </div>
                                                    </h3>
                                                    <form action="AsignarFechaRecogida.php" method="post">
                                                        <input type="hidden" name="idReserva" value="<?php echo $idReserva; ?>">
                                                        <input type="text" name="fechaEntrega" value="<?php echo $miReserva['fecha_entrega']; ?>" hidden>
                                                        <input type="text" name="tipoPlaza" value="<?php echo $miReserva['tipo_plaza']; ?>" hidden>
                                                        <input type="text" name="total_gasto_extras1" value="<?php echo $miReserva['total_gasto_extras1']; ?>" hidden>
                                                        <input type="text" name="total_gasto_extras2" value="<?php echo $miReserva['total_gasto_extras2']; ?>" hidden>
                                                        <input type="text" name="total_gasto_extras3" value="<?php echo $miReserva['total_gasto_extras3']; ?>" hidden>
                                                        <input type="text" name="descuento" value="<?php echo $miReserva['descuento']; ?>" hidden>


                                                        <div class="row justify-content-center mb-2">
                                                            <div class="col-md-5 mb-2">
                                                                <label for="fecha-recogida">Fecha de recogida</label>
                                                                <input type="text" name="fechaRecogida" id="fecha_entrega_admin" style="border: 1px solid #ee0606 !important;" class="borderInput form-control form-control-lg" required />
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <button type="submit" class="btn btn-primary">Asignar fecha</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <hr>
                                            <form action="RecibeCrearFactura.php" method="post" autocomplete="off">
                                                <input type="hidden" name="idReserva" value="<?php echo $idReserva; ?>">
                                                <input type="text" name="deuda" value="<?php echo $miReserva['total_pago_reserva']; ?>" hidden>
                                                <input type="text" name="emailCliente" value="<?php echo $miReserva['emailUser']; ?>" hidden>

                                                <div class="row mb-2">
                                                    <div class="col-md-5 mb-2">
                                                        <div class="form-floating mb-2">
                                                            <label for="formato_pago">Formato de Pago</label>
                                                            <?php
                                                            $tiposDePago = array(
                                                                "Transferencia Bancaria",
                                                                "Tarjeta Bancaria",
                                                                "Pago con Tarjeta de Crédito/Débito",
                                                                "Efectivo"
                                                            ); ?>
                                                            <select name="formato_pago" class="form-control form-control-lg" required>
                                                                <option value="" selected="">Seleccione</option>
                                                                <?php
                                                                foreach ($tiposDePago as $tipo) {
                                                                    echo "<option value=\"$tipo\">$tipo</option>";
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-9 mb-2">
                                                        <div class="form-floating mb-2">
                                                            <label for="servicios_extras1">Servicios adicional 1</label>
                                                            <textarea class="form-control" name="servicios_extras1"><?php echo $miReserva['servicios_extras1']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <div class="mb-3">
                                                            <label for="total_gasto_extras1" class="form-label">
                                                                Total gasto adicional 1
                                                                <i class="bi bi-currency-euro"></i></label>
                                                            <input type="text" name="total_gasto_extras1" value="<?php echo $miReserva['total_gasto_extras1']; ?>" oninput="formatCurrency(this)" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-9 mb-2">
                                                        <div class="form-floating mb-2">
                                                            <label for="servicios_extras2">Servicios adicional 2</label>
                                                            <textarea class="form-control" name="servicios_extras2"><?php echo $miReserva['servicios_extras2']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <div class="mb-3">
                                                            <label for="total_gasto_extras2" class="form-label">
                                                                Total gasto adicional 2
                                                                <i class="bi bi-currency-euro"></i></label>
                                                            <input type="text" name="total_gasto_extras2" value="<?php echo $miReserva['total_gasto_extras2']; ?>" oninput="formatCurrency(this)" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-9 mb-2">
                                                        <div class="form-floating mb-2">
                                                            <label for="servicios_extras3">Servicios adicional 3</label>
                                                            <textarea class="form-control" name="servicios_extras3"><?php echo $miReserva['servicios_extras3']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-2">
                                                        <div class="mb-3">
                                                            <label for="total_gasto_extras3" class="form-label">
                                                                Total gasto adicional 3
                                                                <i class="bi bi-currency-euro"></i></label>
                                                            <input type="text" name="total_gasto_extras3" value="<?php echo $miReserva['total_gasto_extras3']; ?>" oninput="formatCurrency(this)" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-9 mb-2">
                                                        <label for="observacion_cliente">Observaciones</label>
                                                        <div class="form-floating">
                                                            <textarea class="form-control" name="observacion_cliente" style="height: 130px"><?php echo $miReserva['observacion_cliente']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <a class="btn btn-secondary" href="EstanciasEntradas.php" title="Volver">
                                                        Cancelar
                                                    </a>
                                                    <button type="submit" class="btn btn-primary">Crear factura</button>
                                                </div>
                                            </form>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                            <?php if ($fechaRecogida != 'Sin definir') { ?>
                                <div class="col-md-5">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <h2 class="mb-4 text-center">Resumen Factura
                                                <hr>
                                            </h2>
                                            <?php
                                            $deudaTotalGatosExtra = 0;
                                            for ($i = 1; $i <= 3; $i++) {
                                                $total_gasto_extra = isset($miReserva["total_gasto_extras{$i}"]) ? trim($miReserva["total_gasto_extras{$i}"]) : 0;
                                                if ($total_gasto_extra !== "") {
                                                    $deudaTotalGatosExtra = number_format(($deudaTotalGatosExtra + $total_gasto_extra), 2, '.', '');
                                                }
                                            }
                                            $totalDeudaClienteSinDescuento = number_format(($miReserva['total_pago_reserva'] + $deudaTotalGatosExtra), 2, '.', '');

                                            $descuento = trim($miReserva['descuento']);
                                            $total_pago_final_pagar = 0;
                                            if ($descuento != 0) {
                                                // Aplica el descuento
                                                $total_pago_final_pagar = number_format($totalDeudaClienteSinDescuento - ($totalDeudaClienteSinDescuento * ($descuento / 100)), 2, '.', '');
                                            }
                                            ?>

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Fecha Entrada: &nbsp; &nbsp;<?php echo date("d/m/Y", strtotime($miReserva["fecha_entrega"])); ?></li>
                                                <li class="list-group-item">Fecha Recogida: &nbsp; &nbsp;
                                                    <?php
                                                    echo ($miReserva["fecha_recogida"] != 'Sin definir' ? date("d/m/Y", strtotime($miReserva["fecha_recogida"])) : $miReserva["fecha_recogida"]);
                                                    ?>
                                                </li>
                                                <li class="list-group-item">Días de estancia: &nbsp; &nbsp;<?php echo $miReserva['total_dias_reserva']; ?></li>
                                                <li class="list-group-item">Plaza: &nbsp; &nbsp;<?php echo $miReserva['tipo_plaza']; ?></li>
                                                <li class="list-group-item">Deuda sin gasto adicional: &nbsp; &nbsp;<?php echo $miReserva['total_pago_reserva']; ?> <i class="bi bi-currency-euro"></i></li>
                                                <li class="list-group-item">Total gasto adicional 1: &nbsp; &nbsp;<?php echo $miReserva['total_gasto_extras1']; ?> <i class="bi bi-currency-euro"></i></li>
                                                <li class="list-group-item">Total gasto adicional 2: &nbsp; &nbsp;<?php echo $miReserva['total_gasto_extras2']; ?> <i class="bi bi-currency-euro"></i></li>
                                                <li class="list-group-item">Total gasto adicional 3: &nbsp; &nbsp;<?php echo $miReserva['total_gasto_extras3']; ?> <i class="bi bi-currency-euro"></i></li>
                                                <li class="list-group-item">Descuento: &nbsp; &nbsp;<strong> <?php echo $descuento; ?> %</strong></li>
                                                <li class="list-group-item">Total Deuda: &nbsp; &nbsp;<strong> <?php echo $total_pago_final_pagar; ?> <i class="bi bi-currency-euro"></i></strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'bases/PageJs.html'; ?>
        <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
        <script src="https://unpkg.com/gijgo@1.9.14/js/messages/messages.es-es.js" type="text/javascript"></script>
        <script src="../assets/custom/js/custom_date_time.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('ok');
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