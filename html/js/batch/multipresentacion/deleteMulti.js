$(document).ready(function() {

    //Eliminar Multipresentacion

    eliminarMulti = (id) => {
        var confirm = alertify
            .confirm(
                "Batch Record",
                `Está seguro de eliminar este registro. Está acción no podra reversarse`,
                null,
                null
            ).set("labels", { ok: "Si", cancel: "No" });

        confirm.set("onok", function() {
            let totalKg = 0;
            objetos = $(".multi").length;
            let ref = $(`#MultiReferencia${id}`).val();

            $(`#MultiReferencia${id}`).remove();
            $(`#cantidadMulti${id}`).remove();
            $(`#tamanioloteMulti${id}`).remove();
            $(`.btneliminarMulti${id}`).remove();
            $(`#densidadMulti${id}`).remove();
            $(`#presentacionMulti${id}`).remove();

            /* Suma todos los lotes */
            for (let i = 1; i <= objetos; i++) {
                tamaniolote = $(`#tamanioloteMulti${i}`).val();
                if (tamaniolote)
                    totalKg =
                    parseFloat(totalKg) + parseFloat($(`#tamanioloteMulti${i}`).val());
            }
            $("#sumaMulti").val(totalKg);
            data = { id: data.id_batch, ref, operacion: 5 };

            $.post("php/multi.php", data, function(data, textStatus, jqXHR) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Registro eliminado exitosamente");
            });
        });
    }
});