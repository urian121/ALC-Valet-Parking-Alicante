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
                $clientesBD = getClientes($con);
                if (isset($_GET['idCliente'])) {
                    $idCliente = $_GET['idCliente'];
                    $infoCliente = infoClienteBD($con, $idCliente);
                }
                ?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row justify-content-md-center">
                            <div class="col-md-5 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="auth-form-light py-2 px-4">
                                            <h1 class="card-title text-center mb-4">Crear Cuenta Cliente
                                                <hr>
                                            </h1>
                                            <form action="funciones.php" method="post" autocomplete="off">
                                                <input type="text" name="accion" value="<?php echo isset($infoCliente['IdUser']) ? 'actualizarClienteAdmin' : 'crearCliente'; ?>" hidden>
                                                <?php if (isset($infoCliente['IdUser'])) { ?>
                                                    <input type="text" name="IdUser" value="<?php echo $infoCliente['IdUser']; ?>" hidden>
                                                <?php } ?>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" name="nombre_completo" class="form-control form-control-lg" required="" placeholder="Nombre completo / Razón social" value="<?php echo isset($infoCliente['nombre_completo']) ? $infoCliente['nombre_completo'] : ''; ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="din" class="form-control form-control-lg" placeholder="DNI / CIF" value="<?php echo isset($infoCliente['din']) ? $infoCliente['din'] : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="direccion_completa" class="form-control form-control-lg" placeholder="Dirección completa" value="<?php echo isset($infoCliente['direccion_completa']) ? $infoCliente['direccion_completa'] : ''; ?>">
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="password" name="passwordUser" class="form-control form-control-lg" placeholder="Clave" <?php (isset($infoCliente['IdUser'])) ? '' : 'required'; ?>>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <input type="email" name="emailUser" class="form-control form-control-lg" placeholder="Email" value="<?php echo isset($infoCliente['emailUser']) ? $infoCliente['emailUser'] : ''; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 mb-2">
                                                        <input type="text" name="tlf" class="form-control form-control-lg" placeholder="Teléfono" value="<?php echo isset($infoCliente['tlf']) ? $infoCliente['tlf'] : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="observaciones" placeholder="Observaciones" style="height: 140px"><?php echo isset($infoCliente['observaciones']) ? $infoCliente['observaciones'] : ''; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3 class="text-center">Datos del Vehiculo
                                                            <hr>
                                                        </h3>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="marca_car" class="form-control form-control-lg campo_obligatorio" placeholder="Marca" value="<?php echo isset($infoCliente['marca_car']) ? $infoCliente['marca_car'] : ''; ?>" required />
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="modelo_car" class="form-control form-control-lg campo_obligatorio" placeholder="Modelo" value="<?php echo isset($infoCliente['modelo_car']) ? $infoCliente['modelo_car'] : ''; ?>" required />
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="color_car" class="form-control form-control-lg campo_obligatorio" placeholder="Color" value="<?php echo isset($infoCliente['color_car']) ? $infoCliente['color_car'] : ''; ?>" required />
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <input type="text" name="matricula_car" class="form-control form-control-lg campo_obligatorio" placeholder="Matrícula" <?php echo isset($infoCliente['matricula_car']) ? 'readonly' : ''; ?> value="<?php echo isset($infoCliente['matricula_car']) ? $infoCliente['matricula_car'] : ''; ?>" required />
                                                </div>

                                                <div class="mt-3">
                                                    <?php if (isset($infoCliente['IdUser'])) { ?>
                                                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                                            Actualizar Cliente
                                                        </button>
                                                    <?php } else { ?>
                                                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                                            Registrar Cliente
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
                                        <h1 class="text-center mb-4">Lista de Clientes
                                            <hr>
                                        </h1>
                                        <div class="table-responsive">
                                            <table id="MiTabla" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Cliente</th>
                                                        <th>DNI / CIF</th>
                                                        <th>Email</th>
                                                        <th>Teléfono</th>
                                                        <th>Dirección</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = mysqli_fetch_array($clientesBD)) { ?>
                                                        <tr>
                                                            <td class="custom_td"><?php echo $row["nombre_completo"]; ?></td>
                                                            <td class="custom_td"><?php echo $row["din"]; ?></td>
                                                            <td class="custom_td"><?php echo $row["emailUser"]; ?></td>
                                                            <td class="custom_td"><?php echo $row["tlf"]; ?></td>
                                                            <td class="custom_td"><?php echo $row["direccion_completa"]; ?></td>
                                                            <td class="custom_td">
                                                                <a href="CrearCliente.php?idCliente=<?php echo $row["IdUser"]; ?>" class="btn btn-info btn_padding">
                                                                    <i class="bi bi-pencil"></i>
                                                                    Editar
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
        <script>
            $(document).ready(function() {
                $("#MiTabla").DataTable({
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