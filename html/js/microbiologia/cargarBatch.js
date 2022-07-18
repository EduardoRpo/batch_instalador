//Cargar Batch
$(document).ready(function() {

    const cargarBatchMicro = () => {
        $.ajax({
            url: `/api/micro/${idBatch}/${modulo}`,
            success: function(result) {
                if (result == null)
                    return false
                else {
                    desinfectante(result)
                    equipos(result)
                    analisisMicro(result)
                    aprobacion(result)
                    firmas(result)
                }
            }
        });
    };


    const desinfectante = (data) => {
        $("#sel_producto_desinfeccion").val(data[0].desinfectante);
        $("#desinfectante_obs").val(data[0].observaciones);
    }

    const equipos = (data) => {
        $(".sel_incubadora").val(data[1]["id"]);
        $(".sel_autoclave").val(data[2]["id"]);
        $(".sel_cabina").val(data[3]["id"]);
    }

    const analisisMicro = (data) => {
        cont = 4
        acum = 0
        acum1 = 0

        for (let i = 1; i < 5; i++) {
            ref = $(`.m${i}`).html();
            if (ref) {
                cont = cont + 1
                acum = acum + 1
            }
        }

        for (let i = 4; i < cont; i++) {
            for (let j = 1; j < 5; j++) {
                referencia = $(`.m${j}`).html();
                let indice = referencia.indexOf("/");
                referencia = referencia.substring(5, indice).trim()

                if (data[i]['referencia'] == referencia) {
                    $(`.inputMesofilos${j}`).val(data[i]["mesofilos"]).prop('disabled', true);
                    $(`#pseudomona${j}`).val(data[i]["pseudomona"]).prop('disabled', true)
                    $(`#escherichia${j}`).val(data[i]["escherichia"]).prop('disabled', true);
                    $(`#staphylococcus${j}`).val(data[i]["staphylococcus"]).prop('disabled', true);
                    $(`#fechaSiembra${j}`).val(data[i]["fecha_siembra"]).prop('disabled', true);
                    $(`#fechaResultados${j}`).val(data[i]["fecha_resultados"]).prop('disabled', true);
                }

            }
        }
    }

    const aprobacion = (data) => {
        observaciones = data[4]["observaciones"];
        if (observaciones != "") {
            $("#observacionesLote").slideDown();
            $("#observacionesLoteRechazado").val(data[4]["observaciones"]);
            $("#btnRechazado").prop("checked", true);
        } else {
            $("#btnAceptado").prop("checked", true);
        }
    }

    const firmas = (data) => {
        firm = [];

        for (let i = 1; i < 5; i++) {
            let isDisabled = $(`.inputMesofilos${i}`).prop('disabled');
            if (isDisabled == true)
                acum1 = acum1 + 1
        }
        if (acum == acum1) {
            idfirma = data.length - 2
            firm.push(data[idfirma]);
            firmado(firm, 1);
            if (data[data.length - 1] != "false") {
                firm.push(data[data.length - 1]);
                firmado(firm, 2);
            }
        }
    }

    cargarBatchMicro()
});