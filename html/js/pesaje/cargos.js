$(document).ready(function() {
    /* Carga de Cargos  */

    $.ajax({
        url: `/api/cargos`,
        type: 'GET',
    }).done((data, status, xhr) => {
        data.forEach((cargo, indx) => {
            $(`#cargo-${indx + 1}`).val(cargo.cargo)
        })
    })

});