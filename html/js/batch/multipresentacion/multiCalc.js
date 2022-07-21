$(document).ready(function() {
    //calcular Tamaño del Lote

    CalculoloteMulti = (id) => {

        const referencia = $(`#MultiReferencia${id}`).val();
        const densidad = $(`#densidadMulti${id}`).val();
        const presentacion = $(`#presentacionMulti${id}`).val();
        //const lote = $("#loteTotal").val();
        cantidad = $(`#cantidadMulti${id}`).val();

        let totalKg = 0;

        if (referencia == undefined) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Seleccione la presentación.");
            return false;
        }

        if (cantidad == 0) {
            alertify.set("notifier", "position", "top-right");
            alertify.notify("Ingrese las unidades por presentación.");
            return false;
        }

        /* Calcula el lote de la presentacion de acuerdo con la seleccion */

        let lotePresentacion = parseInt((densidad * cantidad * presentacion) / 1000);
        $(`#tamanioloteMulti${id}`).val(lotePresentacion);

        /* Suma todos los lotes */

        for (let i = 1; i <= id; i++)
            totalKg = parseFloat(totalKg) + parseFloat($(`#tamanioloteMulti${i}`).val());

        $("#sumaMulti").val(totalKg);

        /* Valida que un lote no este por fuera del rango */

        if (totalKg > 2500) {
            alertify.set("notifier", "position", "top-right");
            alertify.error("El total en Kg supera el tamaño máximo por lote");
            $("#sumaMulti").val("");
            $(`#cantidadMulti${id}`).val("");
            $(`#tamanioloteMulti${id}`).val("");
            return false;
        }
    }
});