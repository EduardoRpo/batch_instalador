/* Ocultar alerts fact */
$(".fact1").hide();
$("#fact2").hide();
$("#fact3").hide();
$("#fact4").hide();

$(".notif_unidades1").hide();
$(".notif_unidades2").hide();
$(".notif_unidades3").hide();
$(".notif_unidades4").hide();

$(document).ready(function() {

    /* Ocultar presentacion despachos */

    ocultar_presentacion_despachos = () => {
        for (let i = 2; i < 6; i++) {
            $(`#despachos${i}`).attr("hidden", true);
        }
    }
});