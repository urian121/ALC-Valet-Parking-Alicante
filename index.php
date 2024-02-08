<?php
session_start();
if (isset($_SESSION['emailUser']) != "") {
  include('../config/config.php');
  $IdUser     = $_SESSION['IdUser'];
  $rolUser     = $_SESSION['rol'];
  $email      = $_SESSION['emailUser'];
  header('location: dashboard/');
}
?>
<!DOCTYPE html>
<html lang="es">
<?php include('basesLogin/head.php'); ?>
<style>
  body {
    background-color: #f5f7ff !important;
  }
</style>

<body>
  <?php
  include('msjs.php');
  include("dashboard/bases/loader.html");
  include("headerIdioma.html");
  ?>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4">
              <div class="brand-logo text-center mb-4">
                <a href="./">
                  <img src="assets/custom/imgs/logo_naranja.png" alt="logo" />
                </a>
              </div>
              <h2 class="text-center mb-4" id="loginTitle">Iniciar Sesión</h2>
              <form action="acciones/login/acciones_login.php" method="post" class="pt-3" autocomplete="off">
                <div class="form-group">
                  <input type="email" name="emailUser" class="form-control form-control-lg" required placeholder="Email" />
                </div>
                <div class="form-group">
                  <input type="password" name="passwordUser" class="form-control form-control-lg" placeholder="Password" required />
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="loginBtn">
                    Entrar
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  <span id="register">¿Nuevo aquí?</span>
                  <a href="crearCuenta.php" class="text-primary" id="create_account">Crear una cuenta</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  <span id="old_pass">¿Olvidaste tu clave?</span>
                  <a href="recuperarClave.php" class="text-primary" id="link_recovery">Recuperar clave aquí</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('basesLogin/footerJS.html'); ?>
</body>

</html>