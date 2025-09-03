/* Carga instructivo preparación para producto */

instructivos = async() => {
    let result
    try {
        // Usar archivo fetch local en lugar de API que falla
        result = await $.ajax({ 
            url: `../../html/php/instructivos_fetch.php?referencia=${referencia}`,
            type: 'GET'
        })
        return result
    } catch (error) {
        console.error('Error cargando instructivos:', error)
        return []
    }
}

cargarInstructivos = async() => {
    console.log('🔍 cargarInstructivos - Iniciando carga de instructivos');
    console.log('🔍 cargarInstructivos - Referencia:', referencia);
    
    data = await instructivos()
    console.log('🔍 cargarInstructivos - Datos recibidos:', data);
    console.log('🔍 cargarInstructivos - Tipo de datos:', typeof data);
    
    $("#pasos_instructivo").html("");
    pasos = data;
    let i = 1;

    console.log('🔍 cargarInstructivos - Procesando instructivos, cantidad:', data.length);
    
    data.forEach((instructivo, indx) => {
        console.log(`🔍 cargarInstructivos - Procesando instructivo ${indx + 1}:`, instructivo);
        
        instructivo.tiempo = instructivo.tiempo * 60;
        console.log(`🔍 cargarInstructivos - Tiempo convertido a segundos: ${instructivo.tiempo}`);

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