/**
 * Funcion para validar las fechas, aplicando algunas reglas
 */
function validarFechas() {
  let fechaEntrega = document.getElementById("fecha_entrega_admin").value;
  let fechaRecogida = document.getElementById("hora_entrega_admin").value;

  // Convertir las cadenas de fecha en objetos Date
  let fechaEntregaDate = new Date(
    fechaEntrega.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3")
  );
  let fechaRecogidaDate = new Date(
    fechaRecogida.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3")
  );

  let m = "";
  if (fechaEntregaDate > fechaRecogidaDate) {
    m = "La fecha de entraga no puede ser mayor a la fecha de Recogida";
    mi_alerta(m, 0);
    return null;
  } else if (fechaRecogidaDate < fechaEntregaDate) {
    m = "La fecha de recogida no puede ser mayor a la fecha de Entrega";
    mi_alerta(m, 0);
    return null;
  } else if (fechaEntregaDate.getTime() === fechaRecogidaDate.getTime()) {
    m = "La fecha de Entrega no puede ser igual a la fecha de Recogida";
    mi_alerta(m, 0);
    return null;
  }

  const divExist = document.querySelector(".alert");
  if (divExist) {
    divExist.remove();
  }

  // Calcular la diferencia en milisegundos
  var diferenciaMilisegundos = fechaRecogidaDate - fechaEntregaDate;
  // Calcular la diferencia en días
  var diferenciaDias = Math.floor(
    diferenciaMilisegundos / (1000 * 60 * 60 * 24)
  );
  return diferenciaDias;
}

function mi_alerta(msj, tipo_msj) {
  const divExistente = document.querySelector(".alert");
  if (divExistente) {
    divExistente.remove();
  }
  const divRespuesta = document.createElement("div");

  divRespuesta.innerHTML = `
          <div class="alert ${
            tipo_msj == 1 ? "alert-success" : "alert-danger"
          }  alert-dismissible text-center" role="alert" style="font-size: 16px;">
            ${msj}
          </div>
        `;

  setTimeout(function () {
    divRespuesta.innerHTML = "";
  }, 8000);

  // Agregar el div al final del contenedor con clase "container"
  const container = document.querySelector(".card-title");
  container.insertAdjacentElement("beforeend", divRespuesta);
}
