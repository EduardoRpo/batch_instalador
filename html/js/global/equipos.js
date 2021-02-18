
/* carga de maquinas */

function cargarEquipos() {

    let linea = $(".select-Linea").val();
    if (modulo == 6)
        linea = $(`#select-Linea${id_multi}`).val();

    $.ajax({
        method: 'POST',
        url: '../../html/php/cargarMaquinas.php',
        data: { linea: linea },

        success: function (response) {
            if (response == "")
                return false;
            const info = JSON.parse(response);

            /* $('.txtEnvasadora').val('');
            $('.txtLoteadora').val('');
            $('#sel_agitador').val('');
            $('#sel_marmita').val('');
            $(`#sel_banda${id_multi}`).val('');
            $(`#sel_etiqueteadora${id_multi}`).val('');
            $(`#sel_tunel${id_multi}`).val('');

            $('#sel_agitador').val(info.data[0].maquina);
            $(`#txtBanda${id_multi}`).val(info.data[1].maquina);
            $('.txtEnvasadora').val(info.data[2].maquina);
            $(`#txtEtiqueteadora${id_multi}`).val(info.data[3].maquina);
            $('.txtLoteadora').val(info.data[4].maquina);
            $('#sel_marmita').val(info.data[5].maquina);
            $(`#txtTunel${id_multi}`).val(info.data[6].maquina); */

        },
        error: function (response) {
            console.log(response);
        }
    })
}
