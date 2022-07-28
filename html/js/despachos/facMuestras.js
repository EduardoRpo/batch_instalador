$(document).ready(function() {
    /* Cargar facturacion de muestras */

    fact_muestras = (referencia, i) => {
        $.post("/html/php/servicios/despachos/fact_muestras.php", { referencia },
            function(data, textStatus, jqXHR) {
                data = JSON.parse(data);
                muestras = $(`#muestras_retencion_acond${i}`).val();
                if (data[0].facturar) $(`#fact${i}`).show();
            }
        );
    };
});