
//Consulta batch Envasado por fecha
$('.cssload-loader').hide();
$(document).on('click', '#btnBatchEnvasado', function (e) {
    e.preventDefault();

    fechaInicial = $(`#fechaInicial`).val();
    fechaFinal = $(`#fechaFinal`).val();

    if (fechaInicial > fechaFinal) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("La fecha Inicial debe ser mayor a la fecha Final");
        return false;
    }

    $.ajax({
        type: "POST",
        url: "api/gestionEnvasado",
        data: { fechaInicial, fechaFinal },
        beforeSend: function () {
            $('.cssload-loader').show();
            $('#btnBatchEnvasado').hide();
        },
        complete: function () {
            $('.cssload-loader').hide();
            $('#btnBatchEnvasado').show();
        },
        success: function (r) {
            if (r.error) {
                alertify.set("notifier", "position", "top-right");
                alertify.error(r.message);
            } else if (r.info) {
                alertify.set("notifier", "position", "top-right");
                alertify.notify(r.message);
            } else {
                alertify.set("notifier", "position", "top-right");
                alertify.success(r.message);
            }
        },
    });
});