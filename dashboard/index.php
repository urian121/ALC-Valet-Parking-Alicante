<?php
session_start();
if (isset($_SESSION['emailUser']) != "") {
  include('../config/config.php');
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
  <style>
    .gj-picker-md table tr td.today div {
      color: #BDBDBD;
    }
  </style>

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
        include 'selectDate.php';
        ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <?php
            if ($rolUser == 0) { ?>
              <div class="row justify-content-md-center">
                <div class="col-md-8 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h1 class="card-title text-center mb-5">Crea tu reserva aquí en segundos
                        <hr>
                      </h1>

                      <form action="funciones.php" method="post" autocomplete="off">
                        <input type="text" name="accion" value="crearReservaClienteDashboard" hidden>
                        <input type="text" name="email_cliente" value="<?php echo $email; ?>" hidden>
                        <input type="text" name="IdUser" value="<?php echo $IdUser; ?>" hidden>
                        <div class="row mb-2">
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="fecha-entrega">Fecha de entrega</label>
                            <input type="text" name="fecha_entrega" id="fecha_entrega" class="borderInput form-control form-control-lg campo_obligatorio" required />
                          </div>
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="hora_entrega">Hora de entrega</label>
                            <select name="hora_entrega" id="hora_entrega" class="form-control form-control-lg campo_obligatorio" required>
                              <option value="" selected="">Seleccione</option>
                              <?php echo generarOpcionesDeHora(); ?>
                            </select>
                          </div>
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="fecha-recogida">Fecha de recogida</label>
                            <input type="text" name="fecha_recogida" id="fecha_recogida" class="borderInput form-control form-control-lg campo_obligatorio" />
                          </div>
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="hora-recogida">Hora de recogida</label>
                            <select name="hora_recogida" class="form-control form-control-lg campo_obligatorio">
                              <option value="No la sé" selected="">No la sé</option>
                              <?php echo generarOpcionesDeHora(); ?>
                            </select>
                          </div>
                        </div>

                        <div class="row mb-2">
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="">Tipo de plaza</label>
                            <select name="tipo_plaza" id="tipo_plaza" class="form-control form-control-lg campo_obligatorio" required>
                              <option value="" selected>Seleccione</option>
                              <option value="Plaza Aire Libre">Plaza Aire Libre</option>
                              <option value="Plaza Cubierto">Plaza Cubierto</option>
                            </select>
                          </div>
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="">Terminal de entrega</label>
                            <select name="terminal_entrega" class="form-control form-control-lg campo_obligatorio" required>
                              <option value="" selected>Seleccione</option>
                              <option value="Aeropuerto de Alicante">Aeropuerto de Alicante</option>
                            </select>
                          </div>
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="">Terminal de recogida</label>
                            <select name="terminal_recogida" class="form-control form-control-lg campo_obligatorio" required>
                              <option value="" selected>Seleccione</option>
                              <option value="Aeropuerto de Alicante">Aeropuerto de Alicante</option>
                            </select>
                          </div>
                          <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="">Matrícula</label>
                            <input type="text" name="matricula" class="form-control form-control-lg campo_obligatorio" required />
                          </div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-12 col-md-4 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="">Color</label>
                            <input type="text" name="color" class="form-control form-control-lg campo_obligatorio" required />
                          </div>
                          <div class="col-md-6 mb-2">
                            <label for="">Marca - Modelo</label>
                            <input type="text" name="marca_modelo" class="form-control form-control-lg campo_obligatorio" required />
                          </div>

                          <div class="col-12 col-md-4 col-lg-6 col-xl-3 col-xxl-3 mb-2">
                            <label for="">Nº Vuelo de Vuelta</label>
                            <input type="text" name="numero_vuelo_de_vuelta" class="form-control form-control-lg campo_obligatorio" />
                          </div>
                        </div>

                        <div class="row mb-2">
                          <div class="col-md-6 mb-2">
                            <label for="observacion_cliente">Observaciones</label>
                            <div class="form-floating">
                              <textarea class="form-control" name="observacion_cliente" style="height: 100px"></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                          <button type="submit" class="btn btn-primary mr-2">Crear mi Reserva Ahora</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>


    <?php include 'bases/PageJs.html'; ?>
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