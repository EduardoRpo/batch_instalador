
/* carga de maquinas */

function cargarEquipos() {

    //let linea = $(".select-Linea").val();
    if (modulo == 6)
        linea = $(`#select-Linea${id_multi}`).val();

    $.ajax({
        method: 'POST',
        url: '../../html/php/cargarMaquinas.php',
        //data: { linea: linea },

        success: function (response) {
            if (response == "")
                return false;
            const info = JSON.parse(response);

            if (modulo == 3) {
                $('#sel_agitador').val(info.data[0].equipo);
                $('#sel_marmita').val(info.data[1].equipo);
            }

        },
        error: function (response) {
            console.log(response);
        }
    })
}
