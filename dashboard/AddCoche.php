<?php
session_start();
if (isset($_SESSION['emailUser']) != "" && $_SESSION['rol'] == 0) {
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
                $listaCochesClientes = getCochesClientes($con, $IdUser);
                if (isset($_GET['id'])) {
                    $idCoche = $_GET['id'];
                    $infoCliente = infoCocheBD($con, $idCoche, $IdUser);
                }
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center">
                            <div class="col-md-5 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="auth-form-light py-2 px-4">
                                            <h1 class="card-title text-center mb-4 title_add_coche">Registrar mi Coche
                                                <hr>
                                            </h1>
                                            <form action="funciones.php" method="post" autocomplete="off">
                                                <input type="text" name="idCliente" value="<?php echo $IdUser; ?>" hidden>
                                                <input type="text" name="accion" value="<?php echo isset($infoCliente['IdUser']) ? 'actualizarCocheCliente' : 'registraCocheCliente'; ?>" hidden>
                                                <?php
                                                if (isset($infoCliente['id'])) {
                                                    echo '<input type="text" name="id" value="' . $infoCliente['id'] . '" hidden>';
                                                } ?>

                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="marca_car" id="marca_car_placeholder" class="form-control form-control-lg campo_obligatorio" placeholder="Marca" value="<?php echo isset($infoCliente['marca_car']) ? $infoCliente['marca_car'] : ''; ?>" required />
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="modelo_car" id="modelo_car_placeholder" class="form-control form-control-lg campo_obligatorio" placeholder="Modelo" value="<?php echo isset($infoCliente['modelo_car']) ? $infoCliente['modelo_car'] : ''; ?>" required />
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="color_car" id="color_car_placeholder" class="form-control form-control-lg campo_obligatorio" placeholder="Color" value="<?php echo isset($infoCliente['color_car']) ? $infoCliente['color_car'] : ''; ?>" required />
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="matricula_car" id="matricula_car_placeholder" class="form-control form-control-lg campo_obligatorio" placeholder="Matrícula" value="<?php echo isset($infoCliente['matricula_car']) ? $infoCliente['matricula_car'] : ''; ?>" required />
                                                </div>

                                                <div class="mt-3">
                                                    <?php if (isset($infoCliente['id'])) { ?>
                                                        <button type="submit" id="btn_actualizar_coche" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                                            Actualizar Coche
                                                        </button>
                                                    <?php } else { ?>
                                                        <button type="submit" id="btn_registrar_coche" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                                            Registrar Coche
                                                        </button>
                                                    <?php } ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body mt-3">
                                        <h1 class="text-center mb-4">Mis Coches
                                            <hr>
                                        </h1>
                                        <div class="table-responsive">
                                            <table id="MiTabla_coches" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th id="th_marca">Marca</th>
                                                        <th id="th_modelo">Modelos</th>
                                                        <th id="th_color">Color</th>
                                                        <th id="th_matricula">Matrícula</th>
                                                        <th id="th_acciones">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($listaCochesClientes)) { ?>
                                                        <tr>
                                                            <td class="custom_td"><?php echo $row["marca_car"]; ?></td>
                                                            <td class="custom_td"><?php echo $row["modelo_car"]; ?></td>
                                                            <td class="custom_td"><?php echo $row["color_car"]; ?></td>
                                                            <td class="custom_td"><?php echo $row["matricula_car"]; ?></td>
                                                            <td class="custom_td">
                                                                <a href="AddCoche.php?id=<?php echo $row["id"]; ?>" class="btn btn-info btn_padding">
                                                                    <i class="bi bi-pencil"></i>
                                                                    <span class="btn_edit_car">Editar Coche</span>
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
        <script src=" https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
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

                $("#MiTabla_coches").DataTable({
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