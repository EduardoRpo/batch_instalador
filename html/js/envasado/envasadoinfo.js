/* Variables globales */

let pres;
modulo = 5;
let flagEntregas = 0
let equipos = [];

loadBatch = async() => {
    await cargarInfoBatch();
    //carguepreguntas()
    cargarDesinfectantes()
    busqueda_multi();
    deshabilitarbotones();
}

loadBatch()

//validacion de campos y botones

/* cargar = (btn, idbtn) => {
    let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function(r) {
        sessionStorage.setItem("idbtn", idbtn);
        sessionStorage.setItem("btn", btn.id);
        id = btn.id;

        // Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion 

let seleccion = $(".in_desinfeccion").val();

if (seleccion == "Seleccione") {
    alertify.set("notifier", "position", "top-right");
    alertify.error("Seleccione el producto para desinfección.");
    return false;
} * /

/* if (typeof id_multi !== "undefined") {

    // Validacion que todos los datos en linea y el formulario de control en preparacion no esten vacios

    if (id == `controlpeso_realizado${id_multi}`) {
        // Validar equipos 
        let eq1 = $(`#sel_envasadora${id_multi}`).val();
        let eq2 = $(`#sel_loteadora${id_multi}`).val();

        if (eq1 === null || eq2 === null) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione los equipos a usar.");
            return false;
        }

        // Crea objeto para almacenar equipos 

        equipos = [];
        const eq3 = {};
        eq3.equipo = eq1;
        eq3.referencia = referencia;
        eq3.modulo = modulo;
        eq3.batch = idBatch;
        equipos.push(eq3);

        const eq4 = {};
        eq4.equipo = eq2;
        eq4.referencia = referencia;
        eq4.modulo = modulo;
        eq4.batch = idBatch;
        equipos.push(eq4);

        // Valida que todas las muestras y el lote se encuentren correctas

        validar = validarLote();

        if (validar == 0) return false;

        i = sessionStorage.getItem("totalmuestras");
        cantidad_muestras = $(`#muestras${id_multi}`).val();

        if (i != cantidad_muestras) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todas las muestras");
            return false;
        }
    }

    if (id == `devolucion_realizado${id_multi}`) {
        let cantidadEnvasada = $(`.txtEnvasada${id_multi}`).val();

        if (cantidadEnvasada == "") {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Ingrese todos los datos");
            return false;
        }

        //validar en que multipresentacion se encuentra
        id_multi == 1 ?
            ((start = 1), (end = 4)) :
            id_multi == 2 ?
            ((start = 4), (end = 7)) :
            id_multi == 3 ?
            ((start = 7), (end = 10)) :
            ((start = 10), (end = 12));

        //validar que los datos de toda la tabla se encuentran completos

        for (let i = start; i < end; i++) {
            let averias = $(`.averias${i}`).val();
            let sobrante = $(`.sobrante${i}`).val();
            if (
                averias == "" ||
                sobrante == "" ||
                averias == undefined ||
                sobrante == undefined
            ) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos");
                return false;
            }
        }
    }
} * /

/* Carga el modal para la autenticacion */

/* $("#usuario").val("");
$("#clave").val("");
$("#m_firmar").modal("show");
});
} */