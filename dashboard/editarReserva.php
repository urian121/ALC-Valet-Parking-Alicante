<?php
session_start();
if (isset($_SESSION['emailUser']) != "" && $_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    $IdUser     = $_SESSION['IdUser'];
    $rolUser     = $_SESSION['rol'];
    $email      = $_SESSION['emailUser'];
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
            <?php include 'bases/navbar.php' ?>
            <div class="container-fluid page-body-wrapper">
                <?php
                include 'bases/nav.php';
                include 'funciones.php';
                include 'selectDate.php';
                $clientesBD = getClientes($con);
                if (isset($_GET['idReserva'])) {
                    $idReserva = $_GET['idReserva'];
                    $infoReserva = getReservaID($con, $idReserva);
                }
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="card-title text-center mb-5">
                                            <a href="EstanciasSalidas.php" class="float-left" title="Volver">
                                                <i class="bi bi-arrow-left-circle"></i>
                                            </a>
                                            Editar Reserva
                                            <hr>
                                        </h2>

                                        <form action="RecibeUpdateReserva.php" method="post" autocomplete="off">
                                            <input type="hidden" name="emailUser" id="emailUser" value="<?php echo $infoReserva['emailUser']; ?>" />
                                            <input type="hidden" name="idReserva" id="idReserva" value="<?php echo $idReserva; ?>" />
                                            <div class="row mb-2">
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="IdUser">Asignar Clientes</label>
                                                    <select name="IdUser" onchange="selectCliente(this.value)" class="form-control form-control-lg" required>
                                                        <option value="" <?php echo ($infoReserva['IdUser'] == '') ? 'selected' : ''; ?>>Seleccione</option>
                                                        <?php
                                                        while ($cliente = mysqli_fetch_array($clientesBD)) {
                                                            $selected = ($infoReserva['IdUser'] == $cliente["IdUser"]) ? 'selected' : '';
                                                        ?>
                                                            <option value="<?php echo $cliente["IdUser"]; ?>" <?php echo $selected; ?>>
                                                                DNI /CIF : <?php echo $cliente["din"]; ?> - <?php echo $cliente["nombre_completo"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="fecha-entrega">Fecha de entrega</label>
                                                    <input type="text" name="fecha_entrega" id="fecha_entrega_admin" value="<?php echo $infoReserva['fecha_entrega']; ?>" class="borderInput form-control form-control-lg" required />
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="hora_entrega">Hora de entrega</label>
                                                    <select name="hora_entrega" id="hora_entrega_admin" class="form-control form-control-lg" required>
                                                        <option value="No la sé" <?php echo ($infoReserva['hora_entrega'] == 'No la sé') ? 'selected' : ''; ?>>No la sé</option>
                                                        <?php
                                                        for ($hour = 5; $hour <= 24; $hour++) {
                                                            for ($minute = 0; $minute <= 50; $minute += 10) {
                                                                $hourString = sprintf("%02d", $hour) . ":" . sprintf("%02d", $minute) . ":00"; // Añade los segundos al formato de tiempo
                                                        ?>
                                                                <option value="<?php echo $hourString; ?>" <?php echo ($infoReserva['hora_entrega'] == $hourString) ? 'selected' : ''; ?>><?php echo $hourString; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="fecha-recogida">Fecha de recogida</label>
                                                    <input type="text" name="fecha_recogida" id="fecha_recogida_admin" value="<?php echo $infoReserva['fecha_recogida']; ?>" class="borderInput form-control form-control-lg" />
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="hora-recogida">Hora de recogida</label>
                                                    <select name="hora_recogida" id="hora_recogida" class="form-control form-control-lg">
                                                        <option value="No la sé" <?php echo ($infoReserva['hora_recogida'] == 'No la sé') ? 'selected' : ''; ?>>No la sé</option>
                                                        <?php
                                                        for ($hour = 5; $hour <= 24; $hour++) {
                                                            for ($minute = 0; $minute <= 50; $minute += 10) {
                                                                $hourString = sprintf("%02d", $hour) . ":" . sprintf("%02d", $minute);
                                                        ?>
                                                                <option value="<?php echo $hourString; ?>" <?php echo ($infoReserva['hora_recogida'] == $hourString) ? 'selected' : ''; ?>><?php echo $hourString; ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="tipo_plaza">Tipo de plaza</label>
                                                    <select name="tipo_plaza" id="tipo_plaza" class="form-control form-control-lg" required>
                                                        <option value="" <?php if ($infoReserva['tipo_plaza'] == '') echo 'selected'; ?>>Seleccione</option>
                                                        <option value="Plaza Aire Libre" <?php if ($infoReserva['tipo_plaza'] == 'Plaza Aire Libre') echo 'selected'; ?>>Plaza Aire Libre</option>
                                                        <option value="Plaza Cubierto" <?php if ($infoReserva['tipo_plaza'] == 'Plaza Cubierto') echo 'selected'; ?>>Plaza Cubierto</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="terminal_entrega">Terminal de entrega</label>
                                                    <input type="text" name="terminal_entrega" class="form-control form-control-lg" value="<?php echo $infoReserva['terminal_entrega']; ?>" required />
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="terminal_recogida">Terminal de recogida</label>
                                                    <input type="text" name="terminal_recogida" class="form-control form-control-lg" value="<?php echo $infoReserva['terminal_recogida']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="matricula_car">Matrícula</label>
                                                    <input type="text" name="matricula_car" class="form-control form-control-lg" value="<?php echo $infoReserva['matricula_car']; ?>" required readonly />
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="color_car">Color</label>
                                                    <input type="text" name="color_car" class="form-control form-control-lg" value="<?php echo $infoReserva['color_car']; ?>" require />
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="marca_car">Marca</label>
                                                    <input type="text" name="marca_car" class="form-control form-control-lg" value="<?php echo $infoReserva['marca_car']; ?>" required />
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="modelo_car">Modelo</label>
                                                    <input type="text" name="modelo_car" class="form-control form-control-lg" value="<?php echo $infoReserva['modelo_car']; ?>" required />
                                                </div>
                                                <div class="col-12 col-md-4 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="numero_vuelo_de_vuelta">Nº Vuelo de Vuelta</label>
                                                    <input type="text" name="numero_vuelo_de_vuelta" class="form-control form-control-lg" value="<?php echo $infoReserva['numero_vuelo_de_vuelta']; ?>" />
                                                </div>

                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="descuento">Aplicar Descuento %</label>
                                                    <input type="number" name="descuento" id="descuento" value="<?php echo $infoReserva['descuento']; ?>" class="form-control form-control-lg" />
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="servicio_adicional">Servicios Adicionales</label>
                                                    <?php echo $infoReserva['servicio_adicional']; ?>
                                                    <div class="mb-3 form-check">
                                                        <input type="checkbox" name="servicio_adicional" id="servicio_adicional" class="form-check-input" style="margin-left: 0;" value="Si" <?php echo ($infoReserva['servicio_adicional'] == 'Si') ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="servicio_adicional">Lavado Exterior Básico (Gratuito)</label>
                                                    </div>

                                                </div>
                                                <div class="col-4 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="idiomaCliente">Idioma del Cliente</label>
                                                    <select name="idiomaCliente" id="idiomaCliente" class="form-control form-control-lg" required>
                                                        <option value="" selected>Seleccione</option>
                                                        <option value="es">Español</option>
                                                        <option value="en">Ingles</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-2">
                                                    <label for="servicios_extras1">
                                                        Servicios adicional <span style="font-size: 20px; font-weight: bold">1</span>
                                                    </label>
                                                    <textarea class="form-control" name="servicios_extras1"><?php echo $infoReserva['servicios_extras1']; ?></textarea>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="total_gasto_extras1" class="form-label">
                                                        Total gasto adicional <span style="font-size: 20px; font-weight: bold">1</span>
                                                    </label>
                                                    <input type="text" name="total_gasto_extras1" value='<?php echo $infoReserva['total_gasto_extras1']; ?>' oninput="formatCurrency(this)" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-2">
                                                    <label for="servicios_extras2">
                                                        Servicios adicional <span style="font-size: 20px; font-weight: bold">2</span>
                                                    </label>
                                                    <textarea class="form-control" name="servicios_extras2"><?php echo $infoReserva['servicios_extras2']; ?></textarea>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="total_gasto_extras2" class="form-label">
                                                        Total gasto adicional <span style="font-size: 20px; font-weight: bold">2</span>
                                                    </label>
                                                    <input type="text" name="total_gasto_extras2" value='<?php echo $infoReserva['total_gasto_extras2']; ?>' oninput="formatCurrency(this)" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-2">
                                                    <label for="servicios_extras3">
                                                        Servicios adicional <span style="font-size: 20px; font-weight: bold">3</span>
                                                    </label>
                                                    <textarea class="form-control" name="servicios_extras3"><?php echo $infoReserva['servicios_extras3']; ?></textarea>
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                                                    <label for="total_gasto_extras3" class="form-label">
                                                        Total gasto adicional <span style="font-size: 20px; font-weight: bold">3</span>
                                                    </label>
                                                    <input type="text" name="total_gasto_extras3" value='<?php echo $infoReserva['total_gasto_extras3']; ?>' oninput="formatCurrency(this)" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6 mb-2">
                                                    <label for="observacion_cliente">Observaciones</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="observacion_cliente" style="height: 130px"><?php echo $infoReserva['observacion_cliente']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-md-center mb-3">
                                                <div class="col-md-6">
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                                            Actualizar Reserva
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'bases/PageJs.html'; ?>
        <script src="../assets/custom/js/reserva.js"></script>
        <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
        <script src="https://unpkg.com/gijgo@1.9.14/js/messages/messages.es-es.js" type="text/javascript"></script>
        <script src="../assets/custom/js/custom_date_time.js"></script>

    </body>

    </html>
<?php
} else { ?>
    <script type="text/javascript">
        location.href = "../acciones/login/exit.php";
    </script>
<?php }  ?>