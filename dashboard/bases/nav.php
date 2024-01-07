<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <?php
    if ($rolUser == 1) { ?>
      <li class="nav-item">
        <a class="nav-link" href="CrearReserva.php">
          <img src="../assets/custom/imgs/carro.png" alt="car" style="padding: 0px 10px 0px 0px" />
          <span class="menu-title">Crear Reserva</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="CrearCliente.php">
          <i class="bi bi-person-fill-add menu-icon"></i>
          <span class="menu-title">Clientes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
          <i class="bi bi-alarm menu-icon"></i>
          <span class="menu-title">Estancias</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="error">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="EstanciasEntradas.php"> Estancias de Entradas </a></li>
            <li class="nav-item"> <a class="nav-link" href="EstanciasSalidas.php"> Estancias de Salidas </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="HistorialReservas.php">
          <i class="bi bi-calendar3 menu-icon"></i>
          <span class="menu-title">Historial de Reservas</span>
        </a>
      </li>
    <?php } else { ?>
      <li class="nav-item active">
        <a class="nav-link" href="./">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title">Inicio</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Reservas.php">
          <img src="../assets/custom/imgs/carro.png" alt="car" style="padding: 0px 10px 0px 0px" />
          <span class="menu-title">Mis Reservas</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>