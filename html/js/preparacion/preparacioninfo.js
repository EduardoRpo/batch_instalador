idBatch = location.href.split("/")[4];
referencia = location.href.split("/")[5];
let queeProcess = 0;
var pasos;
let paso = 4;
let tanqueOk = 0;
let tiempoTotal = 0;
let pasoEjecutado = 0;
modulo = 3;

loadBatch = async() => {
    await cargarInfoBatch();
    cargarTanques()
}

loadBatch()
cargarInstructivos()


/* function cargar(btn, idbtn) {
    let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function(r) {

        sessionStorage.setItem("idbtn", idbtn);
        id = btn.id;

        // Valida que se ha seleccionado el producto de desinfeccion para el proceso 

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

// valida que el instructivo se haya ejecutado 
if (id == "preparacion_realizado") {
    ordenpasos = sessionStorage.getItem("ordenpasos");

    if (pasoEjecutado !== 0 || pasoEjecutado == 0)
        if (pasoEjecutado < ordenpasos) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Para continuar. Complete todo el instructivo");
            return false;
        }
}

// Almacenar la data en un array 

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
// Carga el modal para la autenticacion 

$("#usuario").val("");
$("#clave").val("");
$("#m_firmar").modal("show");
});
} * /


/* Cargar fecha */

Date.prototype.toDateInputValue = function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
};

$("#in_fecha").attr("min", new Date().toDateInputValue());