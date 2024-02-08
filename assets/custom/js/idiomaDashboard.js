document.addEventListener("DOMContentLoaded", function () {
  var idiomaGuardado = localStorage.getItem("idioma");
  if (idiomaGuardado) {
    cambiarIdioma(idiomaGuardado);
  }
});

function cambiarIdioma(idioma) {
  let linkInicio = {
    es: "Inicio",
    en: "Home",
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
    en: "Air-park",
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

  /**
   * Actualiza el idioma
   */
  document.documentElement.lang = idioma;
  localStorage.setItem("idioma", idioma);
}

function selector(elemento) {
  return document.querySelector(elemento);
}
