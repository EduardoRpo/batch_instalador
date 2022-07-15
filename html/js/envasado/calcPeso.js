$(document).ready(function() {
    /* Calcular peso minimo, maximo y promedio */

    identificarDensidad = (batch) => {
        let densidadAprobada = 0;
        $.ajax({
            type: "POST",
            url: "../../html/php/controlProceso.php",
            data: { modulo: 4, idBatch },

            success: function(response) {
                if (response == 0) return false;
                else {
                    let espec = JSON.parse(response);
                    for (let i = 0; i < espec.length; i++) {
                        densidadAprobada = densidadAprobada + espec[i].densidad;
                    }
                    densidadAprobada = densidadAprobada / espec.length;
                    calcularPeso(densidadAprobada);
                }
            },
        });
    }

    calcularPeso = (densidadAprobada) => {
        var peso_min = batch.presentacion * densidadAprobada;
        var peso_max = peso_min * (1 + 0.01);
        var prom = (parseInt(peso_min) + peso_max) / 2;

        $(`.minimo`).val(peso_min.toFixed(2));
        $(`.maximo`).val(peso_max.toFixed(2));
        $(`.medio`).val(prom.toFixed(2));
    }

});