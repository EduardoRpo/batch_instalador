$(document).ready(function() {
    /* Crear Preguntas */

    preguntas = async(modulo) => {
        let result
        try {
            result = await $.ajax({ url: `/api/questions/${modulo}` })
            return result
        } catch (error) {
            console.error(error)
        }
    }


    carguepreguntas = async() => {
        const data = await preguntas(modulo)
        cantidadpreguntas = data.length;

        $("#preguntas-div").html("");

        data.forEach((question, indx) => {
            $("#preguntas-div").append(`
                <a for="recipient-name" class="col-form-label" id="${question.id_pregunta}">${question.pregunta}</a>
                <label class="checkbox"> 
                <input type="radio" class="questions" name="question-${question.id_pregunta}" id="${question.id_pregunta}" value="1" /></label>
                <label class="checkbox"> 
                <input type="radio" name="question-${question.id_pregunta}" id="${question.id_pregunta}" value="0"/></label>`);
        });
        //cargarPreguntasAlmacenadas(data)
    }

    /* Consulta */

    /* preguntasAlmacenadas = async() => {
        data = { operacion: 1, modulo, idBatch }
        return result = await sendDataPOST("../../html/php/despeje.php", data)
    } */

    /* cargarPreguntasAlmacenadas = async(info) => {
        //info = await preguntasAlmacenadas()
        if (info !== "") {
            for (let i = 0; i < info.length; i++) {
                let question = "question-" + `${info[i].id_pregunta}`;
                let valor = info[i].solucion;
                $("input:radio[name=" + question + "][value=" + valor + "]").prop("checked", true);
            }
            return true
        } else return false;
    } */


    /* Almacenar datos de preguntas */

    guardar_preguntas = (idfirma) => {
        let list = { datos: [] };

        $("input:radio:checked").each(function() {
            list.datos.push({
                pregunta: $(this).attr("id"),
                solucion: $(this).val(),
                modulo: modulo,
                batch: idBatch,
            });
        });

        json = JSON.stringify(list);
        let obj = JSON.parse(json);

        desinfectante = $("#sel_producto_desinfeccion").val();
        obs_desinfectante = $("#in_observaciones").val();

        $.ajax({
            type: "POST",
            url: "../../html/php/despeje.php",
            data: {
                operacion: 4,
                respuestas: obj,
                modulo,
                idBatch,
                desinfectante,
                obs_desinfectante,
                realizo: idfirma,
            },
            success: function(response) {
                if (response > 0) {
                    $(".despeje_realizado")
                        .css({ background: "lightgray", border: "gray" })
                        .prop("disabled", true);
                    $(".despeje_verificado").prop("disabled", false);
                    habilitarbotones();
                }
            },
        });
    }

});