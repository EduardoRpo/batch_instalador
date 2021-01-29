
let idBatch = location.href.split('/')[4];
let referencia = location.href.split('/')[5];
let proceso = $('h1:eq(1)').text();
var modulo;
var batch;
let template;
let cantidadpreguntas;
let completo = 0;

Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

$('#in_fecha').val(new Date().toDateInputValue());
$('#in_fecha').attr('min', new Date().toDateInputValue());

/* Deshabilitar botones de firmas */

$(document).ready(function () {
    setTimeout(() => {

        $('.despeje_verificado').prop('disabled', true);
        $('.pesaje_realizado').prop('disabled', true);
        $('.pesaje_verificado').prop('disabled', true);

        if (modulo == 3) {
            $('.preparacion_realizado').prop('disabled', true);
            $('.preparacion_verificado').prop('disabled', true);
        } else if (modulo == 4) {
            $('.preparacion_realizado').prop('disabled', true);
            $('.preparacion_verificado').prop('disabled', true);
        }
    }, 500);
});

/* cargar batch al finalizar la carga de los demas procesos */

$(document).ready(function () {
    setTimeout(() => {
        if (modulo !== undefined && modulo != 9)
            cargarBatch();
    }, 1000);
});


/* Modulo */

$.ajax({
    'method': 'POST',
    'url': '../../html/php/modulo.php',
    'data': { proceso },

    success: function (data, status, xhr) {
        if (data !== '') {
            const info = JSON.parse(data);
            modulo = info[0].id;

            if (modulo != 4 && modulo != 9)
                carguepreguntas(modulo);

            if (modulo != 9) {
                desinfectantes();
                cargar_condiciones_medio();
                validarTanques(modulo);
            }
        }
    }
});

/* Carga de datos de informacion del batch record seleccionado */
function batch_record() {
    $.ajax({
        url: `../../api/batch/${idBatch}`,
        type: 'GET',

    }).done((data, status, xhr) => {

        batch = data;
        const tamano_lote = formatoCO(data.tamano_lote);

        $('#in_numero_orden').val(data.numero_orden);
        $('#in_numero_lote').val(data.numero_lote);
        $('#in_referencia').val(data.referencia);
        $('#in_nombre_referencia').val(data.nombre_referencia);
        $('#in_linea').val(data.linea);
        $('#in_fecha_programacion').val(data.fecha_programacion);
        $('#in_tamano_lote').val(tamano_lote);

        localStorage.setItem("orden", data.numero_orden);
        localStorage.setItem("tamano_lote", data.tamano_lote);
        return batch;
    });
}


$.ajax({
    url: `../../api/batch/${idBatch}`,
    type: 'GET',

}).done((data, status, xhr) => {

    batch = data;
    const tamano_lote = formatoCO(data.tamano_lote);

    $('#in_numero_orden').val(data.numero_orden);
    $('#in_numero_lote').val(data.numero_lote);
    $('#in_referencia').val(data.referencia);
    $('#in_nombre_referencia').val(data.nombre_referencia);
    $('#in_linea').val(data.linea);
    $('#in_fecha_programacion').val(data.fecha_programacion);
    $('#in_tamano_lote').val(tamano_lote);

    localStorage.setItem("orden", data.numero_orden);
    localStorage.setItem("tamano_lote", data.tamano_lote);
    return batch;
});

/* Calcular la fecha del dia  */

function fechaHoy() {
    var d = new Date();

    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fechaActual = d.getFullYear() + '/' + (mes < 10 ? '0' : '') + mes + '/' + (dia < 10 ? '0' : '') + dia;
}

/* formato de numeros miles y decimales */

const formatoCO = (number) => {
    if (number === undefined) {
        return false;
    }
    const exp = /(\d)(?=(\d{3})+(?!\d))/g;
    const rep = '$1.';
    let arr = number.toString().split('.');
    arr[0] = arr[0].replace(exp, rep);
    return arr[1] ? arr.join(',') : arr[0];
}

const formatoGeneral = (number) => {

    const numero = number.replace(".", "");
    const numero1 = numero.replace(",", ".");
    return numero1;

}

/* Cargar lineas */

$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: '../../html/php/cargarLineas.php',
        data: { operacion: 1 },

        success: function (r) {
            info = JSON.parse(r);

            let $select = $('.select-Linea');
            $select.empty();

            $select.append('<option disabled selected>' + "Seleccionar" + '</option>');

            $.each(info.data, function (i, value) {
                $select.append('<option value ="' + value.id + '">' + value.linea + '</option>');
            });
        }
    });
});