function validar_ph() {
    min = $("#in_ph").attr("min");
    max = $("#in_ph").attr("max");

    /* min = parseFloat(min) - 0.05;
    max = parseFloat(max) + 0.05;
*/
    densidad = parseFloat($("#in_ph").val());

    if (densidad > max || densidad < min) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("El valor del PH esta por fuera del rango. Revise nuevamente.");
        return false;
    }
}

function validar_viscosidad() {
    min = $("#in_viscocidad").attr("min");
    max = $("#in_viscocidad").attr("max");

    /* min = parseFloat(min) - 0.05;
    max = parseFloat(max) + 0.05;
*/
    densidad = parseFloat($("#in_viscocidad").val());

    if (densidad > max || densidad < min) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("El valor de la Viscosidad esta por fuera del rango. Revise nuevamente.");
        return false;
    }
}

/* validar min y max en densidad aprobacion */

function validar_densidad() {
    min = $("#in_densidad").attr("min");
    max = $("#in_densidad").attr("max");

    /* min = parseFloat(min) - 0.05;
    max = parseFloat(max) + 0.05;
*/
    densidad = parseFloat($("#in_densidad").val());

    if (densidad > max || densidad < min) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("El valor de la Densidad esta por fuera del rango. Revise nuevamente.");
        return false;
    }
}