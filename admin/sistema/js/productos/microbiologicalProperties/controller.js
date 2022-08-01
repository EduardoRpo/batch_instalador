$(".cardMicro").hide();
$("#card_apariencia").show();

/* Mostrar Menu */

$(".contenedor-menu .menu a").removeAttr("style");
$("#link_generales").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();


$(document).ready(function() {

    $(document).on("click", ".controller", function(e) {
        id = this.id;
        $(`.cardMicro`).hide();
        $(`#card_${id}`).show();

    });
});