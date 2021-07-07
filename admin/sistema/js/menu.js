$("#inicio").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_menu_pdf").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
  $(location).attr("href", "index.php");
});

$("#parametrosg").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideToggle();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_menu_pdf").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
});

$("#productos").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideToggle();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_menu_pdf").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
});

$("#usuarios").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideToggle();
  $(".contenedor-menu .menu ul.menu_menu_pdf").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
});

$("#instructivos").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(
    ".contenedor-menu .menu ul.menu_productos ul.menu_instructivos"
  ).slideToggle();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
  $(".contenedor-menu .menu ul.menu_menu_pdf").slideUp();
});

$("#horarios").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideToggle();
  $(".contenedor-menu .menu ul.menu_menu_pdf").slideUp();
});

$("#pdf").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
  $(".contenedor-menu .menu ul.menu_pdf").slideToggle();
});

$("#auditoria").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
  $(".contenedor-menu .menu ul.menu_pdf").slideUp();
  $(".contenedor-menu .menu ul.menu_auditoria").slideToggle();
});

$("#formulas").click(function (e) {
  e.preventDefault();
  $(".contenedor-menu .menu ul.menu_generales").slideUp();
  $(".contenedor-menu .menu ul.menu_productos").slideUp();
  $(".contenedor-menu .menu ul.menu_usuarios").slideUp();
  $(".contenedor-menu .menu ul.menu_horarios").slideUp();
  $(".contenedor-menu .menu ul.menu_pdf").slideUp();
  $(".contenedor-menu .menu ul.menu_formulas").slideToggle();
});
