
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

/* Deshabilitar bon verificado */
$(document).ready(function () {
    /* $('#despeje_verificado').css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true); */
    
    
    $('#despeje_verificado').prop("disabled", false);


});

/* cargar batch al finalizar la carga de los demas procesos */

$(document).ready(function () {
    setTimeout(() => {
        cargarBatch();
    }, 1000);
});


/* Modulo */

$.ajax({
    method: 'POST',
    url: '../../html/php/modulo.php',
    data: { proceso: proceso },

    success: function (data) {
        if (data !== '') {
            const info = JSON.parse(data);
            modulo = info[0].id;

            carguepreguntas(modulo);
            desinfectantes();
            cargueCondicionesMedio();
            validarTanques(modulo);
            cargarSelectorIncidencias();

        }
    }
});

/* Carga de datos de informacion del batch record seleccionado */

$.ajax({
    url: `../../api/batch/${idBatch}`,
    type: 'GET'
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

    if (proceso === 'Envasado') {
        cargarTablaEnvase(batch);
        calcularPeso(batch);
        calcularMuestras(batch);
    }
});


/* Calcular la fecha del dia  */

function fechaHoy() {
    var d = new Date();

    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fechaActual = d.getFullYear() + '/' + (mes < 10 ? '0' : '') + mes + '/' + (dia < 10 ? '0' : '') + dia;
}

/* formato de numeros */

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