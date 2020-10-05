
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

            cargueDesinfectantes();
            carguepreguntas(modulo);
            cargueCondicionesMedio();
            validarTanques(modulo);
        }
    }
});


/* Cargar desinfectantes */
function cargueDesinfectantes() {

    $.ajax({
        url: `../../api/desinfectantes`,
        type: 'GET'
    }).done((data, status, xhr) => {
        data.forEach(desinfectante => {
            $('#sel_producto_desinfeccion').append(`<option value="${desinfectante.id}">${desinfectante.nombre}</option>`);
        });
    });
}

/* cargue de preguntas */

function carguepreguntas(data) {
    proceso = data;

    $.ajax({
        url: `../../api/questions/${proceso}`,
        type: 'GET'
    }).done((data, status, xhr) => {
        cantidadpreguntas = data.length;

        $('#preguntas-div').html('');
        data.forEach((question, indx) => {
            $('#preguntas-div').append(`
                    <a for="recipient-name" class="col-form-label" id="${question.id}">${question.pregunta}</a>
                    <label class="checkbox"> 
                    <input type="radio" class="questions" name="question-${question.id}" id="S${question.id_pregunta}" value="1"/></label>
                    <label class="checkbox"> 
                    <input type="radio" name="question-${question.id}" id="N${question.id_pregunta}" value="0"/></label>`
            );
        });

    });
}

/* Mostrar ventana de Condiciones Medio de acuerdo con el tiempo establecido en la BD*/

function cargueCondicionesMedio() {
    $.ajax({
        'type': 'POST',
        'url': '../../html/php/condicionesmedio.php',
        'data': { operacion: "1", modulo: proceso },

        success: function (resp) {

            if (resp == 3) {
                return false;
            }
            let t = JSON.parse(resp);
            let tiempo = Math.round(Math.random() * (t[0].t_max - t[0].t_min) + parseInt(t[0].t_min));

            setTimeout(function () {
                $("#m_CondicionesMedio").modal("show");
            }, tiempo * 60000);
        }
    });
}


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


/* Carga de tanques para mostrar en los proceso de pesaje, preparacion y aprobacion */

function validarTanques(modulo) {
    if (modulo == 2 || modulo == 3 || modulo == 4) {
        let cantidad = 0;
        ocultarfilasTanques(5);
    }

}

/* Ocultar filas tanques */

function ocultarfilasTanques(filas) {
    filas = filas + 1;
    for (let i = filas; i < 6; i++) {
        $(`#fila${i}`).attr("hidden", true);
    }
    cargarTanques();
}

/* Cargar Tanques de acuerdo al batch */

function cargarTanques() {
    $.ajax({

        'method': 'POST',
        'url': '../../html/php/tanques.php',
        'data': { id: idBatch },

        success: function (data) {
            var info = JSON.parse(data);
            if (info == '') { return false; }

            var j = 1;

            for (let i = 0; i < info.length; i++) {
                $(`#tanque${j}`).html(formatoCO(info[i].tanque));
                $(`#cantidad${j}`).html(info[i].cantidad);
                $(`#total${j}`).html(formatoCO(info[i].tanque * info[i].cantidad));
                j++;

                cantidad = cantidad + parseInt(info[i].cantidad);
            }
            ocultarfilasTanques(info.length);

            if (proceso === "2" || proceso === "3") {
                controlProceso(cantidad);
            } else if (proceso === "4") {
                cargaTanquesControl(cantidad);
            }


        },
        error: function (r) {
            alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar los tanques.");
        }

    });
}


/* tabla de observaciones en la pestaña de informacion del producto */

$(document).ready(function () {
    $('#txtobservacionesTanques').DataTable({
        "scrollY": "100px", "scrollCollapse": true, searching: false, paging: false, info: false, ordering: false,
        columnDefs: [{
            targets: "_all",
            sortable: false
        }],
    });

    $('.dataTables_length').addClass('bs-select');
});


/* Mostrar los checkbox de acuerdo con la cantidad de tanques */

function controlProceso(cantidad) {

    if (cantidad > 10) {
        cantidad = 10;
    }

    for (let i = 1; i <= cantidad; i++) {
        $(".chk-control").append(`<input type="checkbox" id="chkcontrolTanques${i}" style="height: 30px; width:30px;">`);
    }
}

/* Almacenar informacion de condiciones del medio */

function guardar_condicionesMedio() {

    let proceso = $('h1').text();
    let temperatura = $('#temperatura').val();
    let humedad = $('#humedad').val();
    let url = $(location).attr('href');
    let id_batch = url.split("/");

    if (temperatura === "" || humedad === "") {
        alertify.set("notifier", "position", "top-right"); alertify.error("Complete todos los datos para continuar con el proceso.");
        return false;
    }

    $('#m_CondicionesMedio').modal('hide');

    $.ajax({
        'type': 'POST',
        'url': '../../html/php/condicionesmedio.php',
        'data': {
            operacion: "2",
            modulo: proceso,
            temperatura: temperatura,
            humedad: humedad,
            id: id_batch[4]
        },

        success: function (resp) {
            alertify.set("notifier", "position", "top-right"); alertify.success("Condiciones del Medio Almacenado");
        }
    });
    //return false;
}

//Validacion campos de preguntas diligenciados

$('.in_desinfeccion').click((event) => {
    event.preventDefault();

    let flag = false;
    $('.questions').each((indx, question) => {
        if (flag) {
            return;
        }
        let name = $(question).attr('name');
        if (!$(`input[name='${name}']:radio`).is(':checked')) {
            flag = true;

            $.alert({
                theme: 'white',
                icon: 'fa fa-warning',
                title: 'Samara Cosmetics',
                content: 'Antes de continuar, complete todas las preguntas',
                confirmButtonClass: 'btn-info',
            });
        }
    });
});


function validarParametrosControl() {
    let flag = false;
    $('.questions').each((indx, question) => {
        if (flag) {
            return;
        }
        let name = $(question).attr('name');
        if (!$(`input[name='${name}']:radio`).is(':checked')) {
            flag = true;

            $.alert({
                theme: 'white',
                icon: 'fa fa-warning',
                title: 'Samara Cosmetics',
                content: 'Antes de continuar, complete todas las preguntas',
                confirmButtonClass: 'btn-info',
            });
            completo = 0;
            return false;
        }
        completo = 1;
    });
}


/* Calcular la fecha del dia  */

function fechaHoy() {
    var d = new Date();

    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fechaActual = d.getFullYear() + '/' + (mes < 10 ? '0' : '') + mes + '/' + (dia < 10 ? '0' : '') + dia;
}

/* carga de maquinas */

function cargarMaquinas() {
    const linea = $("#select-Linea").val();

    $.ajax({
        method: 'POST',
        url: '../../html/php/cargarMaquinas.php',
        data: { linea: linea },

        success: function (response) {
            const info = JSON.parse(response);

            $('.txtEnvasadora').val('');
            $('.txtLoteadora').val('');
            $('#sel_agitador').val('');
            $('#sel_marmita').val('');
            $('#sel_banda').val('');
            $('#sel_etiqueteadora').val('');
            $('#sel_tunel').val('');

            $('#sel_agitador').val(info.data[0].maquina);
            $('#txtBanda').val(info.data[1].maquina);
            $('.txtEnvasadora').val(info.data[2].maquina);
            $('#txtEtiqueteadora').val(info.data[3].maquina);
            $('.txtLoteadora').val(info.data[4].maquina);
            $('#sel_marmita').val(info.data[5].maquina);
            $('#txtTunel').val(info.data[6].maquina);

        },
        error: function (response) {
            console.log(response);
        }
    })
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