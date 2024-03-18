function toggleMenu() {
  var menuContent = document.getElementById("menuContent");
  var usuariocontent = document.querySelector(".usuario");

  if (menuContent.style.display === "none") {
      // Abre el menú y cierra el contenido del usuario
      menuContent.style.display = "block";
      usuariocontent.style.display = "none";
  } else {
      // Cierra el menú
      menuContent.style.display = "none";
  }
}

// Cierra el menú si se hace clic fuera de él
window.onclick = function(event) {
  var menuContent = document.getElementById("menuContent");
  var usuariocontent = document.querySelector(".usuario");

  if (!event.target.matches('.menu-btn')) {
      if (menuContent.style.display === "block") {
          // Cierra el menú
          menuContent.style.display = "none";
      }

      if (usuariocontent.style.display === "none") {
          // Cierra el contenido del usuario
          usuariocontent.style.display = "flex";
      }
  }
}