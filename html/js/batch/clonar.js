//Clonar un Batch Record
var data

$(document).ready(function() {

    clonar = () => {
        if ($("input[name='optradio']:radio").is(":checked")) {
            $("#txtCantidadCB").val("");
            $("#ClonarModal").modal("show");
            $("#txtCantidadCB").focus();
        } else {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Para Clonar seleccione un Batch Record");
        }
    }

    $("#tablaBatch tbody").on("click", "tr", function() {
        //data = tabla.row(this).data();
        data = tablaBatch.row(this).data();
    });

    $("#form_clonar").submit(function(event) {
        event.preventDefault();
        if ($("input[name='optradio']:radio").is(":checked")) {
            var duplicar = $("#txtCantidadCB").val();
            clonarCantidad = parseInt(duplicar);

            if (clonarCantidad > 10) {
                alertify.set("notifier", "position", "top-right");
                alertify.error("El número máximo para clonar son 9 Batch Record");
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "/html/php/crearbatch/clonar.php",
                    data: { id: data.id_batch, referencia: data.referencia, clonarCantidad },

                    success: function(r) {
                        if (r >= 1) {
                            alertify.set("notifier", "position", "top-right");
                            alertify.success("Batch Record Clonado.");
                            $("#ClonarModal").modal("hide");
                            actualizarTabla();
                        } else {
                            alertify.set("notifier", "position", "top-right");
                            alertify.error("Ocurrió algún error. Intente nuevamente.");
                        }
                    },
                });
            }
        } else {
            alertify.set("notifier", "position", "top-right");
            alertify.error("Imposible clonar");
        }
    });

});