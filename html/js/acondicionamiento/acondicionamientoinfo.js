let presentacion;
let r1 = 0, r2 = 0, r3 = 0;
let id_multi = 1;
//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function () {
    setTimeout(() => {
        busqueda_multi();
        /* identificarDensidad(batch); */
        deshabilitarbotones();

    }, 500);
});

/* Cargar Multipresentacion */

function busqueda_multi() {

    ocultar_acondicionamiento();
    /* ocultarfilasTanques(5); */

    $.ajax({

        'method': 'POST',
        'url': '../../html/php/busqueda_multipresentacion.php',
        'data': { idBatch },

        success: function (data) {

            batchMulti = JSON.parse(data);

            let j = 1;
            if (batchMulti !== 0) {
                for (let i = 0; i < batchMulti.length; i++) {
                    referencia = batchMulti[i].referencia;
                    presentacion = batchMulti[i].presentacion;
                    cantidad = batchMulti[i].cantidad;
                    densidad = batchMulti[i].densidad;
                    total = batchMulti[i].total;

                    $(`#ref${j}`).val(referencia);

                    $(`#tanque${j}`).html(formatoCO(presentacion));
                    $(`#cantidad${j}`).html(formatoCO(cantidad));
                    $(`#unidadesProgramadas${j}`).val(cantidad);
                    $(`#total${j}`).html(formatoCO(total));

                    $(`#fila${j}`).attr("hidden", false);
                    $(`#acondicionamiento${j}`).attr("hidden", false);
                    $(`#acondicionamientoMulti${j}`).html('ACONDICIONAMIENTO PRESENTACIÓN: ' + presentacion);
                    cargarTablaEnvase(j, referencia, cantidad);
                    calcularMuestras(j, cantidad);
                    rendimiento = rendimiento_producto(referencia, presentacion, cantidad, densidad, total);
                    $(`#rendimientoProducto${j}`).val(rendimiento);
                    j++;
                }
            } else {

                $(`#tanque${j}`).html(formatoCO(batch.presentacion));
                $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
                $(`#unidadesProgramadas${j}`).val(batch.unidad_lote);
                $(`#total${j}`).html(formatoCO(batch.tamano_lote));
                $(`#acondicionamientoMulti${j}`).html('ACONDICIONAMIENTO PRESENTACIÓN: ' + batch.presentacion);
                $(`#ref${j}`).val(referencia);

                cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
                calcularMuestras(j, batch.unidad_lote);
                rendimiento = rendimiento_producto(referencia, batch.presentacion, batch.unidad_lote, batch.densidad, batch.tamano_lote);
                $(`#rendimientoProducto${j}`).val(rendimiento);
            }
            multi = j + 1;
        },
        error: function (r) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar la multipresentacion.");
        }

    });
};

/* deshabilitar botones */

function deshabilitarbotones() {

    for (let i = 1; i < 4; i++) {
        $(`.controlpeso_realizado${i}`).prop('disabled', true);
        $(`.controlpeso_verificado${i}`).prop('disabled', true);
        $(`.devolucion_realizado${i}`).prop('disabled', true);
        $(`.devolucion_verificado${i}`).prop('disabled', true);
        $(`.conciliacion_realizado${i}`).prop('disabled', true);
    }
}

function habilitarbotones() {

    btn_id = localStorage.getItem("idbtn");

    if (btn_id == 'firma1')
        $(`.controlpeso_realizado${id_multi}`).prop('disabled', false);
}

/* Ocultar Envasado */

function ocultar_acondicionamiento() {
    for (let i = 2; i < 6; i++) {
        $(`#acondicionamiento${i}`).attr("hidden", true);
    }
}

/* Cargar referencia */

$('.ref_multi1').click(function (e) {
    e.preventDefault();
    ref_multi = $(`.ref1`).val();
    id_multi = 1;
    r1++;
    presentacion_multi();
});

$('.ref_multi2').click(function (e) {
    e.preventDefault();
    ref_multi = $(`.ref2`).val();
    id_multi = 2;
    r2++;
    presentacion_multi();
});

$('.ref_multi3').click(function (e) {
    e.preventDefault();
    ref_multi = $(`.ref3`).val();
    id_multi = 3;
    r3++;
    presentacion_multi();
});

function presentacion_multi() {
    envase = $(`#acondicionamientoMulti${id_multi}`).html();
    presentacion = envase.slice(32, envase.length);
    cargarfirma2();
}

/* Cargar tabla Material */

function cargarTablaEnvase(j, referencia, cantidad) {

    $.ajax({
        url: '../../html/php/envase.php',
        type: 'POST',
        data: { referencia },

    }).done((data, status, xhr) => {

        var info = JSON.parse(data);
        empaqueEnvasado = formatoCO(Math.round(cantidad / info.data[0].unidad_empaque));
        unidades = formatoCO(cantidad);

        /* $(`.envase${j}`).html(info.data[0].id_envase);
        $(`.descripcion_envase${j}`).html(info.data[0].envase);

        $(`.tapa${j}`).html(info.data[0].id_tapa);
        $(`.descripcion_tapa${j}`).html(info.data[0].tapa);

        $(`.etiqueta${j}`).html(info.data[0].id_etiqueta);
        $(`.descripcion_etiqueta${j}`).html(info.data[0].etiqueta); */

        $(`.empaque${j}`).html(info.data[0].id_empaque);
        $(`.descripcion_empaque${j}`).html(info.data[0].empaque);

        $(`.otros${j}`).html(info.data[0].id_otros);
        $(`.descripcion_otros${j}`).html(info.data[0].otros);

        $(`.unidades${j}`).html(unidades);
        $(`.unidades${j}e`).html(empaqueEnvasado);

    });
}


function cargar(btn, idbtn) {

    localStorage.setItem("idbtn", idbtn);
    localStorage.setItem("btn", btn.id);
    id = btn.id;

    /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */
    let seleccion = $('.in_desinfeccion').val();

    if (seleccion == "Seleccione") {
        alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione el producto para desinfección.");
        return false;
    }

    /* Valida el proceso para la segunda seccion */
    if (id != 'despeje_realizado') {
        let seleccion = $(`#select-Linea${id_multi}`).val();

        if (seleccion == null) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione la linea de producción.");
            return false;
        }

        /* validar que todas las muestras se registraron */
        i = localStorage.getItem(`totalmuestras${id_multi}`)
        cantidad_muestras = $(`#muestras${id_multi}`).val() * 5;

        if (i != cantidad_muestras) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todas las muestras");
            return false;
        }
    }

    if (id == `devolucion_realizado${id_multi}`) {
        let utilizada = $(`#utilizada_empaque${id_multi}`).val();
        let averias = $(`#averias_empaque${id_multi}`).val();
        let sobrante = $(`#sobrante_empaque${id_multi}`).val();


        if (utilizada == '' || averias == '' || sobrante == '') {
            alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
            return false;
        }

        utilizada = $(`#utilizada_otros${id_multi}`).val();
        averias = $(`#averias_otros${id_multi}`).val();
        sobrante = $(`#sobrante_otros${id_multi}`).val();

        if (utilizada == '' || averias == '' || sobrante == '') {
            alertify.set("notifier", "position", "top-right"); alertify.error("Ingrese todos los datos");
            return false;
        }
    }
    /* Carga el modal para la autenticacion */

    $('#usuario').val('');
    $('#clave').val('');
    $('#m_firmar').modal('show');
}



$(`#select-Linea1, #select-Linea2, #select-Linea3`).change(function () {
    cargarEquipos();
})


//recalcular valores en la tabla de devolucion de materiales envase
function recalcular_valores() {

    let utilizada = $(`#utilizada_empaque${id_multi}`).val();
    let averias = $(`#averias_empaque${id_multi}`).val();
    let sobrante = $(`#sobrante_empaque${id_multi}`).val();

    utilizada == '' ? utilizada = 0 : utilizada;
    averias == '' ? averias = 0 : averias;
    sobrante == '' ? sobrante = 0 : sobrante;

    let total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
    total = formatoCO(parseInt(total));
    $(`#totalDevolucion_empaque${id_multi}`).html(total);

    utilizada = $(`#utilizada_otros${id_multi}`).val();
    averias = $(`#averias_otros${id_multi}`).val();
    sobrante = $(`#sobrante_otros${id_multi}`).val();

    utilizada == '' ? utilizada = 0 : utilizada;
    averias == '' ? averias = 0 : averias;
    sobrante == '' ? sobrante = 0 : sobrante;

    total = parseInt(utilizada) + parseInt(averias) + parseInt(sobrante);
    total = formatoCO(parseInt(total));
    $(`#totalDevolucion_otros${id_multi}`).html(total);

}



function deshabilitarbtn() {
    //$(`.controlpeso_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
    btn = localStorage.getItem('btn');

    if (btn == 'despeje_realizado')
        for (let i = 1; i < 4; i++)
            $(`.controlpeso_realizado${i}`).prop('disabled', false);

    if (btn == `controlpeso_realizado${id_multi}`) {
        $(`.controlpeso_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        $(`.controlpeso_verificado${id_multi}`).prop('disabled', false);
        $(`.devolucion_realizado${id_multi}`).prop('disabled', false);
    }

    if (btn == `devolucion_realizado${id_multi}`) {
        $(`.devolucion_realizado${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);
        $(`.devolucion_realizado${id_multi}`).prop('disabled', false);
    }

}

/* Almacena la info de tabla devolucion material */

function registrar_material_sobrante(info) {

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
        url: '../../html/php/c_devolucionMaterial.php',
        data: { materialsobrante, ref_multi, idBatch, modulo, info },

        success: function (response) {
            alertify.set("notifier", "position", "top-right"); alertify.success("Firmado satisfactoriamente");
        }
    });

};

let unidad = $('txtUnidadesProducidas').val();
/* validar unidades producidads vs la envasada - 
Enviar notificacion -- 
Texto (Existe una diferencia entre las unidades envasadas y las 
    acondicionadas de la orden de produccion XXX referencia XXXX)
 */

function conciliacionRendimiento() {
    let unidadEmpaque = 10; //se debe cargar desde envasado
    let unidadesProducidas = parseInt($(`#txtUnidadesProducidas${id_multi}`).val());
    let retencion = $(`#txtMuestrasRetencion${id_multi}`).val();
    let unidadesProgramadas = parseInt($(`#unidadesProgramadas${id_multi}`).val());

    if (retencion == undefined || retencion == '')
        retencion = 0;

    if (parseInt(retencion) > parseInt(unidadesProducidas)) {
        alertify.set("notifier", "position", "top-right"); alertify.error("La cantidad de muestras de retención no debe ser superior a la cantidad de Unidades Producidas");
        var totalCajas = ''
        var entregarBodega = ''
    } else {
        totalCajas = Math.floor((unidadesProducidas - retencion) / unidadEmpaque);
        entregarBodega = (unidadesProducidas - retencion);
    }

    $(`#txtTotal-Cajas${id_multi}`).val(formatoCO(totalCajas));
    $(`#txtEntrega-Bodega${id_multi}`).val(formatoCO(entregarBodega));
    $(`#txtPorcentaje-Unidades${id_multi}`).val(((unidadesProducidas / unidadesProgramadas) * 100).toFixed(2) + "%");

}

function rendimiento_producto(referencia, presentacion, cantidad, densidad, total) {

    let rendimiento = (presentacion * cantidad * densidad) / 1000;
    rendimiento = ((rendimiento / total) * 100).toFixed(2) + "%";
    return rendimiento;

}