$(document).ready(function () {

    /* Calcular peso minimo, maximo y promedio */

    identificarDensidad = (batch) => {
        let densidadAprobada = 0;
        $.ajax({
            type: "POST",
            url: "../../html/php/controlProceso.php",
            data: { modulo: 4, idBatch },

            success: function (response) {
                if (response == 0) return false;
                else {
                    let espec = JSON.parse(response);
                    for (let i = 0; i < espec.length; i++) {
                        densidadAprobada = densidadAprobada + espec[i].densidad;
                    }
                    densidadAprobada = densidadAprobada / espec.length;
                    $('.densidadAprobada').html(`Especificaciones Técnicas - Densidad Aprobada ${densidadAprobada}`);
                    calcularPeso(densidadAprobada);
                }
            },
        });
    }

    calcularPeso = (densidadAprobada) => {
        let peso_min = batch.presentacion * densidadAprobada;
        let peso_max = peso_min * (1 + 0.01);
        let prom = (parseFloat(peso_min) + peso_max) / 2;
        let pdensidadAprob = peso_max / densidadAprobada;
        let promml = prom / densidadAprobada

        $(`.minimo`).val(`${peso_min.toFixed(2)} gr - (${(peso_min / densidadAprobada).toFixed(2)} ml)`);
        $(`.medio`).val(`${prom.toFixed(2)} gr - (${promml.toFixed(2)} ml)`);
        $(`.maximo`).val(`${peso_max.toFixed(2)} gr - (${pdensidadAprob.toFixed(2)} ml)`);
    }

});