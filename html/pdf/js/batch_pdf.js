
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
    //data = { operacion: 2, id };
    info_General();
    parametros_Control();
    area_desinfeccion();
    desinfectante();
    condiciones_medio();
});




function info_General() {

    $.post("../../html/php/c_batch_pdf.php", data = { operacion: 2, id },
        function (data, textStatus, jqXHR) {
            if (data == 'false')
                return false;
            let info = JSON.parse(data);
            $('#ref').val(info.referencia);
            $('#nref').val(info.nombre_referencia);
            $('#marca').val(info.marca);
            $('#propietario').val(info.propietario);
            $('#notificacion').val(info.notificacion);
            $('#presentacion').val(info.presentacion);
            $('#orden').val(info.numero_orden);
            $('#lote').val(info.numero_lote);
            $('.fecha').val(info.fecha_creacion);
            $('#tamanolt').val(info.tamano_lote);
            $('#tamanol').val(info.tamano_lote);
            $('#unidades').val(info.unidad_lote);
            $('.fecha').html(info.fecha_creacion);
        });
}

function parametros_Control() {

    for (let k = 2; k < 7; k++) {
        k == 4 ? k++ : k;
        let data = { operacion: 3, id, modulo: k }

        $.post("../../html/php/c_batch_pdf.php", data,
            function (data, textStatus, jqXHR) {
                if (data == 'false')
                    return false;
                let info = JSON.parse(data);
                let j = 1;
                for (let i = 0; i < info.length; i++) {
                    $(`#despeje_linea${k}`).append(`
                    <tr>
                        <th scope="row" class="centrado">${j}</th>
                        <td>${info[i].pregunta}</td>
                        <td class="centrado">${info[i].solucion == 1 ? 'X' : ''}</td>
                        <td class="centrado">${info[i].solucion == 0 ? 'X' : ''}</td>
                    </tr>`);
                    j++;
                }

            });
    }
}

function area_desinfeccion() {
    for (let k = 2; k < 7; k++) {
        //k == 4 ? k++ : k;
        let data = { operacion: 4, modulo: k };

        $.post("../../html/php/c_batch_pdf.php", data,
            function (data, textStatus, jqXHR) {
                if (data == 'false')
                    return false;

                let info = JSON.parse(data);
                let j = 1;

                for (let i = 0; i < info.length; i++) {
                    $(`#area_desinfeccion${k}`).append(`
                        <tr>
                            <td>${info[i].descripcion}</td>
                            <td class="centrado desinfectante${k}"></td>
                            <td class="centrado concentracion${k}"></td>
                            <td></td>
                        </tr>`
                    )
                    j++;
                }
            });
    }
}

function desinfectante() {
    for (let k = 2; k < 7; k++) {
        //k == 4 ? k++ : k;
        let data = { operacion: 5, modulo: k, id };

        $.post("../../html/php/c_batch_pdf.php", data,
            function (data, textStatus, jqXHR) {
                if (data == 'false')
                    return false;

                let info = JSON.parse(data);
                
                $(`.desinfectante${k}`).html(info.desinfectante);
                $(`.concentracion${k}`).html(info.concentracion);
                
            });
    }
}

function condiciones_medio() {
    for (let k = 2; k < 7; k++) {
        k == 4 ? k++ : k;
        let data = { operacion: 6, id, modulo: k }
        $.post("../../html/php/c_batch_pdf.php", data,
            function (data, textStatus, jqXHR) {
                if (data == 'false')
                    return false;
                let info = JSON.parse(data);
                $(`#fecha_medio${k}`).html(info.fecha);
                $(`#temperatura${k}`).html(info.temperatura + ' °C');
                $(`#humedad${k}`).html(info.humedad + ' %');

            });
    }
}
