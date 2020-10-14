
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
