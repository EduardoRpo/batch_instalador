/* Mostrar Batch para Impresion */

$(".pdf").click(function(e) {
    e.preventDefault();
    $("#m_batch_pdf").modal();
    /* $("#tabla_batch_pdf").dataTable().fnDestroy();
    cargartablabatch_pdf(); */
});

$('#titleBatchEliminado').hide();


$("#buscar_batch").click(function(e) {
    e.preventDefault();
    let idBatch = $("#search").val();
    $.get(`/api/batch/${idBatch}`, function(data, textStatus, jqXHR) {
        if ((textStatus = "success")) {
            if (data) {
                $("#search").val("");
                $("#batchpdf").html(`Batch: ${idBatch}`);
                $("#ref").html(data.referencia);
                $("#prod").html(data.nombre_referencia);
                $("#lote").html(data.numero_lote);
                $("#accions").empty();
                $("#accions").append(
                    `<a href="/pdf/${idBatch}/${data.referencia}" target="_blank"><i class="fas fa-external-link-alt"></i></a>`
                );

                if (data.estado == 0)
                    $('#titleBatchEliminado').show();
                else
                    $('#titleBatchEliminado').hide();

            } else {
                alertify.set("notifier", "position", "top-right");
                alertify.error("Valor buscado no existe.");
                $("#search").val("");
                $("#batchpdf").html("");
                $("#ref").html("");
                $("#prod").html("");
                $("#lote").html("");
                $("#accions").empty();
                $("#accions").append("");
            }
        }
    });
});

$('[data-toggle="popover"]').popover();