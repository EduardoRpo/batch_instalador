/* Carga instructivo preparación para producto */

instructivos = async() => {
    let result
    try {
        result = await $.ajax({ url: `/api/instructivos/${referencia}` })
        return result
    } catch (error) {
        console.error(error)
    }
}

cargarInstructivos = async() => {
    data = await instructivos()
    $("#pasos_instructivo").html("");
    pasos = data;
    let i = 1;

    data.forEach((instructivo, indx) => {
        instructivo.tiempo = instructivo.tiempo * 60;

        $("#pasos_instructivo").append(`
                <a href="javascript:void(0)" onclick="procesoTiempo(event)" 
                    class="proceso-instructivo" attr-indx="${indx}" attr-id="${instructivo.id}" 
                    id="proceso-instructivo${i}" attr-tiempo="${instructivo.tiempo}">PASO ${indx + 1}: ${instructivo.pasos}</a><br />`);
        tiempoTotal = tiempoTotal + instructivo.tiempo;
        i++;
    });
    let ordenpasos = i;
    sessionStorage.setItem("ordenpasos", ordenpasos - 1);
    ocultarInstructivo();

}

$(document).ready(function() {

    /* Marque la linea del instructivo al ser ejecutado como exitosa */

    refreshInstructivo = () => {
        $("#tiempo_instructivo").val(0);
        $(".proceso-instructivo").each(function(link) {
            if ($(this).attr("attr-indx") < queeProcess) {
                $(this).addClass("text-sucess");
            }
        });
    }

    /* Ocultar las instrucciones del paso 3 en adelante */

    ocultarInstructivo = () => {
        var numElem = $("#pasos_instructivo .proceso-instructivo").length;

        for (i = 4; i <= numElem; i++) {
            $(`#proceso-instructivo${i}`).css("color", "#FFFFFF");
            $(`#proceso-instructivo${i}`).css("outline", "none");
        }
        paso = 4;
    }

    /* Mostrar siguiente paso */

    mostrarInstructivo = () => {
        $(`#proceso-instructivo${paso}`).css("color", "#67757c");
        paso = paso + 1;
    }

    /* Reiniciar instructivo */

    reiniciarInstructivo = () => {
        $(".proceso-instructivo").removeClass("text-sucess");
        queeProcess = 0;
        ocultarInstructivo();
    }
});