let presentacion;

//Carga el proceso despues de cargar la data  del Batch

$(document).ready(function () {
    setTimeout(() => {
        busqueda_multi(batch);
        /* identificarDensidad(batch); */
        deshabilitarbotones();

    }, 500);
});

/* deshabilitar botones */

function deshabilitarbotones() {

    for (let i = 1; i < 4; i++) {
        $(`.controlpeso_realizado${i}`).prop('disabled', true);
        $(`.controlpeso_verificado${i}`).prop('disabled', true);
        $(`.devolucion_realizado${i}`).prop('disabled', true);
        $(`.devolucion_verificado${i}`).prop('disabled', true);
    }
}

function habilitarbotones() {

    btn_id = localStorage.getItem("idbtn");

    if (btn_id == 'firma1')
        $(`.controlpeso_realizado${id_multi}`).prop('disabled', false);
}

/* Cargar Multipresentacion */

function busqueda_multi(batch) {

    ocultarEnvasado();
    /* ocultarfilasTanques(5); */

    $.ajax({

        'method': 'POST',
        'url': '../../html/php/busqueda_multipresentacion.php',
        'data': { id: idBatch },

        success: function (data) {

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
                    $(`#acondicionamiento${j}`).attr("hidden", false);
                    $(`#acondicionamientoMulti${j}`).html('ACONDICIONAMIENTO PRESENTACIÓN: ' + presentacion);
                    cargarTablaEnvase(j, referencia, cantidad);
                    calcularMuestras(j, cantidad);
                    j++;
                }
            } else {

                $(`#tanque${j}`).html(formatoCO(batch.presentacion));
                $(`#cantidad${j}`).html(formatoCO(batch.unidad_lote));
                $(`#total${j}`).html(formatoCO(batch.tamano_lote));
                $(`#acondicionamientoMulti${j}`).html('ACONDICIONAMIENTO PRESENTACIÓN: ' + batch.presentacion);
                $(`#ref${j}`).val(referencia);
                cargarTablaEnvase(j, batch.referencia, batch.unidad_lote);
                calcularMuestras(j, batch.unidad_lote);
            }
            multi = j + 1;
        },
        error: function (r) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar la multipresentacion.");
        }

    });
};

/* Ocultar Envasado */

function ocultarEnvasado() {
    for (let i = 2; i < 6; i++) {
        $(`#envasado${i}`).attr("hidden", true);
    }
}

/* Cargar referencia */

$('.ref_multi1').click(function (e) {
    e.preventDefault();
    ref_multi = $(`.ref1`).val();
    id_multi = 1;
    presentacion_multi();
});

$('.ref_multi2').click(function (e) {
    e.preventDefault();
    ref_multi = $(`.ref2`).val();
    id_multi = 2;
    presentacion_multi();
});

$('.ref_multi3').click(function (e) {
    e.preventDefault();
    ref_multi = $(`.ref3`).val();
    id_multi = 3;
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
    id = btn.id;

    /* Valida que se ha seleccionado el producto de desinfeccion para el proceso de aprobacion */

    let seleccion = $('.in_desinfeccion').val();

    if (seleccion == "Seleccione") {
        alertify.set("notifier", "position", "top-right"); alertify.error("Seleccione el producto para desinfección.");
        return false;
    }


    //Validacion de control de tanques
    /*  if (id == "aprobacion_realizado") {
         validar = controlTanques();
         if (validar == 0) {
             return false;
         }
     } */

    /* Validacion que el formulario se encuentre completamente lleno */

    /* if (id == 'aprobacion_realizado') {
        validar = validardatosresultadosPreparacion();
        if (validar == 0)
            return false;
    }*/

    //validar que todos los campso se encuentres completos en el formularios

    /*   validarParametrosControl(); */

    /* Carga el modal para la autenticacion */

    $('#usuario').val('');
    $('#clave').val('');
    $('#m_firmar').modal('show');
}



$("#select-Linea").change(function () {
    cargarEquipos();
})

let unidad = $('txtUnidadesProducidas').val();
/* validar unidades producidads vs la envasada - 
Enviar notificacion -- 
Texto (Existe una diferencia entre las unidades envasadas y las 
    acondicionadas de la orden de produccion XXX referencia XXXX)
 */

function conciliacionRendimiento(retencion) {
    let unidadEmpaque = 10; //se debe cargar desde envasado
    let UnidadesProducidas = $('#txtUnidadesProducidas').val()
    let totalCajas = Math.floor((UnidadesProducidas - retencion) / unidadEmpaque);
    let entregarBodega = (UnidadesProducidas - retencion);

    $('#txtTotal-Cajas').val(formatoCO(totalCajas));
    $('#txtEntrega-Bodega').val(formatoCO(entregarBodega));

    //txtReponsable, cargar el cargo de la tablar cargos el 1

}


