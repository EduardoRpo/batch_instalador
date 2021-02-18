
/* bloquear inputs */
$("input").prop('readonly', true);


/* Imprimir pdf */
$(document).on('click', '.link-imprimir', function (e) {
    e.preventDefault();
    $(location).attr('href', "pdf.php");
});

/* cerrar ventana */
$(document).on('click', '.link-cerrar', function (e) {
    e.preventDefault();
    window.close();
});

/* Cargar data */

$(document).ready(function () {
    id = sessionStorage.getItem('id');

    cargar_Alertas();
    info_General();
    parametros_Control();
    area_desinfeccion();
    desinfectante();
    condiciones_medio();
    control_proceso();
});


function cargar_Alertas() {
    $.post("../../html/php/c_batch_pdf.php", data = { operacion: 7 },
        function (data, textStatus, jqXHR) {

            info = JSON.parse(data);

            for (let i = 0; i < info.length; i++) {
                data = Object.values(JSON.parse(info[i].descripcion));
                $(`#title${info[i].ubicacion}`).html('<b>' + data[0].titulo + '</b>');

                for (let j = 0; j < data[0].vinetas.length; j++) {
                    $(`#vinetas${info[i].ubicacion}`).append(
                        `<li>${data[0].vinetas[j]}</li>`

                    );
                }
            }
        });
}

function info_General() {

    $.post("../../html/php/c_batch_pdf.php", data = { operacion: 2, id },
        function (data, textStatus, jqXHR) {
            if (data == 'false')
                return false;
            let info = JSON.parse(data);
            $('#ref').html(info.referencia);
            $('#nref').html('<b>' + info.nombre_referencia + '</b>');
            $('#marca').html('<b>' + info.marca + '</b>');
            $('#propietario').html('<b>' + info.propietario + '</b>');
            $('#notificacion').html('<b>' + info.notificacion + '</b>');
            $('#presentacion').html('<b>' + info.presentacion + '</b>');
            $('#orden').html('<b>' + info.numero_orden + '</b>');
            $('#lote').html('<b>' + info.numero_lote + '</b>');
            $('.fecha').html('<b>' + info.fecha_creacion + '</b>');
            $('#tamanolt').html('<b>' + info.tamano_lote + '</b>');
            $('#tamanol').html('<b>' + info.tamano_lote + '</b>');
            $('#unidades').html('<b>' + info.unidad_lote + '</b>');
            $('.fecha').html('<b>' + info.fecha_creacion + '</b>');
            especificaciones_producto();
        });
}

function parametros_Control() {

    let data = { operacion: 3, id }

    $.post("../../html/php/c_batch_pdf.php", data,
        function (data, textStatus, jqXHR) {
            if (data == 'false')
                return false;
            let info = JSON.parse(data);
            let j = 1;
            let modulo = 1;

            for (let i = 0; i < info.length; i++) {

                if (modulo == info[i].id_modulo)
                    j++;
                else {
                    j = 1;
                    modulo = info[i].id_modulo;
                }

                $(`#despeje_linea${info[i].id_modulo}`).append(`
                    <tr>
                        <th scope="row" class="centrado">${j}</th>
                        <td>${info[i].pregunta}</td>
                        <td class="centrado">${info[i].solucion == 1 ? 'X' : ''}</td>
                        <td class="centrado">${info[i].solucion == 0 ? 'X' : ''}</td>
                    </tr>`);
            }

        });
}

function area_desinfeccion() {
    let data = { operacion: 4 };

    $.post("../../html/php/c_batch_pdf.php", data,
        function (data, textStatus, jqXHR) {
            if (data == 'false')
                return false;

            let info = JSON.parse(data);

            for (let i = 0; i < info.data.length; i++) {
                $(`#area_desinfeccion${info.data[i].modulo}`).append(`
                    <tr>
                        <td>${info.data[i].descripcion}</td>
                        <td class="centrado desinfectante${info.data[i].modulo}"></td>
                        <td class="centrado concentracion${info.data[i].modulo}"></td>
                        <td></td>
                    </tr>`
                )
            }
        });
}


function desinfectante() {
    let data = { operacion: 5, id };

    $.post("../../html/php/c_batch_pdf.php", data,
        function (data, textStatus, jqXHR) {
            if (data == 'false')
                return false;

            let info = JSON.parse(data);
            for (let i = 0; i < info.length; i++) {
                $(`#blank_rea${info[i].modulo}`).hide();
                $(`#blank_ver${info[i].modulo}`).hide();
                $(`.desinfectante${info[i].modulo}`).html(info[i].desinfectante);
                $(`.concentracion${info[i].modulo}`).html(info[i].concentracion * 100 + '%');
                $(`#fecha${info[i].modulo}`).html(info[i].fecha_registro);

                if (info[i].realizo != 0) {
                    $(`#f_realizo${info[i].modulo}`).prop('src', info[i].realizo);
                    $(`#user_realizo${info[i].modulo}`).html('Realizó: ' + '<b>' + info[i].nombre_realizo + '</b>');
                } else if (info[i].realizo == 0) {
                    $(`#f_realizo${info[i].modulo}`).prop('hide', true);
                    $(`#blank_rea${info[i].modulo}`).show();
                    $(`#user_realizo${info[i].modulo}`).html('Realizó: ' + '<b> Sin firmar</b>');
                }
                if (info[i].verifico != 0) {
                    $(`#f_verifico${info[i].modulo}`).prop('src', info[i].verifico);
                    $(`#user_verifico${info[i].modulo}`).html('Verificó: ' + '<b>' + info[i].nombre_verifico + '</b>');
                } else {
                    $(`#f_verifico${info[i].modulo}`).hide();
                    $(`#blank_ver${info[i].modulo}`).show()
                    $(`#user_verifico${info[i].modulo}`).html('Verificó: ' + '<b>Sin firmar</b>');
                }
            }

        });
}

function condiciones_medio() {
    let data = { operacion: 6, id }
    $.post("../../html/php/c_batch_pdf.php", data,
        function (data, textStatus, jqXHR) {
            if (data == 'false')
                return false;
            let info = JSON.parse(data);

            for (let i = 0; i < info.length; i++) {
                $(`#fecha_medio${info[i].modulo}`).html(info[i].fecha);
                $(`#temperatura${info[i].modulo}`).html(info[i].temperatura + ' °C');
                $(`#humedad${info[i].modulo}`).html(info[i].humedad + ' %');
            }
        });
}

function especificaciones_producto() {
    
    referencia = $('#ref').html();
    $.ajax({
        url: `/api/productsDetails/${referencia}`,

        type: 'GET'
    }).done((data, status, xhr) => {

        $('#espec_color').html(data.color);
        $('#espec_olor').html(data.olor);
        $('#espec_apariencia').html(data.apariencia);
        $('#espec_poder_espumoso').html(data.poder_espumoso);

        $('#espec_untosidad').html(data.untuosidad);
        $('#espec_ph').html(`${data.limite_inferior_ph} a ${data.limite_superior_ph}`);

        $('#in_ph').attr('min', data.limite_inferior_ph);
        $('#in_ph').attr('max', data.limite_superior_ph);

        $('#espec_densidad').html(`${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`);

        $('#in_densidad').attr('min', data.limite_inferior_densidad_gravedad);
        $('#in_densidad').attr('max', data.limite_superior_densidad_gravedad);

        $('#espec_grado_alcohol').html(`${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`);

        $('#in_grado_alcohol').attr('min', data.limite_inferior_grado_alcohol);
        $('#in_grado_alcohol').attr('max', data.limite_superior_grado_alcohol);

        $('#espec_viscidad').html(`${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`);

        $('#in_viscocidad').attr('min', data.limite_inferior_viscosidad);
        $('#in_viscocidad').attr('max', data.limite_superior_viscosidad);
    });
}


function control_proceso() {

    let data = { operacion: 10, id }
    $.post("../../html/php/c_batch_pdf.php", data,
        function (data, textStatus, jqXHR) {
            if (data == 'false')
                return false;

            let info = JSON.parse(data);
            for (let i = 0; i < info.length; i++) {
                $(`.color${info[i].modulo}`).html(info[0].color == 1 ? 'Cumple' : info[0].color == 2 ? 'No Cumple' : 'No aplica');
                $(`.olor${info[i].modulo}`).html(info[0].olor == 1 ? 'Cumple' : info[0].color == 2 ? 'No Cumple' : 'No aplica');
                $(`.apariencia${info[i].modulo}`).html(info[0].apariencia == 1 ? 'Cumple' : info[0].color == 2 ? 'No Cumple' : 'No aplica');
                $(`.ph${info[i].modulo}`).html(info[0].ph);
                $(`.viscosidad${info[i].modulo}`).html(info[0].viscosidad);
                $(`.densidad${info[i].modulo}`).html(info[0].densidad);
                $(`.untuosidad${info[i].modulo}`).html(info[0].untuosidad == 1 ? 'Cumple' : info[0].color == 2 ? 'No Cumple' : 'No aplica');
                $(`.espumoso${info[i].modulo}`).html(info[0].espumoso == 1 ? 'Cumple' : info[0].color == 2 ? 'No Cumple' : 'No aplica');
                $(`.alcohol${info[i].modulo}`).html(info[0].alcohol == 1 ? 'Cumple' : info[0].color == 2 ? 'No Cumple' : 'No aplica');
            }
        });

}