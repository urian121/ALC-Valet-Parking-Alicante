<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo mr-5" href="./">
      <img src="../assets/custom/imgs/logo_naranja.png" class="mr-2" alt="logo" />
    </a>
    <a class="navbar-brand brand-logo-mini" href="./">
      <img src="../assets/custom/imgs/logo_naranja.png" alt="logo" />
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <?php
      if ($rolUser == 0) { ?>
        <li class="nav-item">
          <img title="Español" src="../assets/custom/imgs/es.png" alt="Español" onclick="cambiarIdioma('es')" style="width: 30px; display: block; cursor: pointer" />
        </li>
        <li class="nav-item">
          <img title="English" src=" ../assets/custom/imgs/en.png" alt="English" onclick="cambiarIdioma('en')" style="width: 30px; display: block; cursor: pointer" />
        </li>
      <?php } ?>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <i class="bi bi-person-fill perfil_radius"></i>
          <span> <?php echo $email; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a href="MiPerfil.php?C=<?php echo $IdUser; ?>" class="dropdown-item">
            <i class="ti-settings text-primary"></i>
            <span id="spanMiPerfil">Mi Perfil</span>
          </a>
          <a href="../acciones/login/exit.php" class="dropdown-item">
            <i class="ti-power-off text-primary"></i>
            <span id="spanCerrarSesion">Cerrar Sesión</span>
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>