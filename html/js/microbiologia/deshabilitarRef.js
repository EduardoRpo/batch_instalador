$(document).ready(function() {
    bloquearReferenciasGuardar = (data) => {
        for (let i = 2; i < data.length; i++) {
            let multi = data[i].multi
            $(`.inputMesofilos${multi}`).prop('disabled', true);
            $(`#pseudomona${multi}`).prop('disabled', true)
            $(`#escherichia${multi}`).prop('disabled', true);
            $(`#staphylococcus${multi}`).prop('disabled', true);
            $(`#fechaSiembra${multi}`).prop('disabled', true);
            $(`#fechaResultados${multi}`).prop('disabled', true);
        }
    }
});