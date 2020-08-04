
let idBatch = location.href.split('/')[4];
let referencia = location.href.split('/')[5];
let proceso = $('h1').text();
var batch;
let template;


Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

$('#in_fecha').val(new Date().toDateInputValue());
$('#in_fecha').attr('min', new Date().toDateInputValue());

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
    $('#in_linea').val(data.nombre_linea);
    $('#in_fecha_programacion').val(data.fecha_programacion);
    $('#in_tamano_lote').val(tamano_lote);

    if (proceso === 'Envasado') {
        cargarTablaEnvase(batch);
        calcularPeso(batch);
        calcularMuestras(batch);
    }
});

/* Carga de tanques para mostrar en los proceso de pesaje, preparacion y aprobacion */
let cantidad = 0;
$.ajax({

    'method': 'POST',
    'url': '../../html/php/tanques.php',
    'data': { id: idBatch },

    success: function (data) {
        var info = JSON.parse(data);

        if (info === undefined) {
            alertify.set("notifier", "position", "top-right"); alertify.error("No se encontró información de Tanques.");
        } else {
            template = 'Tanque            Cantidad              Total ';
            document.getElementById("observaciones").value += template + '\n';
            for (i = 0; i < info.length; i++) {
                template = '    ' + info[i].tanque + '                      ' + info[i].cantidad + '                   ' + info[i].tanque * info[i].cantidad;
                document.getElementById("observaciones").value += template + '\n';
                cantidad = cantidad + parseInt(info[i].cantidad);

            }
        }

        if (proceso === "Pesaje" || proceso === "Preparación") {
            controlProceso(cantidad);
        } else if (proceso === "Aprobación") {
            cargaTanquesControl(cantidad);
        }


    },
    error: function (r) {
        alertify.set("notifier", "position", "top-right"); alertify.error("Error al Cargar los tanques.");
    }

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

/* Mostrar ventana de Condiciones Medio de acuerdo con el tiempo establecido en la BD*/

$(document).ready(function () {

    $.ajax({
        'type': 'POST',
        'url': '../../html/php/condicionesmedio.php',
        'data': { operacion: "1", modulo: proceso },

        success: function (resp) {

            let t = JSON.parse(resp);
            let tiempo = Math.round(Math.random() * (t.max - t.min) + parseInt(t.min));
            //setTimeout(function(){  $("#m_CondicionesMedio").modal("show").modal({backdrop: 'static', keyboard: false}); }, tiempo*60000);
            setTimeout(function () {
                $("#m_CondicionesMedio").modal("show");
            }, tiempo * 60000); //.modal({backdrop: 'static', keyboard: false})
        }
    });
    return false;

});

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
    return false;

}


/* Cargar desinfectantes */

$.ajax({
    url: `../../api/desinfectantes`,
    type: 'GET'
}).done((data, status, xhr) => {
    data.forEach(desinfectante => {
        $('#sel_producto_desinfeccion').append(`<option value="${desinfectante.id}">${desinfectante.nombre}</option>`);
    });
});

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
            debugger
            $('.txtEnvasadora').val('');
            $('.txtLoteadora').val('');
            $('#sel_agitador').val('');
            $('#sel_marmita').val('');
            $('#sel_banda').val('');
            $('#sel_etiqueteadora').val('');
            $('#sel_tunel').val('');

            /* $('.txtEnvasadora').val(info[0].envasadora);
            $('.txtLoteadora').val(info[0].loteadora);
            $('#sel_agitador').val(info[0].agitador);
            $('#sel_marmita').val(info[0].marmita); */
            
            $('#sel_agitador').val(info[0].maquina);
            $('#txtBanda').val(info[1].maquina);
            $('.txtEnvasadora').val(info[2].maquina);
            $('#txtEtiqueteadora').val(info[3].maquina);
            $('.txtLoteadora').val(info[4].maquina);
            $('#sel_marmita').val(info[5].maquina);
            $('#txtTunel').val(info[6].maquina);

        },
        error: function (response) {
            console.log(response);
        }
    })
}

/* formato de numeros */

const formatoCO = (number) => {

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



/* function enviar() {
    $('#myModal2').modal('hide');
    let usuario = $('#usuariomodal2').val();
    console.log(usuario);
    let contrasena = $('#contrasenamodal2').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',

        success: function (resp) {

            let parent = $('#in_realizado').parent();
            $('#in_realizado').remove();
            parent.append(`<img id="in_verificado" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

}

function enviar2() {

    $('#myModal3').modal('hide');
    let usuario = $('#usuariomodal3').val();
    let contrasena = $('#contrasenamodal3').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (resp) {
            let parent = $('#in_verificado').parent();
            $('#in_verificado').remove();
            parent.append(`<img id="in_verificado" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

}

function enviar3() {
    $('#myModal4').modal('hide');
    let usuario = $('#usuariomodal4').val();
    let contrasena = $('#contrasenamodal4').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (resp) {

            let parent = $('#in_realizado_2').parent();
            $('#in_realizado_2').remove();
            parent.append(`<img id="in_realizado_2" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

}

function enviar4() {

    $('#myModal5').modal('hide');
    let usuario = $('#usuariomodal5').val();
    let contrasena = $('#contrasenamodal5').val();
    let user = {
        email: usuario,
        password: contrasena
    };
    $.ajax({
        type: 'POST',
        url: '/api/user',
        data: JSON.stringify(user),
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (resp) {
            let parent = $('#in_verificado_2').parent();
            $('#in_verificado_2').remove();
            parent.append(`<img  id="in_verificado_2" src="data:image/png;base64, ${resp.firma}" height="130">`);
        }
    });
    return false;

} */