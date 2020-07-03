let idBatch = location.href.split('/')[4];
let referencia = location.href.split('/')[5];
let batch;

Date.prototype.toDateInputValue = (function () {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0, 10);
});

$('#in_fecha').val(new Date().toDateInputValue());
$('#in_fecha').attr('min', new Date().toDateInputValue());
$.ajax({
    url: `../../api/batch/${idBatch}`,
    type: 'GET'
}).done((data, status, xhr) => {
    batch = data;
    $('#in_numero_orden').val(data.numero_orden);
    $('#in_numero_lote').val(data.numero_lote);
    $('#in_referencia').val(data.referencia);
    $('#in_nombre_referencia').val(data.nombre_referencia);
    $('#in_linea').val(data.nombre_linea);
    $('#in_fecha_programacion').val(data.fecha_programacion);
    $('#in_tamano_lote').val(data.tamano_lote);
});

/* Cargar ventana de Condiciones Medio */

$(document).ready(function () {
    setTimeout(function(){ 
        $('#modalCondicionesMedio').modal('show'); }, Math.floor(Math.random() * (300000 - 180000)) + 180000); /* 5 min y 15min */
});

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


function fechahoy(){
    var d = new Date();

    var mes = d.getMonth() + 1;
    var dia = d.getDate();
    var fechaActual = d.getFullYear() + '/' + (mes<10 ? '0' : '') + mes + '/' + (dia<10 ? '0' : '') + dia;
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