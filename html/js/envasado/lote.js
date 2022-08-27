/* Validar que el valor del lote corresponda */

function validarLote() {
    const lote = $(`#validarLote${id_multi}`).val();

    if (lote == "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese el número del lote");
        $("#validarLote").val("").css("border-color", "red");
        return false;
    } else
        return true;
}

function revisarLote() {
    let data = $(`#validarLote${id_multi}`).val();
    let lote = $("#in_numero_lote").val();

    if (lote != data) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Lote digitado no corresponde al procesado. Valide nuevamente!");

        $(`#validarLote${id_multi}`).val("").css("border-color", "red");
        return false;
    }
    $(`#validarLote${id_multi}`).css("border-color", "#67757c");
}