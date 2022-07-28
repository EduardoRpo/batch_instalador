$(document).ready(function() {

    /* cargar Desinfectantes */

    desinfectantes = async() => {
        let result
        try {
            result = await $.ajax({ url: `/api/desinfectantes` })
            return result
        } catch (error) {
            console.error(error)
        }
    }

    cargarDesinfectantes = async() => {
        const data = await desinfectantes()
        data.forEach((desinfectante) => {
            $("#sel_producto_desinfeccion").append(
                `<option value="${desinfectante.id}">${desinfectante.nombre}</option>`
            );
        });
    }

    //Consulta desinfectates almacenados

    /* desinfectanteAlmacenado = async () => {
        data = { operacion: 2, modulo, idBatch }
        return result = await sendDataPOST("../../html/php/despeje.php", data)
    }

    cargarDesinfectanteAlmacenado = async () => {
        info = await desinfectanteAlmacenado()
        if (info) {
            desinfectante = info.desinfectante;
            observacion = info.observaciones;
            firma = info.urlfirma;

            $("#sel_producto_desinfeccion").val(desinfectante);
            $("#in_observaciones").val(observacion);

            // firma 
            firmado(firma, 1);

            // habilitar botones para siguiente seccion
            for (i = 1; i < 5; i++)
                $(`.controlpeso_realizado${i}`).prop("disabled", false);
            return true

        } else
            return false
    } */

    //Validacion campos de preguntas diligenciados

    $(".in_desinfeccion").click(function(event) {
        //$('.in_desinfeccion').click((event) => {
        event.preventDefault();

        let flag = false;
        $(".questions").each((indx, question) => {
            if (flag) {
                return;
            }
            let name = $(question).attr("name");
            if (!$(`input[name='${name}']:radio`).is(":checked")) {
                flag = true;

                $.alert({
                    theme: "white",
                    icon: "fa fa-warning",
                    title: "Samara Cosmetics",
                    content: "Complete todas las preguntas",
                    confirmButtonClass: "btn-info",
                });
            }
        });
    });

    validarParametrosControl = () => {
        let flag = false;
        $(".questions").each((indx, question) => {
            if (flag) {
                return;
            }
            let name = $(question).attr("name");
            if (!$(`input[name='${name}']:radio`).is(":checked")) {
                flag = true;

                $.alert({
                    theme: "white",
                    icon: "fa fa-warning",
                    title: "Samara Cosmetics",
                    content: "Complete todas las preguntas",
                    confirmButtonClass: "btn-info",
                });
                completo = 0;
                return false;
            }
            completo = 1;
        });
    }
});