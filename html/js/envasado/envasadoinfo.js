let pres;
modulo = 5;
//let envase;
//let presentacion;
/* let r1,
  r2,
  r3 = 0; */
let equipos = [];

//validacion de campos y botones

function cargar(btn, idbtn) {
    let confirm = alertify.confirm('Samara Cosmetics', '¿La información cargada es correcta?', null, null).set('labels', { ok: 'Si', cancel: 'No' });
    confirm.set('onok', function(r) {
        sessionStorage.setItem("idbtn", idbtn);
        sessionStorage.setItem("btn", btn.id);
        id = btn.id;

        /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

        let seleccion = $(".in_desinfeccion").val();

        if (seleccion == "Seleccione") {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione el producto para desinfección.");
            return false;
        }

        if (typeof id_multi !== "undefined") {

            /* Validacion que todos los datos en linea y el formulario de control en preparacion no esten vacios */

            if (id == `controlpeso_realizado${id_multi}`) {
                /* Validar equipos */
                let eq1 = $(`#sel_envasadora${id_multi}`).val();
                let eq2 = $(`#sel_loteadora${id_multi}`).val();

                if (eq1 === null || eq2 === null) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("Seleccione los equipos a usar.");
                    return false;
                }

                /* Crea objeto para almacenar equipos */

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

                /* Valida que todas las muestras y el lote se encuentren correctas*/

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
        }

        /* Carga el modal para la autenticacion */

        $("#usuario").val("");
        $("#clave").val("");
        $("#m_firmar").modal("show");
    });
}

//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function() {
    setTimeout(() => {
        batch_record();
        busqueda_multi();
        deshabilitarbotones();
    }, 1000);
});

/* deshabilitar botones */

function deshabilitarbotones() {
    for (let i = 1; i < 5; i++) {
        //  $(`.controlpeso_realizado${i}`).prop("disabled", true);
        $(`.controlpeso_verificado${i}`).prop("disabled", true);
        $(`.devolucion_realizado${i}`).prop("disabled", true);
        $(`.devolucion_verificado${i}`).prop("disabled", true);
        $(`.btnEntregasParciales${i}`).prop("disabled", true);
    }
}

/* Cargar Multipresentacion */

function busqueda_multi() {
    ocultarEnvasado();

    $.ajax({
        method: "POST",
        url: "../../html/php/busqueda_multipresentacion.php",
        data: { idBatch },

        success: function(data) {
            batchMulti = JSON.parse(data);

            let j = 1;
            if (batchMulti !== 0) {
                for (let i = 0; i < batchMulti.length; i++) {
                    referencia = batchMulti[i].referencia;
                    presentacion = batchMulti[i].presentacion;
                    cantidad = batchMulti[i].cantidad;
                    total = batchMulti[i].total;

                    $(`#ref${j}`).val(referencia);

                    $(`#tanque${j}`).html(formatoCO(presentacion));
                    $(`#cantidad${j}`).html(formatoCO(cantidad));
                    $(`#total${j}`).html(formatoCO(total));

                    $(`#fila${j}`).attr("hidden", false);
                    $(`#envasado${j}`).attr("hidden", false);
                    $(`#envasadoMulti${j}`).html(`ENVASADO PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`);

                    cargarTablaEnvase(j, referencia, cantidad);
                    calcularMuestras(j, cantidad);
                    cargarEntregasParciales(j, referencia)
                    j++;
                }
            } else {
                $(`#tanque${j}`).html(formatoCO(batch.presentacion));
                $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
                $(`#total${j}`).html(formatoCO(batch.tamano_lote));
                $(`#envasadoMulti${j}`).html(`ENVASADO PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`);
                $(`#ref${j}`).val(referencia);

                cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
                calcularMuestras(j, batch.unidad_lote);
                cargarEntregasParciales(j, referencia)
            }
            multi = j + 1;
        },
        error: function(r) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Error al Cargar la multipresentacion.");
        },
    });
}

/* Ocultar Envasado */

function ocultarEnvasado() {
    for (let i = 2; i < 6; i++) {
        $(`#envasado${i}`).attr("hidden", true);
    }
}

/* Calcular peso minimo, maximo y promedio */

function identificarDensidad(batch) {
    let densidadAprobada = 0;
    $.ajax({
        type: "POST",
        url: "../../html/php/controlProceso.php",
        data: { modulo: 4, idBatch },

        success: function(response) {
            if (response == 0) return false;
            else {
                let espec = JSON.parse(response);
                for (let i = 0; i < espec.length; i++) {
                    densidadAprobada = densidadAprobada + espec[i].densidad;
                }
                densidadAprobada = densidadAprobada / espec.length;
                calcularPeso(densidadAprobada);
            }
        },
    });
}

function calcularPeso(densidadAprobada) {
    var peso_min = batch.presentacion * densidadAprobada;
    var peso_max = peso_min * (1 + 0.01);
    var prom = (parseInt(peso_min) + peso_max) / 2;

    $(`.minimo`).val(peso_min.toFixed(2));
    $(`.maximo`).val(peso_max.toFixed(2));
    $(`.medio`).val(prom.toFixed(2));
}

/* Validar que el valor del lote corresponda */

function validarLote() {
    const lote = $(`#validarLote${id_multi}`).val();

    if (lote == "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Ingrese el número del lote");
        $("#validarLote").val("").css("border-color", "red");
        return 0;
    }
}

function revisarLote() {
    let data = $(`#validarLote${id_multi}`).val();
    let lote = $("#in_numero_lote").val();

    if (lote != data) {
        alertify.set("notifier", "position", "top-right");
        alertify.error(
            "Lote digitado no corresponde al procesado. Valide nuevamente!"
        );
        $(`#validarLote${id_multi}`).val("").css("border-color", "red");
        return false;
    }
    $(`#validarLote${id_multi}`).css("border-color", "#67757c");
}

/* Carga tabla de envase del producto */

function cargarTablaEnvase(j, referencia, cantidad) {
    $.ajax({
        url: "../../html/php/envase.php",
        type: "POST",
        data: { referencia },
    }).done((data, status, xhr) => {
        var info = JSON.parse(data);
        empaqueEnvasado = Math.round(cantidad / info[0].unidad_empaque);
        unidades = formatoCO(cantidad);

        /* Carga datos material referencia */

        $(`.envase${j}`).html(info[0].id_envase);
        $(`.descripcion_envase${j}`).html(info[0].envase);

        $(`.tapa${j}`).html(info[0].id_tapa);
        $(`.descripcion_tapa${j}`).html(info[0].tapa);

        $(`.etiqueta${j}`).html(info[0].id_etiqueta);
        $(`.descripcion_etiqueta${j}`).html(info[0].etiqueta);

        $(`.unidades${j}`).html(unidades);
        $(`.unidades${j}e`).html(empaqueEnvasado);

        /* Carga valores sin referencia mp  */

        id_multi = j;
        if (info[0].id_envase == 50000) {
            $(`#envaseEnvasada${j}`).val(0).prop("disabled", true);
            $(`#envaseAverias${j}`).val(0).prop("disabled", true);
            $(`#envaseSobrante${j}`).val(0).prop("disabled", true);
            $(`#envaseDevolucion${j}`).html(0);
        }

        if (info[0].id_tapa == 50000) {
            $(`#tapaEnvasada${j}`).val(0).prop("disabled", true);
            $(`#tapaAverias${j}`).val(0).prop("disabled", true);
            $(`#tapaSobrante${j}`).val(0).prop("disabled", true);
            $(`#tapaDevolucion${j}`).html(0);
        }

        if (info[0].id_etiqueta == 50000) {
            $(`#etiquetaEnvasada${j}`).val(0).prop("disabled", true);
            $(`#etiquetaAverias${j}`).val(0).prop("disabled", true);
            $(`#etiquetaSobrante${j}`).val(0).prop("disabled", true);
            $(`#etiquetaDevolucion${j}`).html(0);
        }
    });
}

/* Cargar Entregas parciales */

const cargarEntregasParciales = (j, referencia) => {

    $.ajax({
        type: "post",
        url: "../../../api/cargarEntregasParciales",
        data: { batch: idBatch, referencia: referencia },
        success: function(resp) {

            if (resp.message == 'total') {
                $(`#unidadesEnvasadasTotales${j}`).val(resp.unidades);
                $(`#unidadesEnvasadas${j}`).val(resp.unidades).prop('disabled', true);
                $(`.btnEntregasParciales${j}`).prop('disabled', true);
                $(`.devolucion_realizado${j}`).prop('disabled', false);

            }
        }
    });
}

/* Calculo de la devolucion de material */

function devolucionMaterialEnvasada(valor) {
    let unidades_envasadas = formatoCO(parseInt(valor));

    if (isNaN(unidades_envasadas)) {
        unidades_envasadas = 0;
    }

    //si la cantidad de envasado es diferente a los recibido envie una notificacion, la orden de produccion, diferencia entre recibida y envasada y presentacion
    $(`.envasada${id_multi}`).html(unidades_envasadas);
    recalcular_valores();
}

//recalcular valores en la tabla de devolucion de materiales envase

function recalcular_valores() {
    let envasada = $(`#envaseEnvasada${id_multi}`).val();
    let averias = $(`#envaseAverias${id_multi}`).val();
    let sobrante = $(`#envaseSobrante${id_multi}`).val();
    let totalEnvase = parseInt(envasada) + parseInt(averias) + parseInt(sobrante);
    $(`#envaseDevolucion${id_multi}`).html(totalEnvase);

    averias = $(`#tapaAverias${id_multi}`).val();
    sobrante = $(`#tapaSobrante${id_multi}`).val();
    let totalTapa = parseInt(envasada) + parseInt(averias) + parseInt(sobrante);
    $(`#tapaDevolucion${id_multi}`).html(totalTapa);

    averias = $(`#etiquetaAverias${id_multi}`).val();
    sobrante = $(`#etiquetaSobrante${id_multi}`).val();
    let totalEtiqueta =
        parseInt(envasada) + parseInt(averias) + parseInt(sobrante);
    $(`#etiquetaDevolucion${id_multi}`).html(totalEtiqueta);
}

/* Validar linea seleccionada */

function validarLinea() {
    const linea = $(`#select-Linea${id_multi}`).val();

    if (linea == null) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Seleccione la linea");
        return 0;
    }
}

/* Almacena la info de tabla devolucion material */

function registrar_material_sobrante(realizo) {
    let materialsobrante = [];
    id_multi == 1 ? ((start = 1), (end = 4)) :
        id_multi == 2 ? ((start = 4), (end = 7)) :
        id_multi == 3 ? ((start = 7), (end = 10)) :
        ((start = 10), (end = 12));

    for (let i = start; i < end; i++) {
        let datasobrante = {};
        let itemref = $(`.refEmpaque${i}`).html();
        let envasada = $(`.envasada${i}`).val();
        envasada == "" || envasada == undefined ?
            (envasada = $(`.envasada${start}`).val()) :
            envasada;
        let averias = $(`.averias${i}`).val();
        let sobrante = $(`.sobrante${i}`).val();

        datasobrante.referencia = itemref;
        datasobrante.envasada = envasada;
        datasobrante.averias = averias;
        datasobrante.sobrante = sobrante;
        materialsobrante.push(datasobrante);
    }

    $.ajax({
        type: "POST",
        url: "../../html/php/c_devolucionMaterial.php",
        data: { materialsobrante, ref_multi, idBatch, modulo, realizo },

        success: function(r) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Firmado satisfactoriamente");
            habilitarbtn(btn_id);
        },
    });
}