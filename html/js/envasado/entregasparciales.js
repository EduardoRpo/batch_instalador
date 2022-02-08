$(document).ready(function() {

    $('#btnEntregasParciales1').click(function(e) {
        e.preventDefault();
        let unidadesEnv = $('#unidadesEnvasadas1').val();
        multi = 1
        unidadesEnvasadas(unidadesEnv, multi)
    })

    $('#btnEntregasParciales2').click(function(e) {
        e.preventDefault();
        let unidadesEnv = $('#unidadesEnvasadas2').val();
        multi = 2
        unidadesEnvasadas(unidadesEnv, multi)
    })

    $('#btnEntregasParciales3').click(function(e) {
        e.preventDefault();
        let unidadesEnv = $('#unidadesEnvasadas3').val();
        multi = 3
        unidadesEnvasadas(unidadesEnv, multi)
    })

    $('#btnEntregasParciales4').click(function(e) {
        e.preventDefault();
        let unidadesEnv = $('#unidadesEnvasadas4').val();
        multi = 4
        unidadesEnvasadas(unidadesEnv, multi)
    })


    const unidadesEnvasadas = (data, multi) => {

        if (data == "" || data == 0) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Para hacer una entrega parcial, ingrese un mayor valor a cero(0)");
            return false
        }

        unidadesEnv = data
        modulo = modulo
        referencia = batch.referencia

        data = { unidadesEnv, idBatch, modulo, referencia }

        alertify.confirm('Entregas Parciales', '¿Entrega Parcial?', function() {

            $.post("../../../api/entregasparciales", data,
                function(data, textStatus, jqXHR) {
                    if (data.success == true) {
                        alertify.set("notifier", "position", "top-right");
                        alertify.success(data.message);
                        $(`#unidadesEnvasadasTotales${multi}`).val(data.value);
                        $(`#unidadesEnvasadas${multi}`).val('');

                    } else if (data.success == error) {
                        alertify.set("notifier", "position", "top-right");
                        alertify.error(data.message);
                    }
                },

            );

        }, function() {

            $.post("../../../api/entregastotales", data,
                function(data, textStatus, jqXHR) {
                    if (data.success == true) {

                        alertify.set("notifier", "position", "top-right");
                        alertify.success(data.message);
                        $(`#unidadesEnvasadas${multi}`).prop('disabled', true);
                        $(`.unidadesEnvasadasTotales${multi}`).prop('disabled', true);
                        $(`.btnEntregasParciales${multi}`).prop('disabled', true);
                        $(`.devolucion_realizado${multi}`).prop('disabled', false);

                        $(`#unidadesEnvasadasTotales${multi}`).val(data.value);
                        $(`#envaseEnvasada${multi}`).val(data.value);
                        $(`.envasada${multi}`).html(data.value);

                        /* habilitar boton de firma */
                    } else if (data.success == error) {
                        alertify.set("notifier", "position", "top-right");
                        alertify.error(data.message);
                    }
                },
            );


        }).set("labels", {
            ok: "Si, Parcial",
            cancel: "No, Total",
        });
    }
});