$('#inicio').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.abrir1 ul.abrir3').slideUp();
    $('.contenedor-menu .menu ul.abrir').slideUp();
    $('.contenedor-menu .menu ul.abrir1').slideUp();
    $('.contenedor-menu .menu ul.abrir2').slideUp();
    $(location).attr('href', "index.php");
});

$('#parametrosg').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.abrir1 ul.abrir3').slideUp();
    $('.contenedor-menu .menu ul.abrir').slideToggle();
    $('.contenedor-menu .menu ul.abrir1').slideUp();
    $('.contenedor-menu .menu ul.abrir2').slideUp();
});


$('#productos').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.abrir1 ul.abrir3').slideUp();
    $('.contenedor-menu .menu ul.abrir1').slideToggle();
    $('.contenedor-menu .menu ul.abrir').slideUp();
    $('.contenedor-menu .menu ul.abrir2').slideUp();

});

$('#usuarios').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.abrir1 ul.abrir3').slideUp();
    $('.contenedor-menu .menu ul.abrir2').slideToggle();
    $('.contenedor-menu .menu ul.abrir1').slideUp();
    $('.contenedor-menu .menu ul.abrir').slideUp();
});

$('#instructivoss').click(function (e) {
    e.preventDefault();
    $('.contenedor-menu .menu ul.abrir1 ul.abrir3').slideToggle();
    $('.contenedor-menu .menu ul.abrir2').slideUp();
   // $('.contenedor-menu .menu ul.abrir1').slideToggle();
    $('.contenedor-menu .menu ul.abrir').slideUp();
    
});

