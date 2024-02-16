document.addEventListener("DOMContentLoaded", function () {
  var idiomaGuardado = localStorage.getItem("idioma");
  if (idiomaGuardado) {
    cambiarIdioma(idiomaGuardado);
  }
});

function cambiarIdioma(idioma) {
  /**
   *Modulo registrar carro desde el cliente
   */
  let title_add_coche = {
    es: "Registrar Mi Coche",
    en: "Register My Car",
  };
  let marca_car_placeholder = {
    es: "Marca",
    en: "Car brand",
  };
  let modelo_car_placeholder = {
    es: "Modelo",
    en: "Car model",
  };
  let color_car_placeholder = {
    es: "Color",
    en: "Car color",
  };
  let matricula_car_placeholder = {
    es: "Matricula",
    en: "Car plate",
  };
  let btn_actualizar_coche = {
    es: "Actualizar Coche",
    en: "Update Car",
  };
  let btn_registrar_coche = {
    es: "Registrar Coche",
    en: "Register Car",
  };
  let th_acciones = {
    es: "Acciones",
    en: "Actions",
  };

  let idioma_btn_editar_car = {
    es: "Editar Coche",
    en: "Edit Car",
  };
  let select_coche = {
    es: "Seleccionar Coche",
    en: "Select Car",
  };
  let option_car_one = {
    es: "Selecccioner un Coche",
    en: "Select a Car",
  };

  let btn_edit_car = document.querySelectorAll(".btn_edit_car");
  btn_edit_car.forEach(function (element) {
    element.innerText = idioma_btn_editar_car[idioma];
  });

  let linkInicio = {
    es: "Crear Nueva Reserva",
    en: "Create Reservation",
  };
  let linkAddCoche = {
    es: "Registrar mi Coche",
    en: "Register my car",
  };

  let linkReservas = {
    es: "Mis Reservas",
    en: "My Reservations",
  };

  let spanMiPerfil = {
    es: "Mi Perfil",
    en: "My Profile",
  };

  let spanCerrarSesion = {
    es: "Cerrar Sesión",
    en: "Log out",
  };

  var title_reserva = {
    es: "Crea tu reserva aquí en segundos",
    en: "Create your reservation here in seconds",
  };

  let labelFechaEntrega = {
    es: "Fecha de entrega",
    en: "Delivery date",
  };

  let labelHoraEntrega = {
    es: "Hora de entrega",
    en: "Delivery time",
  };

  let labelFechaRecogida = {
    es: "Fecha de recogida",
    en: "Pick-up date",
  };

  let labelHoraRecogida = {
    es: "Hora de recogida (Aterrizaje)",
    en: "Pick-up time (Landing)",
  };

  let optionNo = {
    es: "No la sé",
    en: "Don't know",
  };

  let labelTipoPlaza = {
    es: "Tipo de plaza",
    en: "Parking type",
  };
  let optionPlazaAireLibre = {
    es: "Plaza de aire libre",
    en: "Outdoor",
  };
  let optionPlazaCubierto = {
    es: "Plaza cubierta",
    en: "Covered parking",
  };
  let valorSeleccione = {
    es: "Seleccione",
    en: "Select",
  };

  let labelTerminalEntrega = {
    es: "Terminal de entrega",
    en: "Delivery terminal",
  };

  let labelTerminalRecogida = {
    es: "Terminal de recogida",
    en: "Pick-up terminal",
  };

  let labelMatricula = {
    es: "Matrícula",
    en: "License plate",
  };

  let labelMarca = {
    es: "Marca",
    en: "Brand",
  };

  let labelModelo = {
    es: "Modelo",
    en: "Model",
  };

  let labelNumeroVuelo = {
    es: "Número Vuelo de Vuelta",
    en: "Return Flight number",
  };

  let labelObservaciones = {
    es: "Observaciones",
    en: "Observations",
  };

  let btnCrearReserva = {
    es: "Crear mi Reserva Ahora",
    en: "Create my Reservation Now",
  };

  /**
   * Tabla lista de reservas
   */
  let title_tabla_reservas = {
    es: "Mis Reservaciones",
    en: "My Reservations",
  };
  let th_numeroReserva = {
    es: "Nº Reserva",
    en: "Reservation Number",
  };
  let th_terminalEntrega = {
    es: "Terminal de entrega",
    en: "Delivery terminal",
  };
  let th_fechaEntrega = {
    es: "Fecha de entrega",
    en: "Delivery date",
  };
  let th_horaEntrega = {
    es: "Hora de entrega",
    en: "Delivery time",
  };
  let th_fechaRecogida = {
    es: "Fecha de recogida",
    en: "Pick-up date",
  };

  let th_horaRecogida = {
    es: "Hora de recogida (Aterrizaje)",
    en: "Pick-up time (Landing)",
  };

  let th_plaza = {
    es: "Tipo de plaza",
    en: "Parking type",
  };
  let th_terminalRecogida = {
    es: "Fecha de recogida",
    en: "Pick-up terminal",
  };
  let th_matricula = {
    es: "Matrímula",
    en: "License Plate",
  };
  let th_pdf = {
    es: "Reserva PDF",
    en: "Reservation PDF",
  };
  let optionAeropuerto = {
    es: "Aeropuerto de Alicante",
    en: "Alicante Airport",
  };

  /**
   * Actualizar Perfil
   */
  let titleUpdatePerfil = {
    es: "Actualizar Mi Perfil",
    en: "Update My Profile",
  };
  let nombre_completo = {
    es: "Nombre Completo",
    en: "Full Name",
  };
  let direccion_completa = {
    es: "Dirección completa",
    en: "Full Address",
  };
  let passwordUser = {
    es: "Nueva Contraseña",
    en: "New Password",
  };
  let tlf = {
    es: "Telefóno",
    en: "Phone",
  };
  let btnUpdate = {
    es: "Actualizar Mi Perfil",
    en: "Update My Profile",
  };
  let btnCancel = {
    es: "Cancelar",
    en: "Cancel",
  };

  // Actualiza el contenido de la página según el idioma seleccionado
  selector("#linkAddCoche")
    ? (selector("#linkAddCoche").innerText = linkAddCoche[idioma])
    : "";
  selector("#linkInicio")
    ? (selector("#linkInicio").innerText = linkInicio[idioma])
    : "";
  selector("#linkReservas")
    ? (selector("#linkReservas").innerText = linkReservas[idioma])
    : "";
  selector("#spanMiPerfil")
    ? (selector("#spanMiPerfil").innerText = spanMiPerfil[idioma])
    : "";
  selector("#spanCerrarSesion")
    ? (selector("#spanCerrarSesion").innerText = spanCerrarSesion[idioma])
    : "";
  selector("#title_reserva")
    ? (selector("#title_reserva").innerText = title_reserva[idioma])
    : "";
  selector(".title_add_coche")
    ? (selector(".title_add_coche").innerText = title_add_coche[idioma])
    : "";
  selector("#labelFechaEntrega")
    ? (selector("#labelFechaEntrega").innerText = labelFechaEntrega[idioma])
    : "";
  selector("#labelHoraEntrega")
    ? (selector("#labelHoraEntrega").innerText = labelHoraEntrega[idioma])
    : "";
  selector("#labelFechaRecogida")
    ? (selector("#labelFechaRecogida").innerText = labelFechaRecogida[idioma])
    : "";
  selector("#labelHoraRecogida")
    ? (selector("#labelHoraRecogida").innerText = labelHoraRecogida[idioma])
    : "";
  selector("#optionNo")
    ? (selector("#optionNo").innerText = optionNo[idioma])
    : "";
  selector("#labelTipoPlaza")
    ? (selector("#labelTipoPlaza").innerText = labelTipoPlaza[idioma])
    : "";
  selector("#optionPlazaAireLibre")
    ? (selector("#optionPlazaAireLibre").innerText =
        optionPlazaAireLibre[idioma])
    : "";
  selector("#optionPlazaCubierto")
    ? (selector("#optionPlazaCubierto").innerText = optionPlazaCubierto[idioma])
    : "";
  selector("#labelTerminalEntrega")
    ? (selector("#labelTerminalEntrega").innerText =
        labelTerminalEntrega[idioma])
    : "";
  selector("#labelTerminalRecogida")
    ? (selector("#labelTerminalRecogida").innerText =
        labelTerminalRecogida[idioma])
    : "";
  selector("#labelMatricula")
    ? (selector("#labelMatricula").innerText = labelMatricula[idioma])
    : "";
  selector("#labelMarca")
    ? (selector("#labelMarca").innerText = labelMarca[idioma])
    : "";
  selector("#labelModelo")
    ? (selector("#labelModelo").innerText = labelModelo[idioma])
    : "";
  selector("#labelNumeroVuelo")
    ? (selector("#labelNumeroVuelo").innerText = labelNumeroVuelo[idioma])
    : "";
  selector("#labelObservaciones")
    ? (selector("#labelObservaciones").innerText = labelObservaciones[idioma])
    : "";
  selector("#btnCrearReserva")
    ? (selector("#btnCrearReserva").innerText = btnCrearReserva[idioma])
    : "";
  selector("#title_tabla_reservas")
    ? (selector("#title_tabla_reservas").innerText =
        title_tabla_reservas[idioma])
    : "";

  document.querySelectorAll("#valorSeleccione")
    ? document
        .querySelectorAll("#valorSeleccione")
        .forEach((element) => (element.innerText = valorSeleccione[idioma]))
    : "";

  document.querySelectorAll("#optionAeropuerto")
    ? document
        .querySelectorAll("#optionAeropuerto")
        .forEach((element) => (element.innerText = optionAeropuerto[idioma]))
    : "";

  selector("#th_numeroReserva")
    ? (selector("#th_numeroReserva").innerText = th_numeroReserva[idioma])
    : "";
  selector("#th_fechaEntrega")
    ? (selector("#th_fechaEntrega").innerText = th_fechaEntrega[idioma])
    : "";
  selector("#th_horaEntrega")
    ? (selector("#th_horaEntrega").innerText = th_horaEntrega[idioma])
    : "";
  selector("#th_fechaRecogida")
    ? (selector("#th_fechaRecogida").innerText = th_fechaRecogida[idioma])
    : "";
  selector("#th_horaRecogida")
    ? (selector("#th_horaRecogida").innerText = th_horaRecogida[idioma])
    : "";
  selector("#th_plaza")
    ? (selector("#th_plaza").innerText = th_plaza[idioma])
    : "";
  selector("#th_terminalRecogida")
    ? (selector("#th_terminalRecogida").innerText = th_terminalRecogida[idioma])
    : "";
  selector("#th_matricula")
    ? (selector("#th_matricula").innerText = th_matricula[idioma])
    : "";
  selector("#th_pdf") ? (selector("#th_pdf").innerText = th_pdf[idioma]) : "";

  selector("#th_terminalEntrega")
    ? (selector("#th_terminalEntrega").innerText = th_terminalEntrega[idioma])
    : "";

  /**
   * Actualizar formulario crear coche desde el cliente
   */
  selector("#marca_car_placeholder")
    ? (selector("#marca_car_placeholder").placeholder =
        marca_car_placeholder[idioma])
    : "";
  selector("#modelo_car_placeholder")
    ? (selector("#modelo_car_placeholder").placeholder =
        modelo_car_placeholder[idioma])
    : "";
  selector("#color_car_")
    ? (selector("#color_car_placeholder").placeholder =
        color_car_placeholder[idioma])
    : "";
  selector("#matricula_car_placeholder")
    ? (selector("#matricula_car_placeholder").placeholder =
        matricula_car_placeholder[idioma])
    : "";

  selector("#btn_registrar_coche")
    ? (selector("#btn_registrar_coche").innerText = btn_registrar_coche[idioma])
    : "";
  selector("#btn_actualizar_coche")
    ? (selector("#btn_actualizar_coche").innerText =
        btn_actualizar_coche[idioma])
    : "";

  selector("#option_car_one")
    ? (selector("#option_car_one").innerText = option_car_one[idioma])
    : "";
  /**
   * Actualizando la cabecera de la tabla de coches
   */
  selector("#th_marca")
    ? (selector("#th_marca").innerText = marca_car_placeholder[idioma])
    : "";
  selector("#th_modelo")
    ? (selector("#th_modelo").innerText = modelo_car_placeholder[idioma])
    : "";
  selector("#th_color")
    ? (selector("#th_color").innerText = color_car_placeholder[idioma])
    : "";
  selector("#th_matricula")
    ? (selector("#th_matricula").innerText = matricula_car_placeholder[idioma])
    : "";
  selector("#th_acciones")
    ? (selector("#th_acciones").innerText = th_acciones[idioma])
    : "";
  /**
   * Actualizar perfil
   */
  selector("#titleUpdatePerfil")
    ? (selector("#titleUpdatePerfil").innerText = titleUpdatePerfil[idioma])
    : "";
  selector("#nombre_completo")
    ? (selector("#nombre_completo").placeholder = nombre_completo[idioma])
    : "";
  selector("#direccion_completa")
    ? (selector("#direccion_completa").placeholder = direccion_completa[idioma])
    : "";
  selector("#passwordUser")
    ? (selector("#passwordUser").placeholder = passwordUser[idioma])
    : "";
  selector("#tlf") ? (selector("#tlf").placeholder = tlf[idioma]) : "";
  selector("#btnUpdate")
    ? (selector("#btnUpdate").innerText = btnUpdate[idioma])
    : "";

  selector("#btnCancel")
    ? (selector("#btnCancel").innerText = btnCancel[idioma])
    : "";
  selector("#select_coche")
    ? (selector("#select_coche").innerText = select_coche[idioma])
    : "";
  /**
   * Actualiza el idioma
   */
  document.documentElement.lang = idioma;
  localStorage.setItem("idioma", idioma);
}

function selector(elemento) {
  return document.querySelector(elemento);
}
