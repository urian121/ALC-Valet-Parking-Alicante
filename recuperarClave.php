<!DOCTYPE html>
<html lang="es">
<?php include('basesLogin/head.php'); ?>

<body>
  <?php
  include('msjs.php');
  include("dashboard/bases/loader.html");
  include("headerIdioma.html");
  ?>


  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row mt-5 w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4">
              <div class="brand-logo text-center mb-4">
                <a href="./">
                  <img src="assets/custom/imgs/logo_naranja.png" alt="logo" />
                </a>
              </div>
              <h2 class="text-center mb-4" id="recovery_pass_title">Recuperar Clave
                <hr>
              </h2>
              <form action="acciones/login/RecoveryPass.php" method="post" autocomplete="off">
                <div class="row mb-2">
                  <div class="col-md-12 mb-2">
                    <input type="email" name="emailUser" id="emailUser" class="form-control form-control-lg" placeholder="Email" required />
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" id="btn_recovery">
                    Recuperar mi clave
                  </button>
                </div>
                <div class="mt-3 my-2 d-flex justify-content-start align-items-center">
                  <a href="./" class="auth-link text-black" title="volver">
                    <i class="bi bi-arrow-left-circle"></i>
                    <span id="back">Volver</span>
                  </a>
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