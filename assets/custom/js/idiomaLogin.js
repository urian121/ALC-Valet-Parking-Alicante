document.addEventListener("DOMContentLoaded", function () {
  let idiomaGuardado = localStorage.getItem("idioma");
  if (idiomaGuardado) {
    cambiarIdioma(idiomaGuardado);
  } else {
    localStorage.setItem("idioma", "es");
  }
});

function cambiarIdioma(idioma) {
  let loginTitle = {
    es: "Iniciar Sesión",
    en: "Log in",
  };

  let loginBtn = {
    es: "Entrar",
    en: "get in",
  };

  let register = {
    es: "¿Nuevo aquí?",
    en: "New here?",
  };

  let create_account = {
    es: "Crear una cuenta",
    en: "Create an account",
  };

  let create_account_title = {
    es: "Crea una cuenta",
    en: "Create an account",
  };

  let old_pass = {
    es: "¿Olvidaste tu contraseña?",
    en: "Forgot your password?",
  };
  let link_recovery = {
    es: "Recuperar clave aquí",
    en: "Recover your password",
  };

  let btn_recovery = {
    es: "Recuperar mi clave",
    en: "Recover my password",
  };
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

  // Actualiza el contenido de la página según el idioma seleccionado
  selector("#loginTitle")
    ? (selector("#loginTitle").innerText = loginTitle[idioma])
    : "";

  selector("#loginBtn")
    ? (selector("#loginBtn").innerText = loginBtn[idioma])
    : selector("#loginBtn");

  selector("#register")
    ? (selector("#register").innerText = register[idioma])
    : "";
  selector("#create_account")
    ? (selector("#create_account").innerText = create_account[idioma])
    : "";
  selector("#link_recovery")
    ? (selector("#link_recovery").innerText = link_recovery[idioma])
    : "";
  selector("#old_pass")
    ? (selector("#old_pass").innerText = old_pass[idioma])
    : "";
  selector("#btn_recovery")
    ? (selector("#btn_recovery").innerText = btn_recovery[idioma])
    : "";
  selector(".title_add_coche")
    ? (selector(".title_add_coche").innerText = title_add_coche[idioma])
    : "";
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
  /**
   * Crear cuenta de usuario
   */
  let nombre_completo = {
    es: "Nombre completo",
    en: "Full name",
  };
  let din = {
    es: "CIF",
    en: "CIF",
  };

  let direccion_completa = {
    es: "Dirección completa",
    en: "Full address (only companies)",
  };
  let tlf = {
    es: "Teléfono",
    en: "Phone",
  };
  let conocido_por = {
    es: "¿Cómo nos ha conocido?",
    en: "How did you know us?",
  };
  let create_account_btn = {
    es: "Crear cuenta",
    en: "Create account",
  };
  let emailUser = {
    es: "Correo electronico",
    en: "Email",
  };
  let passwordUser = {
    es: "Clave",
    en: "Password",
  };

  let observaciones = {
    es: "Observaciones",
    en: "Observations",
  };
  let terminos = {
    es: "Acepto los terminos y condiciones",
    en: "Accept the terms and conditions",
  };
  let back = {
    es: "Volver",
    en: "Back",
  };

  let first_select = {
    es: "Seleccionar",
    en: "Select",
  };
  let cliente = {
    es: "Ya soy cliente",
    en: "I am already a client",
  };
  let telefono = {
    es: "Teléfono",
    en: "Phone",
  };
  let amigo = {
    es: "Un Amigo",
    en: "A Friend",
  };
  let periodico = {
    es: "Periódico",
    en: "Newspaper",
  };
  let folleto = {
    es: "Folleto",
    en: "User information",
  };

  selector("#create_account_title")
    ? (selector("#create_account_title").innerText =
        create_account_title[idioma])
    : "";

  selector("#nombre_completo")
    ? (selector("#nombre_completo").placeholder = nombre_completo[idioma])
    : "";
  selector("#din") ? (selector("#din").placeholder = din[idioma]) : "";
  selector("#direccion_completa")
    ? (selector("#direccion_completa").placeholder = direccion_completa[idioma])
    : "";
  selector("#tlf") ? (selector("#tlf").placeholder = tlf[idioma]) : "";
  selector("#conocido_por")
    ? (selector("#conocido_por").innerText = conocido_por[idioma])
    : "";
  selector("#create_account_btn")
    ? (selector("#create_account_btn").innerText = create_account_btn[idioma])
    : "";
  selector("#emailUser")
    ? (selector("#emailUser").placeholder = emailUser[idioma])
    : "";
  selector("#passwordUser")
    ? (selector("#passwordUser").placeholder = passwordUser[idioma])
    : "";
  selector("#observaciones")
    ? (selector("#observaciones").placeholder = observaciones[idioma])
    : "";
  selector("#terminos")
    ? (selector("#terminos").innerText = terminos[idioma])
    : "";

  selector("#first_select")
    ? (selector("#first_select").innerText = first_select[idioma])
    : "";

  selector("#back") ? (selector("#back").innerText = back[idioma]) : "";
  selector("#cliente")
    ? (selector("#cliente").innerText = cliente[idioma])
    : "";
  selector("#telefono")
    ? (selector("#telefono").innerText = telefono[idioma])
    : "";
  selector("#amigo") ? (selector("#amigo").innerText = amigo[idioma]) : "";
  selector("#periodico")
    ? (selector("#periodico").innerText = periodico[idioma])
    : "";
  selector("#folleto")
    ? (selector("#folleto").innerText = folleto[idioma])
    : "";

  document.documentElement.lang = idioma;
  localStorage.setItem("idioma", idioma);
}

function selector(elemento) {
  return document.querySelector(elemento);
}
