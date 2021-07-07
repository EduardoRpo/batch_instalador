$("#instructivos").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
  $(".contenedor-menu .menu ul.menu_pdf").slideUp();
  $(".contenedor-menu .menu ul.menu_instructivos").slideToggle();
});