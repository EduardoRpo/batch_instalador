
$('#btnBatchEnvasado').prop('disabled', true);

//Restriccion fechas

$(document).on('blur', '#fechaFinal', function (e) {
    e.preventDefault();

    fechaInicial = $(`#fechaInicial`).val();
    fechaFinal = $(`#fechaFinal`).val();

    if (fechaInicial > fechaFinal) {
        alertify.set("notifier", "position", "top-right");
        alertify.success("La fecha Inicial debe ser mayor a la fecha Final");
        return false;
    } else
        $('#btnBatchEnvasado').prop('disabled', false);
});


//Consulta batch Envasado por fecha

$(document).on('click', '#btnBatchEnvasado', function (e) {
    e.preventDefault();

    fechaInicial = $(`#fechaInicial`).val();
    fechaFinal = $(`#fechaFinal`).val();

    $.ajax({
        type: "POST",
        url: "api/gestionEnvasado",
        data: { fechaInicial, fechaFinal },

        success: function (r) {
            if (r.error) {
                alertify.set("notifier", "position", "top-right");
                alertify.error(r.message);
            }
            else {
                alertify.set("notifier", "position", "top-right");
                alertify.success(r.message);
            }
        },
    });
});