$(document).ready(function() {

    //Guardar Multi

    $('#btnCargarKg').click(function(e) {

        e.preventDefault();
        let totalCantidades = 0;
        const ref = [];
        let j = 1;

        //contar Multipresentacion
        objetos = $(".multi").length;
        totalKg = $('#sumaMulti').val();
        //obtener referencias

        for (i = 0; i < objetos; i++) {
            const multi = {};

            multi.referencia = $(`#MultiReferencia${j}`).val();
            multi.cantidadunidades = $(`#cantidadMulti${j}`).val();
            multi.tamaniopresentacion = $(`#tamanioloteMulti${j}`).val();

            totalCantidades = totalCantidades + parseInt($(`#cantidadMulti${j}`).val());

            if (multi.referencia || multi.cantidadunidades || multi.tamaniopresentacion)
                ref.push(multi);
            j++;
        }

        multi = JSON.stringify(ref)
        sessionStorage.setItem('multi', multi)
        $('#Modal_Multipresentacion').modal('hide');

        totalKg = $('#sumaMulti').val();
        totalTamaniolote = totalKg * (1 + ajuste)

        $('#tamanototallote').val(totalTamaniolote.toFixed(2));
        $('#unidadesxlote').val(totalCantidades);

    });

    guardar_Multi = (ref) => {

        $.ajax({
            type: "POST",
            url: "php/multi.php",
            data: { operacion: "4", ref, id: idBatch },

            success: function(r) {
                if (r == 1) {
                    alertify.set("notifier", "position", "top-right");
                    alertify.success("Multipresentación registrada con éxito.");
                    cerrarModal();
                    debugger
                    const ajuste = $("#ajuste").val();
                    $('#tamanototallote').val(totalKg * (1 + ajuste));
                    //actualizarTabla();
                } else {
                    alertify.set("notifier", "position", "top-right");
                    alertify.error("No se registro la Multipresentacion. Valide nuevamente.");
                }
            },
            error: function(r) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Error al registrar la Multipresentación.");
            },
        });

    }

});