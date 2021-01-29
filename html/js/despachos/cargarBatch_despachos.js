

function cargarBatch() {
    operacion = 4;
    $.post("../../html/php/conciliacion_rendimiento.php", data = { operacion, idBatch, ref_multi, modulo },
        function (data, textStatus, jqXHR) {
            info = JSON.parse(data);
            if (info == 0)
                return false;
            $(`#unidades_recibidas${id_multi}`).val(info[0].unidades_producidas).attr('readonly', true);
            $(`#cajas${id_multi}`).val(info[0].cajas).attr('readonly', true);
            $(`#mov_inventario${id_multi}`).val(info[0].mov_inventario).attr('readonly', true);
            $(`#obs${id_multi}`).attr('readonly', true);
            firmado(info[0].urlfirma);
        },

    );
}


/* Registro de Firma */

function firmado(datos) {

    let template = '<img id=":id:" src=":firma:" alt="firma_usuario" height="130">';
    let parent;

    btn_id = $('#idbtn').val();

    parent = $(`#despacho${id_multi}`).parent();
    $(`#despacho${id_multi}`).remove();
    $(`#despacho${id_multi}`).css({ 'background': 'lightgray', 'border': 'gray' }).prop('disabled', true);

    let firma = template.replace(':firma:', datos);
    parent.append(firma).html
}