$(document).ready(function() {
    /* Cargar Materia Prima */

    materiaPrima = (tb) => {
        $.ajax({
            url: `/api/rawMaterials/${tb}`,

            success: function(info) {
                let $selectReferencia = $('#cmbreferencia')
                cargarSelect(info, $selectReferencia)
            },
            error: function(response) {
                console.log(response)
            },
        })
    }
});