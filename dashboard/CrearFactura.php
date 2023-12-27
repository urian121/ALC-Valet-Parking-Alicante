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
                ?>
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
                                            <div class="col-md-6 mb-2">
                                                Deuda:
                                                <strong> <?php echo $miReserva['total_pago_reserva']; ?>
                                                    <i class="bi bi-currency-euro"></i>
                                                </strong>
                                            </div>
                                        </div>
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
    </body>

    </html>
<?php
} else { ?>
    <script type="text/javascript">
        location.href = "../acciones/login/exit.php";
    </script>
<?php }  ?>