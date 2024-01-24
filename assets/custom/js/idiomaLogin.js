document.addEventListener("DOMContentLoaded", function () {
  var idiomaGuardado = localStorage.getItem("idioma");
  if (idiomaGuardado) {
    cambiarIdioma(idiomaGuardado);
  }
});

function cambiarIdioma(idioma) {
  var loginTitle = {
    es: "Iniciar Sesión",
    en: "Log in",
  };

  var loginBtn = {
    es: "Entrar",
    en: "get in",
  };

  var register = {
    es: "¿Nuevo aquí?",
    en: "New here?",
  };
  var create_account = {
    es: "Crear una cuenta",
    en: "Create an account",
  };
  let create_account_title = {
    es: "Crea una cuenta",
    en: "Create an account",
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

  /**
   * Crear cuenta de usuario
   */
  let nombre_completo = {
    es: "Nombre completo",
    en: "Full name",
  };
  let din = {
    es: "DNI",
    en: "DNI",
  };

  let direccion_completa = {
    es: "Dirección completa",
    en: "Full address",
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
