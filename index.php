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

  /* Agrega el estilo para el fondo específico */
  .background-div {
    background-image: url('assets/custom/imgs/login.jpg');
    /* Reemplaza con la ruta de tu imagen */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: white;
    /* Asegura que el texto sea visible en la imagen de fondo */
    border-radius: 10px;
    min-height: 60vh;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
</style>

<body>
  <?php
  include('msjs.php');
  include("dashboard/bases/loader.html");
  ?>

  <div class="container-fluid" style="max-width: 80% !important; margin: 0 auto !important;">
    <div class="row  align-items-center min-vh-100 auth">
      <div class="col-md-5 mt-5 mb-5">
        <div class="auth-form-light text-left py-5 px-4">
          <div class="brand-logo text-center mb-4">
            <a href="./">
              <img src="assets/custom/imgs/logo_naranja.png" alt="logo" />
            </a>
          </div>
          <h2 class="text-center mb-4">Iniciar Sesión</h2>
          <form action="acciones/login/acciones_login.php" method="post" class="pt-3" autocomplete="off">
            <div class="form-group">
              <input type="email" name="emailUser" class="form-control form-control-lg" required placeholder="Email" />
            </div>
            <div class="form-group">
              <input type="password" name="passwordUser" class="form-control form-control-lg" placeholder="Clave" required />
            </div>
            <div class="mt-3">
              <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                Iniciar sesión
              </button>
            </div>
            <div class="text-center mt-4 font-weight-light">
              ¿Nuevo aquí? <a href="crearCuenta.php" class="text-primary">Crear una cuenta</a>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-7 mb-5 text-center background-div img-fluid">
        <h1 class="mt-5">¡Únete a nosotros ahora y crea tu cuenta en segundos!</h1>
      </div>
    </div>
  </div>

  <?php include('basesLogin/footerJS.html'); ?>
</body>

</html>