/* variables globales */

modulo = 6;
let id_multi = 1;
let flag = 0;
let equipos = [];

//Carga el proceso despues de cargar la data  del Batch

loadBatch = async() => {
    await cargarInfoBatch();
    result = await carguepreguntas(modulo);
    result = await cargarDesinfectantes();
    await busqueda_multi();
    await deshabilitarBotones();
    cargarBatchMulti()
}

loadBatch()

/* Ocultar Acondicionamiento */

ocultar_acondicionamiento = () => {
    for (let i = 2; i < 6; i++) {
        $(`#acondicionamiento${i}`).attr("hidden", true);
    }
}

// cargar = (btn, idbtn) => {
//     let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
//     confirm.set('onok', function(r) {
//         sessionStorage.setItem("idbtn", idbtn);
//         sessionStorage.setItem("btn", btn.id);
//         id = btn.id;

/* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */
// let seleccion = $(".in_desinfeccion").val();

// if (seleccion == "Seleccione") {
//     alertify.set("notifier", "position", "top-right");
//     alertify.error("Seleccione el producto para desinfección.");
//     return false;
// }

// Valida el proceso para la segunda seccion 
// if (id != "despeje_realizado" && id != "despeje_verificado") {
//     let banda = $(`#sel_banda${id_multi}`).val();
//     let etiquetadora = $(`#sel_etiquetadora${id_multi}`).val();
//     let tunel = $(`#sel_tunel${id_multi}`).val();

//     if (!banda || !etiquetadora || !tunel) {
//         alertify.set("notifier", "position", "top-right");
//         alertify.error("Seleccione los equipos de la linea de producción.");
//         return false;
//     } else {
//         crearEquiposAcondicionamiento()
//     }
// }

/* validar que todas las muestras se registraron */

// if (id == `controlpeso_realizado${id_multi}`) {
//     i = sessionStorage.getItem(`totalmuestras${id_multi}`);
//     cantidad_muestras = $(`#muestras${id_multi}`).val() * 5;

//     if (i != cantidad_muestras) {
//         alertify.set("notifier", "position", "top-right");
//         alertify.error("Ingrese todas las muestras");
//         return false;
//     }
// }

// if (id == `devolucion_realizado${id_multi}`) {
//     let utilizada = $(`#utilizada_empaque${id_multi}`).val();
//     let averias = $(`#averias_empaque${id_multi}`).val();
//     let sobrante = $(`#sobrante_empaque${id_multi}`).val();

//     if (utilizada == "" || averias == "" || sobrante == "") {
//         alertify.set("notifier", "position", "top-right");
//         alertify.error("Ingrese todos los datos");
//         return false;
//     }

//     utilizada = $(`#utilizada_otros${id_multi}`).val();
//     averias = $(`#averias_otros${id_multi}`).val();
//     sobrante = $(`#sobrante_otros${id_multi}`).val();

//     if (utilizada == "" || averias == "" || sobrante == "") {
//         alertify.set("notifier", "position", "top-right");
//         alertify.error("Ingrese todos los datos");
//         return false;
//     }
// }

// if (id == `conciliacion_realizado${id_multi}`) {
//     let unidades = $(`#txtUnidadesProducidas${id_multi}`).val();
//     let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
//     let mov = $(`#txtNoMovimiento${id_multi}`).val();

//     let conciliacion = unidades * retencion * mov;

//     if (conciliacion == 0) {
//         alertify.set("notifier", "position", "top-right");
//         alertify.error("Campos vacios o con valor cero");
//         return false;
//     }
// }
/* Carga el modal para la autenticacion */

//         $("#usuario").val("");
//         $("#clave").val("");
//         $("#m_firmar").modal("show");
//     });
// }