<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">

    <?php
    if ($rolUser == 1) { ?>
      <li class="nav-item">
        <a class="nav-link" href="AgendaDiaria.php">
          <i class="bi bi-calendar3 menu-icon"></i>
          <span class="menu-title">Agenda diaria</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="CrearReserva.php">
          <img src="../assets/custom/imgs/carro.png" alt="car" style="padding: 0px 10px 0px 0px" />
          <span class="menu-title">Crear Nueva Estancia</span>
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
        <a class="nav-link" href="NuevoUsuario.php">
          <i class="bi bi-person-fill-lock"></i>
          <span class="menu-title">Crear Usuario</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="HistorialReservas.php">
          <img src="../assets/custom/imgs/carro.png" alt="car" style="padding: 0px 10px 0px 0px" />
          <span class="menu-title">Historial Reservas</span>
        </a>
      </li>

    <?php } elseif ($rolUser == 2) { ?>
      <li class="nav-item">
        <a class="nav-link" href="AgendaDiaria.php">
          <i class="bi bi-calendar3 menu-icon"></i>
          <span class="menu-title">Agenda diaria</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="CrearReserva.php">
          <img src="../assets/custom/imgs/carro.png" alt="car" style="padding: 0px 10px 0px 0px" />
          <span class="menu-title">Crear Nueva Estancia</span>
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
    <?php } else { ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <img src="../assets/custom/imgs/carro.png" alt="car" style="padding: 0px 10px 0px 0px" />
          <span class="menu-title" id="linkAddCoche">Registrar mi Coche</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="NuevaReserva.php">
          <i class="icon-grid menu-icon"></i>
          <span class="menu-title" id="linkInicio">Crear Nueva Reserva</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Reservas.php">
          <img src="../assets/custom/imgs/carro.png" alt="car" style="padding: 0px 10px 0px 0px" />
          <span class="menu-title" id="linkReservas">Mis Reservas</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</nav>