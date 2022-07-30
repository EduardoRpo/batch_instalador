$(".cardPackaging").hide();
$("#card_tapa").show();

/* Mostrar Menu seleccionado */
$(".contenedor-menu .menu a").removeAttr("style");
$("#link_empaques").css("background", "coral");
$(".contenedor-menu .menu ul.menu_productos").show();


$(document).ready(function() {

    $(document).on("click", ".controller", function(e) {
        id = this.id;
        $(`.cardPackaging`).hide();
        $(`#card_${id}`).show();

    });
});