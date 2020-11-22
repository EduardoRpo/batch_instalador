
idBatch = location.href.split('/')[4];
referencia = location.href.split('/')[5];
let queeProcess = 0;
var pasos;
let paso = 4;
let tanqueOk = 0;
let tiempoTotal = 0;
let pasoEjecutado = 0

/* Cargar tabla de obaservaciones */

Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

/* Carga info del producto */

$('#in_fecha').attr('min', new Date().toDateInputValue());
$.ajax({
    url: `../../api/batch/${idBatch}`,
    type: 'GET'
}).done((data, status, xhr) => {
    $('#in_numero_orden').val(data.numero_orden);
    $('#in_numero_lote').val(data.numero_lote);
    $('#in_fecha').val(data.fecha_programacion);
    $('#in_referencia').val(data.referencia);
    $('#in_nombre_referencia').val(data.nombre_referencia);
    $('#in_linea').val(data.linea);

});

/* Carga preguntas */

/* $.ajax({
    url: `../../api/questions/3`,
    type: 'GET'
}).done((data, status, xhr) => {
    $('#preguntas-div').html('');
    data.forEach(question => {
        $('#preguntas-div').append(`<div class="col-md-10 col-2 align-self-right">
                    <a for="recipient-name" class="col-form-label">${question.pregunta}</a>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <label class="checkbox"> <input type="radio" name="question-${question.id}" value="si"/>
                    </label>
                  </div>
                  <div class="col-md-1 col-0 align-self-center">
                    <label class="checkbox"> <input type="radio" name="question-${question.id}" value="no"/>
                    </label>
                  </div>`);
    });

}); */

/* Carga maquina agitadores */
/* 
$.ajax({
    url: `/api/agitadores`,
    type: 'GET'
}).done((data, status, xhr) => {
    data.forEach(agitador => {
        $('#sel_agitador').append(`<option value="${agitador.id}">${agitador.nombre}</option>`);
    });
});
 */
/* Carga maquina marmitas */

/* $.ajax({
    url: `/api/marmitas`,
    type: 'GET'
}).done((data, status, xhr) => {
    data.forEach(agitador => {
        $('#sel_marmita').append(`<option value="${agitador.id}">${agitador.nombre}</option>`);
    });
}); */

/* Cargar lineas */

$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: '../../html/php/cargarLineas.php',
        data: { operacion: 1 },

        success: function (r) {
            info = JSON.parse(r);

            let $select = $('#select-Linea');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $select.append('<option value ="' + value.id + '">' + value.linea + '</option>');
            });
        }
    });
});



/* Cargar maquinas de acuerdo con la linea */

$("#select-Linea").change(function () {
    cargarEquipos();
})

/* Carga tabla de propiedades del producto */

$.ajax({
    url: `/api/productsDetails/${referencia}`,
    type: 'GET'
}).done((data, status, xhr) => {

    $('#espec_color').html(data.color);
    $('#espec_olor').html(data.olor);
    $('#espec_apariencia').html(data.apariencia);
    $('#espec_poder_espumoso').html(data.poder_espumoso);

    $('#espec_untosidad').html(data.untuosidad);
    $('#espec_ph').html(`${data.limite_inferior_ph} a ${data.limite_superior_ph}`);

    $('#in_ph').attr('min', data.limite_inferior_ph);
    $('#in_ph').attr('max', data.limite_superior_ph);

    $('#espec_densidad').html(`${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`);

    $('#in_densidad').attr('min', data.limite_inferior_densidad_gravedad);
    $('#in_densidad').attr('max', data.limite_superior_densidad_gravedad);

    $('#espec_grado_alcohol').html(`${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`);

    $('#in_grado_alcohol').attr('min', data.limite_inferior_grado_alcohol);
    $('#in_grado_alcohol').attr('max', data.limite_superior_grado_alcohol);

    $('#espec_viscidad').html(`${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`);

    $('#in_viscocidad').attr('min', data.limite_inferior_viscosidad);
    $('#in_viscocidad').attr('max', data.limite_superior_viscosidad);


});

/* Carga instructivo preparación para producto */


$.ajax({
    url: `/api/instructivos/${referencia}`,
    type: 'GET',
}).done((data, status, xhr) => {
    $('#pasos_instructivo').html('');
    pasos = data;
    var i = 1;

    data.forEach((instructivo, indx) => {

        instructivo.tiempo = instructivo.tiempo * 60;

        $('#pasos_instructivo').append(`<a href="javascript:void(0)" onclick="procesoTiempo(event)" 
            class="proceso-instructivo" attr-indx="${indx}" attr-id="${instructivo.id}" id="proceso-instructivo${i}" 
            attr-tiempo="${instructivo.tiempo}">PASO ${indx + 1}: ${instructivo.proceso} </a>  <br/>`);
        tiempoTotal = tiempoTotal + instructivo.tiempo;
        i++;
    });
    var ordenpasos = i;
    localStorage.setItem("ordenpasos", ordenpasos - 1);
    ocultarInstructivo();
}).fail(err => {
    console.log(err);
});

/* Cargar el tiempo del proceso */

function procesoTiempo(event) {

    pasoEjecutado = pasoEjecutado + 1;
    validar = controlTanques();
    if (validar == 0)
        return false;

    let tiempo = $(event.target).attr('attr-tiempo');
    let id = $(event.target).attr('attr-id');
    let proceso = pasos[queeProcess];

    /* marcar el check del tanque siguiente y validar */

    if (proceso.id == id) {
        $('#tiempo_instructivo').val(tiempo);
    } else {

        $.alert({
            theme: 'white',
            icon: 'fa fa-warning',
            title: 'Samara Cosmetics',
            content: 'Siga el orden del instructivo',
            confirmButtonClass: 'btn-info',
            type: 'warning',
        });
    }
}

/* Validar que la linea ha sido seleccionada */

function validarLinea() {
    const linea = $('#select-Linea').val();

    if (linea == null) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Antes de continuar, seleccione la linea para identificar el Equipo a usar para la linea de producción");
        return 0;
    }
}

/* Marque la linea del instructivo al ser ejecutado como exitosa */

function refreshInstructivo() {
    $('#tiempo_instructivo').val(0);
    $('.proceso-instructivo').each(function (link) {
        if ($(this).attr('attr-indx') < queeProcess) {
            $(this).addClass('text-sucess');
        }
    });
}

/* Ocultar las instrucciones del paso 3 en adelante */

function ocultarInstructivo() {

    var numElem = $('#pasos_instructivo .proceso-instructivo').length;

    for (i = 4; i <= numElem; i++) {
        $("#proceso-instructivo" + i).css("color", "#FFFFFF");
        $("#proceso-instructivo" + i).css("outline", "none");
    }
}

/* Mostrar siguiente paso */

function mostrarInstructivo() {

    $("#proceso-instructivo" + paso).css("color", "#67757c");
    paso = paso + 1;
}

/* Reiniciar instructivo */

function reiniciarInstructivo() {
    $('.proceso-instructivo').removeClass('text-sucess');
    ocultarInstructivo();
}