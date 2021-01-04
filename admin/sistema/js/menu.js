$('#inicio').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.menu_generales').slideUp();
    $('.contenedor-menu .menu ul.menu_productos').slideUp();
    $('.contenedor-menu .menu ul.menu_usuarios').slideUp();
    $(location).attr('href', "index.php");
});

$('#parametrosg').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.menu_generales').slideToggle();
    $('.contenedor-menu .menu ul.menu_productos').slideUp();
    $('.contenedor-menu .menu ul.menu_usuarios').slideUp();
});

$('#productos').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.menu_generales').slideUp();
    $('.contenedor-menu .menu ul.menu_productos').slideToggle();
    $('.contenedor-menu .menu ul.menu_usuarios').slideUp();

});

$('#usuarios').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.menu_generales').slideUp();
    $('.contenedor-menu .menu ul.menu_productos').slideUp();
    $('.contenedor-menu .menu ul.menu_usuarios').slideToggle();
});

$('#instructivos').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.menu_generales').slideUp();
    $('.contenedor-menu .menu ul.menu_productos ul.menu_instructivos').slideToggle();
    $('.contenedor-menu .menu ul.menu_usuarios').slideUp();
});

