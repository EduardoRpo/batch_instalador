//let presentacion;
/* let r1 = 0,
  r2 = 0,
  r3 = 0; */
modulo = 6;
let id_multi = 1;
let flag = 0;
let equipos = [];

//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function() {
    setTimeout(() => {
        busqueda_multi();
        deshabilitarbotones();
    }, 1000);
});

/* Cargar Multipresentacion */

function busqueda_multi() {
    ocultar_acondicionamiento();
    /* ocultarfilasTanques(5); */

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
                    densidad_producto = batchMulti[i].densidad_producto;
                    total = batchMulti[i].total;

                    $(`#ref${j}`).val(referencia);
                    $(`#unidad_empaque${j}`).val(batchMulti[i].unidad_empaque);
                    $(`#presentacion${j}`).val(presentacion);
                    $(`#densidad${j}`).val(densidad_producto);
                    $(`#total${j}`).val(total);

                    $(`#tanque${j}`).html(formatoCO(presentacion));
                    $(`#cantidad${j}`).html(formatoCO(cantidad));
                    $(`#unidadesProgramadas${j}`).val(cantidad);
                    $(`#total${j}`).html(formatoCO(total));

                    $(`#fila${j}`).attr("hidden", false);
                    $(`#acondicionamiento${j}`).attr("hidden", false);
                    $(`#acondicionamientoMulti${j}`).html(
                        `ACONDICIONAMIENTO PRESENTACIÓN: ${presentacion} REFERENCIA ${referencia}`
                    );
                    cargarTablaEnvase(j, referencia, cantidad);
                    calcularMuestras(j, cantidad);

                    //rendimiento = rendimiento_producto(referencia, presentacion, densidad, total);
                    //$(`#rendimientoProducto${j}`).val(rendimiento);
                    j++;
                }
            } else {
                batch == undefined ? location.reload() : batch;
                $(`#tanque${j}`).html(formatoCO(batch.presentacion));
                $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
                $(`#unidadesProgramadas${j}`).val(batch.unidad_lote);
                $(`#total${j}`).html(formatoCO(batch.tamano_lote));
                $(`#acondicionamientoMulti${j}`).html(
                    `ACONDICIONAMIENTO PRESENTACIÓN: ${batch.presentacion} REFERENCIA: ${batch.referencia}`
                );

                $(`#ref${j}`).val(referencia);
                $(`#unidad_empaque${j}`).val(batch.unidad_empaque);
                $(`#presentacion${j}`).val(batch.presentacion);
                $(`#densidad${j}`).val(batch.densidad_producto);
                /* $(`#total${j}`).val(batch.tamano_lote); */

                cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
                calcularMuestras(j, batch.unidad_lote);
                //rendimiento = rendimiento_producto(referencia, batch.presentacion, batch.unidad_lote, batch.densidad, batch.tamano_lote);
                //$(`#rendimientoProducto${j}`).val(rendimiento);
            }
            multi = j + 1;
        },
        error: function(r) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Error al Cargar la multipresentacion.");
        },
    });
}

/* deshabilitar botones */

function deshabilitarbotones() {
    for (let i = 1; i < 5; i++) {
        $(`.controlpeso_realizado${i}`).prop("disabled", true);
        $(`.controlpeso_verificado${i}`).prop("disabled", true);
        $(`.devolucion_realizado${i}`).prop("disabled", true);
        $(`.devolucion_verificado${i}`).prop("disabled", true);
        $(`.conciliacion_realizado${i}`).prop("disabled", true);
    }
}

/* Ocultar Acondicionamiento */

function ocultar_acondicionamiento() {
    for (let i = 2; i < 6; i++) {
        $(`#acondicionamiento${i}`).attr("hidden", true);
    }
}

/* Cargar tabla Material */

function cargarTablaEnvase(j, referencia, cantidad) {
    $.ajax({
        url: "../../html/php/envase.php",
        type: "POST",
        data: { referencia },
    }).done((data, status, xhr) => {
        var info = JSON.parse(data);
        if (info[0].unidad_empaque === 0) empaqueEnvasado = "Sin unidad de Empaque";
        else
            empaqueEnvasado = formatoCO(
                Math.round(cantidad / info[0].unidad_empaque)
            );
        unidades = formatoCO(cantidad);

        $(`.empaque${j}`).html(info[0].id_empaque);
        $(`.descripcion_empaque${j}`).html(info[0].empaque);

        $(`.otros${j}`).html(info[0].id_otros);
        $(`.descripcion_otros${j}`).html(info[0].otros);

        $(`.unidades${j}`).html(unidades);
        $(`.unidades${j}e`).html(empaqueEnvasado);

        for (let i = 1; i < 4; i++) {
            if (info[0].id_empaque == 50000) {
                $(`#utilizada_empaque${j}`).val(0).prop("disabled", true);
                $(`#averias_empaque${j}`).val(0).prop("disabled", true);
                $(`#sobrante_empaque${j}`).val(0).prop("disabled", true);
                recalcular_valores();
            }
            if (info[0].id_otros == 50000) {
                $(`#utilizada_otros${j}`).val(0).prop("disabled", true);
                $(`#averias_otros${j}`).val(0).prop("disabled", true);
                $(`#sobrante_otros${j}`).val(0).prop("disabled", true);
                recalcular_valores();
            }
        }
    });
}

$(".sel_equipos").change(function(e) {
    e.preventDefault();
    if (flag == 0) {
        imprimirEtiquetasFull();
        flag = flag + 1;
    }
});

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

        /* Valida el proceso para la segunda seccion */
        if (id != "despeje_realizado" && id != "despeje_verificado") {
            let banda = $(`#sel_banda${id_multi}`).val();
            let etiquetadora = $(`#sel_etiquetadora${id_multi}`).val();
            let tunel = $(`#sel_tunel${id_multi}`).val();

            if (!banda || !etiquetadora || !tunel) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Seleccione los equipos de la linea de producción.");
                return false;
            } else {
                equipos = [];
                for (i = 1; i < 4; i++) {
                    const equipo = {};
                    if (i === 1) equipo.equipo = banda;
                    if (i === 2) equipo.equipo = etiquetadora;
                    if (i === 3) equipo.equipo = tunel;
                    equipo.batch = idBatch;
                    equipo.modulo = modulo;
                    equipo.referencia = ref_multi;
                    equipos.push(equipo);
                }
            }
        }
        /* validar que todas las muestras se registraron */
        if (id == `controlpeso_realizado${id_multi}`) {
            i = sessionStorage.getItem(`totalmuestras${id_multi}`);
            cantidad_muestras = $(`#muestras${id_multi}`).val() * 5;

            if (i != cantidad_muestras) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todas las muestras");
                return false;
            }
        }

        if (id == `devolucion_realizado${id_multi}`) {
            let utilizada = $(`#utilizada_empaque${id_multi}`).val();
            let averias = $(`#averias_empaque${id_multi}`).val();
            let sobrante = $(`#sobrante_empaque${id_multi}`).val();

            if (utilizada == "" || averias == "" || sobrante == "") {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos");
                return false;
            }

            utilizada = $(`#utilizada_otros${id_multi}`).val();
            averias = $(`#averias_otros${id_multi}`).val();
            sobrante = $(`#sobrante_otros${id_multi}`).val();

            if (utilizada == "" || averias == "" || sobrante == "") {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Ingrese todos los datos");
                return false;
            }
        }

        if (id == `conciliacion_realizado${id_multi}`) {
            let unidades = $(`#txtUnidadesProducidas${id_multi}`).val();
            let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
            let mov = $(`#txtNoMovimiento${id_multi}`).val();

            let conciliacion = unidades * retencion * mov;

            if (conciliacion == 0) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Campos vacios o con valor cero");
                return false;
            }
        }
        /* Carga el modal para la autenticacion */

        $("#usuario").val("");
        $("#clave").val("");
        $("#m_firmar").modal("show");
    });
}

//recalcular valores en la tabla de devolucion de materiales envase

function recalcular_valores() {
    let utilizada = $(`#utilizada_empaque${id_multi}`).val();
    let averias = $(`#averias_empaque${id_multi}`).val();
    let sobrante = $(`#sobrante_empaque${id_multi}`).val();

    utilizada == "" ? (utilizada = 0) : utilizada;
    averias == "" ? (averias = 0) : averias;
    sobrante == "" ? (sobrante = 0) : sobrante;

    let total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
    total = formatoCO(parseInt(total));
    $(`#totalDevolucion_empaque${id_multi}`).html(total);

    utilizada = $(`#utilizada_otros${id_multi}`).val();
    averias = $(`#averias_otros${id_multi}`).val();
    sobrante = $(`#sobrante_otros${id_multi}`).val();

    utilizada == "" ? (utilizada = 0) : utilizada;
    averias == "" ? (averias = 0) : averias;
    sobrante == "" ? (sobrante = 0) : sobrante;

    total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
    total = formatoCO(parseInt(total));
    $(`#totalDevolucion_otros${id_multi}`).html(total);
}

/* Almacena la info de tabla devolucion material */

function registrar_material_sobrante(realizo) {
    let materialsobrante = [];
    let datasobrante = {};

    let itemref = $(`#refempaque${id_multi}`).html();
    let envasada = $(`#utilizada_empaque${id_multi}`).val();
    let averias = $(`#averias_empaque${id_multi}`).val();
    let sobrante = $(`#sobrante_empaque${id_multi}`).val();

    datasobrante.referencia = itemref;
    datasobrante.envasada = envasada;
    datasobrante.averias = averias;
    datasobrante.sobrante = sobrante;
    materialsobrante.push(datasobrante);

    datasobrante = {};
    itemref = $(`#refempaque2`).html();
    envasada = $(`#utilizada_otros${id_multi}`).val();
    averias = $(`#averias_otros${id_multi}`).val();
    sobrante = $(`#sobrante_otros${id_multi}`).val();

    datasobrante.referencia = itemref;
    datasobrante.envasada = envasada;
    datasobrante.averias = averias;
    datasobrante.sobrante = sobrante;
    materialsobrante.push(datasobrante);

    $.ajax({
        type: "POST",
        url: "../../html/php/c_devolucionMaterial.php",
        data: { materialsobrante, ref_multi, idBatch, modulo, realizo },

        success: function(response) {
            alertify.set("notifier", "position", "top-right");
            alertify.success("Firmado satisfactoriamente");
            habilitarbtn(btn_id);
        },
    });
}

let unidad = $("txtUnidadesProducidas").val();

function conciliacionRendimiento() {
    $(`#txtNoMovimiento${id_multi}`).val("");
    let unidadEmpaque = $(`#unidad_empaque${id_multi}`).val(); //se debe cargar desde envasado

    if (unidadEmpaque === "0") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Valide las unidades de empaque del producto con el administrador, presenta valor cero (0)");
        $(`#txtTotal-Cajas${id_multi}`).val("Valide unidades de Empaque");

    }

    let unidadesProducidas = parseInt($(`#txtUnidadesProducidas${id_multi}`).val());
    let parcialesUnidadesProducidas = parseInt($(`#parcialesUnidadesProducidas${id_multi}`).val());

    isNaN(parcialesUnidadesProducidas) ? parcialesUnidadesProducidas = 0 : parcialesUnidadesProducidas

    unidadesProducidas = parseFloat(unidadesProducidas) + parseFloat(parcialesUnidadesProducidas)

    let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
    let unidadesProgramadas = parseInt($(`#unidadesProgramadas${id_multi}`).val());

    if (retencion == undefined || retencion == "") retencion = 0;

    isNaN(unidadesProducidas) ?
        (unidadesProducidas = $(`#parcialesUnidadesProducidas${id_multi}`).val()) :
        unidadesProducidas;

    if (parseInt(retencion) > parseInt(unidadesProducidas)) {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Muestras de retención mayor a las Unidades Producidas");
        var totalCajas = "";
        var entregarBodega = "";
    } else {
        totalCajas = Math.ceil((unidadesProducidas - retencion) / unidadEmpaque); //aproximar por encima
        totalCajas == Infinity ? (totalCajas = "No Aplica") : totalCajas;
        entregarBodega = unidadesProducidas - retencion;
    }

    $(`#txtTotal-Cajas${id_multi}`).val(formatoCO(totalCajas));
    $(`#txtEntrega-Bodega${id_multi}`).val(formatoCO(entregarBodega));
    $(`#txtPorcentaje-Unidades${id_multi}`).val(((unidadesProducidas / unidadesProgramadas) * 100).toFixed(2) + "%");

    rendimiento_producto();
}

/* Reimprimir Etiquetas */

reimprimirEtiquetas = () => {
    imprimirEtiquetasFull();
    alertify.set("notifier", "position", "top-right");
    alertify.success("Reimpresion de etiquetas correctamente");
}


function rendimiento_producto() {

    cantidadparciales = $(`#parcialesUnidadesProducidas${id_multi}`).val();
    cantidadparciales == "" ? cantidadparciales = 0 : cantidadparciales
    cantidadIngresada = $(`#txtUnidadesProducidas${id_multi}`).val();
    cantidadIngresada == "" ? cantidadIngresada = 0 : cantidadIngresada

    cantidad = parseFloat(cantidadparciales) + parseFloat(cantidadIngresada)

    presentacion = parseInt($(`#presentacion${id_multi}`).val());
    densidad = parseFloat($(`#densidad${id_multi}`).val());
    total = $(`#total${id_multi}`).html();
    /* total = $(`#in_tamano_lote`).val(); 
    total = total.replace(".", ""); */

    let rendimiento = (presentacion * cantidad * densidad) / 1000;
    rendimiento = ((rendimiento / total) * 100).toFixed(2) + "%";
    $(`#rendimientoProducto${id_multi}`).val(rendimiento);
}

function registrar_conciliacion(info) {
    let operacion = 1;
    let unidades = $(`#txtUnidadesProducidas${id_multi}`).val();
    let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
    let mov = $(`#txtNoMovimiento${id_multi}`).val();
    let cajas = $(`#txtTotal-Cajas${id_multi}`).val();
    data = {
        operacion,
        unidades,
        retencion,
        cajas,
        mov,
        modulo,
        idBatch,
        ref_multi,
        realizo: info[0].id,
    };
    alertify
        .confirm(
            "Entrega",
            "¿Entrega parcial?",
            function() {
                data.entrega_final = 0;
                $.post(
                    "../../../html/php/servicios/parciales.php",
                    data,
                    function(data, textStatus, jqXHR) {
                        data = JSON.parse(data);
                        if (textStatus == "success") {
                            if (data.length == 1) imprimirEtiquetasRetencion();

                            alertify.set("notifier", "position", "top-right");
                            alertify.success("Conciliación parcial registrada satisfactoriamente");
                            let suma = 0;
                            data.forEach((element) => {
                                suma = suma + element.unidades;
                            });
                            alertify.alert("Entrega Parcial", `Total Unidades Entregadas: <b>${suma}</b>`);
                            $(`#parcialesUnidadesProducidas${id_multi}`).val(suma);
                            $(`#txtMuestrasRetencion${id_multi}`).prop("readonly", true);
                            $(`#txtUnidadesProducidas${id_multi}`).val("");
                            conciliacionRendimiento();
                        }
                    }
                );
            },
            function() {
                data.entrega_final = 1;

                $.post(
                    "../../html/php/conciliacion_rendimiento.php",
                    data,
                    function(data, textStatus, jqXHR) {
                        if (data == 'false') {
                            alertify.set("notifier", "position", "top-right");
                            alertify.error("No se puede hacer el cierre total. Para finalizar la entrega debe completar el módulo de envasado");
                            return false
                        }
                        if (textStatus == "success") {
                            imprimirEtiquetasRetencion();
                            alertify.set("notifier", "position", "top-right");
                            alertify.success("Conciliación registrada satisfactoriamente");
                            $(`.conciliacion_realizado${id_multi}`)
                                .css({ background: "lightgray", border: "gray" })
                                .prop("disabled", true);
                            final = parseFloat($(`#txtUnidadesProducidas${id_multi}`).val());
                            parciales = parseFloat(
                                $(`#parcialesUnidadesProducidas${id_multi}`).val()
                            );
                            if (isNaN(parciales)) parciales = 0;

                            $(`#txtUnidadesProducidas${id_multi}`).val(final + parciales);
                            $(`#parcialesUnidadesProducidas${id_multi}`).val(
                                final + parciales
                            );
                            $(`#txtMuestrasRetencion${id_multi}`).prop("disable", "true");
                            $(`#alert_entregas${id_multi}`).removeClass("alert-danger");
                            $(`#alert_entregas${id_multi}`).addClass("alert-success");
                            conciliacionRendimiento();
                            firmar(info);
                        }
                    }
                );
            }
        )
        .set("labels", {
            ok: "Si, Parcial",
            cancel: "No, Total",
        });
}