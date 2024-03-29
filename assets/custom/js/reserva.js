const selectCliente = async (idCliente) => {
  const emailUser = document.querySelector("#emailUser");
  if (idCliente == "") {
    emailUser.value = "";
    return;
  }

  try {
    const url = "../acciones/servicio_api/buscar_cliente_reserva.php";
    const response = await axios.post(url, { idCliente });

    const { success, data } = response.data;

    const terminal_entrega = document.querySelector(
      'input[name="terminal_entrega"]'
    );
    const terminal_recogida = document.querySelector(
      'input[name="terminal_recogida"]'
    );
    const matricula_car = document.querySelector('input[name="matricula_car"]');
    const color_car = document.querySelector('input[name="color_car"]');
    const marca_car = document.querySelector('input[name="marca_car"]');
    const modelo_car = document.querySelector('input[name="modelo_car"]');

    if (success === true && data.length === 0) {
      console.log("El cliente nunca a creado una reserva");
      emailUser.value = "";
      terminal_entrega.value = "";
      terminal_recogida.value = "";
      matricula_car.value = "";
      color_car.value = "";
      marca_car.value = "";
      modelo_car.value = "";
      mi_alerta("El cliente nunca a creado una reserva", 0);
      return;
    }

    emailUser.value = data[0][0];
    terminal_entrega.value = data[0][1];
    terminal_recogida.value = data[0][2];
    matricula_car.value = data[0][3];
    color_car.value = data[0][4];
    marca_car.value = data[0][5];
    modelo_car.value = data[0][6];
  } catch (error) {
    console.error("Error al consultar el valor a Pagar:", error);
  }
};

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
