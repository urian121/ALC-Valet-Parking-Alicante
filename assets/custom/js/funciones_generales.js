window.addEventListener("load", (event) => {
  const loader = document.querySelector(".page-loading");
  setTimeout(function () {
    loader.classList.remove("active");
    loader.remove();
  }, 500);
});

function formatCurrency(buttonEvent) {
  let nameInput = buttonEvent.name;
  let value = buttonEvent.value;

  // Elimina espacios en blanco y comas
  //value = value.replace(/\s/g, "").replace(/,/g, "");

  // Elimina espacios en blanco y puntos
  value = value.replace(/\s/g, "").replace(/\./g, "");

  // Permite solo números
  value = value.replace(/[^0-9]/g, "");

  // Limita la longitud a 7 caracteres
  if (value.length > 5) {
    value = value.slice(0, 5);
  }

  // Agrega la coma automáticamente
  const integerPart = value.slice(0, -2);
  const decimalPart = value.slice(-2);
  value = integerPart + "." + decimalPart;

  // Asigna el valor formateado al campo de texto
  document.querySelector(`input[name="${nameInput}"]`).value = value;
}

/***
 * filtar Reservas por fechas
 */
function enviarFiltroFechaReserva(event) {
  event.preventDefault();
  loaderF(true);

  let fechaReserva = document.querySelector("#fechaReserva").value;

  $.post("filtrar_reservas.php", { fechaReserva }, function (data) {
    loaderF(false);

    let enlace = document.getElementById("descargarFiltroReservas");
    enlace.href = `descargarFiltroAgendaDiariaPDF.php?fechaReserva=${fechaReserva}`;
    $(".resultadoFiltro").html(data);
    document.querySelector("#contentPrint").style.display = "block";
  });
}

// Agrega el evento al formulario
$(document).ready(function () {
  $("#miFormulario").submit(enviarFiltroFechaReserva);
});

function loaderF(statusLoader) {
  if (statusLoader) {
    $("#loaderFiltro").show();
    $("#loaderFiltro").html(
      '<img class="img-fluid" src="../assets/custom/imgs/cargando.svg" style="left:50%; right: 50%; width:50px;">'
    );
  } else {
    $("#loaderFiltro").hide();
  }
}
