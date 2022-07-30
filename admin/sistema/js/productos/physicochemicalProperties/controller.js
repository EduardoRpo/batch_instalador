$(".card_recuento_mesofilos").hide();
$("#card_apariencia").show();

/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_fisico_quimicas").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();

$(document).ready(function() {

    $(document).on("click", ".controller", function(e) {
        id = this.id;
        $(`.cardPropiedades`).hide();
        $(`#card_${id}`).show();

    });
});