idBatch = location.href.split("/")[4];
referencia = location.href.split("/")[5];
let queeProcess = 0;
var pasos;
let paso = 4;
let tanqueOk = 0;
let tiempoTotal = 0;
let pasoEjecutado = 0;
modulo = 3;

function cargar(btn, idbtn) {
    let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function(r) {

        sessionStorage.setItem("idbtn", idbtn);
        id = btn.id;

        /* Valida que se ha seleccionado el producto de desinfeccion para el proceso */

        let seleccion = $("#sel_producto_desinfeccion").val();
        //if (seleccion != "Seleccione") seleccion = $("#select-Linea").val();

        if (seleccion == "Seleccione") {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione el producto para desinfección.");
            return false;
        }

        //Validacion de control de tanques

        if (id == "preparacion_realizado") {
            validar = controlTanques();
            if (validar == 0) {
                return false;
            }
        }

        /* valida que el instructivo se haya ejecutado */
        if (id == "preparacion_realizado") {
            ordenpasos = sessionStorage.getItem("ordenpasos");

            if (pasoEjecutado !== 0 || pasoEjecutado == 0)
                if (pasoEjecutado < ordenpasos) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Para continuar. Complete todo el instructivo");
                    return false;
                }
        }

        /* Almacenar la data en un array */

        if (id == "preparacion_realizado") {
            validar = cargarResultadosEspecificaciones();
            if (validar == 0) return false;
        }

        if (id !== "despeje_realizado" && id !== "preparacion_realizado") {
            if (id !== "despeje_verificado") {
                if ($("#despeje_verificado").is(":disabled") == false) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error(
                        "Primero ejecute la firma para Calidad en la sección de Despeje de Lineas y Procesos."
                    );
                    return false;
                }
            }
        }
        /* Carga el modal para la autenticacion */

        $("#usuario").val("");
        $("#clave").val("");
        $("#m_firmar").modal("show");
    });
}

/* Habilitar Botones */

function habilitarbotones() {
    $(".preparacion_realizado").prop("disabled", false);
}

/* Cargar tabla de observaciones */

Date.prototype.toDateInputValue = function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
};

/* Carga info del producto */

$("#in_fecha").attr("min", new Date().toDateInputValue());

$.ajax({
    url: `../../api/batch/${idBatch}`,
    type: "GET",
}).done((data, status, xhr) => {
    $("#in_numero_orden").val(data.numero_orden);
    $("#in_numero_lote").val(data.numero_lote);
    $("#in_fecha").val(data.fecha_programacion);
    $("#in_referencia").val(data.referencia);
    $("#in_nombre_referencia").val(data.nombre_referencia);
    $("#in_linea").val(data.linea);
});

/* Carga instructivo preparación para producto */

$.ajax({
        url: `/api/instructivos/${referencia}`,
        type: "GET",
    })
    .done((data, status, xhr) => {
        $("#pasos_instructivo").html("");
        pasos = data;
        var i = 1;

        data.forEach((instructivo, indx) => {
            instructivo.tiempo = instructivo.tiempo * 60;

            $("#pasos_instructivo")
                .append(`<a href="javascript:void(0)" onclick="procesoTiempo(event)" 
            class="proceso-instructivo" attr-indx="${indx}" attr-id="${instructivo.id
          }" id="proceso-instructivo${i}" 
            attr-tiempo="${instructivo.tiempo}">PASO ${indx + 1}: ${instructivo.pasos
          } </a>  <br/>`);
            tiempoTotal = tiempoTotal + instructivo.tiempo;
            i++;
        });
        var ordenpasos = i;
        sessionStorage.setItem("ordenpasos", ordenpasos - 1);
        ocultarInstructivo();
    })
    .fail((err) => {
        console.log(err);
    });

/* Cargar el tiempo del proceso */

function procesoTiempo(event) {
    pasoEjecutado = pasoEjecutado + 1;
    validar = controlTanques();
    if (validar == 0) return false;

    let tiempo = $(event.target).attr("attr-tiempo");
    let id = $(event.target).attr("attr-id");
    let proceso = pasos[queeProcess];

    /* marcar el check del tanque siguiente y validar */

    if (proceso.id == id) {
        $("#tiempo_instructivo").val(tiempo);
    } else {
        $.alert({
            theme: "white",
            icon: "fa fa-warning",
            title: "Samara Cosmetics",
            content: "Siga el orden del instructivo",
            confirmButtonClass: "btn-info",
            type: "warning",
        });
    }
}

/* Marque la linea del instructivo al ser ejecutado como exitosa */

function refreshInstructivo() {
    $("#tiempo_instructivo").val(0);
    $(".proceso-instructivo").each(function(link) {
        if ($(this).attr("attr-indx") < queeProcess) {
            $(this).addClass("text-sucess");
        }
    });
}

/* Ocultar las instrucciones del paso 3 en adelante */

function ocultarInstructivo() {
    var numElem = $("#pasos_instructivo .proceso-instructivo").length;

    for (i = 4; i <= numElem; i++) {
        $(`#proceso-instructivo${i}`).css("color", "#FFFFFF");
        $(`#proceso-instructivo${i}`).css("outline", "none");
    }
    paso = 4;
}

/* Mostrar siguiente paso */

function mostrarInstructivo() {
    $(`#proceso-instructivo${paso}`).css("color", "#67757c");
    paso = paso + 1;
}

/* Reiniciar instructivo */

function reiniciarInstructivo() {
    $(".proceso-instructivo").removeClass("text-sucess");
    queeProcess = 0;
    ocultarInstructivo();
}

function deshabilitarbtn() {
    $(".preparacion_realizado")
        .css({ background: "lightgray", border: "gray" })
        .prop("disabled", true);
    $(".preparacion_verificado").prop("disabled", false);
}