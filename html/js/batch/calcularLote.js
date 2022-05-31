$(document).ready(function() {

    const pedidosProgramar = []

    /*    $(document).on('click', '#calcLote', function(e) {
           e.preventDefault();
           $("input:checkbox:checked").each(
               function() {
                   alert("El checkbox con valor " + this.id + " está seleccionado");
               }
           );
       });
    */

    /* Cargar la data de la fila */

    $("#tablaPreBatch tbody").on("click", "tr", function() {
        fila = tablaPreBatch.row(this).data();
    });


    $(document).on('change', '.checkboxPedidos', function(e) {
        e.preventDefault();

        if ($(this).is(':checked')) {

            pedidos = {}

            referencia = this.id
            cantidad = $(`#cant-${referencia}`).val();
            granel = fila.granel;

            if (cantidad == 0) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("La cantidad a programar no puede ser cero (0)");
                $(this).prop("checked", false);
                return false
            }

            pedidos.referencia = referencia
            pedidos.cantidad = cantidad
            pedidos.granel = granel

            pedidosProgramar.push(pedidos)



        } else {
            $(`#cant-${referencia}`).val('');
        }
    });

    $(document).on('click', '#calcLote', function(e) {

        $.ajax({
            type: "POST",
            url: "/api/calcTamanioLote",
            data: { data: pedidosProgramar },
            success: function(resp) {

            }
        });
    })
});