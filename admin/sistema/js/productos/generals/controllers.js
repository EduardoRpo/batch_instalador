$(".cardGenerales").hide();
$("#card_nombre_producto").show();

/* Mostrar Menu */

$(".contenedor-menu .menu a").removeAttr("style");
$("#link_generales").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();

$(document).ready(function() {

    $(document).on("click", ".controller", function(e) {
        id = this.id;
        $(`.cardGenerales`).hide();
        $(`#card_${id}`).show();

    });
});